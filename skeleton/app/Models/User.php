<?php
namespace App\Models;

require_once __DIR__ . '/../Helpers/db.php';

class User {

  /**
   * Sab users ko DB se laata hai.
   */
  public static function all() {
    $result = db()->query("SELECT * FROM users");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  /**
   * Ek specific user ko ID se find karta hai.
   */
  public static function find($id) {
    $stmt = db()->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }

  /**
   * Naya user create karta hai.
   */
  public static function create($data) {
    $stmt = db()->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt->bind_param("sss", $data['username'], $data['email'], $password);
    return $stmt->execute();
  }

  /**
   * Ek user ko ID se update karta hai.
   */
  public static function update($id, $data) {
    $stmt = db()->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $data['username'], $data['email'], $id);
    return $stmt->execute();
  }

  /**
   * Ek user ko ID se delete karta hai.
   */
  public static function delete($id) {
    $stmt = db()->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }

}
