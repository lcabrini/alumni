<?php

require_once('util.php');
require_once('content.php');

$twig = get_twig();
/*
$db = get_database_connection();
$sql = "select * from content where content_key = 'intro_message'";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();*/
$content = get_content_by_key('intro_message');
echo $twig->render('home.twig', ['intro' => $content]);
//$stmt->close();
