<?php
include 'config.php';
session_start();
if(isset($_FILES['fileToUpload']))
{
$file_name = $_FILES['fileToUpload']['name'];
$file_size = $_FILES['fileToUpload']['size'];
$file_tmp = $_FILES['fileToUpload']['tmp_name'];
$file_type = $_FILES['fileToUpload']['type'];
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
    move_uploaded_file($file_tmp,"upload/".$file_name);
}
else {
    print_r($errors);
    die();
}
}
$title = mysqli_real_escape_string($conn,$_POST['post_title']);
$description = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);
$date = date("d M, Y");
//die("hi stop");
$author = $_SESSION['user_id'];
$sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('$title','$description',$category,'$date',$author,'$file_name');";
$sql .= "UPDATE category set post = post + 1 WHERE category_id= {$category}";

if(mysqli_multi_query($conn,$sql))
{
    $_SESSION['success'] = "<div style='color:green; font-weight:bold'>Post added Successfully</div>";
    header('location:'.SITEURL.'admin/post.php');
}

?>