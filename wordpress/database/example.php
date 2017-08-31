error_reporting(E_ALL); ini_set('display_errors', 1)


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



$name="ms0943";
$pass="ms0943";
$db_name="ms0943";
$host="student-db.cse.unt.edu";
$connection=new mysqli($host,$name,$pass,$db_name);
if ($connection->connect_error){
	die("Database Connection failed".
		$connection->connect_error);
}


 
if (($_POST['submit'])){

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



/*$query="INSERT INTO users(";
$query.= "'FirstName','LastName','Password','ConfirmPassword'";
$query.=") VALUES(";
$query.="'{$FirstName}','{$LastName}','{$Password}','{$ConfirmPassword}')";
*/
//$query = "INSERT INTO users(FirstName, LastName, Password, username, ConfirmPassword, email, phone, veteran, senior, lisence) VALUES ('{$FirstName}','{$LastName}','{$Password}','{$username}',{$ConfirmPassword}','{$Email}','{$Phone}',{$veteran},{$senior},'{$LicenseNumber}')";

//$Password = password_hash($Password, PASSWORD_BCRYPT);
//$ConfirmPassword = password_hash($ConfirmPassword, PASSWORD_BCRYPT);

$query = "INSERT INTO users(FirstName, LastName, username, Password, ConfirmPassword, email, phone, veteran, senior, lisence) VALUES ('{$FirstName}','{$LastName}','{$username}','{$Password}','{$ConfirmPassword}','{$Email}','{$Phone}','{$veteran}','{$senior}','{$LicenseNumber}')";

print_r($query);
$result=mysqli_query($connection,$query);
echo $result;
if ($result){
     redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/successful_register/");
}else {
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}
}

if (isset($connection)){
mysqli_close($connection);
}
?>


 
