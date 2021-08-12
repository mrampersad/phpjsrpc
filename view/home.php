<!doctype html>
<html lang="en">
    <head>
        <title>Demo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://unpkg.com/react@17.0.2/umd/react.development.js"></script>
        <script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.development.js"></script>
        <script type="text/javascript">
            const h = React.createElement
        </script>
        <?php require_once 'component/demo.php'; ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                ReactDOM.render(
                    h(Demo, null),
                    document.getElementById('root'),
                )
            })
        </script>
    </head>
    <body>
        <div id="root" class="container"></div>
    </body>
</html>
