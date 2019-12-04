  
    
    <footer class="page-footer">

        <!--Stylesheet for footer-->
        <link rel="stylesheet" media="all" href="<?php echo url_for('pages/stylesheets/footer.css'); ?>"/>
    
        <div style="background-color: #21d192;">
            <div class="container">
    
                <!-- First row -->
                <div class="row py-4 my-2">
    
                    <!-- First grid -->
                    <div class="col-md-4 mx-auto">
                    <h6 class="text-uppercase font-weight-bold">KCL Chess Club</h6>
                    <hr>
                    <p class="footerP">Come and join our Chess Club and learn how to play chess as a PRO</p>   
                    </div>
    
                    <!-- Second grid -->
                    <div class="col-md-2 mx-auto">
                        <h6>Useful Links</h6>
                        <hr>
                        <p class="footerP"><a href="<?php echo url_for('pages/index.php'); ?>">Home</a></p>
                        <p class="footerP"><a href="<?php echo url_for('pages/News/index.php'); ?>">News</a></p>
                        <p class="footerP"><a href="<?php echo url_for('pages/events.php'); ?>">Events</a></p>
                        <p class="footerP"><a href="<?php echo url_for('pages/Tournament/index.php'); ?>">Tournaments</a></p>
    
                    </div>
    
                    <!-- Grid column -->
                    <div class="col-md-4 mx-auto">
                        <h6>Contact</h6>
                        <hr>
                        <p class="footerP"><i class="fa fa-home"></i> Strand, London, UK</p>
                        <p class="footerP"><i class="fa fa-envelope"></i> kclchessclub.kcl.ac.uk</p>
                        <p class="footerP"><i class="fa fa-phone"></i> + 44 020 7848 1588</p>
                        <p class="footerP"><i class="fa fa-print"></i> + 44 020 7836 5454</p>
    
                    </div>
                </div>
    
                <!-- Second row -->
                <div class="row align-items-center">
    
                    <!-- First Grid -->
                    <div class="col-md-6 text-center text-md-left mb-md-0">
                    <h6>Get connected with us on social networks!</h6>
                    </div>
    
                    <!-- Second Grid -->
                    <div class="col-md-6 text-center text-md-right">
                        <!-- Add icon library -->
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
                        <a href="https://www.facebook.com/kclsupage/" class="fb-ic">
                            <i class="fa fa-facebook-f white-text mr-4"> </i>
                        </a>
                        <a href="https://twitter.com/kclsu" class="tw-ic">
                            <i class="fa fa-twitter white-text mr-4"> </i>
                        </a>
                        <a href="https://www.instagram.com/kclsu/" class="ins-ic">
                            <i class="fa fa-instagram white-text"> </i>
                        </a>
    
                    </div>
                </div>
    
                <!-- Third row -->
                <div class="footer-copyright text-center py-2" id ="copyright">© 2019 Copyright:
                    <a href="<?php echo url_for('pages/index.php'); ?>"> kclchessclub.com</a>
                </div>
                
            </div>
        </div>
    </footer>
  </body>
</html>

<?php db_disconnect($db); ?>
