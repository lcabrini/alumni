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

function add_project($project) {
    $db = get_database_connection();
    $sql = "insert into projects(project_name, description, status) " .
        "values(?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sss", $project['project_name'], 
        $project['description'], $project['status']);
    $stmt->execute();
    return $db->insert_id;
}
