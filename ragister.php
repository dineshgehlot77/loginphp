<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Ragister Form</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
 <style>
 body {
  display: flex;
  align-items: center;
  justify-content: center;
 }
 .ragister_form{
  /* text-align: center; */
  top: 12%;
  position: absolute;
  width: 400px;
  height: 440px;
 box-shadow: 4px 4px 7px 4px lightgray;

 }
 .ragister_form input {
  width: 80%;
  margin: 10px 0px;
  /* padding: 5px 5px; */
  /* box-shadow: 1px 1px 2px 2px lightgray; */
 }
  .ragister_form #password {
  width: 65%;
 }
.ragister_form #show {
  border-radius: 2px;
  margin-left: 10px;
  position: relative;
 }
 
  .ragister_form #show:hover {
  background-color: black;
  color: white;
  transition: 0.5s;
 }
 .ragister_form input:focus {
  border: 2px solid yellow;
 }
 .ragister_form form .radio_button {
    display: inline-flex;
    width: 150px;
    margin: 0px 38px;
    box-shadow: none;
 }
 </style>
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
$conn = mysqli_connect("localhost", "root", "", "ragister");
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$lastname = $_POST['lastname'];
  $exitSql = "select * from userdetail where email='$email'";
  $res = mysqli_query($conn, $exitSql);
  if(mysqli_num_rows($res) > 0){
    echo '<script>alert("Email is already in use");</script>';
  }else{
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO `userdetail` (`username`, `lastname`, `email`, `number`,`gender`, `password`) VALUES ('$name', '$lastname', '$email', '$number', '$gender', '$hash');";
  $result = mysqli_query($conn, $sql);
  if($result){
  $_SESSION['username'] = $name;
  echo '<script>alert("Thank you: '.$_SESSION['username'].' successfully inserted")</script>';
  }else {
    echo '<script>alert("something error: try again")</script>';
  }
  }
}
?>
<div class="ragister_form">
<h4 class="bg-success p-3 text-light text-center">User Ragitration Form</h4>
 <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
 <i class='fas fa-user-circle mx-3'></i>
 <input type="text" name="name" minlength="3" pattern="[A-Za-z]{1}[a-z]{2,15}" title="first capital other lowercase letters" placeholder=" firstname" required>
<i class="fas fa-user-ninja mx-3"></i>
 <input type="text" name="lastname" minlength="3" pattern="[A-Za-z]{1}[a-z]{2,15}" title="first capital other lowercase letters" placeholder=" Lastname" required>
 <i class='fas fa-envelope mx-3'></i>
 <input type="email" placeholder=" Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="please follow email format" name="email" id="email" required>
 <i class='fas fa-phone mx-3'></i>
 <input type="text" placeholder=" Number" pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9"  name="number" required>
 <i class='fas fa-lock mx-3'></i>
 <input type="password" placeholder=" Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="must contain Abc123!@#" minlength="5" name="password" id="password" required>
 <button type="button" id="show">show</button>
  <div class="radio_button">
  <input type="radio" value="male"  name="gender" required>male
 <input type="radio" value="Female" name="gender" required>female
 </div>
  <p id='error' class="text-danger mx-5"></p>
 <button type="submit" class="btn btn-success px-4 text-light mx-5 mb-4">submit</button>
 </form>
 </div>
 <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" ></script>
  <script>
    let show = document.querySelector("#show");
    let password = document.querySelector("#password");
    let error = document.querySelector("#error");
show.addEventListener("click", function(){
  error.innerText = '';
  if(password.value == ''){
   error.innerText = 'use !@12Ab strong password';
 }
else if(password.getAttribute("type") == 'password'){
   password.setAttribute('type', 'text');
show.innerText = "Hide";
 } else if(password.getAttribute("type") == 'text'){
  password.setAttribute('type', 'password');
  show.innerText = "Show";
 }
});
  </script>
</body>
</html>