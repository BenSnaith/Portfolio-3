<?php
declare(strict_types=1);
//session_start();

function checkCreateErrors()
{
    if(isset($_SESSION["errorCreate"]))
    {
        $errors = $_SESSION["errorCreate"];

        foreach($errors as $error)
        {
            echo '<p class="project-errors">'.$error.'</p>';
        }

        // Unset the error array when we are done with it
        unset($_SESSION["errorCreate"]);
    }
    else if (isset($_GET["create"]) && $_GET["create"] === "true")
    {
        echo '<p class="project-success">Project Created!</p>';
    }
}