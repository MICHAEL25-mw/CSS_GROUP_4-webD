<?php
session_start();
// Get user details from session
$name = $_SESSION['full_name'] ?? 'Unknown User';
$role = $_SESSION['role'] ?? 'User';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="/lucas/css-group-4/frontend/css/profile.css">
</head>
<body>

    <?php
$initial = strtoupper(substr(trim($name), 0, 1));
?>

<div style="
        background-color: gray;
        width:100px;
        height: 100px;
        border-radius:50%;
        display: flex;
        font-size: 1.8rem;
        align-items: center;
        justify-content:center;
        color:#fff;
        margin: 40px auto;
">
        <?= htmlspecialchars($initial) ?>
</div>

    <div class="profile-info">
        <h2 id="name"><?= htmlspecialchars($name) ?></h2>
        <div class="role"><?= htmlspecialchars($role) ?></div>
        <button id="edit-profile-btn">Edit Profile</button>
    </div>

    <div class="edit-profile"></div>

    <script>
        document.getElementById('edit-profile-btn').addEventListener('click', () => {
            const editProfileDiv = document.querySelector('.edit-profile');

            editProfileDiv.innerHTML = `
                <h3>Edit Profile</h3>
                <form id="edit-profile-form" action="../../backend/php/update_profile.php" method="POST">
                    <div class='cancel-btn' id='cancel-btn'><i class="fa-solid fa-xmark"></i></div>

                    <label for="old-password">Old password:</label>
                    <input type="password" name="old_password">

                    <label for="new-password">New password:</label>
                    <input type="password" name="new_password">
                    <input type="submit" value="Save" name="save">
                </form>
            `;

            editProfileDiv.classList.add('active');

            document.getElementById('cancel-btn').addEventListener('click', () => {
                editProfileDiv.innerHTML = '';
                editProfileDiv.classList.remove('active');
            });
        });
    </script>

</body>
</html>