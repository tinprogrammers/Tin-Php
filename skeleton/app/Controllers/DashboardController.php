<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\User;

class DashboardController {
  public function index() {
    $userModel = new User();
    $users = $userModel->getAll();

    View::render('dashboard/index', [
      'users' => $users
    ]);
  }
}
