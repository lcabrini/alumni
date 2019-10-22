<?php

require_once('util.php');

function get_content_by_key($key) {
    $db = get_database_connection();
    $sql = "select * from content where content_key = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $key);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
}

function update_content($content) {
    $db = get_database_connection();
    $subtitle = $content['subtitile'] || "";
    $sql = "update content set title = ?, subtitle = ?, body = ? " .
        "where content_key = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssss", $content['title'], $subtitle,
        $content['body'], $content['content_key']);
    $stmt->execute();
}
