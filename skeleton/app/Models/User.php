<?php
namespace App\Models;

use mysqli;

class User {
  private $db;

  public function __construct() {
    $this->db = new mysqli('localhost', 'root', '', 'login_system');
    if ($this->db->connect_error) {
      die("Connection failed: " . $this->db->connect_error);
    }
  }

  // ✅ GET: All users or by ID
  public function get($id = null) {
    if ($id) {
      $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_assoc();
    } else {
      $result = $this->db->query("SELECT * FROM users");
      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }

  // ✅ POST: Create new user
  public function post($data) {
    $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt->bind_param("sss", $data['username'], $data['email'], $password);
    return $stmt->execute();
  }

  // ✅ PUT: Update user by ID
  public function put($id, $data) {
    $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $data['username'], $data['email'], $id);
    return $stmt->execute();
  }

  // ✅ DELETE: Delete user by ID
  public function delete($id) {
    $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }

  public function __destruct() {
    $this->db->close();
  }
}
