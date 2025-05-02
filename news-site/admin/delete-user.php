<?php
include 'config.php';


if($_SESSION['role']=='0')
{
  header('location:'.SITEURL.'admin/post.php');
}
$id = $_GET['id'];
$sql = "delete from user where user_id=$id";
$res = mysqli_query($conn,$sql);
if($res==true)
{
    $_SESSION['success'] = "<div style='color:green; font-weight:bold'>User Deleted successfuly</div>";
    header('location:'.SITEURL.'/admin/users.php');
}
mysqli_close($conn);
?>