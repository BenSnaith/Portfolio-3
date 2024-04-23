<?php 
require_once("./includes/config_session.inc.php");
//session_start();
//session_regenerate_id();
require_once("./includes/register_view.inc.php");
require_once("./includes/login_view.inc.php");
require_once("./create/create_view.php");
require_once("./includes/dbh.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Project view</title>
</head>
<body>
    <div class="header">
        <h3>
            <?= serveUsername() ?>
        </h3>
        <?php
        if(isset($_SESSION["user_id"])) { ?>
        <form action="./includes/logout.inc.php">
        <button id="logout">Logout</button>
        </form>
        <?php } ?>
    </div>
    <hr>
    <?php
    if(!isset($_SESSION["user_id"])) { ?>
        <div class="block-containers">
        <div class="register">
            <h1>Register</h1>
            <form action="includes/register.inc.php" method="POST" id="register-form">
            <?php
            serveRegisterInputs();
            ?>
            <input type="submit" value="Register" class="register-input submit">
            </form>
            <?php
            checkSignupErrors();
            ?>
        </div>
        <hr id="divider">
        <div class="login">
            <h1>Login</h1>
            <form action="./includes/login.inc.php" method="POST" id="login-form">
            <input type="text" name="username" placeholder="Username" class="login-input">
            <br>
            <input type="password" name="password" placeholder="Password" class="login-input">
            <br>
            <input type="submit" value="Login" class="login-input submit">
            </form>
            <?php
            checkLoginErrors();
            ?>
        </div>
        </div>
        <hr>
    <?php } ?>
    <?php
    require_once("./mvc/db_model.php");
    require_once("./mvc/db_contr.php");
    $_SESSION["DB"] = getDatabase($pdo);
    if(isset($_GET["id"]))
    {
        $_SESSION["tmpP"] = getProjectByID($pdo, $_GET["id"]);
        $_SESSION["tmpE"] = getUserEmail($pdo, $_SESSION["tmpP"]["uid"]);
        invokeSingletonView();
    }
    else
    {
        invokeDBView();
    }
    ?>
</body>
</html>
