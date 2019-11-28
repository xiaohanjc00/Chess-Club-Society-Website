<?php

  // Subjects

  function find_all_articles() {
    global $db;

    $sql = "SELECT * FROM posts ORDER BY articleDate DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  function find_article_by_id($id) {
    global $db;

    $sql = "SELECT * FROM posts WHERE articleID =" . $id;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
   function find_all_tournaments() {
    global $db;

    $sql = "SELECT * FROM tournament ORDER BY tournamentDate DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  function find_tournament_by_id($id) {
    global $db;

    $sql = "SELECT * FROM tournament WHERE tournamentID =" . $id;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  function delete_article($id) {
    global $db;

    $sql = "DELETE FROM posts WHERE articleID= ".$id;
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function insert_article($title, $description) {
    global $db;
    
    $sql = 'INSERT INTO posts(articleTitle, articleDesc, articleDate) values ("' . $title . '","' . $description . '", now());';
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function insert_article_image($title, $description, $link) {
    global $db;
    
    $sql = 'INSERT INTO posts(articleTitle, articleDesc, articleDate, articleImage) values ("' . $title . '","' . $description . '", now());';
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function insert_tournament($tournamentOrganizer, $tournamentName, $tournamentDate, $deadline) {
    global $db;
    
    $sql = 'INSERT INTO tournament(tournamentOrganizer, tournamentName, tournamentDate, deadline) values ("' . $tournamentOrganizer . '","' . $tournamentName . '", "' .$tournamentDate . '", "'. $deadline. '");';
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  function delete_tournament($id) {
    global $db;
    
    $sql = 'DELETE FROM tournament WHERE tournamentID =' . $id;
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  
  
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
        // TODO: implement complete user validation
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
