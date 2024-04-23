<?php
declare(strict_types=1);

//session_start();

// Serve the index page the register user inputs, if a user attempted to create an account and failed, serve
// a new set of inputs with their old information prefilled, never serve them the password as this should be
// confirmed anyway
function serveRegisterInputs() 
{
    if(isset($_SESSION["registerData"]["username"]) && !isset($_SESSION["errorRegister"]["usernameTaken"]))
    {
        echo '<input type="text" name="username" placeholder="Username" class="register-input" value="'.$_SESSION["registerData"]["username"].'">';
        echo "<br>";
    }
    else
    {
        echo '<input type="text" name="username" placeholder="Username" class="register-input">';
        echo "<br>";
    }

    echo '<input type="password" name="password" placeholder="Password" class="register-input">';
    echo '<br>';

    if(isset($_SESSION["registerData"]["email"]) && !isset($_SESSION["errorRegister"]["invalidEmail"]) && !isset($_SESSION["errorRegister"]["emailRegistered"]))
    {
        echo '<input type="text" name="email" placeholder="Email" class="register-input" value="'.$_SESSION["registerData"]["email"].'">';
        echo '<br>';
    }
    else 
    {
        echo '<input type="text" name="email" placeholder="Email" class="register-input">';
        echo '<br>';
    }
}

function checkSignupErrors()
{
    if(isset($_SESSION["errorRegister"]))
    {
        $errors = $_SESSION["errorRegister"];

        echo "<br>";

        foreach($errors as $error)
        {
            echo "<p>".$error."</p>";
        }

        // Unset the error array when we are done with it
        unset($_SESSION["errorRegister"]);
    }
    else if (isset($_GET["register"]) && $_GET["register"] === "success")
    {
        echo "<br>";
        echo "<p>Signup Successful!</p>";
    }
}