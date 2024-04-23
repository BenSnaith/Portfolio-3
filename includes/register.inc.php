<?php
session_start();

// Check that the user has submitted the form properly
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    try
    {
        // FILES MUST BE INCLUDED IN THE MVC ORDER, OTHERWISE THIS WILL NOT WORK
        require_once("../includes/dbh.inc.php");
        require_once("../includes/register_model.inc.php");
        require_once("../includes/register_contr.inc.php");

        // Handle errors. (done on the server side as client side languages can be edited)
        // Inputs/Errors are all handled in the controller of the MVC model.
        $errors = [];
        if(isInputEmpty($username, $password, $email))
        {
            $errors["emptyInput"] = "Please fill in all required fields.";
        }
        if(isEmailInvalid($email))
        {
            $errors["invalidEmail"] = "Please use a valid email.";
        }
        if(isUsernameTaken($pdo, $username))
        {
            $errors["usernameTaken"] = "Username already taken.";
        }
        if(isEmailRegistered($pdo, $email))
        {
            $errors["emailRegistered"] = "This email is already registered.";
        }

        // Link to the config file where we started the session so we can use session superglobal
        require_once("./config_session.inc.php");
        // If there is data in the array this will return true.
        if($errors)
        {
            $_SESSION["errorRegister"] = $errors;

            // QoL feature: send the user back their info so they don't have to type it in over and over again.
            $registerData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["registerData"] = $registerData;

            header("Location: ../");
            die();
        }

        // If there are no errors, create the user in the controller.
        createUser($pdo, $username, $password, $email);
        header("Location: ../index.php?register=success");
        $pdo = null;
        $smnt = null;
        die();
    }
    catch (PDOException $e)
    {
        ?>
            <p>Sorry, a database error has occurred. Please try again.</p>
            <br>
            <p>(Error details: <?= $e->getMessage() ?>)</p>
        <?php
    }
}
else
{
    // If the user is here when they shouldn't, send back to home page and kill script.
    header("Location: ../");
    die();
}