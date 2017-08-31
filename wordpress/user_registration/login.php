<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
</head>


<h1> New User ?? Register Here !!</h1>
<form action="login.php" method="post">
<h4> All Fields are Mandatory * </h4>
First Name: <input type="text" name="firstname" value=""/> <br \>
Last Name: <input type="text" name="lastname" value=""/> <br \>  
User Name: <input type="text" name="username" value=""/> <br \> 
Password: <input type="password" name="password" value=""/> <br \> 
Confirm Password: <input type="password" name="confirmpassword" value=""/> <br \> 
Email: <input type="text" name="email" value=""/> <br \> 
Phone Number : <input type="text" name="phone" value=""/> <br \> 
Are You a Veteran?<br \> <input type="radio" name="veteran" value="Yes"> Yes <br>
<input type="radio" name="veteran" value="No"> No <br>
 Are You a Senior Citizen ?<br \> <input type="radio" name="senior" value="Yes"> Yes <br>
 <input type="radio" name="senior" value="No"> No <br>
 License Number: <input type="text" name="license" value=""/> <br \>
 <input type="submit" name="submit" value="Submit"> <br \>
  </form>

 <?php
function redirect_to($new_location){
	header("Location: ".$new_location);
	exit;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



$name="root";
$pass="";
$db_name="sec_e_car";
$host="localhost";
$connection=mysqli_connect($host,$name,$pass,$db_name);
if (mysqli_connect_errno()){
	die("Database Connection failed".
		mysqli_connect_error().
		"(".mysqli_connect_errno().")"
		);
}

$FirstName=test_input($_POST["firstname"]);
$LastName=test_input($_POST["lastname"]);
$username=test_input($_POST["username"]);
$Password=test_input($_POST["password"]);
$ConfirmPassword=test_input($_POST["confirmpassword"]);
$Email=test_input($_POST["email"]); 
$Phone=test_input($_POST["phone"]); 
$veteran=($_POST["veteran"]);
$senior=($_POST["senior"]);
$LicenseNumber=test_input($_POST["license"]);  

//$Password = password_hash($Password, PASSWORD_BCRYPT);
//$ConfirmPassword = password_hash($ConfirmPassword, PASSWORD_BCRYPT);

$query = "INSERT INTO users(FirstName, LastName, username, Password, ConfirmPassword, email, phone, veteran, senior, lisence) VALUES ('{$FirstName}','{$LastName}','{$username}','{$Password}','{$ConfirmPassword}','{$Email}','{$Phone}','{$veteran}','{$senior}','{$LicenseNumber}')";

print_r($query);
$result=mysqli_query($connection,$query);
if ($result){
	?>
	<h3> User Registration Successful :) </h3>
 <?php   
}else {
	echo "user creation failed";
}

if (isset($connection)){
mysqli_close($connection);
}
?>

  


</body>
</html>
