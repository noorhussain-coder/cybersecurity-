<?php
include('database.php');

// Add profile_image column if it doesn't exist
$sql = "ALTER TABLE users ADD COLUMN IF NOT EXISTS profile_image VARCHAR(255)";

if ($conn->query($sql) === TRUE) {
    echo "✓ profile_image column added to users table successfully!";
} else {
    echo "✗ Error: " . $conn->error;
}

$conn->close();
?>
