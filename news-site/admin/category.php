<?php include "header.php";
include 'config.php';

if($_SESSION['role']=='0')
{
  header('location:'.SITEURL.'admin/post.php');
}
 ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
                <?php 
            if(isset($_SESSION['success']))
            {
             echo $_SESSION['success'];
             unset($_SESSION['success']);
            }
            ?>
            </div>
            
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <!-- Code for access data from database  -->
                        <?php
                        $sql = "select * from category";
                        $res = mysqli_query($conn,$sql);
                        $sn = 0;
                        if(isset($_GET['pg']))
                        {
                          $pg = $_GET['pg'];
                        }
                        else {
                            $pg = 1;
                            }
                            $total_record = mysqli_num_rows($res);
                        $num_of_page = ceil($total_record/4);
                        $offset = ($pg-1)*4;

                        if(mysqli_num_rows($res) > 0)
                        {
                            $sql1 = "select * from category limit $offset,4";
                            $res1 = mysqli_query($conn,$sql1);
                           while($row = mysqli_fetch_assoc($res1))
                           {
                            $id = $row['category_id'];
                            $name = $row['category_name'];
                            $post = $row['post'];
                            ?>
                        <tr>
                            <td class='id'><?php echo ++$sn;?></td>
                            <td><?php echo "$name";?></td>
                            <td><?php echo "$post";?></td>
                            <td class='edit'><a href='update-category.php?cat_id=<?php echo $id; ?>&&cat_name=<?php echo $name; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?cat_id=<?php echo $id; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                           }}
                           else {
                            echo "no data found";
                           }
                        ?>
                        
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>


                <!-- Pagination code Start-->

                <?php
                    if($pg!=1)
                    {
                       
                    echo '<li><a href="category.php?pg='.($pg-1).'"><<</a><li>';
                    }
                    for($i=1;$i<=$num_of_page;$i++)
                                {
                                    if($i==$pg)
                                    $active = "active";
                                    else
                                    $active = "";
                                ?>
                      <li class="<?php echo $active;?>"><a href="category.php?pg=<?php echo $i;?>"><?php echo $i; ?></a></li>
                      <?php
                       }
                      if($pg!=$num_of_page)
                      {  
                         
                       echo '<li><a href="category.php?pg='.($pg+1).'">>></a><li>';
                      }
                      ?>
                      <!-- Pagination code end here -->
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
