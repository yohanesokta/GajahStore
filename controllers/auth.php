<?php

require_once 'base.php';
require_once 'models/UserModel.php';

class AuthController extends BaseController {

    public function __construct($db) {
        parent::__construct($db);
        $this->startSession();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $userModel = new UserModel($this->db);
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['IDPengguna'];
                $_SESSION['user_name'] = $user['Nama'];
                $_SESSION['user_role'] = $user['Role'];
                
                if ($user['Role'] === 'admin') {
                    $this->redirect('/admin');
                }
                else {
                    $this->redirect('/');
                }
            } else {
                $this->view('login', ['error' => 'Invalid email or password.', 'title' => 'Login']);
            }
        } else {
            $this->view('login', ['title' => 'Login']);
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            $errors = [];
            if (empty($name) || empty($email) || empty($password)) {
                $errors[] = "All fields are required.";
            }
            if ($password !== $confirm_password) {
                $errors[] = "Passwords do not match.";
                
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            $userModel = new UserModel($this->db);
            if ($userModel->isEmailTaken($email)) {
                $errors[] = "This email address is already registered.";
            }

            if (empty($errors)) {
                if ($userModel->register($name, $email, $password)) {
                    $this->redirect('/login?registered=true');
                }
                else {
                    $errors[] = "Registration failed. Please try again.";
                    $this->view('register', ['errors' => $errors, 'name' => $name, 'email' => $email, 'title' => 'Register']);
                }
            }
            else {
                $this->view('register', ['errors' => $errors, 'name' => $name, 'email' => $email, 'title' => 'Register']);
            }

        } else {
            $this->view('register', ['title' => 'Register']);
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('/login');
    }
}
