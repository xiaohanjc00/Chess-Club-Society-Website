<?php require_once('../../../private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

    <!--Main container-->
    <div class="main">
        <!--Stylesheet for header-->
        <link rel="stylesheet" media="all" href="<?php echo url_for('pages/stylesheets/home.css'); ?>"/>
        
        <br>
        <h1>Welcome to the Chess Society</h1>
        <br>
        <p>
            Whether you’re the next Magnus Carlsen or a complete beginner 
            just hoping to learn the rules of chess, the chess society has
            something for you. In our relaxed weekly sessions beginners
            will be able to learn the rules and basic strategies of the game,
            while more experienced players can test their skills against
            worthy opposition.
        </p>
        <!--Sub-Image in relation with the text above-->
        <img id="subImage" src="<?php echo url_for('Images/Chess.jpg'); ?>">
        <br>

        <!--Other information essential for the home page-->
        <h2 style="font-size: 30px;">Upcoming events</h2>
        <li>........</li>
        <li>........</li>
        <li>........</li>
    </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
