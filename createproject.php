<?php
session_start();
require_once("./includes/config_session.inc.php");
require_once("./create/create_view.php");
require_once("./includes/login_view.inc.php");
if(!isset($_SESSION["user_name"]))
{
    header("Location: ./");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Create project</title>
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
    <div class="create-form">
    <h1>Create a new project</h1>
    <?php
    checkCreateErrors();
    ?>
    <form action="./create/createform.php" method="POST" class="create">
    <label for="title">Title: </label><input type="text" name="title" maxlength="60" placeholder="Title (60 characters)"><br>
    <label for="start_date">Start Date: </label><input type="date" name="start_date"><br>
    <label for="end_date">End Date: </label><input type="date" name="end_date"><br>
    <label for="phase">Project phase: </label>
    <select name="phase">
    <option value="design" selected>Design</option>
    <option value="development">Development</option>
    <option value="testing">Testing</option>
    <option value="deployment">Deployment</option>
    <option value="complete">Complete</option>
    </select><br>
    <label for="description">Description: </label><br><textarea name="description" cols="30" rows="10" maxlength="120" placeholder="Description (120 characters)"></textarea><br>
    <input type="submit">
    </form>
    <form action="./" class="back-button">
    <button>Back</button>
    </form>
    </div>
</body>
</html>