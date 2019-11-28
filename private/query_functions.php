<?php

    function find_user_by_id($id) {
        global $db;
        $sql = "SELECT * FROM users ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $user;
    }

    function validate_user($user, $options=[]) {
        if(is_blank($user['first_name'])) {
            $errors[] = "Please enter your first name.";
        } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 255))) {
            $errors[] = "Please enter a valid first name.";
        }
        if(is_blank($user['last_name'])) {
            $errors[] = "Please enter your last name.";
        } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 255))) {
            $errors[] = "Please enter a valid last name.";
        }
        if(is_blank($user['dob'])) {
            $errors[] = "Please enter your date of birth.";
        } elseif (!has_length($user['dob'], array('min' => 7, 'max' => 10))) {
            $errors[] = "Please enter your date of birth as YYYY-MM-DD.";
        }
        if(is_blank($user['gender'])) {
            $errors[] = "Please enter your gender M/F/O.";
        } elseif (!has_length($user['gender'], array('min' => 1, 'max' => 1))) {
            $errors[] = "Please enter your gender as M or F or O.";
        }
        if(is_blank($user['phone'])) {
            $errors[] = "Please enter your phone number.";
        } elseif (!has_length($user['phone'], array('min' => 9, 'max' => 11))) {
            $errors[] = "Please enter a valid phone number.";
        }
        if(is_blank($user['address'])) {
            $errors[] = "Please enter your mailing address.";
        } elseif (!has_length($user['address'], array('min' => 10, 'max' => 255))) {
            $errors[] = "Please enter a valid mailing address.";
        }
        if(is_blank($user['email'])) {
            $errors[] = "Please enter your email address.";
        } elseif (!has_length($user['email'], array('max' => 255))) {
            $errors[] = "Email address must be less than 255 characters.";
        } elseif (!has_valid_email_format($user['email'])) {
            $errors[] = "Please enter a valid email address.";
        }
        $password_required = $options['password_required'] ?? true;
        if($password_required) {
            if(is_blank(user['password'])) {
              $errors[] = "Please enter a password";
            } elseif (!has_length($user['password'], array('min' => 12))) {
              $errors[] = "Password must contain 12 or more characters";
            } elseif (!preg_match('/[A-Z]/', $user['password'])) {
              $errors[] = "Password must contain at least 1 uppercase letter";
            } elseif (!preg_match('/[a-z]/', $user['password'])) {
              $errors[] = "Password must contain at least 1 lowercase letter";
            } elseif (!preg_match('/[0-9]/', $user['password'])) {
              $errors[] = "Password must contain at least 1 number";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['password']))
              $errors[] = "Password must contain at least 1 symbol";
            }
            return $errors;
    }

    function insert_user($user) {
        // TODO: insert new user into database
    }

    function update_user($user) {
        global $db;
        $password_sent = !is_blank($user['password']);
        $errors = validate_user($user, ['password_required' => $password_sent]);
        if (!empty($errors)) {
            return $errors;
        }
        $sql = "UPDATE users SET ";
        $sql .= "first_name='" . db_escape($db, $user['first_name']) . "', ";
        $sql .= "last_name='" . db_escape($db, $user['last_name']) . "', ";
        $sql .= "dob='" . db_escape($db, $user['dob']) . "', ";
        $sql .= "gender='" . db_escape($db, $user['gender']) . "', ";
        $sql .= "phone='" . db_escape($db, $user['phone']) . "', ";
        $sql .= "address='" . db_escape($db, $user['address']) . "', ";
        $sql .= "email='" . db_escape($db, $user['email']) . "', ";
        $sql .= "username='" . db_escape($db, $user['username']) . "' ";
        if($password_sent) {
            $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);
            $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
        }
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

    function delete_user($user) {
        // TODO: delete a user from the database
    }

?>
