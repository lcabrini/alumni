<?php

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
