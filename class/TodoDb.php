<?php

class TodoDb {
    protected $db;

    public function __construct() {
        $this->db = new sqlite3('todo.sqlite3');
        //$db->query("CREATE TABLE todo (id INTEGER PRIMARY KEY, name CHAR(100), done BOOL)");
    }

    public function loadTodos() {
        $todos = [];
        
        $res = $this->db->query("SELECT id, name, done FROM todo");
        while(true) {
            $todo = $res->fetchArray(SQLITE3_ASSOC);
            if($todo === false) break;
            $todos[] = [
                'id' => $todo['id'],
                'name' => $todo['name'],
                'done' => $todo['done'] ? true : false,
            ];
        }

        return $todos;
    }

    public function addTodo($name) {
        $stmt = $this->db->prepare('INSERT INTO todo (name, done) VALUES (:name, 0)');
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    public function toggleTodo($id) {
        $stmt = $this->db->prepare('UPDATE todo SET done = done <> 1 WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteTodo($id) {
        $stmt = $this->db->prepare('DELETE FROM todo WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
