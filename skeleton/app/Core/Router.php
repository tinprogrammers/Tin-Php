<?php
namespace App\Core;

class Router {
  private $routes = [];

  /**
   * GET route add karo
   */
  public function get($uri, $action) {
    $this->add('GET', $uri, $action);
  }

  /**
   * POST route add karo
   */
  public function post($uri, $action) {
    $this->add('POST', $uri, $action);
  }

  /**
   * Route ko routes list mein add karo
   */
  private function add($method, $uri, $action) {
    $this->routes[] = [
      'method' => $method,
      'uri'    => $uri,
      'action' => $action
    ];
  }

  /**
   * ⭐ FINAL dispatch with debug:
   * - Dynamic segments handle hotay hain {param}
   * - Safe regex delimiter
   * - Subfolder base fix
   * - Reflection se required params
   * - Debug lines
   */
  public function dispatch() {
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    // Subfolder base fix
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $uri = '/' . ltrim(str_replace($base, '', $requestUri), '/');
    $uri = $uri ?: '/';

    // Trim leading/trailing
    $trimmedUri = trim($uri, '/');
    $trimmedUri = $trimmedUri === '' ? '/' : $trimmedUri;

    // echo "<pre>";
    // echo "== Debug ==\n";
    // echo "Request Method: $requestMethod\n";
    // echo "Request URI: $requestUri\n";
    // echo "Base Path: $base\n";
    // echo "Trimmed URI: $trimmedUri\n";
    // echo "-------------\n";
    // echo "Registered Routes:\n";
    // print_r($this->routes);
    // echo "-------------\n";
    // echo "</pre>";

    foreach ($this->routes as $route) {
      if ($route['method'] !== $requestMethod) {
        continue;
      }

      // ⭐ Build regex: safe with # delimiter
      $routeUri = trim($route['uri'], '/');

      $pattern = preg_replace('#\{[^\}]+\}#', '([^/]+)', $routeUri);
      $pattern = str_replace('/', '\/', $pattern);

      if ($route['uri'] === '/') {
        $regex = '#^\/$#'; // Root case
      } else {
        $regex = '#^' . $pattern . '$#';
      }

      // echo "<pre>Trying Route: {$route['uri']} => Regex: $regex</pre>";

      if (preg_match($regex, $trimmedUri, $matches)) {
        array_shift($matches); // remove full match

        // echo "<pre>Matched! Params: ";
        // print_r($matches);
        // echo "</pre>";

        list($controller, $method) = explode('@', $route['action']);
        $controllerClass = "\\App\\Controllers\\$controller";

        if (!class_exists($controllerClass)) {
          die("❌ Controller $controllerClass not found.");
        }

        $c = new $controllerClass();

        if (!method_exists($c, $method)) {
          die("❌ Method $method not found in $controllerClass.");
        }

        // Reflection se safe param fill
        $ref = new \ReflectionMethod($c, $method);
        $expected = $ref->getNumberOfRequiredParameters();
        $given = count($matches);

        if ($given < $expected) {
          $matches = array_merge($matches, array_fill(0, $expected - $given, null));
        }

        // echo "<pre>Calling: $controllerClass@$method with Params: ";
        // print_r($matches);
        // echo "</pre>";

        call_user_func_array([$c, $method], $matches);
        return;
      }
    }

    http_response_code(404);
    echo "404 Not Found 😢";
  }
}
