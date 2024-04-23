<?php

declare(strict_types=1);

function getUsername(object $pdo, string $username)
{
    $query = "SELECT username FROM users WHERE username = :username;";
    // Preventing SQL injection
    $smnt = $pdo->prepare($query);
    $smnt->bindParam(":username", $username);
    $smnt->execute();

    $result = $smnt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getEmail(object $pdo, string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    // Preventing SQL injection
    $smnt = $pdo->prepare($query);
    $smnt->bindParam(":email", $email);
    $smnt->execute();

    $result = $smnt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function setUser(object $pdo, string $username, string $pwd, string $email)
{
    $query = "INSERT INTO users (username, password, email) VALUES (:username, :pwd, :email);";
    // Preventing SQL injection
    $smnt = $pdo->prepare($query);

    // SECURITY MEASURE: add a cost to hashing the password to make it more time consuming against brute force
    // attacks
    $options = [
        'cost' => 12
    ];
    $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $smnt->bindParam(":username", $username);
    $smnt->bindParam(":pwd", $hashedpwd);
    $smnt->bindParam(":email", $email);
    $smnt->execute();
}

