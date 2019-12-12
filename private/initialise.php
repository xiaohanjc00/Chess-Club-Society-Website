<?php
    session_start(); // turn on sessions

    ob_start(); // output buffering is turned on

    // switch on all errors (for debugging)
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    // Assign file paths to PHP constants
    define("PRIVATE_PATH", dirname(__FILE__)); // __FILE__ returns current path to this file
    define("PROJECT_PATH", dirname(PRIVATE_PATH)); // dirname() returns path to parent directory
    define("PUBLIC_PATH", PROJECT_PATH . '/public');
    define("SHARED_PATH", PRIVATE_PATH . '/shared');

    // Assign root URL to a PHP constant
    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

    require_once('functions.php');
    require_once('database.php');
    require_once('query_functions.php');
    require_once('query_functions_users.php');
    require_once('query_functions_news.php');
    require_once('query_functions_events.php');
    require_once('query_functions_tournaments.php');
    require_once('query_functions_ratings.php');
    require_once('validation_functions.php');
    require_once('auth_functions.php');
    
    $db = db_connect();
    $errors = [];    

?>
