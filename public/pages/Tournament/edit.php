
<?php 

    function editTournament(){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        try {
            update_tournament($_POST["organizer"], $_POST["name"], $_POST["date"], $_POST["deadline"], "", "", $id);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
?>
<?php
    echo "<form  action=edit.php?id=".$_GET['id'] ." method='post'>  " ;
    echo "Tournament organizer: <input type='text' name='organizer' />  ";

    echo "<form  action= edit.php?id=".$_GET['id'] ."  method='post'> ";  
    echo "Tournament Name: <input type='text' name='name' />  ";

    echo "<form  action=edit.php?id=".$_GET['id'] ." method='post'> ";
    echo "Tournament Date: <input type='datetime-local' name='date' />"  ;

    echo "<form  action=edit.php?id=".$_GET['id'] ." method='post'> ";
    echo "Registration deadline: <input type='datetime-local' name='deadline' />"  ;

    echo "<input type='submit' name='editDescription' value ='Edit tournament'/> <br>";
    echo "</form>";
    
    
    echo "<form  action='index.php' method='post'> ";
    echo "<input type='submit' name='done' value ='Done'/> <br>";
    echo "</form>";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(!empty($_POST["organizer"]) && !empty($_POST["name"]) && !empty($_POST["date"]) && !empty($_POST["deadline"])){
            editTournament();
        }
        else{
            $message = "You need to have all fields filled in !";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } 
    
    ?>
