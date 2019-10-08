<?php

require_once('vendor/autoload.php');
session_start();

$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/':
        $file = 'home.php';
        break;

    case '/login':
        $file = 'login.php';
        break;

    case '/register':
        $file = 'register.php';
        break;

    default:
        $file = '404.php';
        break;
}

require __DIR__ . '/' . $file;

#require_once('home.php');
