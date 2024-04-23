<?php

declare(strict_types=1);

function isInputEmpty(string $username, string $pwd)
{
    if(empty($username) || empty($pwd))
    {
        return true;
    }
    return false;
}

function isUsernameInvalid(bool|array $result)
{
    if(!$result)
    {
        return true;
    }
    return false;
}

function isPasswordInvalid(string $password, string $hashedpass)
{
    if(!password_verify($password, $hashedpass))
    {
        return true;
    }
    return false;
}