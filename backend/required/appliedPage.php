<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>applied students</title>
    <?php require_once(__DIR__ . '/config.php'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/frontend/css/admin.css">
</head>
<body>
<?php require_once(__DIR__. '/../required/topBar.php'); ?>

<style>
#save{
    background-color: green;
    width: 200px;
    border:none;
}
#genpdf{
    background-color: black;
    width: auto;
    border: none;
}
table{
    margin-bottom: 20px;
}
form{
    width: 80vw;
}
</style>

<h2>Allocated Students</h2>

<?php
if (!isset($dbConn)) {
    require_once(__DIR__ . '/dbConnect.php');
}

$dbConn->query("CREATE TABLE IF NOT EXISTS allocated_students (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    StudentID VARCHAR(50) NOT NULL,
    RoomName VARCHAR(10) NOT NULL,
    FOREIGN KEY (StudentID) REFERENCES users(ID)
) ENGINE=InnoDB");

$allocatedStudents = $dbConn->query(
    "SELECT allocated.ID, allocated.StudentID, users.FullName, users.Gender, allocated.RoomName
     FROM allocated_students allocated
     JOIN users ON users.ID = allocated.StudentID
     ORDER BY allocated.RoomName, users.FullName"
);
?>

<form action="../php/editAllocation.php" method="post">
<table>
<tr>
<th>No</th>
<th>Student ID</th>
<th>Full Name</th>
<th>Gender</th>
<th>Room Name</th>
</tr>

<?php
$allocatedCount = 0;

while($row = $allocatedStudents->fetch_assoc()){
    $allocatedCount++;
    $studentId = htmlspecialchars($row['StudentID'], ENT_QUOTES);
    $fullName = htmlspecialchars($row['FullName'], ENT_QUOTES);
    $gender = htmlspecialchars($row['Gender'], ENT_QUOTES);
    $allocatedId = (int)$row['ID'];
    $roomName = htmlspecialchars($row['RoomName'], ENT_QUOTES);

    echo "<tr>
    <td>$allocatedCount</td>
    <td><input type='text' name='studentid[$allocatedId]' value='$studentId'></td>
    <td>$fullName</td>
    <td>$gender</td>
    <td>$roomName</td>
    </tr>";
}

if ($allocatedCount === 0) {
    echo "<tr><td colspan='5'>No allocated students found.</td></tr>";
}
?>

</table>

<div>
<button type="submit" name="save" id="save">save changes</button>
<button type="button" id="genpdf" onclick='window.location.href="../../generatepdf.php"'>generate pdf</button>
</div>
</form>

<h2>Not Selected Students</h2>

<?php
$unallocatedStudents = $dbConn->query(
    "SELECT a.StudentID, u.FullName, u.Gender
     FROM applied_students a
     JOIN users u ON u.ID = a.StudentID
     LEFT JOIN allocated_students allocated ON a.StudentID = allocated.StudentID
     WHERE allocated.StudentID IS NULL
     ORDER BY u.FullName"
);
?>
<form action="">
<table>
<tr>
<th>No</th>
<th>Student ID</th>
<th>Full Name</th>
<th>Gender</th>
<th>Status</th>
</tr>

<?php
$unallocatedCount = 0;

while ($row = $unallocatedStudents->fetch_assoc()) {
    $unallocatedCount++;
    $studentId = htmlspecialchars($row['StudentID'], ENT_QUOTES);
    $fullName = htmlspecialchars($row['FullName'], ENT_QUOTES);
    $gender = htmlspecialchars($row['Gender'], ENT_QUOTES);

    echo "<tr>
    <td>$unallocatedCount</td>
    <td>$studentId</td>
    <td>$fullName</td>
    <td>$gender</td>
    <td>Not selected</td>
    </tr>";
}

if ($unallocatedCount === 0) {
    echo "<tr><td colspan='5'>All applicants have been allocated.</td></tr>";
}
?>

</table>
</form>
<script src="<?= BASE_URL ?>/frontend/javascript/admin.js"></script>

</body>
</html>