<?php require_once('../../../private/initialise.php'); ?>

<?php
    if(!isset($_GET['id'])) {
        redirect_to(url_for('../profile/index.php'));
    }
    
    $id = $_GET['id'];   
    $matches = find_all_matches($id);
?>

<?php include(SHARED_PATH . '/header.php'); ?>

    <!--Main container-->
    <div>
        <table table class="table table-hover table-dark">

            <thead>
                <tr>
                <th scope="col">Tournament Name</th>
                <th scope="col">Tournament Date</th>
                <th scope="col">Round Number</th>
                <th scope="col">Round Winner</th>
                <th scope="col">Old ELO rating</th>
                <th scope="col">New ELO rating</th>
                </tr>
            </thead>

            <tbody>
                <?php

                    while($row = mysqli_fetch_assoc($matches)){
                        echo "<tr>";
                        echo "<th scope='col'>". $row["tournamentName"]. "</th>";
                        echo "<th scope='col'>". $row["tournamentDate"]. "</th>";
                        echo "<th scope='col'>". $row["roundNumber"]. "</th>";

                        $name = (get_member_name($row["roundWinner"])->fetch_assoc());
                        echo "<th scope='col'>". $name["first_name"]. "</th>";
                        
                        $rating = get_elo($id,  $row["tournamentID"]);
                        echo "<th scope='col'>". $rating['before']. "</th>";
                        echo "<th scope='col'>". $rating['after']. "</th>";
                        echo "</tr>";
                    }

                ?>

            </tbody>
        </table>
    </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
