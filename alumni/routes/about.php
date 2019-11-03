<?php

require('util.php');
require('content.php');

$content = get_content_by_key('about_us');
$twig = get_twig();
echo $twig->render('about_us.twig',[
    'title' => $content['title'],
    'body' => $content['body']
]);
