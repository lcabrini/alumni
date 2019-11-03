<?php

require_once('util.php');
require_once('content.php');

$twig = get_twig();
$content = get_content_by_key('intro_message');
echo $twig->render('home.twig', ['intro' => $content]);
