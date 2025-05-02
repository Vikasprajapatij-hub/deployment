<?php include "header.php";
include "config.php";
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
                  <br>
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
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
             
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>

                        <?php
                        $sql = "select * from post";
                       
                       $res = mysqli_query($conn,$sql) or die("query failed");
                       $total_record = mysqli_num_rows($res);
                       $num_of_page = ceil($total_record/6);
                        
                        if(isset($_GET['pg']))
                        {
                          $pg = $_GET['pg'];
                        }
                        else {
                            $pg = 1;
                            }
                        
                        $offset = ($pg-1)*6;
                        
                        $Sn=1;
                        if(mysqli_num_rows($res) > 0)
                        {
                          if($_SESSION['role'] == '1')
                          {
                            $sql1 = "SELECT * FROM post
                            LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id
                            LIMIT $offset,6";
                          }
                          elseif($_SESSION['role'] == '0')
                           {
                            $sql2 = "SELECT * FROM post WHERE  post.author = {$_SESSION['user_id']}";
                            $res2 = mysqli_query($conn,$sql2);
                            $num_of_page =  ceil(mysqli_num_rows($res2)/6);
                            
                            $sql1 = "SELECT * FROM post
                            LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id
                             WHERE post.author = {$_SESSION['user_id']} LIMIT $offset,6";
                          }
                             
                            
                            $res1 = mysqli_query($conn,$sql1);
                           
                           
                           
                           
                            while($row = mysqli_fetch_assoc($res1))
                            {  
                                
                                
                                $postid = $row['post_id'];
                                $title = $row['title'];
                                $category = $row['category_name'];
                                $author = $row['username'];
                                $date = $row['post_date'];
                               $author_id = $row['author'];
                               $cat_id = $row['category'];
                      ?>
                          <tr>
                               <td class='id'><?php echo $Sn++;?></td>
                              <td><?php echo $title;?></td>
                              <td><?php echo $category;?></td>
                              <td><?php echo $date;?></td>
                              <td>
                                <?php
                                echo $author;
                                ?>
                              </td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $postid; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $postid;?>&& cat_id=<?php echo $cat_id;?>'><i class='fa fa-trash-o'></i></a></td>
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
                  <!-- Pagination code -->
                  <ul class='pagination admin-pagination'>
                  <?php
                    if($pg!=1)
                    {
                       
                    echo '<li><a href="post.php?pg='.($pg-1).'"><<</a><li>';
                    }
                    for($i=1;$i<=$num_of_page;$i++)
                                {
                                    if($i==$pg)
                                    $active = "active";
                                    else
                                    $active = "";
                                ?>
                      <li class="<?php echo $active;?>"><a href="post.php?pg=<?php echo $i;?>"><?php echo $i; ?></a></li>
                      <?php
                       }
                      if($pg!=$num_of_page)
                      {  
                         
                       echo '<li><a href="post.php?pg='.($pg+1).'">>></a><li>';
                      }
                      ?>
                      <!-- Pagination code end -->
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
