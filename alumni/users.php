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

function add_user($user) {
    // TEMP: this should be a random password.
    if (!isset($user['password'])) {
        $user['password'] = "changeme";
    }
    // END TEMP

    $db = get_database_connection();
    $sql = "insert into users(email, password, full_name, year_graduated)
        values(?, password(?), ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssi", $user['email'], $user['password'],
        $user['full_name'], $user['year_graduated']);
    $stmt->execute();
    return $db->insert_id;
}

function email_exists($email) {
    $db = get_database_connection();
    $sql = "select count(*) from users where email = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_row();
    return $row[0] == 0;
}

function generate_confirmation_code($user_id) {
    $code = bin2hex(random_bytes(16));
    $db = get_database_connection();
    $sql = "insert into confirmation_codes(user_fk, code) values(?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("is", $user_id, $code);
    $stmt->execute();
    $stmt->close();
    return $code;
}

function parse_users_sheet($file) {
    $users = array();
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($file);
    $worksheet = $spreadsheet->getActiveSheet();
    foreach ($worksheet->getRowIterator() as $row) {
        $user = array();
        foreach ($row->getCellIterator() as $key => $cell) {
            switch ($key) {
            case 'A':
                $user['full_name'] = $cell->getValue();
                break;
            case 'B':
                $user['year_graduated'] = $cell->getValue();
                break;
            case 'C':
                $user['email'] = $cell->getValue();
                break;
            default:
                break; // TODO: what to do here?
            }
        }
        $users[] = $user;
    }

    return $users;
}

function is_admin() {
    // XXX: This is a temporary implementation. Once I have roles 
    // implemented this function should rather check if the user
    // plays the admin role.
    if (!isset($_SESSION['user'])) {
        return false;
    } else {
        return $_SESSION['user'] === 1;
    }
}
