<?php
namespace App\Controllers;

use App\Models\User;

class UserController {

  /**
   * GET /users
   * Sab users ko DB se get karta hai aur view load karta hai.
   */
  public function index() {
    $users = User::all(); // Model se saare users lao
    include __DIR__ . '/../../Views/dashboard/index.php'; // View ko load karo aur $users pass karo
  }

  /**
   * GET /users/show?id=1
   * Ek single user detail get karta hai aur view load karta hai.
   */
  public function show($id) {
    $user = User::find($id); // Model se ek user get karo
    include __DIR__ . '/../../Views/dashboard/show.php'; // View ko load karo aur $user pass karo
  }

  /**
   * POST /users/store
   * Naya user create karta hai aur redirect karta hai.
   */
  public function store() {
    // ✅ Request data lo (Laravel mein $request->all())
    $data = [
      'username' => $_POST['username'],
      'email'    => $_POST['email'],
      'password' => $_POST['password']
    ];

    User::create($data); // Model ko bol ke insert karao

    // ✅ Laravel style redirect
    header("Location: /users");
    exit;
  }

  /**
   * POST /users/update?id=1
   * Existing user ko update karta hai aur redirect karta hai.
   */
  public function update($id) {
    $data = [
      'username' => $_POST['username'],
      'email'    => $_POST['email']
    ];

    User::update($id, $data); // Model ko bol ke update karao

    header("Location: /users/show?id=$id");
    exit;
  }

  /**
   * POST /users/delete?id=1
   * User ko DB se delete karta hai aur redirect karta hai.
   */

   
public function destroy($id) {
  $user = User::find($id); // Pehle user data lao

  if ($user) {
    User::delete($id); // Phir delete karo
    // Variable ko view mein bhejo
    $username = $user['name'] ?? 'Unknown User';
    include __DIR__ . '/../../Views/dashboard/delete.php';
    exit;
  } else {
    echo "❌ User not found.";
    exit;
  }
}


}
