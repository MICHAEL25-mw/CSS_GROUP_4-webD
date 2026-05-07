<?php
session_start();
require('../../../backend/required/dbConnect.php');

$dbConn->query("CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$student_id = $_SESSION['user_id'];

$status = "Application status unavailable";

$stmt = $dbConn->prepare("SELECT status FROM application_window WHERE id = 1");
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
    $status = $row['status'];
}

$check = $dbConn->prepare("SELECT id FROM applications WHERE student_id = ?");
$check->bind_param("i", $student_id);
$check->execute();
$checkResult = $check->get_result();

$alreadyApplied = $checkResult->num_rows > 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <link rel="stylesheet" href="student.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous">

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        p.title{
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-top: 20px;
        }

        nav{
            display:flex;
            justify-content:space-between;
            padding:20px 40px;
            background:white;
        }

        nav a{
            text-decoration:none;
            color:black;
            font-size:24px;
        }

        #info{
            width:90%;
            margin:20px auto;
            background:white;
            padding:20px;
            border-radius:10px;
        }

        .container{
            width:90%;
            margin:auto;
            display:flex;
            gap:50px;
            flex-wrap:wrap;
        }

        .status-box, .instructions{
            flex:1;
            min-width:300px;
        }

        #status_info{
            padding:20px;
            border-radius:10px;
            color:white;
            font-weight:bold;
        }

        .apply-btn{
            margin-top:30px;
            padding:15px 40px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-size:18px;
            background:#007bff;
            color:white;
        }

        .apply-btn:disabled{
            background:gray;
            cursor:not-allowed;
        }

        .message{
            text-align:center;
            margin-top:40px;
            font-size:22px;
            font-weight:bold;
            color:green;
        }
    </style>
</head>

<body>

<p class="title">STUDENT DASHBOARD</p>

<nav>
    <a href="#"><i class="fa fa-user"></i></a>
    <a href="../../../index.php"><i class="fa fa-arrow-right-from-bracket"></i></a>
</nav>

<div id="info">
    <strong>Accommodation Status</strong>

    <div id="status_info"
        style="background-color: <?php echo ($status === 'The application window is now open. Feel free to submit your application') ? '#28a745' : '#ffc107'; ?>; margin-top:15px;">
        <?php echo htmlspecialchars($status); ?>
    </div>
</div>

<?php if ($alreadyApplied): ?>

<script>
alert("You have already applied for accommodation.");
</script>

<div class="message">
    You have already submitted your accommodation application.
</div>

<?php else: ?>

<form id="applicationForm"
      action="../../../backend/php/applied.php"
      method="POST">

    <div class="container">

        <div class="status-box">
            <h3>Important Information</h3>
            <ul>
                <li>Only students with no outstanding fees will be considered.</li>
                <li>Cooking inside rooms is prohibited.</li>
                <li>Students must maintain cleanliness and discipline.</li>
                <li>Accommodation is not guaranteed.</li>
            </ul>
        </div>

        <div class="instructions">
            <h3>Agreement</h3>

            <input type="checkbox" id="agree">
            <label for="agree">I agree to the instructions</label>

            <button type="submit" class="apply-btn">
                Apply
            </button>
        </div>

    </div>

</form>

<?php endif; ?>

<script>
const status = "<?php echo addslashes($status); ?>";

const form = document.getElementById("applicationForm");
const agree = document.getElementById("agree");

if (form) {
    form.addEventListener("submit", function (e) {

        if (status !== "The application window is now open. Feel free to submit your application") {
            e.preventDefault();
            alert("Applications are currently CLOSED.");
            return;
        }

        if (!agree.checked) {
            e.preventDefault();
            alert("Please agree to the instructions first.");
            return;
        }
    });
}
</script>

</body>
</html>