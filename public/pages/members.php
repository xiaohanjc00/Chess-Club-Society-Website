<?php 
require_once('../../private/initialise.php');
// require_login();
// require_admin_login();
?>
<?php include(SHARED_PATH . '/header.php'); ?>

<h1 style="font-size: 50px;", text-align="center">Team Members</h1>
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
      <tr>
        <th scope="row">Name1</th>
        <td>Address1</td>
        <td>#1</td>
        <td>M</td>
        <td>01/01</td>
        <td>110</td>
      </tr>
      <tr>
        <th scope="row">Name2</th>
        <td>Address2</td>
        <td>#2</td>
        <td>F</td>
        <td>01/02</td>
        <td>100</td>
      </tr>
      <tr>
        <th scope="row">Name3</th>
        <td>Address3</td>
        <td>#3</td>
        <td>F</td>
        <td>01/03</td>
        <td>130</td>
      </tr>
    </tbody>
     <!--?php showMembers(); ?--> 
  </table>
<?php include(SHARED_PATH . '/footer.php'); ?>
