<?php
require_once __DIR__.'/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$conn = new mysqli("localhost", "root", "", "allocation");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT ID, StudentID, RoomName FROM allocated_students";
$result = $conn->query($sql);


$html = "
<h2>Approved Students List</h2>
<table border='1' cellspacing='0' cellpadding='5'>
<tr>
    <th>ID</th>
    <th>StudentIDr</th>
    <th>Room Name</th>
</tr>
";

while ($row = $result->fetch_assoc()) {
    $html .= "
    <tr>
        <td>{$row['ID']}</td>
        <td>{$row['StudentID']}</td>
        <td>{$row['RoomName']}</td>
    </tr>
    ";
}

$html .= "</table>";


$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Approved_students.pdf");
?>
header('location: backend\required\appliedPage.php')