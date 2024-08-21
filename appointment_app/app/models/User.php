<?php
declare(strict_types=1);

namespace app\models;

class User {
    private \mysqli $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function register(string $username, string $password): void {
        $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('ss', $username, $hashedPassword);
        $stmt->execute();
        $stmt->close();
    }

    public function login(string $username, string $password): bool {
        $stmt = $this->conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashedPassword);
            $stmt->fetch();
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'] = $id;
                $stmt->close();
                return true;
            }
        }

        $stmt->close();
        return false;
    }
}

