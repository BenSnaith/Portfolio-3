<?php
declare(strict_types=1);
session_start();

require_once("./includes/config_session.inc.php");

function serveInputs()
{
    if(isset($_SESSION["tmpP"]))
    {
        $tmpP = $_SESSION["tmpP"];
        echo '<label for="title">Title: </label><input type="text" name="title" value="'.$tmpP["title"].'"><br>';
        echo '<label for="start_date">Start Date: </label><input type="date" name="start_date" value="'.$tmpP["start_date"].'"><br>';
        echo '<label for="end_date">End Date: </label><input type="date" name="end_date" value="'.$tmpP["end_date"].'"><br>';
        echo '<label for="phase">Phase: </label>';
        echo '<select name="phase" value="'.$tmpP["phase"].'">';
        echo '<option value="design">Design</option>';
        echo '<option value="development">Development</option>';
        echo '<option value="testing">Testing</option>';
        echo '<option value="deployment">Deployment</option>';
        echo '<option value="complete">Complete</option>';
        echo '</select><br>';
        echo '<label for="description">Description: </label><br><textarea name="description" cols="30" rows="10">'.$tmpP["description"].'</textarea><br>';
        // MUST UNBIND ID AND TMPP
    }
}

function checkEditErrors()
{
    if(isset($_SESSION["errorEdit"]))
    {
        $errors = $_SESSION["errorEdit"];

        foreach($errors as $error)
        {
            echo "<p>".$error."</p>";
        }

        // Unset the error array when we are done with it
        unset($_SESSION["errorEdit"]);
    }
}