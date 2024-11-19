<?php 
require_once "includes/config_session.inc.php"; 
require_once "includes/signup_view.inc.php"; 
require_once "includes/login_view.inc.php"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php output_username(); ?>

    <br><br>

    <?php
    if (!isset($_SESSION["user_id"])) { ?>
        <h2>Login</h2>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit">Login</button>
        </form>
    <?php } ?>

    <?php check_login_errors(); ?>

    <br><br>

    <h2>Signup</h2>
    <form action="includes/signup.inc.php" method="post">
        <?php signup_inputs(); ?>
        <button type="submit">Register</button>
    </form>

    <?php check_signup_errors(); ?>

    <br><br>

    <h2>Logout</h2>
    <form action="includes/logout.inc.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>