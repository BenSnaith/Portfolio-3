<?php
session_start();
require_once("./includes/config_session.inc.php");
require_once("./edit/edit_view.php");
require_once("./includes/login_view.inc.php");
if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] != $_SESSION["tmpP"]["uid"] || !isset($_GET["id"]))
{
    header("Location: ./");
}
$pid = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Edit Project</title>
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
    <hr class="create-hr">
    <div class="edit-form">
    <h1>Edit an existing Project</h1>
    <?php
        checkEditErrors();
    ?>
    <form action="./edit/editform.php?id=<?php echo $pid ?>" method="POST" class="edit">
    <?= serveInputs() ?>
    <input type="submit">
    </form>
    <form action="./" class="back-button">
    <button>Back</button>
    </form>
    </div>
</body>
</html>