<?php
require_once("dbConnect.php");

$users = [
    ['ID'=>'admin','FullName'=>'Administrator','gender'=>'male','role'=>'admin','password'=>'admin123'],

    ['ID'=>'bit001','FullName'=>'Jane Banda','gender'=>'female','role'=>'student','password'=>'bit001'],
    ['ID'=>'bit002','FullName'=>'John Doe','gender'=>'male','role'=>'student','password'=>'bit002'],
    ['ID'=>'bit003','FullName'=>'Alice Smith','gender'=>'female','role'=>'student','password'=>'bit003'],
    ['ID'=>'bit004','FullName'=>'Bob Johnson','gender'=>'male','role'=>'student','password'=>'bit004'],
    ['ID'=>'bit005','FullName'=>'Charlie Brown','gender'=>'male','role'=>'student','password'=>'bit005'],
    ['ID'=>'bit006','FullName'=>'Diana Wilson','gender'=>'female','role'=>'student','password'=>'bit006'],

    ['ID'=>'css001','FullName'=>'Eve Davis','gender'=>'female','role'=>'student','password'=>'css001'],
    ['ID'=>'css002','FullName'=>'Frank Miller','gender'=>'male','role'=>'student','password'=>'css002'],
    ['ID'=>'css003','FullName'=>'Grace Lee','gender'=>'female','role'=>'student','password'=>'css003'],
    ['ID'=>'css004','FullName'=>'Henry Taylor','gender'=>'male','role'=>'student','password'=>'css004'],
    ['ID'=>'css005','FullName'=>'Ivy Anderson','gender'=>'female','role'=>'student','password'=>'css005'],
    ['ID'=>'css006','FullName'=>'Jack Wilson','gender'=>'male','role'=>'student','password'=>'css006'],

    ['ID'=>'bam001','FullName'=>'Karen White','gender'=>'female','role'=>'student','password'=>'bam001'],
    ['ID'=>'bam002','FullName'=>'Liam Harris','gender'=>'male','role'=>'student','password'=>'bam002'],
    ['ID'=>'bam003','FullName'=>'Mia Clark','gender'=>'female','role'=>'student','password'=>'bam003'],
    ['ID'=>'bam004','FullName'=>'Noah Lewis','gender'=>'male','role'=>'student','password'=>'bam004'],
    ['ID'=>'bam005','FullName'=>'Olivia Walker','gender'=>'female','role'=>'student','password'=>'bam005'],

    ['ID'=>'lcc001','FullName'=>'Paul Young','gender'=>'male','role'=>'student','password'=>'lcc001'],
    ['ID'=>'lcc002','FullName'=>'Quinn King','gender'=>'male','role'=>'student','password'=>'lcc002'],
    ['ID'=>'lcc003','FullName'=>'Rachel Scott','gender'=>'female','role'=>'student','password'=>'lcc003'],
    ['ID'=>'lcc004','FullName'=>'Steve Green','gender'=>'male','role'=>'student','password'=>'lcc004'],
    ['ID'=>'lcc005','FullName'=>'Tony Adams','gender'=>'male','role'=>'student','password'=>'lcc005'],
    ['ID'=>'lcc006','FullName'=>'Uma Patel','gender'=>'female','role'=>'student','password'=>'lcc006'],

    ['ID'=>'ikps001','FullName'=>'Victor Brown','gender'=>'male','role'=>'student','password'=>'ikps001'],
    ['ID'=>'ikps002','FullName'=>'Wendy Davis','gender'=>'female','role'=>'student','password'=>'ikps002'],
    ['ID'=>'ikps003','FullName'=>'Xander Wilson','gender'=>'male','role'=>'student','password'=>'ikps003'],
    ['ID'=>'ikps004','FullName'=>'Yara Martinez','gender'=>'female','role'=>'student','password'=>'ikps004'],
    ['ID'=>'ikps005','FullName'=>'Zack Johnson','gender'=>'male','role'=>'student','password'=>'ikps005'],
    ['ID'=>'ikps006','FullName'=>'Ava Williams','gender'=>'female','role'=>'student','password'=>'ikps006'],

    ['ID'=>'che001','FullName'=>'Ben Thompson','gender'=>'male','role'=>'student','password'=>'che001'],
    ['ID'=>'che002','FullName'=>'Clara Garcia','gender'=>'female','role'=>'student','password'=>'che002'],
    ['ID'=>'che003','FullName'=>'David Lopez','gender'=>'male','role'=>'student','password'=>'che003'],
    ['ID'=>'che004','FullName'=>'Eva Martinez','gender'=>'female','role'=>'student','password'=>'che004'],
    ['ID'=>'che005','FullName'=>'Frank Wilson','gender'=>'male','role'=>'student','password'=>'che005'],
    ['ID'=>'che006','FullName'=>'Grace Brown','gender'=>'female','role'=>'student','password'=>'che006'],

    ['ID'=>'mmb001','FullName'=>'Henry Davis','gender'=>'male','role'=>'student','password'=>'mmb001'],
    ['ID'=>'mmb002','FullName'=>'Ivy Johnson','gender'=>'female','role'=>'student','password'=>'mmb002'],
    ['ID'=>'mmb003','FullName'=>'Jack Miller','gender'=>'male','role'=>'student','password'=>'mmb003'],
    ['ID'=>'mmb004','FullName'=>'Kate Anderson','gender'=>'female','role'=>'student','password'=>'mmb004'],
    ['ID'=>'mmb005','FullName'=>'Leo Taylor','gender'=>'male','role'=>'student','password'=>'mmb005'],
    ['ID'=>'mmb006','FullName'=>'Mia Thomas','gender'=>'female','role'=>'student','password'=>'mmb006'],
    ['ID'=>'mmb007','FullName'=>'Noah Jackson','gender'=>'male','role'=>'student','password'=>'mmb007'],
    ['ID'=>'mmb008','FullName'=>'Olivia White','gender'=>'female','role'=>'student','password'=>'mmb008'],
    ['ID'=>'mmb009','FullName'=>'Paul Harris','gender'=>'male','role'=>'student','password'=>'mmb009'],

    ['ID'=>'mat001','FullName'=>'Quinn Clark','gender'=>'male','role'=>'student','password'=>'mat001'],
    ['ID'=>'mat002','FullName'=>'Rachel Lewis','gender'=>'female','role'=>'student','password'=>'mat002'],
    ['ID'=>'mat003','FullName'=>'Samuel Walker','gender'=>'male','role'=>'student','password'=>'mat003'],
    ['ID'=>'mat004','FullName'=>'Sophia Hall','gender'=>'female','role'=>'student','password'=>'mat004'],
    ['ID'=>'mat005','FullName'=>'Thomas Young','gender'=>'male','role'=>'student','password'=>'mat005'],
    ['ID'=>'mat006','FullName'=>'Uma Scott','gender'=>'female','role'=>'student','password'=>'mat006'],
    ['ID'=>'mat007','FullName'=>'Victor King','gender'=>'male','role'=>'student','password'=>'mat007'],
    ['ID'=>'mat008','FullName'=>'Wanda Wright','gender'=>'female','role'=>'student','password'=>'mat008'],

    ['ID'=>'mcs001','FullName'=>'Xander Brooks','gender'=>'male','role'=>'student','password'=>'mcs001'],
    ['ID'=>'mcs002','FullName'=>'Yara Martinez','gender'=>'female','role'=>'student','password'=>'mcs002'],
    ['ID'=>'mcs003','FullName'=>'Zane Gonzalez','gender'=>'male','role'=>'student','password'=>'mcs003'],
    ['ID'=>'mcs004','FullName'=>'Aria Perez','gender'=>'female','role'=>'student','password'=>'mcs004'],
    ['ID'=>'mcs005','FullName'=>'Benjamin Turner','gender'=>'male','role'=>'student','password'=>'mcs005'],
    ['ID'=>'mcs006','FullName'=>'Chloe Campbell','gender'=>'female','role'=>'student','password'=>'mcs006'],
    ['ID'=>'mcs007','FullName'=>'Daniel Mitchell','gender'=>'male','role'=>'student','password'=>'mcs007'],
    ['ID'=>'mcs008','FullName'=>'Ella Phillips','gender'=>'female','role'=>'student','password'=>'mcs008'],
    ['ID'=>'mcs009','FullName'=>'Finn Edwards','gender'=>'male','role'=>'student','password'=>'mcs009'],

    ['ID'=>'wqm001','FullName'=>'Grace Hill','gender'=>'female','role'=>'student','password'=>'wqm001'],
    ['ID'=>'wqm002','FullName'=>'Henry Adams','gender'=>'male','role'=>'student','password'=>'wqm002'],
    ['ID'=>'wqm003','FullName'=>'Ivy Nelson','gender'=>'female','role'=>'student','password'=>'wqm003'],
    ['ID'=>'wqm004','FullName'=>'Jack Wright','gender'=>'male','role'=>'student','password'=>'wqm004'],
    ['ID'=>'wqm005','FullName'=>'Kate Martin','gender'=>'female','role'=>'student','password'=>'wqm005'],
    ['ID'=>'wqm006','FullName'=>'Liam Thompson','gender'=>'male','role'=>'student','password'=>'wqm006'],
    ['ID'=>'wqm007','FullName'=>'Mia Rodriguez','gender'=>'female','role'=>'student','password'=>'wqm007'],
    ['ID'=>'wqm008','FullName'=>'Noah Lopez','gender'=>'male','role'=>'student','password'=>'wqm008'],
    ['ID'=>'wqm009','FullName'=>'Olivia Hernandez','gender'=>'female','role'=>'student','password'=>'wqm009'],
    ['ID'=>'wqm010','FullName'=>'Paul Gonzalez','gender'=>'male','role'=>'student','password'=>'wqm010'],

    ['ID'=>'lcc007','FullName'=>'Quinn Scott','gender'=>'male','role'=>'student','password'=>'lcc007'],
    ['ID'=>'lcc008','FullName'=>'Rachel King','gender'=>'female','role'=>'student','password'=>'lcc008'],
    ['ID'=>'lcc009','FullName'=>'Samuel Walker','gender'=>'male','role'=>'student','password'=>'lcc009'],
    ['ID'=>'lcc0010','FullName'=>'Sophia Hall','gender'=>'female','role'=>'student','password'=>'lcc0010'],
    ['ID'=>'lcc0011','FullName'=>'Thomas Young','gender'=>'male','role'=>'student','password'=>'lcc0011'],
    ['ID'=>'lcc0012','FullName'=>'Uma Scott','gender'=>'female','role'=>'student','password'=>'lcc0012'],
    ['ID'=>'lcc0013','FullName'=>'Victor Turner','gender'=>'male','role'=>'student','password'=>'lcc0013'],
    ['ID'=>'lcc0014','FullName'=>'Wanda Adams','gender'=>'female','role'=>'student','password'=>'lcc0014'],
    ['ID'=>'lcc0015','FullName'=>'Xander Mitchell','gender'=>'male','role'=>'student','password'=>'lcc0015'],
    ['ID'=>'lcc0016','FullName'=>'Yara Phillips','gender'=>'female','role'=>'student','password'=>'lcc0016'],
    ['ID'=>'lcc0017','FullName'=>'Zachary Campbell','gender'=>'male','role'=>'student','password'=>'lcc0017'],
];


// Create table
$table=$dbConn->query("CREATE TABLE IF NOT EXISTS users (
    ID VARCHAR(50) PRIMARY KEY,
    FullName VARCHAR(100) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    role VARCHAR(20) NOT NULL default 'student',
    password VARCHAR(255) NOT NULL
)");

if(!$table){
    die('Failed to create users table: ' . $dbConn->error);
}

$result = $dbConn->query("SELECT COUNT(*) as total FROM users");
$row = $result->fetch_assoc();

if ($row['total'] == 0) {
    foreach ($users as $user) {
        $hash = password_hash($user['password'], PASSWORD_DEFAULT);
        $escapedID = $dbConn->real_escape_string($user['ID']);
        $escapedName = $dbConn->real_escape_string($user['FullName']);
        $escapedGender = $dbConn->real_escape_string($user['gender']);
        $escapedRole = $dbConn->real_escape_string($user['role']);
        $escapedHash = $dbConn->real_escape_string($hash);
        $insertUser = $dbConn->query(
            "INSERT INTO users (ID, FullName, gender, role, password) VALUES ('{$escapedID}', '{$escapedName}', '{$escapedGender}', '{$escapedRole}', '{$escapedHash}')"
        );
        if (!$insertUser) {
            die('Error inserting user: ' . $dbConn->error);
        }$sql = "CREATE TABLE IF NOT EXISTS application_window (

    id INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(200) NOT NULL

)";

$dbConn->query($sql);

/* ENSURE THERE IS ALWAYS ONE ROW */
$check = $dbConn->query("SELECT COUNT(*) as total FROM application_window");
$row = $check->fetch_assoc();

if($row['total'] == 0){
    $dbConn->query("INSERT INTO application_window(status) VALUES('Closed')");
}

    }
}
?>