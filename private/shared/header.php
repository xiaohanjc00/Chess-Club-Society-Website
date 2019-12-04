<!doctype html>
<html lang="en">
    <head>
        <title>KCL Chess Club</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--Stylesheet for bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!--Stylesheet for public pages-->
        <link rel="stylesheet" media="all" href="<?php echo url_for('pages/stylesheets/public.css'); ?>" />
        <!--Stylesheet for header-->
        <link rel="stylesheet" media="all" href="<?php echo url_for('pages/stylesheets/header.css'); ?>"/>
    </head>

    <body>
        <header>
            <!--Top part of the header (Images and Title)-->
            <div class="topContainer">
                <img class="image" id="chessImage" src="<?php echo url_for('Images/chessboard.jpeg'); ?>">
                <div class="centeredTitle">KCL Chess Society</div>
                <img class="image" id="kclImage" src="<?php echo url_for('Images/img_kcl.png'); ?>">
            </div>

            <!--Bottom part of the header (Navigation Bar)-->
            <div class="topNav">
            <a href="<?php echo url_for('pages/index.php'); ?>">Home</a>
            <a href="<?php echo url_for('pages/News/index.php'); ?>">News</a>
            <a href="<?php echo url_for('pages/Event/index.php'); ?>">Events</a>
            <a href="<?php echo url_for('pages/Tournament/index.php'); ?>">Tournaments</a>
            <a href="<?php echo url_for('pages/members.php'); ?>">Member List</a>
            <a href="<?php echo url_for('pages/log_in.php'); ?>">Login</a>
            <a href="<?php echo url_for('pages/profile.php'); ?>">Profile</a>
            <a href="<?php echo url_for('pages/contact.php'); ?>">Contact Us</a>
            </div>

        </header>
