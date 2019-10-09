<?php

require_once('../vendor/autoload.php');
session_start();

$request = $_SERVER['REQUEST_URI'];
if ($request === '/') {
    $module = 'home';
} else {
    $parts = explode('/', $request);
    $module = $parts[1];
}

$file = __DIR__ . '/' . $module . '.php';
if (file_exists($file)) {
    require $file;
} else {
    require '404.php';
}
