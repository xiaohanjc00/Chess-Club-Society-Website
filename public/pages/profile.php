<!-- <?php require_once('../../private/initialise.php'); ?> -->

<?php echo "hello, this is the profile page." ?></br>

<?php 
    $first_name = "Firstname"; // replace with database query
    $last_name = "Lastname"; // replace with database query
    $name = $first_name . " " . $last_name;
    $pic_url = "https://cdn3.f-cdn.com/contestentries/1376995/30494909/5b566bc71d308_thumb900.jpg"; // replace with database query
    $profile_pic = "<a><img src=\"" . $pic_url . "\" alt=\"profile picture\" width=110></a>";
?>

<?php $page_title = 'Profile'; ?>
<!-- <?php include(SHARED_PATH . '/header.php'); ?> -->

<?php echo "hello, this is the profile page." ?></br>
<?php echo "soon you will be able to edit your name, address, phone number, gender and date of birth" ?></br>
<?php echo "soon you will be able to withdraw as a member of the Chess Society and have all your data removed." ?></br>

<div>
    <h4>Full Name: </h4><?php echo $name ?>
    <h4>Profile picture: </h4><?php echo $profile_pic ?>
    <h4>Chess rating: </h4><?php echo "XXX" ?>
    <h4>Email: </h4><?php echo "name@domain.com" ?>
    <h4>Phone number: </h4><?php echo "12345678900" ?>
    <h4>Mailing address: </h4><?php echo "123 Town, City, ZIP" ?>
    <h4>Gender: </h4><?php echo "F / M / -" ?>
    <h4>Date of birth: </h4><?php echo "15/08/1997" ?>
</div>
<div>
    <p>
        <a href="url_for_edit_profile_details_page">Edit Profile</a></br>
        <a href="url_for_delete_confirmation_page">Cancel membership</a></br>
    </p>
</div>

<!-- <?php include(SHARED_PATH . '/footer.php'); ?> -->

<!--
<!doctype html>
<html>
<style type="text/css">
  h1{
    color: #37474f;
    text-decoration: overline;
    text-align: center;
  }
  h2{
    color: #37474f;
    text-decoration: underline;
    text-align: left;
  }

  p{
    color: #37474f;
    text-indent: 25px;
    font-size: 20px;
  }
  
  li{
    color: #37474f;
    text-indent: 25px;
    font-size: 25px;
  }

  img { 
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 30%;

  }
  
  .sidenav {
  height: 100%;
  width: 250px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #37474f;
  overflow-x: hidden;
  padding-top: 20px;
  border-right: 3px solid black;
}

.sidenav a {
  padding: 12px 16px 20px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #b4c3cb;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 320px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

</style>
<head>
	// <link rel="stylesheet" type="text/css" href="bootstrap-grid.css"> To be changed when using the bootstrap documentation instead of the weblink
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="sidenav">
  <a href="#">Log in / Sign up</a>
  <a href="#">Profile</a>
  <a href="#">Members</a>
  <a href="#">What's New ?</a>
  <a href="#">Upcoming events</a>
  </div>
  <div class="main">
  <br>
    <h1 style="font-size: 50px;">Chess Society</h1>
  <br>
      <p>Whether you’re the next Magnus Carlsen or a complete beginner just hoping to learn the rules of chess, the chess society has something for you. In our relaxed weekly sessions beginners will be able to learn the rules and basic strategies of the game, while more experienced players can test their skills against worthy opposition.
      </p>
      <img src="public/Images/Chess.jpg">
      <br>
      <h2 style="font-size: 30px;">Upcoming events</h2>
      <li>........</li>
      <li>........</li>
      <li>........</li>

</div>
</body>
</html>
-->
