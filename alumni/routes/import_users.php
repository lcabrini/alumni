<?php

require_once('util.php');

if ($_SESSION['user'] != 1) {
    require '404.php';
    die();
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_FILES['users_file'])) {
            $twig = get_twig();
            $twig->render('500.php');
        } else {
            require_once('users.php');
            $users = parse_users_sheet($_FILES['users_file']['tmp_name']);
            foreach ($users as $user) {
                add_user($user);
            }
            echo "done";
        }
    } else {
        $twig = get_twig();
        echo $twig->render('import_users_form.twig');
    }
}
