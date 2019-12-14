<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
    if(is_post_request()){
        $article = [];
        $article['article_title'] = $_POST['article_title'] ?? '';
        $article['article_description'] = $_POST['article_description'] ?? '';
        $article['image_link'] = $_POST['image_link'] ?? '';
        $article['expiry_date'] = $_POST['expiry_date'] ?? '';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $result = update_article($article, $id);

        if($result === true) {
            $_SESSION['message'] = 'New article successfully created!';
            echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
        } 
        else {
            $errors = $result;
        }
    } 

    else {
        $article = [];
        $article['article_title'] = '';
        $article['article_description'] = '';
        $article['image_link'] = '';
        $article['expiry_date'] = '';
    }
?>

<?php
    echo '<div >' ;
    echo '<h4>Edit a Chess News article now!</h4>';
    echo '<p>Please fill in the forms:</p>';  

    echo display_errors($errors); 

    echo '<form width="800px" margin="auto"  action="edit.php?id='. $_GET['id'] .'" method="post">';
    echo '<dl> <dt>Article Title:</dt><dd><input type="text" name="article_title" value="'.$article['article_title'] . '" /></dd> </dl>' ;
    echo '<dl> <dt>Article Description:</dt><dd><input type="text" name="article_description" value="'.$article['article_description'] . '" /></dd> </dl>' ;
    echo '<dl> <dt>Image Link:</dt><dd><input type="text" name="image_link" value="'.$article['image_link'] . '" /></dd> </dl>' ;
    echo '<dl> <dt>Expiry date:</dt><dd><input type="date" name="expiry_date" value="'.$article['expiry_date'] . '" /></dd> </dl>' ;

    echo '<div> <input type="submit" value="Edit article" /> </div>';
    echo '</form>';
    echo '</div>';
?>

<?php include(SHARED_PATH . '/footer.php'); ?>
