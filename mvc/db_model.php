<?php

declare(strict_types=1);

function getDatabase(object $pdo)
{
    $query = "SELECT * FROM projects";
    $smnt = $pdo->prepare($query);
    $smnt->execute();

    $db = $smnt->fetchAll(PDO::FETCH_ASSOC);
    return $db;
}

function getProjectByID(object $pdo, int $pid)
{
    $query = "SELECT * FROM projects WHERE pid = :pid;";
    $smnt = $pdo->prepare($query);
    $smnt->bindParam(":pid", $pid);
    $smnt->execute();

    return $smnt->fetch(PDO::FETCH_ASSOC);
}

function getUserEmail(object $pdo, int $uid)
{
    $query = "SELECT email FROM users where uid = :uid;";
    $smnt = $pdo->prepare($query);
    $smnt->bindParam(":uid", $uid);
    $smnt->execute();

    return $smnt->fetch(PDO::FETCH_ASSOC);
}

