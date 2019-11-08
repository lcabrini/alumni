<?php

require_once('util.php');
require_once('projects.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    add_project($_POST);
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
