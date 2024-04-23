<?php

declare(strict_types=1);

function isTitleEmpty(string $title)
{
    if(empty($title))
    {
        return true;
    }
    return false;
}

function isDateEmpty(string $date)
{
    if(empty($date))
    {
        return true;
    }
    return false;
}

function doesTitleExist(object $pdo, string $title)
{
    if(getByTitle($pdo, $title))
    {
        return true;
    }
    else
    {
        return false;
    }
}

// Get the project from the information

function queryByDate(object $pdo, string $date)
{
    getByDate($pdo, $date);
}

function queryByTitle(object $pdo, string $title)
{
    getByTitle($pdo, $title);
}