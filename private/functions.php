<?php 

    function url_for($path) {
        if($path[0] != '/') {
            // add slash at start
            $path = "/" . $path;
        }
        return WWW_ROOT . $path;
    }
    
    function u($input="") {
        return urlencode($input);
    }
    
    function raw_u($input="") {
        return rawurlencode($input);
    }
    
    function h($input="") {
        return htmlspecialchars($input);
    }
    
    function error_404() {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        exit();
    }
    
    function error_500() {
        header($_SERVER["SERVER_PROTOCOL"] . " 505 Internal Server Error");
        exit();
    }
    
    function redirect_to($page) {
        header("Location: " . $page);
        exit();
    }
    
    function is_post_request() {
      return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    
    function is_get_request() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }
    
    function display_errors($errors=array()) {
        $output = '';
        if(!empty($errors)) {
            $output .= "<div class=\"errors\">";
            $output .= "Please fix the errors:";
            $output .= "<ul>";
            foreach($errors as $error) {
                $output .= "<li>" . h($error) . "</li>";
            }
            $output .= "</ul>";
            $output .= "</div>";                
        }
        return $output;
    }

?>