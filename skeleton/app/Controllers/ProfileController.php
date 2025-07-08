<?php
namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use SessionManager;

class ProfileController {
  public function show() {
    if (!SessionManager::has('username')) {
      header("Location: /login");
      exit();
    }

    $userModel = new User();
    $user = $userModel->getByUsername(SessionManager::get('username'));
    View::render('profile/show', ['user' => $user]);
  }

  public function update() {
    // handle POST update
  }

  public function delete() {
    // handle account deletion
  }
}
