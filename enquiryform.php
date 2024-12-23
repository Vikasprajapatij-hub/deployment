<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Student enquiry form</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
<form method=post action=enquiryform.php> 
        <h1>USER REGISTRATION FORM</h1>
  <div>Name:<input required type="text" name="name" placeholder="enter your name"></div>
  <br> 
  <div>Email:<input required type="email" name="email" placeholder="email"></div>
  <br>
  <div>Mob:<input type="number" name="phone" placeholder="e.g9876543210"></div>
  <br>
  <div class="">Address:<input type="message" name="Address" placeholder="enter your Address">
  </div>
  <br>
<div>
    Gender:<select name="gender" id="gender" placeholder="select your gender">
        <option value="">select your gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
</div>
<br>
<fieldset>
<legend>Choose your course</legend>
<input type="checkbox" name="checkbox[]" value="frontend">Frontend
<input type="checkbox" name="checkbox[]" value="backend">Backend
<input type="checkbox" name="checkbox[]" value="data analyst">Data analyst
</fieldset>
<br>

    <fieldset>
    <Legend>Mode of payment</Legend>
<input type="radio" name="radio" value="online">Online</input>
<input type="radio" name="radio" value="cash">Cash</input>
</fieldset>
<br>
<div>Password:<input type="password" name="password" id="password"></div>
<br>
<div class="custum">
<input type="submit" value="submit" name=submit>
<input type="reset" value="reset">
<br>
</div>
 
<?php
if(isset($_POST['submit']))
{
            
$s_name=$_POST['name'];
$email=$_POST['email'];
$mob=$_POST['phone'];
$address=$_POST['Address'];
$gender=$_POST['gender'];
$course=$_POST['checkbox'];
$course1=implode(",",$course);
echo $course1;
$payment=$_POST['radio'];
$password=$_POST['password'];
               //    IP address  user id    databasename
$mycon=mysqli_connect("localhost","root","","mydatabase");
echo "<br>Connection success<br>";
$sql="insert into student values(?,?,?,?,?,?,?,?)";
$ps=$mycon->prepare($sql);

$ps->bind_param("ssissssi",$s_name,$email,$mob,$address,$gender,$course1,$payment,$password);
$ps->execute();
echo "<br>Record inserted successfully";
}
?>

</form>
</body>
</html>