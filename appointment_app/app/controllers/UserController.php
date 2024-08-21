<?php
declare(strict_types=1);

namespace app\controllers;

use app\models\User;

class UserController {
    public function register(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = new User();
            $user->register($username, $password);
            echo "Inscription réussie.";
        } else {
            include '../app/views/users/register.php';
        }
    }

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = new User();
            if ($user->login($username, $password)) {
                header('Location: /appointment/index');
                exit;
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } else {
            include '../app/views/users/login.php';
        }
    }

    public function logout(): void {
        session_destroy();
        header('Location: /');
        exit;
    }
}
?>
