<?php
// session_start();
 $conn = mysqli_connect("localhost", "root", "", "ragister");
	$id=mysqli_real_escape_string($conn, $_GET['id']);
// $_SESSION['id'] = mysqli_real_escape_string($conn, $_GET['id']);
$msg="";
$username="";
$lastname="";
$email="";
$mobile="";
if(isset($_GET['id']) && $_GET['id']>0){
	$row=
   mysqli_fetch_assoc(mysqli_query($conn,"select * from userdetail where id='$id'"));
	$username=$row['username'];
	$lastname=$row['lastname'];
	$email=$row['email'];
	$mobile=$row['number'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Change User Details</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   <style>
   table{
    margin: 100px auto;
   }
   table tr td input {
    margin: 10px 0px;
    width: 150%;
    padding: 2px 5px;
   }
   </style>
</head>
<body>
<?php
if(isset($_POST['submit'])){
	
	$naming=mysqli_real_escape_string($conn, $_POST['first']);
	$lasting=mysqli_real_escape_string($conn, $_POST['last']);
	$emaila=mysqli_real_escape_string($conn, $_POST['email']);
	$mobilea=mysqli_real_escape_string($conn, $_POST['number']);

$sqlData = "update userdetail set username='$naming', lastname='$lasting', email='$email', number='$mobilea' where id='$id'";
  $res = mysqli_query($conn, $sqlData);
  if($res){
// echo "success";
 header("location: admin.php");
  }
 }
 ?>
 <form method="POST">
 <table>
<tr>
<td>
<input type="text" placeholder="Username" name="first" value="<?php echo $username ?>" />
</td>
</tr>
<tr>
<td>
<input type="text" placeholder="Username" name="last" value="<?php echo $lastname ?>" />
</td>
</tr>
<tr>
<td>
<input type="text" placeholder="Email" name="email" value="<?php echo $email ?>" />
</td>
</tr>
<tr>
<td><input type="text" placeholder="Mobile" name="number" value="<?php echo $mobile ?>" />
</td>

</tr>
<tr>
<td>
<button type="submit" id="profile_submit" class="btn btn-primary mr-2" name="submit">Submit</button>
</td>
</tr>
</table>
</form>
</body>
</html>