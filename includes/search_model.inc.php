<?php

declare(strict_types=1);

function getByTitle(object $pdo, string $title)
{
    $query = "SELECT * FROM projects WHERE title = :title;";
    // Preventing SQL injection
    $smnt = $pdo->prepare($query);
    $smnt->bindParam(":title", $title);
    $smnt->execute();

    $result = $smnt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getByDate(object $pdo, string $date)
{
    $query = "SELECT * FROM projects WHERE start_date = :date;";
    // Preventing SQL injection
    $smnt = $pdo->prepare($query);
    $smnt->bindParam(":date", $date);
    $smnt->execute();

    $result = $smnt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}