<?php

require_once('util.php');

$parts = explode("/", $_SERVER['REQUEST_URI']);
$code = $parts[2];
$db = get_database_connection();
$sql = "select * from confirmation_codes where code = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $code);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    // TODO: the confirmation code was not found
    die();
}

$row = $result->fetch_assoc();
$user_id = $row['user_fk'];
$stmt->close();

$sql = "delete from confirmation_codes where code = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $code);
$stmt->execute();
$stmt->close();

$sql = "update users set status = 'active' where user_id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

$twig = get_twig();
echo $twig->render('confirmed.twig');
