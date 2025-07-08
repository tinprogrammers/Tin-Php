<?php
use App\Models\User;

$userModel = new User();

// GET all
$users = $userModel->get();

// GET by ID
$user = $userModel->get(5);

// POST new
$userModel->post([
  'username' => 'tinqueen',
  'email' => 'queen@tin.com',
  'password' => 'secret123'
]);

// PUT update
$userModel->put(5, [
  'username' => 'newusername',
  'email' => 'new@example.com'
]);

// DELETE user
$userModel->delete(5);
