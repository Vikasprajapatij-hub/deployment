<?php
session_start();
include "config.php";
if(isset($_POST['submit']))
{
if(empty($_FILES['new-logo']['name']))
{
    $file_name = $_POST['old-image'];
}
else
{
    // empty($_FILES['new-image']
   // die( print_r($_FILES['new-image']));
$file_name = $_FILES['new-logo']['name'];

$file_size = $_FILES['new-logo']['size'];
$file_tmp = $_FILES['new-logo']['tmp_name'];
$file_type = $_FILES['new-logo']['type'];
$file_ext = end(explode('.',$file_name));
$extentions = array("jpeg","jpg","png");
if(in_array($file_ext,$extentions) == false)
{
$errors[] = "This extension file not allowed, Please choose JPG or PNG file"; 
}
if($file_size > 2097152)
{
    $errors[] = "File size must be 2mb or lower";
}
if(empty($errors) == true)
{
    move_uploaded_file($file_tmp,"images/".$file_name);
}
else {
    print_r($errors);
    die();
}
}

$webname = mysqli_real_escape_string($conn,$_POST['webname']);

$desc = trim(mysqli_real_escape_string($conn,$_POST['desc']));

  
$sql2 = "UPDATE setting SET websitename='$webname',
        footerdesc='$desc', logo='$file_name'";
if(mysqli_query($conn,$sql2))
{
    $_SESSION['success'] = "<div style='color:green; font-weight:bold'>Setting Updated Successfully</div>";
    header('location:'.SITEURL.'admin/post.php');
}
}
?>