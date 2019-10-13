<?php

require_once('util.php');

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
