<?php include "header.php"; 
include 'config.php';

if($_SESSION['role']=='0')
{
  header('location:'.SITEURL.'admin/post.php');
}
$cat_id = $_GET['cat_id'];
$cat_name = $_GET['cat_name'];

                
                

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="save-update-category.php" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $cat_id; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $cat_name; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" value="update" class="btn btn-primary"/>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
