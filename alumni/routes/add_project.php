<?php

require_once('util.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['message'] = array(
        'type' => 'is-success',
        'text' => 'Added project'
    );
    /*$twig = get_twig();
    $twig->render('home.twig');*/
    header("Location: /");
} else {
    $twig = get_twig();
    echo $twig->render('project_form.twig');
}
