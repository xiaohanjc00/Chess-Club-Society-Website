<?php require_once('../../../private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<style type="text/css">
  
  h1{
    color: #37474f;
    text-decoration: overline;
    text-align: center;
  }

  h2, h3{
    color: #37474f;
    text-decoration: underline;
    text-align: left;
  }

  h4{
    color: #37474f;
    text-decoration: underline;
    text-align: center;
  }

  h4:hover{
    color: red;
    text-decoration: underline;
    text-align: center;
  }

  li{
    color: #37474f;
    text-indent: 25px;
    font-size: 25px;
  }

  p{
    color: #37474f;
    font-size: 25px;
    text-indent: -25px;
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
  margin-left: 300px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}
.error {color: #FF0000;}

input[type=text], select {
  width: 100%;
  color: #37474f;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #37474f;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=password]{
  width: 100%;
  color: #37474f;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #37474f;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #37474f;
  color: #f1f1f1;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #b4c3cb;
}

</style>
<head>
  <!-- <link rel="stylesheet" type="text/css" href="bootstrap-grid.css"> To be changed when using the bootstrap documentation instead of the weblink -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="sidenav">
  <a href="#">...</a>
  <a href="#">...</a>
  <a href="#">To Be Updated</a>
  <a href="#">...</a>
  <a href="#">...</a>
  </div>
  <div class="main">
  <br>
  <h1 style="font-size: 50px;">My Profile</h1>
  
  <h2>Chess society account</h2>
  <?php get_user() ?>
  <br>
  <br>
  <br>
  <form width=" 800px;" margin="auto;" style="font-size:17px; color: #37474f;" align="left" action="profile.php"><input type="submit" value="Delete Chess Society Account" onclick="return confirm('You are about to withdraw as a member of the Chess Society and have all your data removed. Do you want to continue ?')"></form>
      

</div>
</body>

<?php include(SHARED_PATH . '/footer.php'); ?>
