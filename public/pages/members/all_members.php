<?php require_once('../../../private/initialise.php'); ?>
<?php 
require_login();
require_system_admin_login();
?>
<?php include(SHARED_PATH . '/header.php'); ?>

<h1 style="font-size: 50px;", text-align="center">Society Members</h1>


  <table class="table table-hover table-dark">	<!-- style="width:100%" -->
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Address</th>				
      <th scope="col">Phone Number</th>
      <th scope="col">Gender</th>
      <th scope="col">Date of birth</th>
      <th scope="col">Elo Rating</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $members = find_all_members();
        if (mysqli_num_rows($members) > 0) {
            while($row = mysqli_fetch_assoc($members)){
              
                echo "<tr>";
                    echo "<th scope='col'>". $row["username"]. "</th>";
                    echo "<th scope='col'>". $row["first_name"]. " " . $row["last_name"]."</th>";
                    echo "<th scope='col'>". $row["email"]. "</th>";
                    echo "<th scope='col'>". $row["address"]. "</th>";
                    echo "<th scope='col'>". $row["phone"]. "</th>";
                    echo "<th scope='col'>". $row["gender"]. "</th>";
                    echo "<th scope='col'>". $row["dob"]. "</th>";
                    echo "<th scope='col'>". $row["rating"]. "</th>";
                  

                if($row["admin"] == 0){
                    echo "<th scope='col'>";
                    echo '<form width="800px" margin="auto" action="all_members.php?" method="post">';
                    echo '<input type="submit" name ="promote'. $row["id"] .'" value="Promote" />';
                    echo '<input type="hidden" name="promotedID" value="'.$row["id"] .'" />';
                    echo '</form>';
                    echo "</th>";
                    if(isset($_POST["promote". $row["id"] ])) {
                        promote_member($_POST["promotedID"]);
                        $secondsWait = 0;
                        echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
                    }
                }else{
                    echo "<th scope='col'>";
                    echo '<form width="800px" margin="auto" action="all_members.php?" method="post">';
                    echo '<input type="submit" name ="demote'. $row["id"] .'" value="Demote" />';
                    echo '<input type="hidden" name="demotedid" value="'.$row["id"] .'" />';
                    echo '</form>';
                    echo "</th>";
                    if(isset($_POST["demote". $row["id"] ])) {
                        demote_member($_POST["demotedid"]);
                        $secondsWait = 0;
                        echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
                    }   

                    if($row["system_admin"] == 0){
                        echo "<th scope='col'>";
                        echo '<form width="800px" margin="auto" action="all_members.php?" method="post">';
                        echo '<input type="submit" name ="promote'. $row["id"] .'" value="Promote to system admin" />';
                        echo '<input type="hidden" name="promotedid" value="'.$row["id"] .'" />';
                        echo '</form>';
                        echo "</th>";
                        if(isset($_POST["promote". $row["id"] ])) {
                            promote_admin($_POST["promotedid"]);
                            $secondsWait = 0;
                            echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
                        } 
                    }
                    else{
                        echo "<th scope='col'>";
                        echo '<form width="800px" margin="auto" action="all_members.php?" method="post">';
                        echo '<input type="submit" name ="demote'. $row["id"] .'" value="Demote from system admin" />';
                        echo '<input type="hidden" name="demoteid" value="'.$row["id"] .'" />';
                        echo '</form>';
                        echo "</th>";
                        if(isset($_POST["demote". $row["id"] ])) {
                            promote_admin($_POST["demoteid"]);
                            $secondsWait = 0;
                            echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
                        } 
                    }
                    
                }

                echo "</tr>";

                  
            }
        }
        else{
            echo '<p> No tournaments could be found.</p>';   
        }
        ?>

    </tbody>
     <!--?php showMembers(); ?--> 
  </table>
<?php include(SHARED_PATH . '/footer.php'); ?>
