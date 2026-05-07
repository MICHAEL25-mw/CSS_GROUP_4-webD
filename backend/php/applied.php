<?php
session_start();

require_once(__DIR__ . '/../required/dbConnect.php');
require_once(__DIR__ . '/../required/predefinedUsers.php');

$userRole = $_SESSION['role'] ?? null;
$studentID = $_SESSION['user_id'] ?? null;

$dbConn->query("
CREATE TABLE IF NOT EXISTS applied_students (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    StudentID VARCHAR(50) NOT NULL,
    FOREIGN KEY (StudentID) REFERENCES users(ID)
)
");

function hasAlreadyApplied($dbConn, $studentID) {
    $stmt = $dbConn->prepare("SELECT ID FROM applied_students WHERE StudentID = ?");
    $stmt->bind_param("s", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function addAppliedStudent($dbConn, $studentID) {
    $stmt = $dbConn->prepare("INSERT INTO applied_students (StudentID) VALUES (?)");
    $stmt->bind_param("s", $studentID);
    return $stmt->execute();
}

function getAppliedStudents($dbConn) {
    $result = $dbConn->query("SELECT StudentID FROM applied_students");

    if (!$result) {
        die("Error fetching applied students: " . $dbConn->error);
    }

    $ids = [];

    while ($row = $result->fetch_assoc()) {
        $ids[] = $row['StudentID'];
    }

    return $ids;
}

if ($userRole === "student") {

    if (!$studentID) {
        $_SESSION['error'] = "Invalid session. Please log in again.";
        header("Location: ../../index.php");
        exit;
    }

    if (hasAlreadyApplied($dbConn, $studentID)) {
        $_SESSION['error'] = "You have already applied for accommodation.";
        header("Location: ../../frontend/pages/student/student.php");
        exit;
    }

    if (addAppliedStudent($dbConn, $studentID)) {
        $_SESSION['success'] = "Application submitted successfully.";
    } else {
        $_SESSION['error'] = "Failed to submit application. Please try again.";
    }

    header("Location: ../../frontend/pages/student/student.php");
    exit;
}