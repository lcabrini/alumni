<?php

require 'util.php';
require 'users.php';

$twig = get_twig();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!email_exists($_POST['email'])) {
        echo $twig->render('user_exists.twig', 
            ['email' => $_POST['email']]);
    } elseif ($_POST['password'] != $_POST['password2']) {
        $_SESSION['message'] = array(
            'type' => 'is-danger',
            'text' => "The passwords don't match"
        );
        header("Location: /register");
    } else {
        $user['email'] = $_POST['email'];
        $user['password'] = $_POST['password'];
        $user['year_graduated'] = $_POST['year_graduated'];
        add_user($user);
        sendmail($user['email'], "This is a test message");
    }
} else {
    echo $twig->render('register_form.twig');
}
