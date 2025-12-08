<?php
class Routes
{
    private $route = [];
    private $request_url;

    public function __construct()
    {
        $this->request_url = parse_url($_SERVER['REQUEST_URI']);
    }

    public function GET($url, $controller, $middleware = null) 
    {
        $this->route[] = ["URL" => $url, "Controller" => $controller, "Method" => "GET", "Middleware" => $middleware];
    }

    public function POST($url, $controller, $middleware = null)
    {
        $this->route[] = ["URL" => $url, "Controller" => $controller, "Method" => "POST", "Middleware" => $middleware];
    }

    public function JalankanRouting()
    {
        $request_path = strtolower(trim($this->request_url["path"], '/'));

        foreach ($this->route as $route) {
            $route_url = trim($route['URL'], '/');
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_.-]+)', $route_url);
            
            if (preg_match("#^$pattern$#", $request_path, $matches) && $route['Method'] == $_SERVER['REQUEST_METHOD']) {
                list($className, $methodName) = explode("@", $route['Controller']);

                if (class_exists($className)) {
                    $controller = new $className;
                    if (method_exists($controller, $methodName)) {
                        if ($route['Middleware']) {
                            $middleware_controller = new Middleware();
                            $middleware_controller->handle($route['Middleware']);
                        }
                        
                        // Remove the full match and pass the captures to the method
                        array_shift($matches);
                        call_user_func_array([$controller, $methodName], $matches);
                        return;
                    }
                }
            }
        }
        http_response_code(404);
        echo "<p align='center'>404 : Not Found</p>";
    }
}