<?php
namespace App\Models;

use mysqli;

class User {
  private $db;

  public function __construct() {
    $this->db = new mysqli('localhost', 'root', '', 'login_system');
  }

  public function getAll() {
    $result = $this->db->query("SELECT * FROM users");
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
