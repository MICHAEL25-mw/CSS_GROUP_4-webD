<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once("../required/dbConnect.php");
    require_once("../required/predefinedUsers.php");

    $id = $_POST['username'] ?? '';
    $password = $_POST['userPassword'] ?? '';

    $escapedID = $dbConn->real_escape_string($id);

    $result = $dbConn->query("
        SELECT ID, FullName, role, password 
        FROM users 
        WHERE ID = '{$escapedID}'
    ");

    if (!$result) {
        die('Query error: ' . $dbConn->error);
    }

    if ($row = $result->fetch_assoc()) {

        if (password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['ID'];
            $_SESSION['full_name'] = $row['FullName'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'admin') {
                header("Location: ../../frontend/pages/admin/dashboard.php");
                exit();
            } else {
                header("Location: ../../frontend/pages/student/student.php");
                exit();
            }

        }
        else{
            echo "invalid password";
        }
    }
    die($dbConn->error);
}