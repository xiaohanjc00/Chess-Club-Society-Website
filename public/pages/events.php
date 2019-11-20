<link rel="stylesheet" href="/stylesheets/eventsStyle.css">

<div class="title">
  <h2>News</h2>
</div>

<div class="row">
  <div id = "main" class="leftcolumn">
  <?php
      function get_words($sentence, $count = 35) {
          preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
          return $matches[0];
      }

        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'chessSociety';

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    try {

        $article = mysqli_query($connection,'SELECT * FROM posts ORDER BY articleDate DESC');
        if (mysqli_num_rows($article) > 0) {
            while($row = mysqli_fetch_assoc($article)){
                date_default_timezone_get();
                $currentDateTime = date('Y-m-d');
                $currentdatetime1 =  date_create($currentDateTime);
                $articledatetime2 =  date_create(date('Y-m-d',strtotime($row['articleDate'])));
                $dDiff = $articledatetime2 ->diff($currentdatetime1);;
                if($dDiff->format('%r%a') > 7){
                    mysqli_query($connection, 'DELETE FROM posts WHERE articleID='.$row['articleID'] );
                }
                else{
                    echo '<div class="card">';
                    echo '<div class="dropdown">';
                    echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="arrow down"> </i>';
                    echo '<span class="caret"></span></button>';
                    echo '<div class="dropdown-content ">';
                    echo  '<a href="editArticle.php?id='.$row['articleID'].'">Edit</a>';
                    echo '<a href="deleteArticle.php?id='.$row['articleID'].'">Delete</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '<h1><a href=".php?id='.$row['articleID'].'">'.$row['articleTitle'].'</a></h1>';
                    echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['articleDate'])).'</p>';
                    echo '<img class="fakeimg" src="' .$row['articleImage'] .'"">';
                    echo '<p>'. get_words($row['articleDesc']).'</p>';
                    echo '<p><a href="viewArticle.php?id='.$row['articleID'].'">Read More</a></p>';
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
  <div class="rightcolumn">

    <div class="card">
      <h3>Popular Post</h3>
    </div>

    <div class="card">
     <form action="createArticle.php">
        <input type="submit" value="Create new article" />
    </form>


    </div>
  </div>
</div>
