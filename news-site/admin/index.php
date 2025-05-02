
<?php
include 'config.php';
session_start();

// Code for checking user is logged in or not
if(isset($_SESSION['username']))
 {
header("location:http://localhost/test/news-site/admin/post.php");
}

if(isset($_POST['login']))
{
    $user = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select user_id, username, password,role from user where username='$user' and password='$password'";
    $res = mysqli_query($conn,$sql) or die("query failed");
       
    if(mysqli_num_rows($res) > 0)
    {
          
      while($row = mysqli_fetch_assoc($res))
      {
          $_SESSION['username'] = $row['username'];
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['role'] = $row['role'];
          $_SESSION['success'] = "<div style='color:green; font-weight:bold'>Login Successful</div>";
          header('location:'.SITEURL.'admin/post.php');
      }
    }
    else {
        $_SESSION['error'] = "<div style='color:red; font-weight:bold'>User Not Exist</div>";
        header('location:'.SITEURL.'/admin');
        //echo "user not found";
    }
}
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style2.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <br>
                        <?php
                            
                        if(isset($_SESSION['error']))
                        {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        }
                        ?>
                        <br>
                        <!-- Form Start -->
                        <form  action="" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
