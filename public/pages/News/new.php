    <?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>

    <?php include(SHARED_PATH . '/header.php'); ?>

    <?php
        if(is_post_request()) {
            $article = [];
            $article['article_title'] = $_POST['article_title'] ?? '';
            $article['article_description'] = $_POST['article_description'] ?? '';
            $article['image_link'] = $_POST['image_link'] ?? '';
            $article['expiry_date'] = $_POST['expiry_date'] ?? '';

            $result = insert_article($article);
            if($result === true) {
                $_SESSION['message'] = 'New article successfully created!';
                echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            } else {
                $errors = $result;
            }
        } else {
            $article = [];
            $article['article_title'] = '';
            $article['article_description'] = '';
            $article['image_link'] = '';
            $article['expiry_date'] = '';
        }
    ?>

    <link rel="stylesheet" href="../stylesheets/newsStyle.css">

    <div class="header">
        <h2>News</h2>
    </div>


    <div >
        <h4>Write a new Chess News article now!</h4>
        <p>Please fill in the forms:</p>
        <?php echo display_errors($errors); ?>
        <form width="800px" margin="auto" action="<?php echo url_for('pages/News/new.php'); ?>" method="post">
        <dl>
            <dt>Article Title:</dt><dd><input type="text" name="article_title" value="<?php echo h($article['article_title']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Article Description:</dt><dd><input type="text" name="article_description" value="<?php echo h($article['article_description']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Image Link:</dt><dd><input type="text" name="image_link" value="<?php echo h($article['image_link']); ?>" /></dd>
        </dl>
        <dl>
            <dt>Expiry date:</dt><dd><input type="datetime-local" name="expiry_date" value="<?php echo h($article['expiry_date']); ?>" /></dd>
        </dl>
        <div>
            <input type="submit" value="Post new article" />
        </div>
        </form>
    </div>

  
  <?php include(SHARED_PATH . '/footer.php'); ?>
