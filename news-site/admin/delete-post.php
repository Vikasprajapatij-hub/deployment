
<?php
session_start();
include 'config.php';

$id = $_GET['id'];
$cat_id = $_GET['cat_id'];
//Code for deleting image from folder 
$sql1 = "SELECT post_img FROM post WHERE post_id = $id";
$res = mysqli_query($conn,$sql1) or die('Query Failed');
$row = mysqli_fetch_assoc($res);
unlink("upload/".$row['post_img']);
//End
$sql = "DELETE FROM post where post_id=$id;";
$sql .= "UPDATE category set post=post-1 WHERE category_id=$cat_id";


$res = mysqli_multi_query($conn,$sql);

if($res==true)
{
    $_SESSION['success'] = "<div style='color:green; font-weight:bold'>Post Deleted successfuly</div>";
    header('location:'.SITEURL.'/admin/post.php');
}
mysqli_close($conn);
?>