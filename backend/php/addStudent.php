<?php
require_once('../required/dbConnect.php');
require_once('../required/predefinedUsers.php');


$ID = $_POST['studentId'] ?? '';
$fullname = $_POST['fullName'] ?? '';
$password = $ID;
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$escapedFullName = $dbConn->real_escape_string($fullname);
$escapedID = $dbConn->real_escape_string($ID);
$escapedPassword = $dbConn->real_escape_string($hashedPassword);

$insertStudent = $dbConn->query("INSERT INTO users (FullName, ID, password, role) VALUES ('{$escapedFullName}', '{$escapedID}', '{$escapedPassword}', 'student')");
if ($insertStudent) {
    $dbConn->close();
    header("location: ../../frontend/pages/admin/dashboard.php");
    exit();
} else {
    die('Error adding student: ' . $dbConn->error);
}