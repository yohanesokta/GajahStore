<?php

class BaseController {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    protected function loadModel($modelName) {
        $modelPath = 'models/' . $modelName . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $modelName($this->db);
        }
        return null;
    }

    protected function view($viewName, $data = []) {
        // Diagnostic check for the 'intl' extension.
        if (!class_exists('NumberFormatter')) {
            die("FATAL ERROR: The 'intl' PHP extension is not installed or enabled. This extension is required for currency formatting to work. Please enable 'extension=intl' in your php.ini file.");
        }

        // Ensure helpers are always loaded before a view is rendered, using an absolute path.
        require_once __DIR__ . '/../lib/helper.php';

        $viewPath = 'views/' . $viewName . '.php';
        if (file_exists($viewPath)) {
            extract($data); // Extracts array keys into variables
            
            // Start output buffering
            ob_start();
            
            // Include header
            if (!isset($data['hide_header'])) {
                include 'views/partials/header.php';
            }

            // Include the main view file
            include $viewPath;

            // Include footer
            if (!isset($data['hide_footer'])) {
                include 'views/partials/footer.php';
            }
            
            // End buffering and output
            ob_end_flush();
        } else {
            // Handle view not found error
            die("View '$viewName' not found.");
        }
    }

    protected function redirect($url) {
        header("Location: " . $url);
        exit();
    }

    protected function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function isLoggedIn() {
        $this->startSession();
        return isset($_SESSION['user_id']);
    }

    protected function isAdmin() {
        $this->startSession();
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }
    }

    protected function requireAdmin() {
        if (!$this->isAdmin()) {
            // Can redirect to a 'not authorized' page or just home
            $this->redirect('/');
        }
    }
}
