<?php
session_start();
require('../required/dbConnect.php');

if (isset($_POST['save'])) {

    $oldpassword = $_POST['old_password'];
    $newpassword = $_POST['new_password'];
    $ID = $_SESSION['user_id'];

    $stmt = $dbConn->prepare("SELECT password FROM users WHERE ID = ?");
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        die("User not found");
    }

    if (!password_verify($oldpassword, $user['password'])) {
        die("Invalid credentials");
    }
    $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);
    $update = $dbConn->prepare("UPDATE users SET password = ? WHERE ID = ?");
    $update->bind_param("si", $hashedPassword, $ID);
    $update->execute();

    header('Location: ../../frontend/pages/profile.php');
    exit();

} else {
    die('No submit done');
}
?>