<?php
declare(strict_types=1);

//session_start();

function checkLoginErrors()
{
    if(isset($_SESSION["errorLogin"]))
    {
        $errors = $_SESSION["errorLogin"];

        echo "<br>";

        foreach($errors as $error)
        {
            echo '<p>'.$error."</p>";
        }

        unset($_SESSION["errorLogin"]);
    }
    else if (isset($_GET["login"]) && $_GET["login"] === "success")
    {
        echo "<br>";
        echo "Login success!";
    }
}

function serveUsername() 
{
    if(isset($_SESSION["user_id"]))
    {
        echo "You are logged in as: ".$_SESSION["user_name"];
    }
    else
    {
        echo "You are not logged in, please register below!";
    }
}