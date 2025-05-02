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
                  <h1 class="admin-heading">All Users</h1>
                  <?php
              if(isset($_SESSION['success']))
              {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
              }
              ?>
              <br>
              </div>
            
              
              
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                    <tbody>
                        
                        <?php
                
                        $Sn=1;
                        
                        $sql = "select * from user";
                        $res = mysqli_query($conn,$sql) or die("query failed");
                        $total_record = mysqli_num_rows($res);
                        if(isset($_GET['pg']))
                        {
                          $pg = $_GET['pg'];
                        }
                        else {
                            $pg = 1;
                            }
                        $num_of_page = ceil($total_record/4);
                        $offset = ($pg-1)*4;
                        //$sql1 = "select * from user limit $offset,2";
                        //$res1 = mysqli_query($conn,$sql1);
                        if($total_record > 0)
                        {

                             
                            $sql1 = "select * from user limit $offset,4";
                            $res1 = mysqli_query($conn,$sql1);

                            while($row = mysqli_fetch_assoc($res1))
                            {    $id = $row['user_id'];
                                $fname = $row['first_name'];
                                $lname = $row['last_name'];
                                $user = $row['username'];
                                $role = $row['role'];
                            ?>
                          <tr>
                              <td class='id'><?php echo $Sn++; ?></td>
                              <td class='id'><?php echo "$fname $lname"; ?></td>
                              <td><?php echo "$user"; ?></td>
                              <td>
                                <?php
                              if($role==1)
                              echo "Admin";
                            else {
                                echo "Normal User";
                            }
                            ?>
                            </td>
                              <td class='edit'><a href='update-user.php?id=<?php echo "$id";?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo "$id";?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>

                          <?php
                                  }
                                }
                                  else {
                                      echo "<h3>No record found</h3>";
                                  }
                                
                          ?>
                        </tbody>

                  </table>
                  <ul class='pagination admin-pagination'>

                    <!-- Pagination code Start-->

                    <?php
                    if($pg!=1)
                    {
                       
                    echo '<li><a href="users.php?pg='.($pg-1).'"><<</a><li>';
                    }
                    for($i=1;$i<=$num_of_page;$i++)
                                {
                                    if($i==$pg)
                                    $active = "active";
                                    else
                                    $active = "";
                                ?>
                      <li class="<?php echo $active;?>"><a href="users.php?pg=<?php echo $i;?>"><?php echo $i; ?></a></li>
                      <?php
                       }
                      if($pg!=$num_of_page)
                      {  
                         
                       echo '<li><a href="users.php?pg='.($pg+1).'">>></a><li>';
                      }
                      ?>
                      <!-- Pagination code end -->
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "header.php"; ?>
