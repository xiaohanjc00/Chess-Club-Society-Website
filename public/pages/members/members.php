<?php require_once('../../../private/initialise.php'); ?>
<?php 
require_login();
require_admin_login();
?>
<?php include(SHARED_PATH . '/header.php'); ?>

<h1 style="font-size: 50px;", text-align="center">Team Members</h1>


  <table class="table table-hover table-dark">	<!-- style="width:100%" -->
  <thead>
    <tr>
      <th scope="col">Username</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>				
      <th scope="col">Phone Number</th>
      <th scope="col">Gender</th>
      <th scope="col">Date of birth</th>
      <th scope="col">Elo Rating</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $members = find_members();
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
                  echo "<th scope='col'>";

                  echo '<form width="800px" margin="auto" action="members.php?" method="post">';
                  echo '<input type="submit" name ="ban'. $row["id"] .'" value="Ban this user" />';
                  echo '<input type="hidden" name="bannedemail" value="'.$row["email"] .'" />';
                  echo '<input type="hidden" name="bannedid" value="'.$row["id"] .'" />';
                  echo '</form>';
                  echo "</th>";
                echo "</tr>";
                if(isset($_POST["ban". $row["id"] ])) {
                  ban_user($_POST["bannedemail"]);
                  delete_user($_POST["bannedid"]);
                  $secondsWait = 0;
                  echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
                }
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
