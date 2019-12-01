<?php 

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'chess_society';
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    

    function editImage($connection){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        try {
            $event = mysqli_query($connection,'UPDATE events set eventImage="'. $_EVENT["link"] .'" WHERE eventID = ' .$id);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    function editTitle($connection){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        echo $id;
         try {
             echo $_EVENT["title"];
            mysqli_query($connection,'UPDATE events set eventTitle= "'. $_EVENT["title"] .'" WHERE eventID =' .$id.';');
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    function editDescription($connection){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
         try {
            $event = mysqli_query($connection,'UPDATE events set eventDescription="'. $_EVENT["description"] .'" WHERE eventID = ' .$id);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
?>
<?php
    echo "<form  action=edit.php?id=".$_GET['id'] ." method='event'>  " ;
    echo "Image Link: <input type='text' name='link' />  ";
    echo "<input type='submit' name='image' value ='Add/Edit image'/> <br>";
    echo "</form>";

    echo "<form  action= edit.php?id=".$_GET['id'] ."  method='event'> ";  
    echo "Title: <input type='text' name='title' />  ";
    echo "<input type='submit' name='editTitle' value ='Edit title'/> <br>";
    echo "</form>";

    echo "<form  action=edit.php?id=".$_GET['id'] ." method='event'> ";
    echo "Description: <input type='text' name='description' />"  ;
    echo "<input type='submit' name='editDescription' value ='Edit description'/> <br>";
    echo "</form>";

    echo "<form  action='index.php' method='event'> ";
    echo "<input type='submit' name='done' value ='Done'/> <br>";
    echo "</form>";

    if( $_EVENT['image'] ) {
        editImage($connection);
    }
    else if( $_EVENT['editTitle'] ) {
        editTitle($connection);
    }
    else if($_EVENT['editDescription']){
        editDescription($connection);
    }
    
    ?>
