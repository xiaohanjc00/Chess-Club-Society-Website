<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<?php include(SHARED_PATH . '/navigation.php'); ?>
<?php
       function  createNewArticle(){
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $dbname = 'chessSociety';  
            $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
      
            try {
                $insertqry;
                if(empty($_POST["link"])){
                    $insertqry='INSERT INTO posts(articleTitle, articleDesc, articleDate) values ("' . $_POST["title"] . '","' . $_POST["description"] . '", now());';                    
                }
                else{
                    $insertqry='INSERT INTO posts(articleTitle, articleDesc, articleDate, articleImage@) values ("' . $_POST["title"] . '","' . $_POST["description"] . '", now(),"'. $_POST["link"] .'" );';
                }
                $article = mysqli_query($connection, $insertqry);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
        }
?>


<link rel="stylesheet" href="/lab/stylesheets/newsStyle.css">
<div class="header">
  <h2>News</h2>
</div>


  <div class="leftcolumn">

 
    <form  action="new.php" method="post">

        Article Title: <input type="text" name="title" /><br>
    
        Article Description: <input type="text" name="description" /><br>
        
        Image Link: <input type="text" name="link" /><br><br>
        
        Expiry date: <input type="datetime-local" name="date" /><br><br>
        
        <input type="submit" name="Create" />
    
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $currentDateTime = date('Y-m-d');
            $currentdatetime1 =  date_create($currentDateTime);
            if($_POST["date"] < $currentdatetime1){
                $message = "The expiry date can't come before the date it's displayed on !";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            if(!empty($_POST["description"]) && !empty($_POST["title"])){
                createNewArticle();
            }
            else{
                $message = "You need to have both a title and a description ";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        } 
    ?>
    
  
  <?php include(SHARED_PATH . '/footer.php'); ?>
