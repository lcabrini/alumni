<?php

require_once('util.php');

$twig = get_twig();
echo $twig->render('404.twig', ['page' => $_SERVER['REQUEST_URI']]);
