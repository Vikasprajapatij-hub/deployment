<?php include "header.php";
include "config.php"; 


if($_SESSION['role']=='0')
{
  header('location:'.SITEURL.'admin/post.php');
}
if(isset($_POST['save']))
{
$category = $_POST['cat'];
$sql1 = "INSERT INTO category(category_name) VALUES('$category')";
$res1 = mysqli_query($conn,$sql1);
if($res1)
{
    $_SESSION['success'] = "<div style='color:green; font-weight:bold'>Category added successfuly</div>";
    header('location:'.SITEURL.'admin/category.php');
}
else 
{
    echo "failed to add category";
}
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
