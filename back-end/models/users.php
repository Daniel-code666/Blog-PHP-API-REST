<?php

class users
{
    private $conn;

    public $user_id;
    public $user_name;
    public $user_email;
    public $user_password;
    public $user_rol_id;
    public $user_created_at;
    public $rol_id;
    public $rol_name;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
    }

    public function getAllUsers()
    {
        $stmt = $this->conn->prepare("SELECT * FROM users JOIN roles ON rol_id = user_rol_id");

        $stmt->execute();

        return $stmt;
    }

    public function getSingleUser()
    {
        $stmt = $this->conn->prepare("SELECT * FROM users JOIN roles ON rol_id = user_rol_id
        WHERE user_id = :user_id ");

        $stmt->bindParam(":user_id", $this->user_id);

        if ($stmt->execute()) {
            $userDat = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->user_id = $userDat['user_id'];
            $this->user_name = $userDat['user_name'];
            $this->user_email = $userDat['user_email'];
            $this->user_password = $userDat['user_password'];
            $this->user_rol_id = $userDat['user_rol_id'];
            $this->user_created_at = $userDat['user_created_at'];
            $this->rol_id = $userDat['rol_id'];
            $this->rol_name = $userDat['rol_name'];

            return true;
        } else {
            return false;
        }
    }

    public function createUser()
    {
        $stmt = $this->conn->prepare("SELECT user_email FROM users WHERE user_email = :user_email");
        $stmt->bindParam(":user_email", $this->user_email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            return false;
        } else {
            $stmt = $this->conn->prepare("INSERT INTO users(user_name, user_email, user_password, user_rol_id)
                VALUES(:user_name, :user_email, :user_password, 2)");

            $stmt->bindParam(":user_name", $this->user_name);
            $stmt->bindParam(":user_email", $this->user_email);
            $stmt->bindParam(":user_password", $this->user_password);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function updtUser()
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = :user_id");

        $stmt->bindParam(":user_id", $this->user_id);

        $stmt->execute();

        $currData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (
            $currData['user_name'] != $this->user_name || $currData['user_email'] != $this->user_email
            || $currData['user_rol_id'] != $this->user_rol_id
        ) {

            $stmt = $this->conn->prepare("UPDATE users SET user_name = :user_name, user_email = :user_email, user_rol_id = :user_rol_id WHERE user_id = :user_id");

            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":user_name", $this->user_name);
            $stmt->bindParam(":user_email", $this->user_email);
            $stmt->bindParam(":user_rol_id", $this->user_rol_id);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function deleteUser()
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = :user_id");

        $stmt->bindParam(":user_id", $this->user_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login()
    {
        $stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_rol_id, rol_name FROM users
            JOIN roles ON rol_id = user_rol_id
            WHERE user_email = :user_email AND user_password = :user_password");

        $stmt->bindParam(":user_email", $this->user_email);
        $stmt->bindParam(":user_password", $this->user_password);

        if ($stmt->execute()) {
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($userData)) {
                $this->user_id = $userData['user_id'];
                $this->user_name = $userData['user_name'];
                $this->user_email = $userData['user_email'];
                $this->user_rol_id = $userData['user_rol_id'];
                $this->rol_name = $userData['rol_name'];

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
