<?php include "header.php";
include 'config.php';
if($_SESSION['role']=='0')
{
  header('location:'.SITEURL.'post.php');
}
if(isset($_POST['submit']))
{   
     $id = $_POST['user_id'];
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $user = $_POST['username'];
    $role = $_POST['role'];
    
    
    $sql = "update user set first_name='$fname', last_name='$lname', username='$user', role='$role' where user_id=$id";
    $res = mysqli_query($conn,$sql);
    
     if($res==true)
     {
    $_SESSION['success'] = "<div style='color:green; font-weight:bold'>User Updated successfuly</div>";
    header('location:'.SITEURL.'/admin/users.php');
     }
     else {
        $_SESSION['error'] = "<div style='color:red;font-weight:bold'>Failed to update user</div>";
        header('location:'.SITEURL.'/admin/add-user.php');
     }
    
    }
   //mysqli_close($conn);
 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">

                <?php 
                   $id = $_GET['id'];
                   $sql = "select * from user where user_id=$id";
                   $res = mysqli_query($conn,$sql) or die("query failed");
                   if(mysqli_num_rows($res) > 0)
                   {
                    while($row = mysqli_fetch_assoc($res))
                    {
                   ?>
                  <!-- Form Start -->
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $id ;?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value=" ">
                            <?php
                            if($row['role']==1)
                            {
                                echo '<option value="0">normal User</option>';
                              echo '<option value="1" selected >Admin</option>';
                            }
                            else {
                               echo '<option value="0" selected>normal User</option>';
                             echo '<option value="1">Admin</option>';
                            }
                            ?>
                              
                          </select>
                      </div>
                      <?php
                    }
                } 
                      ?>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
