<?php
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    require_once("../includes/config_session.inc.php");
    $title = trim($_POST["title"]);
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];
    $phase = $_POST["phase"];
    $description = $_POST["description"];
    $uid = $_SESSION["user_id"];
    try
    {
        require_once("../includes/config_session.inc.php");
        require_once("../includes/dbh.inc.php");
        require_once("../create/create_model.php");
        require_once("../create/create_contr.php");

        // Handle errors / Data sanitation (done server side for security)
        $errors = [];
        if(isInputEmpty($title, $startDate, $endDate, $phase, $description))
        {
            $errors["emptyInput"] = "Please fill all fields";
        }
        if(isDateRangeInvalid($startDate, $endDate))
        {
            $errors["dateRange"] = "End date must come after start date";
        }
        // TODO: more data sanitation

        if($errors)
        {
            $_SESSION["errorCreate"] = $errors;

            header("Location: ../createproject.php?create=false");
            die();
        }

        createProject($pdo, $title, $startDate, $endDate, $phase, $description, $uid);
        header("Location: ../createproject.php?create=true");
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