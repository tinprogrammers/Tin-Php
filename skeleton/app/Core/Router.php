<?php
namespace App\Core;

class Router {
  private $routes = [];

  public function get($uri, $action) {
    $this->add('GET', $uri, $action);
  }

  public function post($uri, $action) {
    $this->add('POST', $uri, $action);
  }

  private function add($method, $uri, $action) {
    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'action' => $action
    ];
  }

  public function dispatch() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    // 🗂️ Subfolder base path fix
    $base = '/new/public';  // <-- change this to your actual subfolder
    $uri = str_replace($base, '', $uri);
    $uri = $uri ?: '/';

    // 🪓 Debug
    // echo "Debug URI: " . $uri . "<br>";
    // echo "Method: " . $method . "<br>";

    foreach ($this->routes as $route) {
      if ($route['method'] === $method && $route['uri'] === $uri) {
        list($controller, $methodAction) = explode('@', $route['action']);
        $controllerClass = "\\App\\Controllers\\$controller";

        if (class_exists($controllerClass)) {
          $c = new $controllerClass();
          if (method_exists($c, $methodAction)) {
            $c->$methodAction();
            return;
          } else {
            echo "Method $methodAction not found in $controllerClass";
            return;
          }
        } else {
          echo "Controller class $controllerClass not found.";
          return;
        }
      }
    }

    http_response_code(404);
    echo "404 Not Found 😢";
  }
}
