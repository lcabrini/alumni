<?php

require_once('util.php');

$twig = get_twig();
$db = get_database();
$sql = "SELECT * from content where content_key = 'intro_message";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
echo $twig->render('home.twig', ['intro_message'], $row);
$stmt->close();
