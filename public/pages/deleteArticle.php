
  <?php
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'chessSociety';

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    try {
        $article = mysqli_query($connection,'SELECT * FROM posts WHERE articleID =' .$_GET['id']);
        if (mysqli_num_rows($article) > 0) {
            while($row = mysqli_fetch_assoc($article)){
                mysqli_query($connection, 'DELETE FROM posts WHERE articleID='.$row['articleID'] );
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
    echo '<meta http-equiv="refresh" content="0;URL=news.php"/>';
?>
