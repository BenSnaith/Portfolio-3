<?php

declare(strict_types=1);

function getUser(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username;";
    // Preventing SQL injection
    $smnt = $pdo->prepare($query);
    $smnt->bindParam(":username", $username);
    $smnt->execute();

    $result = $smnt->fetch(PDO::FETCH_ASSOC);
    return $result;
}