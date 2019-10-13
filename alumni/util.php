<?php

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

function get_database_connection() 
{
    if (array_key_exists("db", $GLOBALS)) {
        return $GLOBALS['db'];
    }

    $failed = false;

    $host = getenv("ALUMNI_DATABASE_HOST");
    if ($host === false) {
        error_log("ALUMNI_DATABASE_HOST not set");
        $failed = true;
    }

    $user = getenv("ALUMNI_DATABASE_USER");
    if ($user === false) {
        error_log("ALUMNI_DATABASE_USER not set");
        $failed = true;
    }

    $password = getenv("ALUMNI_DATABASE_PASSWORD");
    if ($password === false) {
        error_log("ALUMNI_DATABASE_PASSWORD not set");
        $failed = true;
    }

    $db = getenv("ALUMNI_DATABASE_NAME");
    if ($db === false) {
        error_log("ALUMNI_DATABASE_NAME not set");
        $failed = true;
    }

    $link = mysqli_connect($host, $user, $password, $db);
    if (!$link) {
        error_log("Cannot connect to database server: "
            . mysqli_connect_error());
        $failed = true;
    }

    if ($failed === true) {
        require '500.php';
    } 

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
