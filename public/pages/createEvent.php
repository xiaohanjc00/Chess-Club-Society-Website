<!--
<!DOCTYPE html>
<html>
<body>

<h1>Create Event</h1>

<form action="/action.php">
  Event Name:  <input type="text" name="Ename">
  <input type="submit">
</form>

<br>

<form action="/action.php">
  Event Date: <input type="datetime-local" name="daytime">
  <input type="submit">
</form>


</body>
</html>
-->
<?php
       function  createNewEvent(){
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
            echo '<meta http-equiv="refresh" content="0;URL=event.php"/>';
        }
?>


<link rel="stylesheet" href="../newsStyle.css">
<div class="title">
  <h2>Create Event</h2>
</div>


  <div class="leftcolumn">


  <form  action="createEvent.php" method="post">
  
    Event Name:  <input type="text" name="Ename"/><br><br>
  
    Event Date: <input type="datetime-local" name="Edaytime"/><br><br>

    <!--Article Title: <input type="text" name="title" /><br>

    Article Description: <input type="text" name="description" /><br>

    Image Link: <input type="text" name="link" /><br><br>-->

    <input type="submit" name="Create" />

    </form>
    <?php
           if($_SERVER['REQUEST_METHOD']=='POST')
           {
               createNewEvent();
           }
        ?>

  </div>
