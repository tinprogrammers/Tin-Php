<?php

return [
  'up' => function($db) {
    $query = "
      CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )
    ";
    $db->query($query);
    echo "✅ Created 'users' table!\n";
  },

  'down' => function($db) {
    $query = "DROP TABLE IF EXISTS users";
    $db->query($query);
    echo "❌ Dropped 'users' table!\n";
  }
];
