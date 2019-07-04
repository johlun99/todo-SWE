<?php
require_once("db-handler.php");

class User extends DbHandler
{
    private $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    function __get_id(){
        return $this->id;
    }

    /**
     * @return array
     * Returns an array of the users todos
     */
    public function get_todo_list() {
        try {
            $conn = $this->get_connection();

            $stmt = $conn->prepare("SELECT id, title, description, done FROM todos WHERE user_id = ?");
            $stmt->execute([$this->id]);

            $data = array();

            while ($row = $stmt->fetch()) {
                array_push($data, array($row[0], utf8_encode($row[1]), utf8_encode($row[2]), $row[3]));
            }

            return $data;
        } catch (PDOException $pdo) {
            throw new PDOException($pdo->getMessage());
        }
    }

    public function add_todo($title, $description)
    {
        echo var_dump($this->id);
        try {
            $conn = $this->get_connection();
            $stmt = $conn->prepare("INSERT INTO todos (user_id, title, description) VALUES(?, ?, ?)");

            if ($stmt->execute([$this->id, utf8_decode($title), utf8_decode($description)]))
                return true;

            return false;
        } catch (PDOException $pdo) {
            throw new PDOException($pdo->getMessage());
        }
    }

    /**
     * @param $todo_id
     * Returns true if successful in removing the todo
     */
    public function remove_todo($todo_id) {
        try {
            $conn = $this->get_connection();
            $stmt = $conn->prepare("DELETE FROM todos WHERE user_id = ? AND id = ?");

            if ($stmt->execute([$this->id, $todo_id])) {
                return true;
            }

            return false;
        } catch (PDOException $pdo) {
            throw new PDOException($pdo->getMessage());
        }
    }

    /**
     * @param $todo_id
     * @return bool
     * Toggles the done state of the todo between 0 and 1
     */
    public function update_done_state($todo_id)
    {
        try {
            $conn = $this->get_connection();
            $stmt = $conn->prepare("UPDATE todos SET done = 1 - done WHERE id = ?");

            if ($stmt->execute([$todo_id]))
                return true;

            return false;
        } catch (PDOException $pdo) {
            throw new PDOException($pdo->getMessage());
        }
    }
}