<?php

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
