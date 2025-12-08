<?php
class Controllers
{
    public function view($view, $data = [])
    {
        extract($data);
        require "views/$view.php";
    }
}

class HomeControllers extends Controllers {
    public function home() {
        $this->view('home');
    }
}