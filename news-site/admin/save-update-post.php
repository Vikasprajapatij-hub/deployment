<?php
session_start();
include "config.php";
if(isset($_POST['submit']))
{
if(empty($_FILES['new-image']['name']))
{
    $file_name = $_POST['old-image'];
}
else
{
    // empty($_FILES['new-image']
   // die( print_r($_FILES['new-image']));
$file_name = $_FILES['new-image']['name'];

$file_size = $_FILES['new-image']['size'];
$file_tmp = $_FILES['new-image']['tmp_name'];
$file_type = $_FILES['new-image']['type'];
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

$description = trim(mysqli_real_escape_string($conn,$_POST['postdesc']));
$category = mysqli_real_escape_string($conn,$_POST['category']);
$post_id =  $_POST['post_id'];
 $old_category = $_POST['old_category'];


        
  
     $sql = "UPDATE post SET title='$title',
        description='$description', category='$category', post_img='$file_name' WHERE post_id=$post_id;";
        if($old_category != $category)
        {
            $sql .= "UPDATE category set post=post+1 WHERE category_id=$category;";
            $sql .= "UPDATE category set post=post-1 WHERE category_id=$old_category";
        }
    
    
      
       
if(mysqli_multi_query($conn,$sql))
{
    $_SESSION['success'] = "<div style='color:green; font-weight:bold'>Post Updated Successfully</div>";
    header('location:'.SITEURL.'admin/post.php');
}
}


?>