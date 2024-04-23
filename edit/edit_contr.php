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

function invalidDateRange(string $startDate, string $endDate)
{
    if($startDate > $endDate)
    {
        return true;
    }
    return false;
}