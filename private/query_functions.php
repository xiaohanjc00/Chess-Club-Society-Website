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
    
    $sql = 'INSERT INTO posts(articleTitle, articleDesc, articleDate) values ("' . $title . '","' . $description . '", now());'
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
  
  function insert_article($title, $description, $link) {
    global $db;
    
    $sql = 'INSERT INTO posts(articleTitle, articleDesc, articleDate, articleImage) values ("' . $title . '","' . $description . '", now());'
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }function insert_tournament($tournamentOrganizer, $tournamentName, $tournamentDate, $deadl) {
    global $db;
    
    $sql = 'INSERT INTO posts(articleTitle, articleDesc, articleDate, articleImage) values ("' . $title . '","' . $description . '", now());'
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