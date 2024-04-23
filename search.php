<?php
session_start();
require_once("./includes/search_view.inc.php");
require_once("./includes/login_view.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Search</title>
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
    checkQueryErrors();
    if(!isset($_GET["errors"]))
    {
        serveQueryResults();
    }
    ?>
</body>
</html>