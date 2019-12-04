                                                                                                                                                                                                                                                        <?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'chessSociety';
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    function editImage($connection){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        try {
          mysqli_query($connection,'UPDATE posts set E_Title= "'. $_POST["title"] .'" WHERE E_id =' .$id.';');
       } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    function editTitle($connection){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        echo $id;
         try {
             echo $_POST["title"];
            mysqli_query($connection,'UPDATE posts set E_Title= "'. $_POST["title"] .'" WHERE E_id =' .$id.';');
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    function editDescription($connection){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
         try {
            $event = mysqli_query($connection,'UPDATE posts set eventDescription="'. $_POST["description"] .'" WHERE E_id = ' .$id);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    function editDateTime($connection){
        
    }
?>
<?php
    echo "<form  action=editEvent.php?id=".$_GET['id'] ." method='post'>  " ;
    echo "Image Link: <input type='text' name='link' />  ";
    echo "<input type='submit' name='image' value ='Add/Edit image'/> <br>";
    echo "</form>";
    echo "<form  action= editEvent.php?id=".$_GET['id'] ."  method='post'> ";
    echo "Title: <input type='text' name='title' />  ";
    echo "<input type='submit' name='editTitle' value ='Edit title'/> <br>";
    echo "</form>";
    echo "<form  action=editEvent.php?id=".$_GET['id'] ." method='post'> ";
    echo "Description: <input type='text' name='description' />"  ;
    echo "<input type='submit' name='editDescription' value ='Edit description'/> <br>";
    echo "</form>";
    echo "<form  action='event.php' method='post'> ";
    echo "<input type='submit' name='done' value ='Done'/> <br>";
    echo "</form>";
    if( $_POST['editTitle'] ) {
        editTitle($connection);
    }
    else if( $_POST['editTitle'] ) {
        editTitle($connection);
    }
    else if($_POST['editDescription']){
        editDescription($connection);
    }
    ?>