<?php
include('database.php');

// Create contact_messages table
// $sql = "CREATE TABLE IF NOT EXISTS contact_messages (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(100) NOT NULL,
//     email VARCHAR(100) NOT NULL,
//     subject VARCHAR(255) NOT NULL,
//     message TEXT NOT NULL,
//     status ENUM('new', 'read', 'replied') DEFAULT 'new',
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     INDEX(email),
//     INDEX(created_at)
// )";

if ($conn->query($sql) === TRUE) {
    echo "✓ contact_messages table created successfully!";
} else {
    echo "✗ Error: " . $conn->error;
}

$conn->close();
?>
