<?php

require_once('util.php');

$twig = get_twig();
echo $twig->render('home.twig', ['testvar' => 'a little test']);
