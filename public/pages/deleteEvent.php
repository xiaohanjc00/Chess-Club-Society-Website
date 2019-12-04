<?php
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'chessSociety';
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    try {
        $event = mysqli_query($connection,'SELECT * FROM posts WHERE E_id =' .$_GET['id']);
        if (mysqli_num_rows($event) > 0) {
            while($row = mysqli_fetch_assoc($event)){
                mysqli_query($connection, 'DELETE FROM posts WHERE E_id='.$row['E_id'] );
            }
        }
        else{
            echo '<div class="card">';
            echo '<p> No events could be found.</p>';
            echo '</div>';
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo '<meta http-equiv="refresh" content="0;URL=news.php"/>';
?>
