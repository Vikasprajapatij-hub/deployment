<?php include "header.php"; 

include 'config.php';
$sql = "SELECT  * FROM setting";
$res = mysqli_query($conn,$sql);
if(mysqli_num_rows($res) > 0)
{
    while($row = mysqli_fetch_assoc($res))
    {
         $webname = $row['websitename'];
        $desc = $row['footerdesc'];
       
       $logo = $row['logo'];
       
    }
}
else {
    echo "No data found";
}
?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Website Setting</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">

                  <!-- Form -->
                  <form  action="save-setting.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Website Name</label>
                          <input type="text" name="webname" class="form-control" value="<?php echo $webname;?>" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Footer Description</label>
                          <textarea name="desc" class="form-control" rows="5" required><?php echo $desc;?></textarea>
                      </div>
                      <div class="form-group">
                          <label for="logo">Website Logo</label>
                        <input type="file" name="new-logo" >
                        <img  src="images/<?php echo  "$logo"; ?>" height="150px"> <!-- Showing image from database -->
                        <input type="hidden" name="old-image" value="<?php echo  "$logo"; ?>">
            </div>
                      
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />

                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
