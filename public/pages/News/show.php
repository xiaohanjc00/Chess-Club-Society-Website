<?php require_once('../../../private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

    <link rel="stylesheet" href="../stylesheets/newsStyle.css">

    <div class="main">
        <div class="row">
            <div id = "main" class="centercolumn">
                <?php
                
                    try {

                        $article = find_article_by_id($_GET['id']);

                        if (mysqli_num_rows($article) > 0) {

                            while($row = mysqli_fetch_assoc($article)){

                                date_default_timezone_get();
                                $currentDateTime = date('Y-m-d');
                                $currentdatetime1 =  date_create($currentDateTime);
                                $articledatetime2 =  date_create(date('Y-m-d',strtotime($row['articleDate'])));
                                $dDiff = $articledatetime2 ->diff($currentdatetime1);

                                if($dDiff->format('%r%a') > 7){
                                    mysqli_query($connection, 'DELETE FROM posts WHERE articleID='.$row['articleID'] );
                                }

                                else{
                                    echo '<div class="card">';
                                    echo '<h1>'.$row['articleTitle'].'</h1>';
                                    echo '<p>Posted on '.date('jS M Y', strtotime($row['articleDate'])).'</p>';
                                    echo '<img class="fakeimg" src="' .$row['articleImage'] .'"">';
                                    echo '<p id="just-line-break">'.$row['articleDesc'].'</p>';                            
                                    echo '</div>';
                                }
                            }
                        }
                        else{
                            echo '<div class="card">';
                            echo '<p> No articles could be found.</p>';         
                            echo '</div>'; 
                        }

                    } 
                    
                    catch(PDOException $e) {
                        echo $e->getMessage();
                    }
                ?>

            </div>
        </div>
    </div>

<?php include(SHARED_PATH . '/footer.php'); ?>