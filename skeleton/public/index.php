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
$router->get('/', 'DashboardController@index');
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@loginPost');
$router->get('/profile', 'ProfileController@show');
$router->post('/profile/update', 'ProfileController@update');
$router->post('/profile/delete', 'ProfileController@delete');

// ✅ Dispatch kar do!
$router->dispatch();
