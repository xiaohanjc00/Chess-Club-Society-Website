<?php 

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'chessSociety';
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    

    function editImage($connection){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        try {
            $article = mysqli_query($connection,'UPDATE posts set articleImage="'. $_POST["link"] .'" WHERE articleID = ' .$id);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    function editTitle($connection){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        echo $id;
         try {
             echo $_POST["title"];
            mysqli_query($connection,'UPDATE posts set articleTitle= "'. $_POST["title"] .'" WHERE articleID =' .$id.';');
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    function editDescription($connection){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
         try {
            $article = mysqli_query($connection,'UPDATE posts set articleDescription="'. $_POST["description"] .'" WHERE articleID = ' .$id);
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

    if( $_POST['image'] ) {
        editImage($connection);
    }
    else if( $_POST['editTitle'] ) {
        editTitle($connection);
    }
    else if($_POST['editDescription']){
        editDescription($connection);
    }
    
    ?>
