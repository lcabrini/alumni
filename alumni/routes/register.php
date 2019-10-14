<?php

require 'util.php';
require 'users.php';

$twig = get_twig();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user['email'] = $_POST['email'];
    $user['password'] = $_POST['password'];
    $user['year_graduated'] = $_POST['year_graduated'];
    add_user($user);
} else {
    echo $twig->render('register_form.twig');
}
