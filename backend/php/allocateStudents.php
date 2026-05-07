<?php

require_once(__DIR__ . '/../required/hostel_info.php');
require_once(__DIR__ . '/../php/applied.php');

$applicants = getAppliedStudents($dbConn);

if (empty($applicants)) {
    header('Location: ../required/appliedPage.php');
    exit();
}
shuffle($applicants);
$createTable = $dbConn->query("
    CREATE TABLE IF NOT EXISTS allocated_students (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        StudentID VARCHAR(50) NOT NULL,
        RoomName VARCHAR(20) NOT NULL,

        CONSTRAINT fk_allocated_student
        FOREIGN KEY (StudentID)
        REFERENCES users(ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE
    ) ENGINE=InnoDB
");

if (!$createTable) {
    die("Table creation error: " . $dbConn->error);
}
if (!$dbConn->query("DELETE FROM allocated_students")) {
    die("Allocation cleanup error: " . $dbConn->error);
}

$dbConn->query("ALTER TABLE allocated_students AUTO_INCREMENT = 1");

$roomsQuery = $dbConn->query("
    SELECT *
    FROM rooms
    ORDER BY HostelID, RoomID
");

if (!$roomsQuery) {
    die("Rooms fetch error: " . $dbConn->error);
}

$rooms = [];
$roomNumbers = [];

while ($row = $roomsQuery->fetch_assoc()) {

    $hostelId = (int)$row['HostelID'];

    if (!isset($roomNumbers[$hostelId])) {
        $roomNumbers[$hostelId] = 0;
    }

    $roomNumbers[$hostelId]++;

    $rooms[] = [
        'RoomID'     => (int)$row['RoomID'],
        'HostelID'   => $hostelId,
        'capacity'   => (int)$row['capacity'],
        'roomNumber' => $roomNumbers[$hostelId]
    ];
}
$totalCapacity = array_sum(array_column($rooms, 'capacity'));

if ($totalCapacity <= 0) {
    die("No available room capacity.");
}
$applicantGenders = [];

$escapedIds = array_map(function ($id) use ($dbConn) {
    return "'" . $dbConn->real_escape_string($id) . "'";
}, $applicants);

$idList = implode(',', $escapedIds);

$genderQuery = $dbConn->query("
    SELECT ID, gender
    FROM users
    WHERE ID IN ($idList)
");

if ($genderQuery) {

    while ($row = $genderQuery->fetch_assoc()) {

        $applicantGenders[$row['ID']] =
            strtolower(trim($row['gender']));
    }
}

function findRandomRoom(array $rooms, string $gender): ?int
{
    $availableRooms = [];

    if ($gender === 'female') {

        foreach ($rooms as $index => $room) {

            if (
                $room['HostelID'] == 1 &&
                $room['capacity'] > 0
            ) {
                $availableRooms[] = $index;
            }
        }

    } else {
        foreach ($rooms as $index => $room) {

            if (
                $room['HostelID'] != 1 &&
                $room['capacity'] > 0
            ) {
                $availableRooms[] = $index;
            }
        }
    }

    if (empty($availableRooms)) {
        return null;
    }
    return $availableRooms[array_rand($availableRooms)];
}

foreach ($applicants as $studentId) {

    if ($totalCapacity <= 0) {
        break;
    }

    $gender = $applicantGenders[$studentId] ?? 'male';

    $roomIndex = findRandomRoom($rooms, $gender);

    if ($roomIndex === null) {
        continue;
    }

    $room = $rooms[$roomIndex];
    $roomName =
        'H' . $room['HostelID'] .
        'R' . $room['roomNumber'];
    $safeStudentId = $dbConn->real_escape_string($studentId);
    $safeRoomName  = $dbConn->real_escape_string($roomName);
    $insertAllocation = $dbConn->query("
        INSERT INTO allocated_students (
            StudentID,
            RoomName
        )
        VALUES (
            '$safeStudentId',
            '$safeRoomName'
        )
    ");

    if (!$insertAllocation) {
        die("Allocation insert error: " . $dbConn->error);
    }
    $rooms[$roomIndex]['capacity']--;
    $totalCapacity--;
}
header('Location: ../required/appliedPage.php');
exit();

?>