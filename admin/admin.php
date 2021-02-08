<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
 <style>
 table{
  margin: 100px auto;
  text-align: center;
 }
 table tr td, table tr th {
  padding: 10px 15px;
 }
 </style>
</head>
<body>
<table>
<thead>
<tr>
<th>#</th>
<th>Name</th>
<th>Email</th>
<th>Mobile</th>
<th>Gender</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php
$i =0;
$conn = mysqli_connect("localhost", "root", "", "ragister");
$sql = 'select * from userdetail';
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) >0){
while($row=mysqli_fetch_assoc($result)){
 $i++;
?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo $row['username'];?> <?php echo $row['lastname'];?></td>
<td><?php echo $row['email'];?></td>
<td><?php echo $row['number'];?></td>
<td><?php echo $row['gender'];?></td>
<td>
	<a class='btn btn-warning mx-1' href="edituser.php?id=<?php echo $row['id']?>">Edit</a>
	<?php
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type= mysqli_real_escape_string($conn, $_GET['type']);
	$id=mysqli_real_escape_string($conn, $_GET['id']);
	if($type=='delete'){
		mysqli_query($conn,"delete from userdetail where id='$id'");
		header("location: admin.php");
	}
}
?>
<a href="?id=<?php echo $row['id']?>&type=delete" class='btn btn-danger'>Delete</a>
<!-- <a  class='btn btn-success'>Deactivate</a> -->
</td>
</tr>
<?php
}}else {
 echo "<h4 style='text-align: center; margin: 100px 0px;'>data not found</h4>";
}
?>
</tbody>
</table>
 <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" ></script>
</body>
</html>