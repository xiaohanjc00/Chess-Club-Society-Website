<!DOCTYPE html>
<html>
<head>
<style>

.Event {
  float: left;
  width: 100%;
  padding: 8px;
}

</style>
</head>



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
        $event = mysqli_query($connection,'SELECT * FROM posts ORDER BY eventDate DESC');
        if (mysqli_num_rows($event) > 0) {
            while($row = mysqli_fetch_assoc($event)){
                date_default_timezone_get();
                $currentDateTime = date('Y-m-d');
                $currentdatetime1 =  date_create($currentDateTime);
                $E_Date2 =  date_create(date('Y-m-d',strtotime($row['E_Date'])));
                $dDiff = $E_Date2 ->diff($currentdatetime1);;
                if($dDiff->format('%r%a') > 7){
                    mysqli_query($connection, 'DELETE FROM posts WHERE E_id='.$row['E_id'] );
                }
                else{
                    echo '<div class="card">';
                    echo '<div class="dropdown">';
                    echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="arrow down"> </i>';
                    echo '<span class="caret"></span></button>';
                    echo '<div class="dropdown-content ">';
                    echo  '<a href="editEvent.php?id='.$row['E_id'].'">Edit</a>';
                    echo '<a href="deleteEvent.php?id='.$row['E_id'].'">Delete</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '<h1><a href=".php?id='.$row['E_id'].'">'.$row['E_Title'].'</a></h1>';
                    echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['E_Date'])).'</p>';
                   //echo '<img class="fakeimg" src="' .$row['eventImage'] .'"">';
                    echo '<p>'. get_words($row['eventDesc']).'</p>';
                    echo '<p><a href="event.php?id='.$row['eventID'].'">Read More</a></p>';
                    echo '</div>';
                }
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
?>

  </div>

<body>

<h1 align="center">Chess Society Events</h1>

<h2>Opening Events</h2>

<p>Click title for more details</p>

  <a href="<?php echo 'show.php?Etitle='.$event['E_Title']?>"><div class="Event" style="background-color:#aaa;">
    <h2>Event</h2>
    <p>..</p>
  </div></a>
  
    <a href="<?php echo 'show.php?Etitle='.$event['E_Title']?>"><div class="Event" style="background-color:#bbb;">
    <h2>Event</h2>
    <p>..</p>
  </div>
</div></a>

    <a href="<?php echo 'show.php?Etitle='.$event['E_Title']?>"><div class="Event" style="background-color:#ccc;">
    <h2>Event</h2>
    <p>..</p>
  </div></a>
  
    <a href="<?php echo 'show.php?Etitle='.$event['E_Title']?>"><div class="Event" style="background-color:#ddd;">
    <h2>Event</h2>
    <p>..</p>
    <p> 
  </div></a>
</div>

<div class="card">
     <form action="createEvent.php">
        <input type="submit" value="Create new Event" />
    </form>
    
<h2>Tournaments</h2>

<p>Click title for more details</p>

  <a class="action" href="<?php echo 'show.php?Etitle='.$Tournaments['T_Title']?>"><div class="Event" style="background-color:#aaa;">
    <h2>Tournament</h2>
    <p>..</p>
  </div></a>
  
  <a class="action" href="<?php echo 'show.php?id='.$Tournaments['T_Title']?>"><div class="Event" style="background-color:#bbb;">
    <h2>Tournament</h2>
    <p>..</p>
  </div></a>
</div>

<div class="row">
  <a class="action" href="<?php echo 'show.php?id='.$Tournaments['T_Title']?>"><div class="Event" style="background-color:#ccc;">
    <h2>Tournament</h2>
    <p>..</p>
  </div></a>
  
  <a class="action" href="<?php echo 'show.php?id='.$Tournaments['T_Title']?>"><div class="Event" style="background-color:#ddd;">
    <h2>Tournament</h2>
    <p>..</p></a>
  </div>
</div>
</body>
</html>


  </div>
  <div class="rightcolumn">

    <div class="card">
    </div>

    <div class="card">
     <form action="createEvent.php">
        <input type="submit" value="Create new Event" />
    </form>


    </div>
  </div>
</div>
