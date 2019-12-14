<?php require_once('../../../private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

    <head>
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
