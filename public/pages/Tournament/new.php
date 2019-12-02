<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php include(SHARED_PATH . '/navigation.php'); ?>
<?php
       function  createNewTournament(){
            try {
                insert_tournament($_POST["organizer"], $_POST["name"],$_POST["date"], $_POST["deadline"]);
                
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
        }
?>


<link rel="stylesheet" href="/lab/stylesheets/newsStyle.css">
<div class="header">
  <h2>Tournament</h2>
</div>


  <div class="leftcolumn">
    <form  action="new.php" method="post">

        Tournament organizer: <input type="text" name="organizer" /><br>
    
        Tournament Name: <input type="text" name="name" /><br>
        
        Tournament Date: <input type="datetime-local" name="date" /><br><br>
        
        Registration deadline: <input type="datetime-local" name="deadline" /><br><br>
        
        <input type="submit" name="Create" />
    
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!empty($_POST["organizer"]) && !empty($_POST["name"])){
                createNewArticle();
            }
        } 
    ?>
  
  <?php include(SHARED_PATH . '/footer.php'); ?>
