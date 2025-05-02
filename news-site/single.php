<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                    <?php
                            $id = $_GET['id'];
                            $sql = "SELECT post_id, title, post_img, description, post_date, username, category_name, category_id, user_id FROM post LEFT JOIN user
                             ON post.author=user.user_id LEFT JOIN category ON post.category=category.category_id WHERE post_id=$id";
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
                                    $user_id = $row['user_id'];
                                }
                            }
                            ?> 
                        <div class="post-content single-post">
                            <h3><?php echo $title ;?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?cat_id=<?php echo $cat_id;?>&&category=<?php echo $category;?>"><?php echo $category ;?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?userid=<?php echo $user_id;?>&&author=<?php echo $author;?>'><?php echo $author ;?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $date ;?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $image ;?>" alt=""/>
                            <p class="description">
                            <?php echo $des ;?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
