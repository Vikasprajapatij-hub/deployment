<?php
session_start();
include "config.php";
                if(isset($_POST['submit']))
                {
                    
                  $cat_id = $_POST['cat_id'];
                   $cat_name = $_POST['cat_name'];
                  
                  $sql = "UPDATE category SET category_name = '$cat_name' WHERE category_id = $cat_id";
                  $res = mysqli_query($conn,$sql) or die('update category query failed');
                  if($res)
                  {
                    $_SESSION['success'] = "<div style='color:green; font-weight:bold'>Category Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/category.php');
                  }
                  else {
                    echo "<h2>Failed to update category</h2>";
                  }

                }
                ?>