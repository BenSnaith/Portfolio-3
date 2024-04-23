<?php

// Set some PHP.ini settings.
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params
([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

// Auto regen session ID for security purposes
if(isset($_SESSION["user_id"]))
{
    if(!isset($_SESSION["lrgn"]))
    {
        regenerateSessionLoggedIn();
    }
    else
    {
        // Regenerate every 30 mins
        $interval = 60 * 30;
        if((time() - $_SESSION["lrgn"]) >= $interval)
        {
            regenerateSessionLoggedIn();
        }
    }    
}
else
{
    if(!isset($_SESSION["lrgn"]))
    {
        regenerateSession();
    }
    else
    {
        // Regenerate every 30 mins
        $interval = 60 * 30;
        if((time() - $_SESSION["lrgn"]) >= $interval)
        {
            regenerateSession();
        }
    }
}

function regenerateSessionLoggedIn() 
{
    session_regenerate_id(true);

    $newSessionID = session_create_id();
    $sessionID = $newSessionID."_".$_SESSION["user_id"];
    session_id($sessionID);

    $_SESSION["lrgn"] = time();
}

function regenerateSession() 
{
    session_regenerate_id(true);
    $_SESSION["lrgn"] = time();
}