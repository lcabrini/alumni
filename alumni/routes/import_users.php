<?php

require_once('util.php');

if ($_SESSION['user'] != 1) {
    require '404.php';
    die();
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_FILES['users_file'])) {
            $twig = get_twig();
            echo $twig->render('500.php');
        } else {
            $file = basename($_FILES['users_file']['name']);
            $filetype = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if ($filetype != "csv") {
                require_once('500.php');
            }
            require_once('users.php');
            $users = parse_users_sheet($_FILES['users_file']['tmp_name']);
            foreach ($users as $user) {
                add_user($user);
            }
            $twig = get_twig();
            echo $twig->render('import_users_result.twig');
        }
    } else {
        $twig = get_twig();
        echo $twig->render('import_users_form.twig');
    }
}
