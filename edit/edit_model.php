<?php

declare(strict_types=1);

function setProject(object $pdo, string $pid, string $title, string $startDate, string $endDate, string $phase, string $description)
{
    $query = "UPDATE projects SET title=:title, start_date=:start_date, end_date=:end_date, phase=:phase, description=:description WHERE pid=:pid;";
    $smnt = $pdo->prepare($query);
    $smnt->bindParam(":title", $title);
    $smnt->bindParam(":start_date", $startDate);
    $smnt->bindParam(":end_date", $endDate);
    $smnt->bindParam(":phase", $phase);
    $smnt->bindParam(":description", $description);
    $smnt->bindParam(":pid", $pid);
    $smnt->execute();
}
