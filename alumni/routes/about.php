<?php

require('util.php');

$db = get_database_connection();
$sql = "select * from content where content_key = 'about_us'";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$twig = get_twig();
echo $twig->render('about_us.twig',[
    'title' => $row['title'],
    'body' => $row['body']
]);
