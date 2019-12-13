<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<link rel="stylesheet" href="../stylesheets/newsStyle.css">

<div class="header">
  <h2>News</h2>
</div>

<div class="row">
  <div id = "main" class="left">
  <?php
      function get_words($sentence, $count = 35) {
          preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
          return $matches[0];
      }
    
      
    try {
        $article = find_all_articles();
        if (mysqli_num_rows($article) > 0) {
            while($row = mysqli_fetch_assoc($article)){
                date_default_timezone_get();
                $currentDateTime = date('Y-m-d');
                $currentdatetime1 =  date_create($currentDateTime);
                $articledatetime2 =  date_create(date('Y-m-d',strtotime($row['articleExpiry'])));
                if($currentdatetime1 == $articledatetime2 ){
                    delete_article($row['articleID']); 
                }
                else{
                    echo '<div class="card">';
                    if(is_logged_in() && user_is_admin()){
                      echo '<div class="dropdown">';
                      echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"></i>';
                      echo '<span class="caret"></span></button>';
                      echo '<div class="dropdown-content">';
                      echo  '<a href="edit.php?id='.$row['articleID'].'">Edit</a>';
                      echo '<a href="delete.php?id='.$row['articleID'].'">Delete</a>';
                      echo '</div>';   
                      echo '</div>';
                    }
                    echo '<h1><a href="show.php?id='.$row['articleID'].'">'.$row['articleTitle'].'</a></h1>';
                    echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['articleDate'])).'</p>';
                    echo '<img class="fakeimg" src="' .$row['articleImage'] .'"">';
                    echo '<p>'. get_words($row['articleDesc']).'</p>';                
                    echo '<p><a href="show.php?id='.$row['articleID'].'">Read More</a></p>';                
                    echo '</div>';
                }
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
    ?>
  </div>
  <div class="right">
  <?php 
    if(is_logged_in() && user_is_admin()){
      echo "<div class='card'>";
      echo "<form action='new.php'>";
      echo "<input type='submit' value='Create new article' />";
      echo "</form>";
    }
  ?>

    </div>
  </div>
</div>

    
<?php include(SHARED_PATH . '/footer.php'); ?>
