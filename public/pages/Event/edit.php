<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php include(SHARED_PATH . '/navigation.php'); ?>
<?php 

    function editImage(){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        try {
            update_event_image($_POST["link"], $id);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    function editTitle(){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        echo $id;
         try {
         update_event_title($_POST["title"], $id);
       } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    function editDescription(){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
         try {
             update_event_description($_POST["description"], $id);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
?>
<?php
    echo "<form  action=edit.php?id=".$_GET['id'] ." method='post'>  " ;
    echo "Image Link: <input type='text' name='link' />  ";
    echo "<input type='submit' name='image' value ='Add/Edit image'/> <br>";
    echo "</form>";

    echo "<form  action= edit.php?id=".$_GET['id'] ."  method='post'> ";  
    echo "Title: <input type='text' name='title' />  ";
    echo "<input type='submit' name='editTitle' value ='Edit title'/> <br>";
    echo "</form>";

    echo "<form  action=edit.php?id=".$_GET['id'] ." method='post'> ";
    echo "Description: <input type='text' name='description' />"  ;
    echo "<input type='submit' name='editDescription' value ='Edit description'/> <br>";
    echo "</form>";

    echo "<form  action='index.php' method='post'> ";
    echo "<input type='submit' name='done' value ='Done'/> <br>";
    echo "</form>";

    if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['image'] ){
        editImage();
    }
    else if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editTitle'] ) {
        editTitle();
    }
    else if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editDescription']){
        editDescription();
    }
    
    ?>
