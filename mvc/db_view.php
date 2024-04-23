<?php
declare(strict_types=1);
//session_start();

function displayCreateButton()
{
    echo '<br>';

    echo '<form action="./createproject.php">';
    echo "<button>Create a new project</button>";
    echo '</form>';
}

function displayDatabase()
{
    echo '<div class="table">';
    echo "<p>Search by Title OR Start Date</p>";
    echo '<form action="./includes/search.inc.php" method="GET">';
    echo '<input type="text" name="titleQuery" placeholder="Title">';
    echo '<span> OR </span>';
    echo '<input type="date" name="dateQuery">';
    echo '<input type="submit" value="Search" id="search-button">';
    echo '</form>';

    if(isset($_SESSION["user_id"]))
    {
        displayCreateButton();
    }

    $db = $_SESSION["DB"];
    echo '<table id="db-table">';
    echo '<tr id="header-row"><th id="title-row">Title</th><th id="date-row">Start Date</th><th id="desc-row">Description</th></tr>';

    foreach($db as $p)
    {
        echo '<tr><td><a href="./index.php?id='.$p["pid"].'">'.$p["title"].'</a></td><td>'.$p["start_date"].'</td><td>'.$p["description"].'</td></tr>';
    }

    echo "</table>";
    echo "</div>";
}

function displaySingleton()
{
    $tmpP = $_SESSION["tmpP"];
    $tmpE = $_SESSION["tmpE"];
    echo '<div class="single-view">';
    echo '<table id="single-table">';
    echo '<tr id="header-row"><th id="single-title-row">Title</th><th id="single-date-row">Start Date</th><th id="single-date-row">End Date</th><th id="phase-row">Phase</th><th id="single-desc-row">Description</th><th id="user-row">User Email</th></tr>';
    echo '<tr><td>'.$tmpP["title"].'</td><td>'.$tmpP["start_date"].'</td><td>'.$tmpP["end_date"].'</td><td class="p-row">'.$tmpP["phase"]."</td><td>".$tmpP["description"]."</td><td>".$tmpE["email"].'</td></tr>';
    echo "</table>";

    echo '<div class="back-edit">';
    echo '<form action="./mvc/unbindget.php" method="POST">';
    echo "<button>Back</button>";
    echo "</form>";
    if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $tmpP["uid"])
    {
        echo '<form action="./editproject.php?id='.$_GET["id"].'" method="POST">';
        echo "<button>Edit Project</button>";
        echo "</form>";
    }
    else
    {
        echo "";
    }
    echo "</div>";
    echo "</div>";
}