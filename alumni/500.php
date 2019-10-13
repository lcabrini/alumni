<?php

require_once('util.php');

$twig = get_twig();
echo $twig->render('500.twig');
die();
