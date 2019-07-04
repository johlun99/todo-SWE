<?php
class DbHandler {
    protected function get_connection()
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=scotchbox", "root", "root");

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NUM);
            $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");

            return $conn;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}