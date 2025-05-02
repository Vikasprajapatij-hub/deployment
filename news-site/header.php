
<?php
include 'admin/config.php';
$page = basename($_SERVER['PHP_SELF']);
//Code for change the title of news site according to content
switch($page)
{
    case "single.php":
        {
            if(isset($_GET['id']))
            {
                   $id = $_GET['id'];         
                $sql_title = "SELECT * FROM post WHERE post_id=$id";
               $res1 = mysqli_query($conn,$sql_title);
               $row1 = mysqli_fetch_assoc($res1);
               $title = $row1['title']." news";
            }
           break;
        }
        case "category.php":
            {
                if(isset($_GET['category']))
                {
                    $title = $_GET['category']." News";
                }
                break;
            }
        case "author.php":
                {
                    if(isset($_GET['author']))
                {
                    $title = "News by ".$_GET['author'];
                }
                    break;
                }
                case "search.php":
                    {
                        if(isset($_GET['search']))
                     {
                    $title = $_GET['search'];
                     }
                        break;
                    }
                    default :
                    $title = "News Site";
                }
                //end
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title;?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <!-- Code start for logo change -->
                <?php
            $sql1 = "SELECT * FROM setting";
        $res1 = mysqli_query($conn,$sql1); 
         if(mysqli_num_rows($res1) > 0)
      {
          while($row = mysqli_fetch_assoc($res1))
                 {
                     if($row['logo'] == "")
                     {
                        echo "<h2>".$row['websitename']."</h2>";
                    
                     }
                    else {
                       $logo = $row['logo'];
                    }
                 }  
        }
              ?>
                <a href="index.php" id="logo"><img src="admin/images/<?php echo $logo;?>"></a>
            </div>

            <!-- /end LOGO -->
        </div>
       
    </div>
</div>
 <div class="mar"><marquee behavior="" direction="">WELCOME  TO  MY  NEWS  SITE</marquee></div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <ul class='menu'> -->
                <ul class='menu'>
                    <?php
                     if(isset($_GET['cat_id']))
                     {
                        $active = "";
                     }
                     else {
                        $active = "active";
                     }
                    ?>
                <li><a class='<?php echo $active;?>' href='http://localhost/test/news-site/'>Home</a></li>
                    <?php
                    session_start();
                    
                    
                    $sql = "SELECT * FROM category WHERE post > 0";
                    $res = mysqli_query($conn,$sql) or die('query failed');

                    

                    if(mysqli_num_rows($res) > 0)
                    {
                        $active = "";
                         while($row = mysqli_fetch_assoc($res))
                        {
                            //This code is for showing which category is active 
                            if(isset($_GET['cat_id']))
                            {
                            if($row['category_id'] == $_GET['cat_id'])
                            {
                                $active = "active";
                            }
                            else {
                                $active = "";
                            } 
                            
                        }
                         //End
                        $category = $row['category_name'];
                        ?>
                    <li><a class='<?php echo $active;?>' href='category.php?cat_id=<?php echo $row['category_id'];?>&&category=<?php echo $category;?>'><?php echo $category;?></a></li>
                    
                    <?php
                     }}
                     ?>
                </ul>
            </div>
        </div>
        
    </div>
</div>

<!-- /Menu Bar -->
