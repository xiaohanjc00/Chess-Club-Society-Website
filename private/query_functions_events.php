<?php 

    // functions for accessing and updating news:

    function find_all_events() {
        global $db;

        $sql = "SELECT * FROM events ORDER BY eventDate DESC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_event_by_id($id) {
        global $db;

        $sql = "SELECT * FROM events WHERE eventID =" . $id;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function delete_event($id) {
        global $db;

        $sql = "DELETE FROM events WHERE eventID= ".$id;
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

    function validate_event($event, $options=[]) {
        $errors = [];
        if(is_blank($event['event_title'])) {
            $errors[] = "Please enter the title of the event.";
        } elseif (!has_length($event['event_title'], array('min' => 2, 'max' => 255))) {
            $errors[] = "Please enter a valid title.";
        }
        if(is_blank($event['event_description'])) {
            $errors[] = "Please enter the description of the event.";
        } elseif (!has_length($event['event_description'], array('min' => 15, 'max' => 5000))) {
            $errors[] = "Please enter a valid description.";
        }

        date_default_timezone_get();
        $currentDateTime = date('Y-m-d');
        $currentdatetime1 =  date_create($currentDateTime);
        $expiryDate =  date_create(date('Y-m-d',strtotime($event['expiry_date'])));

        if($currentdatetime1 >= $expiryDate){
        $errors[] = "Please enter a valid expiry date. Its value cannot come before todays date";
        }
        return $errors;
    }

    function insert_event($event) {
        global $db;

        $errors = validate_event($event);
        if (!empty($errors)) {
            return $errors;
        }
        $sql = 'INSERT INTO';
        $sql .=' events(eventTitle, eventDesc, eventDate ';
        if(!is_blank($event['image_link'])){ $sql.= ', eventImage' ;}
        if(!is_blank($event['expiry_date'])) {$sql .= ', eventExpiry';}
        $sql .= ')values ("' ;
        $sql .= db_escape($db,$event['event_title']) ;
        $sql .= '", "' . db_escape($db, $event['event_description']) ;
        $sql .= '", current_date()';
        if(!is_blank($event['image_link'])) $sql.= ', "' . db_escape($db, $event['image_link']) . '"' ;
        if(!is_blank($event['expiry_date'])) $sql .= ', "' . db_escape($db,$event['expiry_date']) . '"';
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

    function update_event($event, $id) {
        global $db;

        $sql;
        if(!is_blank($event['event_title'])) $sql .= 'UPDATE events set eventTitle= "'.  db_escape($db, $event['event_title']) . '" WHERE eventID =' .$id.';';
        if(!is_blank($event['image_link'])) $sql .= 'UPDATE events set eventImage= "'.  db_escape($db, $event['image_link']) . '" WHERE eventID =' .$id.';';
        if(!is_blank($event['expiry_date'])) $sql .=  'UPDATE events set eventExpiry= "'.  db_escape($db, $event['expiry_date']) . '" WHERE eventID =' .$id.';';
        if(!is_blank($event['event_description'])) $sql .= 'UPDATE events set eventDesc= "'.  db_escape($db, $event['event_description']) . '" WHERE eventID =' .$id.';';
        
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

?>