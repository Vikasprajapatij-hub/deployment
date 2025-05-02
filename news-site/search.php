<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <h2 class="page-heading">Search :<?php echo $_GET['search']; ?></h2>
                    <?php
                          $search_term = mysqli_real_escape_string($conn,$_GET['search']);
                          $sql1 = "SELECT post_id, title, description, username, category_name FROM post LEFT JOIN user
                             ON post.author=user.user_id LEFT JOIN category ON post.category=category.category_id 
                             WHERE post.title LIKE  '%$search_term%' OR post.description LIKE  '%$search_term%' OR category.category_name LIKE  '%$search_term%' OR user.username LIKE  '%$search_term%'";
                       
                            $res1 = mysqli_query($conn,$sql1) or die("query failed");
                              $total_record = mysqli_num_rows($res1);
                              $num_of_page = ceil($total_record/6);
                              
                              if(isset($_GET['pg']))
                               {
                                 $pg = $_GET['pg'];
                               }
                               else {
                               $pg = 1;
                                  }
                              
                             $offset = ($pg-1)*6; 
                  $sql = "SELECT post_id, title, post_img, description, post_date, username, category_name, category_id, user_id FROM post LEFT JOIN user
                             ON post.author=user.user_id LEFT JOIN category ON post.category=category.category_id 
                             WHERE post.title LIKE  '%$search_term%' OR post.description LIKE  '%$search_term%' OR category.category_name LIKE  '%$search_term%' OR user.username LIKE  '%$search_term%'
                            LIMIT $offset,6";
                            $res = mysqli_query($conn,$sql) or die('query failed');
                            if(mysqli_num_rows($res) > 0)
                            {
                                while($row = mysqli_fetch_assoc($res))
                                {
                                
                                    $post_id = $row['post_id'];
                                    $title = $row['title'];
                                    $image =  $row['post_img'];
                                    $des =  $row['description'];
                                    $date =  $row['post_date'];
                                    $author = $row['username'];
                                    $category =  $row['category_name'];
                                    $cat_id = $row['category_id'];
                                    $user_id =  $row['user_id'];
                  ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $post_id;?>"><img src="admin/upload/<?php echo $image ;?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $post_id;?>'><?php echo $title;?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cat_id=<?php echo $cat_id;?>&&category=<?php echo $category;?>'><?php echo $category;?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?userid=<?php echo $user_id;?>&&author=<?php echo $author;?>'><?php echo $author;?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $date;?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($des,0,150)."....";?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $post_id;?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                                }}
                                else {
                                    echo "<h2>No Post Found</h2>";
                                }
                    ?>
                
                    <ul class='pagination'>
                    <?php
                    if($pg!=1)
                    {
                      echo '<li><a href="search.php?pg='.($pg-1).'&&search='.$search_term .'"><<</a><li>';
                    }
                    for($i=1;$i<=$num_of_page;$i++)
                                   {
                                    if($i==$pg)
                                    $active = "active";
                                    else
                                    $active = "";
                            ?>
                    <li class="<?php echo $active;?>"><a href="search.php?pg=<?php echo $i;?>&&search=<?php echo $search_term;?>"><?php echo $i; ?></a></li>
                                      
                     <?php
                       }
                      if($pg < $num_of_page)
                      {  
                         
                       echo '<li><a href="search.php?pg='.($pg+1).'&&search='.$search_term.'">>></a><li>';
                      } 
                      ?>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
