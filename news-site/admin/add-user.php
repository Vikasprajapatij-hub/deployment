<?php include "header.php";
include 'config.php';


if($_SESSION['role']=='0')
{
  header('location:'.SITEURL.'admin/post.php');
}

if(isset($_POST['save']))
{
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$user = $_POST['user'];
$password = $_POST['password'];
$role = $_POST['role'];
$sql1 = "select username from user where username='$user'";
$res1 = mysqli_query($conn,$sql1);
if(mysqli_num_rows($res1) > 0)
{
  echo "<h2>User already exist</h2>";
}
else 
{
$sql = "insert into user (first_name,last_name,username,password,role) values ('$fname','$lname','$user','$password','$role')";
$res = mysqli_query($conn,$sql) or die("Query Failed");

if($res==true)
{
    $_SESSION['success'] = "<div style='color:green; font-weight:bold'>User added successfully</div>";
    header('location:'.SITEURL.'/admin/users.php');
}
else {
    $_SESSION['error'] = "<div style='color:red;font-weight:bold'>Failed to add user</div>";
    header('location:'.SITEURL.'/admin/add-user.php');
}
}

}
mysqli_close($conn);
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="">choose course</label>
                        <input type="radio" name="course" value="B.tech"> B.Tech
                        <input type="radio" name="course" value="B.com"> B.com
                        <input type="radio" name="course" value="Bio"> Bio
                      </div>
                      <div class="form-group">
                        <label for="">Domain</label>
                        <input type="checkbox" name=Domain[] value="frontend"> frontend
                        <input type="checkbox" name=Domain[] value="Backend"> Backend
                        <input type="checkbox" name=Domain[] value="fullstack"> Fullstack
                          </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
