<div id="sidebar" class="col-md-4">
    <!-- search box start-->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box end-->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        $sql = "SELECT post_id, title, post_img, post_date,category_id, category_name FROM post LEFT JOIN category ON post.category=category.category_id ORDER BY post_id DESC LIMIT 3";
        $res = mysqli_query($conn,$sql) or die('query failed');
        if(mysqli_num_rows($res) > 0)
        {
            while($row = mysqli_fetch_assoc($res))
            {
                $post_id = $row['post_id'];
                $title = $row['title'];
                $image =  $row['post_img'];
                
                $date =  $row['post_date'];
                
                $category =  $row['category_name'];
                $cat_id = $row['category_id'];
                
            ?> 
    
        <div class="recent-post">
        <a class="post-img" href="single.php?id=<?php echo $post_id;?>"><img src="admin/upload/<?php echo $image;?>" alt=""/></a>
            <div class="post-content">
                <h5><a href='single.php?id=<?php echo $post_id;?>'><?php echo $title;?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cat_id=<?php echo $cat_id;?>&&category=<?php echo $category;?>'><?php echo $category;?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                     <?php echo $date;?>
                </span>
                <a class='read-more pull-right' href='single.php?id=<?php echo $post_id;?>'>read more</a>
            </div>
        </div>
        <?php
            }}
            else {
                echo "<h2>No Recent Post</h2>";
            }
        ?>
    <!-- /recent posts box -->
</div>
