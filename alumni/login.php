<?php

require_once('util.php');

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

function authenticate($email, $password) {
    $db = get_database_connection();
    $sql = "select user_id from users where email = ? and 
        password = password(?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows !== 0) {
        $ret = 0;
    }
    $row = $result->fetch_assoc();
    $ret = $row['user_id'];
    $stmt->close();
    return $ret;
}

$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = authenticate($_POST['email'], $_POST['password']);
    if ($user_id > 0) {
        $_SESSION['user'] = $user_id;
        header("Location: /dashboard");
        die();
    } else {
        header("Location: /login");
    }
} else {
    echo $twig->render('login_form.twig');
}
