<?php require_once('../../private/initialise.php'); ?>

<?php
    if (is_logged_in()) {
        redirect_to(url_for('pages/profile/index.php'));
    }
    if(is_post_request()) {
        $user = [];
        $user['first_name'] = $_POST['first_name'] ?? '';
        $user['last_name'] = $_POST['last_name'] ?? '';
        $user['dob'] = $_POST['dob'] ?? '';
        $user['gender'] = $_POST['gender'] ?? '';
        $user['phone'] = $_POST['phone'] ?? '';
        $user['address'] = $_POST['address'] ?? '';
        $user['email'] = $_POST['email'] ?? '';
        $user['username'] = $_POST['username'] ?? '';
        $user['password'] = $_POST['password'] ?? '';
        $user['confirm_password'] = $_POST['confirm_password'] ?? '';

        $result = insert_user($user);

        if($result === true) {
            $_SESSION['message'] = 'New account successfully created!';
            redirect_to(url_for('pages/log_in.php'));
        } 
        else {
            $errors = $result;
        }

    } 

    else {
        $user = [];
        $user['first_name'] = '';
        $user['last_name'] = '';
        $user['dob'] = '';
        $user['gender'] = '';
        $user['phone'] = '';
        $user['address'] = '';
        $user['email'] = '';
        $user['username'] = '';
        $user['password'] = '';
        $user['confirm_password'] = '';
    }
?>

<?php $page_title = 'Create Profile'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

    <div class="main">
        <h2>Join the Chess Society now!</h2>
        <p>Please enter your details:</p>

        <link rel="stylesheet" media="all" href="<?php echo url_for('pages/stylesheets/login.css'); ?>"/>

        <?php echo display_errors($errors); ?>
        
        <form width="800px" margin="auto" action="<?php echo url_for('pages/sign_up.php?'); ?>" method="post">
            <dl>
               <dt>First name:</dt><dd><input type="text" name="first_name" value="<?php echo h($user['first_name']); ?>" /></dd>
            </dl>

            <dl>
               <dt>Last name:</dt><dd><input type="text" name="last_name" value="<?php echo h($user['last_name']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Date of birth:</dt><dd><input type="date" name="dob" value="<?php echo h($user['dob']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Gender:</dt><dd><input type="text" name="gender" value="<?php echo h($user['gender']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Phone:</dt><dd><input type="text" name="phone" value="<?php echo h($user['phone']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Address:</dt><dd><input type="text" name="address" value="<?php echo h($user['address']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Email:</dt><dd><input type="text" name="email" value="<?php echo h($user['email']); ?>" /><br /></dd>
            </dl>

            <dl>
                <dt>Username:</dt>
                <dd><input type="text" name="username" value="<?php echo h($user['username']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Password:</dt>
                <dd><input type="Password" name="password" value="" /></dd>
            </dl>

            <dl>
                <dt>Confirm Password:</dt>
                <dd><input type="Password" name="confirm_password" value="" /></dd>
            </dl>

            <p>
                Password must be at least 12 characters, with at least one uppercase letter, lowercase letter, number and symbol.
            </p>

            <br />

            <div>
                <input type="submit" value="Sign up" />
            </div>

        </form>
    </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
