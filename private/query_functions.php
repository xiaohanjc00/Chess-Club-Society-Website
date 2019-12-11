
<?php 

  // functions for accessing and updating news:

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

  function validate_article($article, $options=[]) {
    $errors = [];
    if(is_blank($article['article_title'])) {
        $errors[] = "Please enter the title of the article.";
    } elseif (!has_length($article['article_title'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Please enter a valid title.";
    }
    if(is_blank($article['article_description'])) {
        $errors[] = "Please enter the description of the article.";
    } elseif (!has_length($article['article_description'], array('min' => 15, 'max' => 5000))) {
        $errors[] = "Please enter a valid description.";
    }

    date_default_timezone_get();
    $currentDateTime = date('Y-m-d');
    $currentdatetime1 =  date_create($currentDateTime);
    $expiryDate =  date_create(date('Y-m-d',strtotime($article['expiry_date'])));

    if($currentdatetime1 >= $expiryDate){
      $errors[] = "Please enter a valid expiry date. Its value cannot come before todays date";
    }
    return $errors;
  }

  function insert_article($article) {
    global $db;

    $errors = validate_article($article);
    if (!empty($errors)) {
        return $errors;
    }
    $sql = 'INSERT INTO';
    $sql .=' posts(articleTitle, articleDesc, articleDate ';
    if(!is_blank($article['image_link'])){ $sql.= ', articleImage' ;}
    if(!is_blank($article['expiry_date'])) {$sql .= ', articleExpiry';}
    $sql .= ')values ("' ;
    $sql .= db_escape($db,$article['article_title']) ;
    $sql .= '", "' . db_escape($db, $article['article_description']) ;
    $sql .= '", current_date()';
    if(!is_blank($article['image_link'])) $sql.= ', "' . db_escape($db, $article['image_link']) . '"' ;
    if(!is_blank($article['expiry_date'])) $sql .= ', "' . db_escape($db,$article['expiry_date']) . '"';
    $sql .= ');';
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_article($article, $id) {
    global $db;

    $sql;
    if(!is_blank($article['article_title'])) $sql .= 'UPDATE posts set articleTitle= "'.  db_escape($db, $article['article_title']) . '" WHERE articleID =' .$id.';';
    if(!is_blank($article['image_link'])) $sql .= 'UPDATE posts set articleImage= "'.  db_escape($db, $article['image_link']) . '" WHERE articleID =' .$id.';';
    if(!is_blank($article['expiry_date'])) $sql .=  'UPDATE posts set articleExpiry= "'.  db_escape($db, $article['expiry_date']) . '" WHERE articleID =' .$id.';';
    if(!is_blank($article['article_description'])) $sql .= 'UPDATE posts set articleDesc= "'.  db_escape($db, $article['article_description']) . '" WHERE articleID =' .$id.';';
    
    if(!is_blank($sql)){
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
  }

  // functions for accessing and updating tournaments:

  function validate_tournament($tournament, $options=[]) {
    $errors = [];
    
    if(is_blank($tournament['organizer'])) {
        $errors[] = "Please enter the ID of the organizer.";
    } 
    if(is_blank($tournament['name'])) {
        $errors[] = "Please enter the tournament name.";
    } elseif (!has_length($tournament['name'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Please enter a valid name.";
    }
    if(is_blank($tournament['date'])) {
        $errors[] = "Please enter the date of the tournament.";
    }
    if(is_blank($tournament['deadline'])) {
        $errors[] = "Please enter the deadline for registering.";
    }

    date_default_timezone_get();
    $currentDateTime = date('Y-m-d');
    $currentdatetime1 =  date_create($currentDateTime);
    $tournamentDate =  date_create(date('Y-m-d',strtotime($tournament['date'])));
    $tournamentDeadline =  date_create(date('Y-m-d',strtotime($tournament['deadline'])));

    if($currentdatetime1 > $tournamentDeadline){
      $errors[] = "Please enter a valid deadline date. Its value cannot come before todays date";
    }
    if($currentdatetime1 > $tournamentDate){
      $errors[] = "Please enter a valid tournament date. Its value cannot come before todays date";
    }
    if($tournamentDate < $tournamentDeadline){
      $errors[] = "The deadline registration date cannot come after the date of the tournament";
    }

    return $errors;
  }

  function validate_tournament_update($tournament, $options=[]) {
    $errors = [];
    
    if (!is_blank($tournament['name']) && !has_length($tournament['name'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Please enter a valid name.";
    }

    date_default_timezone_get();
    $currentDateTime = date('Y-m-d');
    $currentdatetime1 =  date_create($currentDateTime);
    $tournamentDate =  date_create(date('Y-m-d',strtotime($tournament['date'])));
    $tournamentDeadline =  date_create(date('Y-m-d',strtotime($tournament['deadline'])));

    if($currentdatetime1 > $tournamentDeadline){
      $errors[] = "Please enter a valid deadline date. Its value cannot come before todays date";
    }
    if($currentdatetime1 > $tournamentDate){
      $errors[] = "Please enter a valid tournament date. Its value cannot come before todays date";
    }
    if($tournamentDate < $tournamentDeadline){
      $errors[] = "The deadline registration date cannot come after the date of the tournament";
    }

    return $errors;
  }

  function insert_tournament($tournament) {
    global $db;

    $errors = validate_tournament($tournament);
    if (!empty($errors)) {
        return $errors;
    }
    $sql = "INSERT INTO tournament";
    $sql .= "(tournamentOrganizer, tournamentName, tournamentDate, deadline)";
    $sql .= " VALUES (";
    $sql .= "'" . db_escape($db, $tournament['organizer']) . "', ";
    $sql .= "'" . db_escape($db, $tournament['name']) . "', ";
    $sql .= "'" . db_escape($db, $tournament['date']) . "', ";
    $sql .= "'" . db_escape($db, $tournament['deadline']) . "'" ;
    $sql .= ");";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        // failed to insert tournament
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

  function update_tournament($tournament, $id) {
    global $db;

    $errors = validate_tournament_update($tournament);
    if (!empty($errors)) {
        return $errors;
    }
    $sql ="";
    if(!is_blank($tournament['name'])) $sql .= 'UPDATE tournament set tournamentName= "'.  db_escape($db, $tournament['name']) . '" WHERE tournamentID =' .$id.'; ';
    if(!is_blank($tournament['organizer'])) $sql .= 'UPDATE tournament set tournamentOrganizer= "'.  db_escape($db, $tournament['organizer']) . '" WHERE tournamentID =' .$id.'; ';
    if(!is_blank($tournament['date'])) $sql .=  'UPDATE tournament set tournamentDate= "'.  db_escape($db, $tournament['date']) . '" WHERE tournamentID =' .$id.'; ';
    if(!is_blank($tournament['deadline'])) $sql .= 'UPDATE tournament set deadline= "'.  db_escape($db, $tournament['deadline']) . '" WHERE tournamentID =' .$id.';';
    
    if(!is_blank($sql)){
      $result = mysqli_query($db, $sql);
      if($result) {
        return true;
      } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }
  }

  function insert_tournament_organizer($tournament) {
    global $db;

    if($tournament['coorganizer'] != "None"){
      $sql = "INSERT INTO tournamentCoOrganizers";
      $sql .= "(organizerID, tournamentID)";
      $sql .= " VALUES (";
      $sql .= db_escape($db, $tournament['coorganizer']) . ",  ";
      $sql .= db_escape($db, $tournament['tournamentID']);
      $sql .= ");";
      $result = mysqli_query($db, $sql);
      if($result) {
          return true;
      } else {
          // failed to insert tournament
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
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

  function insert_tournament_matches($matches) {
    global $db;

    $sql = 'INSERT INTO `tournamentMatches`(firstparticipantID, secondparticipantID, tournamentID, roundNumber)';
    $sql .= 'VALUES';
    $sql .= '("' . $matches['firstparticipantID'] . '","' . $matches['secondparticipantID']  .'","' . $matches['tournamentID'] .'","' . $matches['roundNumber'] .'");';
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

  function find_matches($tournamentID, $round) {
    global $db;

    $sql = 'SELECT * FROM tournamentMatches WHERE tournamentID =' . $tournamentID . ' AND roundNumber ='. $round . ';';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_all_tournamentParticipants($id) {
    global $db;

    $sql = "SELECT * FROM tournamentParticipant, users WHERE id = participantID AND tournamentID = " .$id .";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_all_tournamentMatches($id) {
    global $db;

    $sql = "SELECT * FROM tournamentMatches WHERE tournamentID = " .$id ."  ORDER BY roundNumber;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_user_tournamentMatches($id) {
    global $db;

    $sql = "SELECT * FROM tournamentMatches WHERE firstparticipantID = " .$id ." OR  secondparticipantID = ".$id . "ORDER BY roundNumber;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function set_winner($matchResult){
    $sql = 'UPDATE tournamentMatches set roundWinner= "'.  db_escape($db, $tournament['winner']) . '" AND roundLoser =  "'.  db_escape($db, $tournament['loser']) . '" ';
    $sql .= 'WHERE tournamentID ="' .  db_escape($db, $tournament['tournamentID']).'" AND firstparticipantID = "' .  db_escape($db, $tournament['firstparticipantID']) . '" AND secondparticipantID = "' .  db_escape($db, $tournament['secondparticipantID']) . '";';
    if(!is_blank($sql)){
      $result = mysqli_query($db, $sql);
      if($result) {
        return true;
      } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }
  }

  function find_participants_by_tournament_id($id) {
    global $db;

    $sql = "SELECT * FROM tournamentParticipant WHERE tournamentID= ". $id. ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_tournament_and_participant($id, $tournamentID) {
    global $db;

    $sql = "SELECT participantID FROM tournamentParticipant WHERE participantID= ". $id. " AND tournamentID = ". $tournamentID . ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_tournament_organizer($id, $tournamentID) {
    global $db;

    $sql = "SELECT tournamentOrganizer FROM tournament WHERE tournamentOrganizer= ". $id. " AND tournamentID = ". $tournamentID . ";";
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


// functions for accessing and updating events:

 function find_all_events() {
    global $db;

    $sql = "SELECT * FROM opening_event ORDER BY eventDate DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_event_by_id($id) {
    global $db;

    $sql = "SELECT * FROM opening_event WHERE eventID =" . $id;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function delete_event($id) {
    global $db;

    $sql = "DELETE FROM opening_event WHERE eventID= ".$id;
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

  function insert_event($title, $description) {
    global $db;

    $sql = 'INSERT INTO opening_event(eventTitle, eventDesc, eventDate) values ("' . $title . '","' . $description . '", now());';
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

  function insert_event_image($title, $description, $link) {
    global $db;

    $sql = 'INSERT INTO opening_event(eventTitle, eventDesc, eventDate, eventImage) values ("' . $title . '","' . $description . '", now());';
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

function update_event_image($link, $id) {
    global $db;

    $sql = 'UPDATE opening_event set eventImage="'. $link .'" WHERE eventID = ' .$id.';';
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

  function update_event_title($title, $id) {
    global $db;

    $sql = 'UPDATE opening_event set articleTitle= "'. $title .'" WHERE articleID =' .$id.';';
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

	function update_event_description($description, $id) {
	global $db;

	$sql = 'UPDATE opening_event set eventDescription="'. $description .'" WHERE eventID = ' .$id.';';
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


    // functions for updating rankings from tournaments:

    function tournament_ended($t_id) {
      // returns true if the given tournament (id) has a winner
      global $db;
      $sql = "SELECT * FROM tournament ";
      $sql .= "WHERE id='" . db_escape($db, $t_id) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $tournament = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      if ((is_null($tournament['winnerID']))) {
        return false;
      }
      return true;
    }

    function update_rankings($t_id) {
      if (tournament_ended($t_id)) {
		find_all_tournamentMatches($t_id);

		// update rankings of participants
		update_ranking_from_match();
      }
    }

    function update_ranking_from_match($p1_id, $p2_id) {
		// updates each player's rating from the match result

    }


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

    function find_admins($id) {
        global $db;
        $sql = "SELECT id, first_name FROM users WHERE admin = 1 AND ";
        $sql .= "id NOT IN ";
        $sql .= "(SELECT organizerID 
          FROM tournamentcoorganizers WHERE tournamentID = ". $id . ")";
        $sql .= "AND id NOT IN ";
        $sql .= "(SELECT tournamentOrganizer FROM tournament WHERE tournamentID = ". $id.");";
        $result = mysqli_query($db, $sql);
        //confirm_result_set($result);
        return $result;
    }

    function find_members() {
      global $db;
      $sql = "SELECT * FROM users WHERE admin = 0; ";
      $result = mysqli_query($db, $sql);
      //confirm_result_set($result);
      return $result;
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
