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
        $user['full_name'] = $_POST['full_name'];
        $user['year_graduated'] = $_POST['year_graduated'];
        $uid = add_user($user);
        $code = generate_confirmation_code($uid);
        $message = $twig->render('confirmation_email.twig',
            ['code' => $code]);
        sendmail($user['email'], "New registration", $message);
        echo $twig->render('post_register.twig');
    }
} else {
    echo $twig->render('register_form.twig');
}
