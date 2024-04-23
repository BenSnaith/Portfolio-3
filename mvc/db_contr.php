<?php

declare(strict_types=1);
require_once("./mvc/db_model.php");
include_once("./mvc/db_view.php");

function invokeDBView()
{
    displayDatabase();
}

function invokeSingletonView()
{
    displaySingleton();
}
