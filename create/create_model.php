<?php

declare(strict_types=1);

function setProject(object $pdo, string $title, string $startDate, string $endDate, string $phase, string $description, string $uid)
{
    $query = "INSERT INTO projects (title, start_date, end_date, phase, description, uid) VALUES (:title, :startDate, :endDate, :phase, :description, :uid);";
    $smnt = $pdo->prepare($query);

    $smnt->bindParam(":title", $title);
    $smnt->bindParam(":startDate", $startDate);
    $smnt->bindParam(":endDate", $endDate);
    $smnt->bindParam(":phase", $phase);
    $smnt->bindParam(":description", $description);
    $smnt->bindParam(":uid", $uid);
    $smnt->execute();
}