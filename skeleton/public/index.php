<?php
// ✅ Composer autoload sirf ek hi line se sab class mil jayengi!
require_once __DIR__ . '/../vendor/autoload.php';

// ✅ Use statement for namespaces
use App\Core\Router;
// use App\Core\SessionManager; // agar zarurat ho toh

// ✅ Start session agar SessionManager bana ho toh
// SessionManager::startSecureSession();

// ✅ Create router instance
$router = new Router();

// ✅ Define your routes — bas action aur controller ka naam!
$router->get('/', 'UserController@index');
$router->get('/users/show/{id}', 'UserController@show');
$router->post('/users/store', 'UserController@store');
$router->post('/users/update', 'UserController@update');
$router->get('/users/delete/{id}', 'UserController@destroy');


// ✅ Dispatch kar do!
$router->dispatch();
