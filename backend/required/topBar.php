<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lucas/css-group-4/backend/required/config.php';
require_once(__DIR__ . '/config.php');
?>
<nav>
    <p>Admin <span class="portal">Portal</span></p>
    <div class="buttons">
        <a href="#" class="btn">
            <i class="fa fa-bell"></i>
            notifications
        </a>
        <div class="btn">
            <i class="fa fa-bars" id="menu"></i>
            menu
        </div>
        <a href="<?= BASE_URL ?>/index.php" class="btn">
            <i class="fa fa-arrow-right-from-bracket"></i>
            logout
        </a>
    </div>
</nav>

<section id="set">
    <div id="close">&times</div>
    <a href="<?= BASE_URL ?>/frontend/pages/admin/dashboard.php">Home</a>
    <a href="<?= BASE_URL ?>/frontend/pages/profile.php">profile</a>
    <a id="config-hostels">config Hostels</a>
    <a id="add-student">add student</a>
    <a id="dark-mode">dark mode <i class="fa fa-toggle-off"></i></a>
</section>
