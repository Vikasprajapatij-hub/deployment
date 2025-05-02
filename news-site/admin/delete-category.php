<?php
session_start();
include "config.php";
$cat_id = $_GET['cat_id'];
$sql = "DELETE FROM category WHERE category_id = $cat_id";
$res = mysqli_query($conn,$sql) or die("query failed");
if($res == true)
{
    $_SESSION['success'] = "<div style='color:green; font-weight:bold'>Category deleted Successfully</div>";
    header('location:'.SITEURL.'admin/category.php');
}



?>