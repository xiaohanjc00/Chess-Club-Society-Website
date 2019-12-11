
<?php

    require_once('db_credentials.php');
    // require_once('db_prod_constants.php');

    function db_connect() {
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        confirm_db_connect();
        return $connection;
    }

    function db_disconnect($connection) {
        if(isset($connection)) {
            mysqli_close($connection);
        }
    }

    function db_escape($connection, $input) {
        return mysqli_real_escape_string($connection, $input);
    }

    function confirm_db_connect() {
        if(mysqli_connect_errno()) {
            $message = "Failed database connection: ";
            $message .= mysqli_connect_error();
            $message .= " (" . mysqli_connect_errno() . ")";
            exit($message);
        }
    }

    function confirm_result_set($result_set) {
        if (!$result_set) {
            exit("Database query failed!");
        }
    }

?>
