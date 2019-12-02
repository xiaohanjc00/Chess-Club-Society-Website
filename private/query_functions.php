<?php

  

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

function update_article_image($link, $id) {
    global $db;
    
    $sql = 'UPDATE posts set articleImage="'. $link .'" WHERE articleID = ' .$id.';';
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
  
  function update_article_title($title, $id) {
    global $db;
    
    $sql = 'UPDATE posts set articleTitle= "'. $title .'" WHERE articleID =' .$id.';';
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
    
  function update_article_description($description, $id) {
    global $db;
    
    $sql = 'UPDATE posts set articleDescription="'. $description .'" WHERE articleID = ' .$id.';';
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
  
  function update_tournament($organizer, $name, $date, $deadline, $winner, $firstRunnerUp, $id) {
    global $db;
    
    $sql = "UPDATE tournament SET ";
    $sql .= "tournamentOrganizer='" . $organizer . "', ";
    $sql .= "tournamentName='" . $name . "', ";
    $sql .= "tournamentDate='" . $date. "', ";
    $sql .= "deadline='" . $deadline . "', ";
    $sql .= "winnerID='" . $winner . "', ";
    $sql .= "firstRunnerUpID='" . $firstRunnerUp . "', ";
    $sql .= " WHERE articleID = " .$id.';';
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
  
  function insert_tournament_organizer($organizerID, $tournamentID) {
    global $db;
    
    $sql = 'INSERT INTO tournamentCoOrganizers(organizerID, tournamentID) values ';
    $sql .= '("' . $organizerID . '","' . $tournamentID .'");';
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
  
  function find_all_tournamentOrganizers() {
    global $db;

    $sql = "SELECT * FROM tournamentCoOrganizers ORDER BY tournamentID DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  function find_organizers_by_tournament_id($id) {
    global $db;

    $sql = "SELECT * FROM tournamentCoOrganizers WHERE tournamentID= ". $id. ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  function find_tournament_by_organizer_id($id) {
    global $db;

    $sql = "SELECT * FROM tournamentCoOrganizers WHERE organizerID= ". $id. ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  function delete_tournament_organizer($organizerID) {
    global $db;
    
    $sql = 'DELETE FROM tournamentCoOrganizers WHERE organizerID =' . $organizerID . ' AND tournamentID= '. $tournamentID. ';';
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
  
  function insert_tournament_participant($participantID, $tournamentID) {
    global $db;
    
    $sql = 'INSERT INTO tournamentParticipant(participantID, tournamentID) values ';
    $sql .= '("' . $participantID . '","' . $tournamentID .'");';
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
  
  function find_all_tournamentParticipants() {
    global $db;

    $sql = "SELECT * FROM tournamentParticipant ORDER BY tournamentID DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  function find_participants_by_tournament_id($id) {
    global $db;

    $sql = "SELECT * FROM tournamentParticipant WHERE tournamentID= ". $id. ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  function find_tournament_by_participant_id($id) {
    global $db;

    $sql = "SELECT * FROM tournamentParticipant WHERE participantID= ". $id. ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  
  function delete_tournament_participant($participantID, $tournamentID) {
    global $db;
    
    $sql = 'DELETE FROM tournamentParticipant WHERE organizerID =' . $participantID . ' AND tournamentID= '. $tournamentID. ';';
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

    function delete_user($user) {
        global $db;
        $password_sent = !is_blank($user['password']);
        $errors = validate_user($user, ['password_required' => $password_sent]);
        if (!empty($errors)) {
            return $errors;
        }
        $sql = "DELETE * FROM users";
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
?>
