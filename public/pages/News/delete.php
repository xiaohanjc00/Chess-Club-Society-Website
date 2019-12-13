<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>

  <?php
      
    try {
        $article = find_article_by_id($_GET['id']);
        if (mysqli_num_rows($article) > 0) {
            while($row = mysqli_fetch_assoc($article)){
                delete_article($row['articleID']) ;
            }
        }
        else{
            echo '<div class="card">';
            echo '<p> No articles could be found.</p>';         
            echo '</div>'; 
        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
?>
  
 