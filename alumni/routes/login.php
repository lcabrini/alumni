<?php

require_once('util.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('users.php');
    $user_id = authenticate($_POST['email'], $_POST['password']);
    if ($user_id > 0) {
        $_SESSION['user'] = $user_id;
        header("Location: /dashboard");
        die();
    } else {
        $_SESSION['message'] = array(
            // XXX: assuming Bulma here. Is that a good thing?
            'type' => 'is-danger',
            'text' => 'Authentication failed!'
        );
        header("Location: /login");
    }
} else {
    $twig = get_twig();
    echo $twig->render('login_form.twig');
}
