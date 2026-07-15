<?php
$password = "rahasia123";

// Membuat hash dengan algoritma bcrypt
$hash = password_hash($password, PASSWORD_BCRYPT);

echo "Hasil Hash: " . $hash;
?>