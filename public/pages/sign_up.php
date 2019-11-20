<!doctype html>
<html>
<style type="text/css">
  
  h1 {
    color: #37474f;
    text-decoration: underline;
    text-align: center;
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
  <h1 style="font-size: 40px;">Join the Chess Society now !</h1>
  
  <p>Tell us a bit about yourself</p>
  <form width=" 800px;" margin="auto;" style="font-size:18px; color: #37474f;" align="left" action="......TO BE CHANGED....../.php" method="post">
    Name : <input type="text" name="Name"><br>
    Address : <input type="text" name="Address"><br>
    Phone Number : <input type="text" name="Phone Number"><br>
    Date of Birth : <input type="text" name="Date of Birth"><br>
    Gender : <input type="text" name="Gender"><br>
    username : <input type="text" name="username"><br>
    Ever played chess before ? <input type="checkbox"><br>

    
    <input type="submit">
</form>
  <br>
  
  <br>
      

</div>
</body>
</html>
