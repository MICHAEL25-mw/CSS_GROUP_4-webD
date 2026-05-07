<?php

require_once(__DIR__ . '/../../../backend/required/config.php');
require_once(__DIR__ . '/../../../backend/php/applied.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: " . BASE_URL . "/index.php");
    exit();
}

if (isset($_POST['open-window'])) {

    $openMessage = "The application window is now open. Feel free to submit your application";

    $sql = "
        UPDATE application_window
        SET status = '$openMessage'
        WHERE id = 1
    ";

    $dbConn->query($sql);
}

if (isset($_POST['close-window'])) {

    $closeMessage = "The application window is now closed. We are no longer accepting applications";

    $sql = "
        UPDATE application_window
        SET status = '$closeMessage'
        WHERE id = 1
    ";

    $dbConn->query($sql);
}

$statusQuery = $dbConn->query("
    SELECT status
    FROM application_window
    WHERE id = 1
");

$statusData = $statusQuery->fetch_assoc();

$currentStatus = $statusData['status'] ?? "Unknown";

$appliedStudentIds = getAppliedStudents($dbConn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base-url" content="<?= BASE_URL ?>">

    <title>Admin Dashboard</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet"
          href="<?= BASE_URL ?>/frontend/css/admin.css">
</head>

<body>

<?php require_once(__DIR__ . '/../../../backend/required/topBar.php'); ?>

<div class="applied-list" id="applied-list">

    <h2>Applied Students</h2>

    <table border="1" cellpadding="10">

        <tr>
            <th>No</th>
            <th>Student ID</th>
            <th>Full Name</th>
        </tr>

        <?php
        $count = 1;

        if (!empty($appliedStudentIds)) {

            foreach ($appliedStudentIds as $studentId) {

                $sql = "
                    SELECT ID, FullName
                    FROM users
                    WHERE ID = '$studentId'
                ";

                $result = $dbConn->query($sql);

                if ($result && $result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        echo "
                            <tr>
                                <td>{$count}</td>
                                <td>{$row['ID']}</td>
                                <td>{$row['FullName']}</td>
                            </tr>
                        ";

                        $count++;
                    }
                }
            }
        }

        if ($count === 1) {

            echo "
                <tr>
                    <td colspan='3'>
                        No students found
                    </td>
                </tr>
            ";
        }
        ?>

    </table>
</div>

<div class="window-status">

    <p>
        Student Window Application Status:
        <span><?= $currentStatus ?></span>
    </p>

    <form action="" method="POST" style="display:flex;width:auto; flex-direction: row; justify-content: space-between;">

        <button type="submit" name="open-window">
            Open Window
        </button>

        <button type="submit" style="background-color: red;" name="close-window">
            Close Window
        </button>
    <button id="allocate-rooms"
    style="background-color: black;"
            onclick="window.location.href='<?= BASE_URL ?>/backend/php/allocateStudents.php'">

        Allocate Rooms

    </button>
    </form>
</div>

<script src="<?= BASE_URL ?>/frontend/javascript/admin.js"></script>

</body>
</html>

<?php
$dbConn->close();
?>