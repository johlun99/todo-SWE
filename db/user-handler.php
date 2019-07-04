<?php
require_once("db-handler.php");

class UserHandler extends DbHandler {
    /**
     * @param $username
     * @param $email
     * @return bool
     * @throws Exception
     * Check if a user with the given credentials
     * already exists in the DB
     */
    private function check_existing_user($username, $email)
    {
        try {
            $conn = $this->get_connection();

            $stmt = $conn->prepare("SELECT username FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);

            return !!$stmt->fetch();
        } catch (PDOException $pdo) {
            throw new PDOException($pdo->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $username
     * @param $email
     * @param $password
     * @return bool
     * @throws Exception
     * Try to sign up the user, if user already exists, returns false
     */
    public function sign_up($username, $email, $password) {
        try {
            if ($this->check_existing_user($username, $email))
                return false;

            $conn = $this->get_connection();
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $email, $password]))
                return true;

            return false;
        } catch (PDOException $pdo) {
            throw new PDOException($pdo->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $username
     * @param $password
     * @return mixed
     * @throws Exception
     * Checks the login credentials and returns the
     * id of the given user
     */
    public function login_validation($username, $password)
    {
        try {
            $conn = $this->get_connection();

            $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
            $stmt->execute([$username]);

            $hash = $stmt->fetch()[0];

            if (password_verify($password, $hash)) {
                $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
                $stmt->execute([$username]);

                return $stmt->fetch()[0];
            } else {
                return false;
            }
        } catch (PDOException $pdo) {
            throw new PDOException($pdo->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}