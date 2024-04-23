<?php
session_start();

unset($_GET["id"]);
unset($_SESSION["tmpP"]);
unset($_SESSION["tmpE"]);
header("Location: ../");
die();