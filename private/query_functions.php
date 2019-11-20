<?php 

function find_all_users() {}

function find_user_by_id($id) {}

function find_user_by_username($username) {}

function validate_user($user, $options=[]) {}

function insert_user($user) {}

function update_user($user) {
    global $db;
    $password_sent = !is_blank($admin['password']);
    $errors = validate_user($user, ['password_required' => $password_sent]);
    if (!empty($errors)) {
        return $errors;
    }
    $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);
    $sql = "UPDATE users SET ";
    $sql .= "first_name='" . db_escape($db, $user['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $user['last_name']) . "', ";
    
    // TODO: add user fields on profile page
    // TODO: implement all functions being used here
    
    
    $sql .= "email='" . db_escape($db, $user['email']) . "', ";
    if($password_sent) {
        $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='" . db_escape($db, $user['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_user($user) {}
    
?>
