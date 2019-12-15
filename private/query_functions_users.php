<?php 

	// functions for accessing and updating user details:

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

    function find_user_by_username($username) {
        global $db;
        $sql = "SELECT * FROM users ";
        $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $user;   // assocative array containing all user data
    }

    function validate_user($user, $options=[]) {
        $errors = [];
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
        } elseif (!has_length_exactly($user['dob'], 10)) {
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
        } elseif(check_banned($user['email'])){
            $errors[] = "You have been banned from this society.";
        } elseif (!has_length($user['email'], array('max' => 255))) {
            $errors[] = "Email address must be less than 255 characters.";
        } elseif (!has_valid_email_format($user['email'])) {
            $errors[] = "Please enter a valid email address.";
        }
        $password_required = $options['password_required'] ?? true;
        if($password_required) {
            if(is_blank($user['username'])) {
            $errors[] = "Please enter a username.";
            } elseif (!has_length($user['username'], array('min' => 8, 'max' => 255))) {
            $errors[] = "Your username must be 8-255 characters in length.";
            } elseif (!has_unique_username($user['username'], $user['id'] ?? 0)) {
            $errors[] = "Username invalid: please try a different username";
            }
            if(is_blank($user['password'])) {
            $errors[] = "Please enter a password";
            } elseif (!has_length($user['password'], array('min' => 12))) {
            $errors[] = "Password must contain 12 or more characters";
            } elseif (!preg_match('/[A-Z]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 uppercase letter";
            } elseif (!preg_match('/[a-z]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 lowercase letter";
            } elseif (!preg_match('/[0-9]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 number";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['password'])) {
            $errors[] = "Password must contain at least 1 symbol";
                }
            if(is_blank($user['confirm_password'])) {
            $errors[] = "Passwords must match! Please re-enter password to confirm it.";
            } elseif ($user['password'] !== $user['confirm_password']) {
            $errors[] = "Passwords must match! Please confirm your new password.";
            }
            }
        return $errors;
    }

    function insert_user($user) {
        global $db;
        $errors = validate_user($user);
        if (!empty($errors)) {
            return $errors;
        }
        $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO users ";
        $sql .= "(first_name, last_name, dob, gender, phone, address, email, username, hashed_password) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $user['first_name']) . "',";
        $sql .= "'" . db_escape($db, $user['last_name']) . "',";
        $sql .= "'" . db_escape($db, $user['dob']) . "',";
        $sql .= "'" . db_escape($db, $user['gender']) . "',";
        $sql .= "'" . db_escape($db, $user['phone']) . "',";
        $sql .= "'" . db_escape($db, $user['address']) . "',";
        $sql .= "'" . db_escape($db, $user['email']) . "',";
        $sql .= "'" . db_escape($db, $user['username']) . "',";
        $sql .= "'" . db_escape($db, $hashed_password) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            // failed to insert user
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
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
        $sql .= "email='" . db_escape($db, $user['email']) . "' ";
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

    function get_user($user) {
        global $db;

        $errors = validate_user($user, ['password_required' => $password_sent]);
        if (!empty($errors)) {
            return $errors;
        }

        if($password_sent) {
            $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);
            $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
        }

        $query = "SELECT * FROM users WHERE id='" . db_escape($db, $user['id']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $query);

        if($result) {
            while($value = mysqli_fetch_assoc($result)) {
            echo "<br>";
            echo "<li>Username :" . $value["username"] ."</li>";
            echo "<li>Email :" . $value["email"] ."</li>";
            echo "<li>Current Elo :" . $value["current_elo"] ."</li>" ;  //add current_elo to db
            echo "<li>Last match :" . $value["last_match"] ."</li>";
                //add last_match to db
            echo "<p>Forgot password ?</p>";
            echo "<br>";

            echo "<h3>About myself</h3>";
            echo "<br>";
            echo "<li>First Name :" . $value["first_name"] ."</li>";
            echo "<li>Last Name :" . $value["last_name"] ."</li>";
            echo "<li>Gender :" . $value["gender"] ."</li>";
            echo "<li>Address :" . $value["address"] ."</li>";
            echo "<li>Phone number :" . $value["phone"] ."</li>";
            echo "<li>Date of Birth :" . $value["dob"] ."</li>";
            echo "<br>";
        }
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }

        mysqli_free_result($result);
    }

    function delete_user($id) {
        global $db;
        $sql = "DELETE FROM users ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1;";
        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function find_members() {
        global $db;
        $sql = "SELECT * FROM users WHERE admin = 0; ";
        $result = mysqli_query($db, $sql);
        //confirm_result_set($result);
        return $result;
    }

    function find_all_members() {
        global $db;
        $sql = "SELECT * FROM users WHERE system_admin = 0; ";
        $result = mysqli_query($db, $sql);
        //confirm_result_set($result);
        return $result;
    }

    function find_system_admin($id) {
        global $db;
        $sql = "SELECT * FROM users WHERE system_admin = 1 ;";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function promote_member($id){
        global $db;

        $sql = "UPDATE users SET admin = 1 WHERE id =". $id .";";
        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function demote_member($id){
        global $db;

        $sql = "UPDATE users SET admin = 0 WHERE id =". $id .";";
        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function promote_admin($id){
        global $db;

        $sql = "UPDATE users SET system_admin = 1 WHERE id =". $id .";";
        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function demote_admin($id){
        global $db;

        $sql = "UPDATE users SET system_admin = 0 WHERE id =". $id .";";
        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function ban_user($email){
        global $db; 
  
        $sql = 'INSERT INTO';
        $sql .=' bannedEmails(email) ';
        $sql .= 'values ("' . $email . '");';
  
        $result = mysqli_query($db, $sql);
        if($result) {
          return true;
        } else {
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
        }
      }
  
      function check_banned($email){
        global $db; 
        
        $sql = 'SELECT * FROM bannedEmails;';
  
        $result = mysqli_query($db, $sql);
  
        while($row = mysqli_fetch_assoc($result)){
          if($row['email'] == $email){
            return true;
          }
        }
  
        return false;
      }

      

?>
