<?php require_once('../../../private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

    <!--Main container-->
    <div class="main">

        <!--Stylesheet for header-->
        <link rel="stylesheet" media="all" href="<?php echo url_for('pages/stylesheets/home.css'); ?>"/>
        
        <br>
            <h1>About Us</h1>
        </br>

        <br>

            <p>
                Whether you’re the next Magnus Carlsen or a complete beginner 
                just hoping to learn the rules of chess, the chess society has
                something for you. In our relaxed weekly sessions beginners
                will be able to learn the rules and basic strategies of the game,
                while more experienced players can test their skills against
                worthy opposition.
            </p>
            <br>
            <a href="<?php echo url_for('pages/sign_up.php'); ?>">Click here to become a member today!</a>

            <!--Sub-Image in relation with the text above-->
            <img id="subImage" src="<?php echo url_for('Images/Chess.jpg'); ?>">

        <br>
        
    </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
