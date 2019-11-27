<!-- <?php require_once('../../private/initialise.php'); ?> -->

<?php echo "hello, this is the profile page." ?></br>

<?php 
    $first_name = "Firstname"; // replace with database query
    $last_name = "Lastname"; // replace with database query
    $name = $first_name . " " . $last_name;
    $pic_url = "https://cdn3.f-cdn.com/contestentries/1376995/30494909/5b566bc71d308_thumb900.jpg"; // replace with database query
    $profile_pic = "<a><img src=\"" . $pic_url . "\" alt=\"profile picture\" width=110></a>";
?>

<?php $page_title = 'Profile'; ?>
<!-- <?php include(SHARED_PATH . '/header.php'); ?> -->

<?php echo "hello, this is the profile page." ?></br>
<?php echo "soon you will be able to edit your name, address, phone number, gender and date of birth" ?></br>
<?php echo "soon you will be able to withdraw as a member of the Chess Society and have all your data removed." ?></br>

<div>
    <h4>Full Name: </h4><?php echo $name ?>
    <h4>Profile picture: </h4><?php echo $profile_pic ?>
    <h4>Chess rating: </h4><?php echo "XXX" ?>
    <h4>Email: </h4><?php echo "name@domain.com" ?>
    <h4>Phone number: </h4><?php echo "12345678900" ?>
    <h4>Mailing address: </h4><?php echo "123 Town, City, ZIP" ?>
    <h4>Gender: </h4><?php echo "F / M / -" ?>
    <h4>Date of birth: </h4><?php echo "15/08/1997" ?>
</div>
<div>
    <p>
        <a href="url_for_edit_profile_details_page">Edit Profile</a></br>
        <a href="url_for_delete_confirmation_page">Cancel membership</a></br>
    </p>
</div>

<!-- <?php include(SHARED_PATH . '/footer.php'); ?> -->

