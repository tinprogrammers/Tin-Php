<?php
function db() {
  static $connection;
  if (!$connection) {
    $connection = require __DIR__ . '/../../database/database.php';
  }
  return $connection;
}

// Usage: db()->query("SELECT * FROM users");
