<?php

spl_autoload_register(function ($class) {
    $file = "class/" . str_replace('\\', '/', $class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$PROXIED_FUNCTIONS = [];

function p($fn) {
    global $PROXIED_FUNCTIONS;
    global $url;

    $id = count($PROXIED_FUNCTIONS);
    $PROXIED_FUNCTIONS[$id] = $fn;

    echo "((...params) => fetch('$url', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ fn: $id, params }) }).then(r => r.json()))";
}

class Route {
    public function __construct($pattern, $script) {
        $this->pattern = $pattern;
        $this->script = $script;
    }
}

$routes = [];
require 'routes.php';

// route the request
$script = 'view/notfound.php';
foreach($routes as $route) {
    if($url == $route->pattern) {
        $script = $route->script;
        break;
    }
}

ob_start();
require $script;
$html = ob_get_contents();
ob_end_clean();

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo $html;
        break;
    case 'POST':
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            if(!isset(
                $input['fn'],
                $input['params'],
                $PROXIED_FUNCTIONS[$input['fn']]
            )) throw new Exception();
            $data = json_encode($PROXIED_FUNCTIONS[$input['fn']](...$input['params']));
            header('Content-Type: application/json');
            echo $data;
        } catch(Exception $e) {
            http_response_code(500);
        }
}
