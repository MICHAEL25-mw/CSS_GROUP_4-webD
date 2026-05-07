<?php
require_once('dbConnect.php');

$halls = ['hall1', 'hall2', 'hall3', 'hall4'];
$roomNames = ['room1', 'room2', 'room3', 'room4'];

$sql = "CREATE TABLE IF NOT EXISTS hostels(
    HostelID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    AvailableRooms INT NOT NULL DEFAULT 4
)";
if (!$dbConn->query($sql)) {
    die("Error creating hostel table: " . $dbConn->error);
}

$sqlRooms = "CREATE TABLE IF NOT EXISTS rooms(
    RoomID INT AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    capacity INT NOT NULL DEFAULT 4,
    HostelID INT NOT NULL,
    PRIMARY KEY (RoomID),
    FOREIGN KEY (HostelID) REFERENCES hostels(HostelID)
)";
if (!$dbConn->query($sqlRooms)) {
    die("Error creating rooms table: " . $dbConn->error);
}


$hostelCountResult = $dbConn->query("SELECT COUNT(*) AS total FROM hostels");
$hostelCount = (int)$hostelCountResult->fetch_assoc()['total'];

if ($hostelCount !== count($halls)) {
    $dbConn->query("DELETE FROM rooms");
    $dbConn->query("DELETE FROM hostels");
    $dbConn->query("ALTER TABLE rooms AUTO_INCREMENT = 1");
    $dbConn->query("ALTER TABLE hostels AUTO_INCREMENT = 1");
    foreach ($halls as $hall) {
        $escapedHall = $dbConn->real_escape_string($hall);
        $dbConn->query("INSERT INTO hostels (name) VALUES ('$escapedHall')");
    }
}
$roomCountResult = $dbConn->query("SELECT COUNT(*) AS total FROM rooms");
$roomCount = (int)$roomCountResult->fetch_assoc()['total'];
$expectedRoomCount = count($halls) * count($roomNames);
if ($roomCount !== $expectedRoomCount) {

    $dbConn->query("DELETE FROM rooms");
    $dbConn->query("ALTER TABLE rooms AUTO_INCREMENT = 1");

    $hostelResult = $dbConn->query("SELECT HostelID FROM hostels ORDER BY HostelID");

    if (!$hostelResult) {
        die("Error fetching hostels: " . $dbConn->error);
    }

    while ($hostel = $hostelResult->fetch_assoc()) {

        $hostelID = (int)$hostel['HostelID'];

        foreach ($roomNames as $room) {

            $escapedRoom = $dbConn->real_escape_string($room);

            $dbConn->query("
                INSERT INTO rooms (name, HostelID)
                VALUES ('$escapedRoom', $hostelID)
            ");
        }
    }
}

$RoomNumbers = $dbConn->query("SELECT RoomID FROM rooms");

if (!$RoomNumbers) {
    die("Error fetching room numbers: " . $dbConn->error);
}

while ($row = $RoomNumbers->fetch_assoc()) {

    $roomID = (int)$row['RoomID'];

    $tableExists = $dbConn->query("SHOW TABLES LIKE 'room_$roomID'");

    if (!$tableExists || $tableExists->num_rows === 0) {

        $dbConn->query("
            CREATE TABLE room_$roomID(
                ID INT PRIMARY KEY AUTO_INCREMENT,
                StudentID VARCHAR(50) NOT NULL,
                FOREIGN KEY (StudentID) REFERENCES users(ID)
            )
        ");
    }
}
?>