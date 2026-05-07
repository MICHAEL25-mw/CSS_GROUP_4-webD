<?php
session_start();
require_once('../required/dbConnect.php');
require_once('../required/hostel_info.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hostelID = isset($_POST['HostelID']) ? (int)$_POST['HostelID'] : 0;
    $RoomID = isset($_POST['RoomID']) ? (int)$_POST['RoomID'] : 0;
    $capacity = isset($_POST['capacity']) ? (int)$_POST['capacity'] : 0;

    if ($hostelID <= 0 || $RoomID <= 0 || $capacity <= 0) {
        die('Invalid hostel, room, or capacity values.');
    }

    $hostelCheckResult = $dbConn->query("SELECT HostelID FROM hostels WHERE HostelID = {$hostelID}");
    if ($hostelCheckResult === false) {
        die('Query error: ' . $dbConn->error);
    }

    if ($hostelCheckResult->num_rows === 0) {
        $hostelName = 'hall' . $hostelID;
        $escapedHostelName = $dbConn->real_escape_string($hostelName);
        $insertHostel = $dbConn->query("INSERT INTO hostels (name) VALUES ('{$escapedHostelName}')");
        if (!$insertHostel) {
            die('Error adding hostel: ' . $dbConn->error);
        }
    }

    $roomCheckResult = $dbConn->query("SELECT RoomID FROM rooms WHERE RoomID = {$RoomID} AND HostelID = {$hostelID}");
    if ($roomCheckResult === false) {
        die('Query error: ' . $dbConn->error);
    }

    if ($roomCheckResult->num_rows > 0) {
        // Update capacity if room exists
        $updateRoom = $dbConn->query("UPDATE rooms SET capacity = {$capacity} WHERE RoomID = {$RoomID} AND HostelID = {$hostelID}");
        if (!$updateRoom) {
            die('Error updating room: ' . $dbConn->error);
        }
        header('Location: ../../frontend/pages/admin/dashboard.php');
        exit();
    }

    $insertRoom = $dbConn->query("INSERT INTO rooms (RoomID, capacity, HostelID) VALUES ({$RoomID}, {$capacity}, {$hostelID})");
    if (!$insertRoom) {
        die('Error adding room: ' . $dbConn->error);
    }

    header('Location: ../../frontend/pages/admin/dashboard.php');
    exit();
}

die('Invalid request method.');
