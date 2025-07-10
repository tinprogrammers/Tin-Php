<?php

function db() {
    static $connection;

    if (!$connection) {
        $connection = require __DIR__ . '/../../database/database.php';

        if (!$connection || !($connection instanceof mysqli)) {
            die("❌ DB helper: Invalid connection object returned!");
        }
    }

    return $connection;
}

// echo "✅ DB helper loaded!";

// // ✅ Usage example:
// $result = db()->query("SELECT * FROM users");

// if ($result && $result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         echo $row['name'];
//     }
// }