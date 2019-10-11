<?php

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

function get_database_connection() 
{
    if (array_key_exists("db", $GLOBALS)) {
        return $GLOBALS['db'];
    }

    $host = getenv("ALUMNI_DATABASE_HOST");
    $user = getenv("ALUMNI_DATABASE_USER");
    $password = getenv("ALUMNI_DATABASE_PASSWORD");
    $db = getenv("ALUMNI_DATABASE_NAME");
    $link = mysqli_connect($host, $user, $password, $db);
    $GLOBALS['db'] = $link;
    return $link;
}

function get_twig() {
    $loader = new FilesystemLoader('../templates');
    $twig = new Environment($loader);
    if (isset($_SESSION['message'])) {
        $twig->addGlobal('message', $_SESSION['message']);
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['user'])) {
        $twig->addGlobal('user', $_SESSION['user']);
    }

    return $twig;
}
