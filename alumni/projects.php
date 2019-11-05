<?php

require_once('util.php');

function get_active_projects() {
    $db = get_database_connection();
    $sql = "select * from projects where status = 'active'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
