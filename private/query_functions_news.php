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

        if(!is_blank($article['expiry_date']) && $currentdatetime1 >= $expiryDate){
        $errors[] = "Please enter a valid expiry date. Its value cannot come before todays date";
        }
        return $errors;
    }

    function insert_news_article($article) {
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
        $result = mysqli_multi_query($db, $sql);
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