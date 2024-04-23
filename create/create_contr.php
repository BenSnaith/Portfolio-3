<?php

declare(strict_types=1);

function isInputEmpty(string $title, string $startDate, string $endDate, string $phase, string $description)
{
    if(empty($title) || empty($startDate) || empty($endDate) || empty($phase) || empty($description))
    {
        return true;
    }
    return false;
}

function isDateRangeInvalid(string $startDate, string $endDate)
{
    if($endDate > $startDate)
    {
        return false;
    }
    return true;
}

function createProject(object $pdo, string $title, string $startDate, string $endDate, string $phase, string $description, string $uid)
{
    setProject($pdo, $title, $startDate, $endDate, $phase, $description, $uid);
}