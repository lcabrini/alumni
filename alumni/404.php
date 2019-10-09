<?php

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader);
echo $twig->render('404.twig', ['page' => $_SERVER['REQUEST_URI']]);
