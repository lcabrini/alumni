<?php

require_once('util.php');
require_once('content.php');

if (($_SESSION['user'] != 1)) {
    // TODO: what should really be done here?
    header("Location: /");
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "POST";
    } else {
        $parts = explode("/", $_SERVER['REQUEST_URI']);
        $content_key = $parts[2];
        $twig = get_twig();
        $content = get_content_by_key($content_key);
        echo $twig->render('content_edit_form.twig', 
            ['content' => $content]);
    }
}
