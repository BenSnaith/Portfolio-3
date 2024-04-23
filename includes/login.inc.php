<?php
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $username = $_POST["username"];
    $pwd = $_POST["password"];

    try
    {
        require_once("../includes/config_session.inc.php");
        require_once("../includes/dbh.inc.php");
        require_once("../includes/login_model.inc.php");
        require_once("../includes/login_contr.inc.php");
    
        // Handle errors. (done on the server side as client side languages can be edited)
        // Inputs/Errors are all handled in the controller of the MVC model.
        $errors = [];
        if(isInputEmpty($username, $pwd))
        {
            $errors["emptyInput"] = "Please fill in all required fields.";
        }
        $result = getUser($pdo, $username);
        if(isUsernameInvalid($result))
        {
            $errors["usernameInvalid"] = "Username invalid.";
        }
        if(!isUsernameInvalid($result) && isPasswordInvalid($pwd, $result["password"]))
        {
            $errors["loginInvalid"] = "Incorrect login information.";
        }

        // Link to the config file where we started the session so we can use session superglobal
        require_once("./config_session.inc.php");
        // If there is data in the array this will return true.
        if($errors)
        {
            $_SESSION["errorLogin"] = $errors;

            header("Location: ../");
            die();
        }

        // When the user logs in, create a new SessionID with their UID appended
        $newSessionID = session_create_id();
        $sessionID = $newSessionID."_".$result["uid"];
        session_id($sessionID);

        // Assign some information about the user so we can refer to this later
        $_SESSION["user_id"] = $result["uid"];
        $_SESSION["user_name"] = htmlspecialchars($result["username"]);
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);

        $_SESSION["lrgn"] = time();

        header("Location: ../index.php?login=success");
        $pdo = null;
        $pdo = null;
        die();
    }
    catch(PDOException $e)
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