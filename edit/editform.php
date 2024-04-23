<?php
session_start();

require_once("../includes/config_session.inc.php");
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["id"]) && isset($_SESSION["user_id"]))
{
    $pid = $_GET["id"];
    $title = $_POST["title"];
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];
    $phase = $_POST["phase"];
    $description = $_POST["description"];
    try
    {
        // FILES MUST BE INCLUDED IN MVC ORDER
        require_once("../includes/dbh.inc.php");
        require_once("./edit_model.php");
        require_once("./edit_contr.php");

        // Handle errors. (done on the server side in order to be more secure)
        $errors = [];
        if(isInputEmpty($title, $startDate, $endDate, $phase, $description))
        {
            $errors["emptyInput"] = "Please fill in all fields";
        }
        if(invalidDateRange($startDate, $endDate))
        {
            $errors["invalidDate"] = "Start date can not come after end date";
        }


        if($errors)
        {
            $_SESSION["errorEdit"] = $errors;

            header("Location: ../editproject.php?id=".$pid.";error=true");
            die();
        }

        // If there are no errors, edit the project data
        setProject($pdo, $pid, $title, $startDate, $endDate, $phase, $description);
        header("Location: ../index.php?edit=success");
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