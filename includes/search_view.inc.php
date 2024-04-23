<?php
declare(strict_types=1);
session_start();

require_once("./includes/config_session.inc.php");

function checkQueryErrors()
{
    if(isset($_SESSION["errorQuery"]))
    {
        $errors = $_SESSION["errorQuery"];

        echo '<div class="search-errors">';
        foreach($errors as $error)
        {
            echo '<p class="search-err">'.$error.'</p>';
        }
        echo '<form action="./includes/unbindquery.inc.php" method="POST">';
        echo "<button>Back</button>";
        echo "</form>";
        echo '</div>';
        // Unset the error array on the session
        unset($_SESSION["errorQuery"]);
    }
    else
    {
        echo "";
    }
}

function serveQueryResults()
{
    if(isset($_SESSION["SR"]))
    {
        $db = $_SESSION["SR"];
        echo '<div class="search-div">';
        echo "<table>";
        echo "<tr><th>Title</th><th>Start Date</th><th>Description</th></tr>";

        foreach($db as $p)
        {
            echo '<tr><td><a href="./index.php?id='.$p["pid"].'">'.$p["title"].'</a></td><td>'.$p["start_date"].'</td><td>'.$p["description"].'</td></tr>';
        }

        echo "</table>";
        echo '<form action="./includes/unbindquery.inc.php" method="POST">';
        echo "<button>Back</button>";
        echo "</form>";
    }
    else
    {
        echo "FUNCTION SERVEQUERYRESULTS FAIL SEARCH_VIEW.INC.PHP";
    }
}