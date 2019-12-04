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
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap-grid.css"> To be changed when using the bootstrap documentation instead of the weblink -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="sidenav">
  <a href="#">Log in / Sign up</a>
  <a href="#">Profile</a>
  <a href="#">Members</a>
  <a href="#">What's New ?</a>
  <a href="event.php">Upcoming events</a>
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