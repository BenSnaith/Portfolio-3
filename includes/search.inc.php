<?php
session_start();

// It doesn't matter too much that we are using get as someone may want to bookmark a certain search.
if($_SERVER["REQUEST_METHOD"] === "GET")
{
    $titleQuery = $_GET["titleQuery"];
    $dateQuery = $_GET["dateQuery"];
    try
    {
        require_once("../includes/config_session.inc.php");
        require_once("../includes/dbh.inc.php");
        require_once("../includes/search_model.inc.php");
        require_once("../includes/search_contr.inc.php");

        // Handle any query errors.
        $errors = [];
        if(isTitleEmpty($titleQuery) && isDateEmpty($dateQuery))
        {
            $errors["emptyInput"] = "Please provide a title or a project start date.";
        }
        if(isDateEmpty($dateQuery) && !doesTitleExist($pdo, $titleQuery))
        {
            $errors["titleExtinct"] = "No results for: $titleQuery";
        }

        // Link to the config file for the session
        require_once("./config_session.inc.php");
        // If there are any errors this will return true and kill the script
        if($errors)
        {
            $_SESSION["errorQuery"] = $errors;
            
            header("Location: ../search.php?errors=true");
            die();
        }

        // If there are no errors then perform query
        if(isDateEmpty($dateQuery) && !isTitleEmpty($titleQuery))
        {
            $results = getByTitle($pdo, $titleQuery);
            $_SESSION["SR"] = $results;
        }
        else if(isTitleEmpty($titleQuery) && !isDateEmpty($dateQuery))
        {
            $results = getByDate($pdo, $dateQuery);
            $_SESSION["SR"] = $results;
        }
        else
        {
            $_SESSION["SR"] = "DEBUG: NEITHER DATE QUERY OR TITLE QUERY PROC";
        }

        header("Location: ../search.php");
        $pdo = null;
        $smnt = null;
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
    header("Location: ../");
    die();
}
