<?php
       function  createNewArticle(){
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $dbname = 'chessSociety';
            $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

            try {
                echo $_POST["title"];

                $insertqry='INSERT INTO posts(articleTitle, articleDesc, articleDate) values ("' . $_POST["title"] . '","' . $_POST["description"] . '", now());';
                $article = mysqli_query($connection, $insertqry);


            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            echo '<meta http-equiv="refresh" content="0;URL=news.php"/>';
        }
?>


<link rel="stylesheet" href="/stylesheets/newsStyle.css">
<div class="title">
  <h2>News</h2>
</div>


  <div class="leftcolumn">


  <form  action="createArticle.php" method="post">

    Article Title: <input type="text" name="title" /><br>

    Article Description: <input type="text" name="description" /><br>

    Image Link: <input type="text" name="link" /><br><br>

    <input type="submit" name="Create" />

    </form>
    <?php
           if($_SERVER['REQUEST_METHOD']=='POST')
           {
               createNewArticle();
           }
        ?>

  </div>
