<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<?php include(SHARED_PATH . '/navigation.php'); ?>
<?php
       function  createNewEvent(){
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $dbname = 'chess_society';  
            $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
      
            try {
                $insertqry;
                if(empty($_EVENT["link"])){
                    $insertqry='INSERT INTO opening_event(eventTitle, eventDesc, eventDate) values ("' . $_EVENT["title"] . '","' . $_EVENT["description"] . '", now());';                    
                }
                else{
                    $insertqry='INSERT INTO opening_event(eventTitle, eventDesc, eventDate, eventImage@) values ("' . $_EVENT["title"] . '","' . $_EVENT["description"] . '", now(),"'. $_EVENT["link"] .'" );';
                }
                $event = mysqli_query($connection, $insertqry);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
        }
?>


<link rel="stylesheet" href=".../.../newsStyle.css">
<div class="header">
  <h2>Events</h2>
</div>


  <div class="leftcolumn">

 
    <form  action="new.php" method="event">

        Event Title: <input type="text" name="title" /><br>
    
        Event Description: <input type="text" name="description" /><br>
        
        Image Link: <input type="text" name="link" /><br><br>
        
        Expiry date: <input type="datetime-local" name="date" /><br><br>
        
        <input type="submit" name="Create" />
    
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD']=='EVENT'){
            $currentDateTime = date('Y-m-d');
            $currentdatetime1 =  date_create($currentDateTime);
            if($_EVENT["date"] < $currentdatetime1){
                $message = "The expiry date can't come before the date it's displayed on !";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            if(!empty($_EVENT["description"]) && !empty($_EVENT["title"])){
                createNewEvent();
            }
            else{
                $message = "You need to have both a title and a description ";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        } 
    ?>
    
  
  <?php include(SHARED_PATH . '/footer.php'); ?>
