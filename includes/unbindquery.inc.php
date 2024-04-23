<?php
session_start();

unset($_SESSION["SR"]);
header("Location: ../");
die();