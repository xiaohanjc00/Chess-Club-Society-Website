<?php 

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
?>