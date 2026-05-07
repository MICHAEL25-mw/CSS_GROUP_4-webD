<?php
require_once "backend\php\applied.php";
/*$result = $dbConn->query('SELECT COUNT(*) AS total FROM applied_students');
if ($result) {
    $row = $result->fetch_assoc();
    if ((int)$row['total'] === 0) {
        setPreAppliedStudents($dbConn);
    }
}*/
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>login/signup</title>
        
    </head>

    <body>
        <h2>ACCOMODATION MANAGEMENT SYSTEM</h2>
        <form align="center" method="post" action="./backend/php/login.php"  style="width: 50%; margin: 90px auto;" >
            <div class="logo">
                <img src="download22.png" alt="logo">
             </div>
            <h1>Login Credentials</h1>

            <input type="text" name="username" placeholder="Username or registration number" required>
            <input type="password" name="userPassword" placeholder="Password" required>
            <input type="submit" value="Login" name="submit">
            <div class="error" id="error"></div>
        </form>
    </body>
    
</html>
