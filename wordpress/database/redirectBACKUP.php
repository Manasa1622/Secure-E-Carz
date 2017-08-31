
<?php 

session_start();

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

//Ensure that the passwords are at least 8 characters
//Ensure that the passwords match
//If the passwords are invalid, return True
function invalidPasswords($password, $confirmPassword)
{
	if (strlen($password) < 8)
	{
		return True;
	}
	else
	{
		if ($password != $confirmPassword)
		{
			return True;
		}
		else
		{
			return False; //passwords are valid
		}
	}
}

$name="ms0943";
$pass="ms0943";
$db_name="ms0943";
$host="student-db.cse.unt.edu";

//$conn = new mysqli($host, $name, $pass, $db_name);

//if ($conn->connect_error)
//{
//	die("Database Connection failed." . $conn->connect_error);
//}

$connection=mysqli_connect($host,$name,$pass,$db_name);
if (mysqli_connect_errno()){
	die("Database Connection failed".
		mysqli_connect_error().
		"(".mysqli_connect_errno().")"
		);
}


 
if (($_POST['submit'])){

//prepare and bind
//$stmt = $conn->prepare("INSERT INTO users (FirstName, LastName, username, Password, ConfirmPassword, email, phone, veteran, veteran_id, senior, license) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//$stmt->bind_param("sssssssssss", $FirstName, $LastName, $username, $PasswordHashed, $ConfirmPasswordHashed, $Email, $Phone, $veteran, $veteran_id, $senior, $LicenseNumber);

$FirstName=test_input($_POST["firstname"]);
$LastName=test_input($_POST["lastname"]);
$username=test_input($_POST["username"]);
$Password=test_input($_POST["password"]);
$ConfirmPassword=test_input($_POST["confirmpassword"]);
$Email=$_POST["email"]; 
$Phone=test_input($_POST["phone"]); 
$veteran=($_POST["veteran"]);
$veteran_id=($_POST["veteran_id"]);
$senior=($_POST["senior"]);
$LicenseNumber=test_input($_POST["license"]);  



/*$query="INSERT INTO users(";
$query.= "'FirstName','LastName','Password','ConfirmPassword'";
$query.=") VALUES(";
$query.="'{$FirstName}','{$LastName}','{$Password}','{$ConfirmPassword}')";
*/
//$query = "INSERT INTO users(FirstName, LastName, Password, username, ConfirmPassword, email, phone, veteran, senior, lisence) VALUES ('{$FirstName}','{$LastName}','{$Password}','{$username}',{$ConfirmPassword}','{$Email}','{$Phone}',{$veteran},{$senior},'{$LicenseNumber}')";

//check first name
$FirstName = mysql_escape_string($FirstName);
if (strlen($FirstName) > 30)
{
	file_put_contents("log.txt", "First Name");
	echo("<script language=javascript> alert(\"First Name\");	</script>");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['username']=$username;
	$_SESSION['email']=$Email;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="First name can be nore more than 30 characters.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
	
}

//check last name
$LastName = mysql_escape_string($LastName);
if (strlen($LastName) > 30)
{
	file_put_contents("log.txt", "Last Name");
	echo("<script language=javascript> alert(\"Last Name\");	</script>");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['username']=$username;
	$_SESSION['email']=$Email;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="Last name can be nore more than 30 characters.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}

//check username
$username = mysql_escape_string($username);
if (strlen($username) > 30)
{
	file_put_contents("log.txt", "Username");
	echo("<script language=javascript> alert(\"User Name\");	</script>");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['email']=$Email;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="Username can be no more than 30 characters.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}

//check password
//make sure password and confirmation match
$Password = mysql_escape_string($Password); //this should be unnecessary since we're hashing, but can't hurt
$ConfirmPassword = mysql_escape_string($ConfirmPassword);
if(invalidPasswords($Password, $ConfirmPassword))
{
	//invalid passwords, redirect
	file_put_contents("log.txt", "Password");
	echo("<script language=javascript> alert(\"Password\");	</script>");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['username']=$username;
	$_SESSION['email']=$Email;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="Invalid passwords. Ensure that your passwords match and are at least 8 characters.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}
else
{
	//valid passwords, hash them
	$PasswordHashed = sha1($Password . "secure-e-carz-salt");
	//$PasswordHashed = crypt($Password, '$6$rounds=5000$secure-e-carz-sa$'); //crypt(password, salt)
	$ConfirmPasswordHashed = $PasswordHashed;
}

//check email
if (strpos($Email, '@') == False) //invalid Email
{
	file_put_contents("log.txt", "Email: " . $Email);
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['username']=$username;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="Invalid Email address.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}
$Email = mysql_escape_string($Email);

//check phone
if (strlen($Phone) > 30 || strlen($Phone) < 10)
{
	file_put_contents("log.txt", "Phone");
	echo("<script language=javascript> alert(\"User Name\");	</script>");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['username']=$username;
	$_SESSION['email']=$Email;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="Phone number should be at least 10 digits.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}

//check veteran
switch($veteran)
{
	case 'Yes':
	case 'No': break;
	default: 	echo("<script language=javascript> alert(\"Veteran\");	</script>");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['username']=$username;
	$_SESSION['email']=$Email;
	$_SESSION['phone']=$Phone;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="Veteran status should be yes or no.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/"); //default occurs if they spoof the value
}

//check veteran id
if ($veteran == "Yes")
{
	$error = False;
	if (strlen($veteran_id) > 10)
	{
		$error = True;
		$_SESSION['error']="Veteran ID can be no longer than 10 characters.";
	}
	else if (strlen($veteran_id) == 0)
	{
		$error = True;
		$_SESSION['error']="If you are a veteran, you must enter a veteran ID.";
	}
	
	if($error == True)
	{
		file_put_contents("log.txt", "Vet ID");
		echo("<script language=javascript> alert(\"User Name\");	</script>");
		$_SESSION['firstname']=$FirstName;
		$_SESSION['lastname']=$LastName;
		$_SESSION['email']=$Email;
		$_SESSION['phone']=$Phone;
		$_SESSION['veteran']=$veteran;
		$_SESSION['senior']=$senior;
		$_SESSION['license']=$LicenseNumber;
		redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
	}
}

//check senior
switch($senior)
{
	case 'Yes':
	case 'No': break;
	default: 	echo("<script language=javascript> alert(\"Senior\");	</script>");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['username']=$username;
	$_SESSION['email']=$Email;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="Senior status should be yes or no.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/"); //default occurs if they spoof the value
}

//check license

$query = "INSERT INTO users(FirstName, LastName, username, Password, ConfirmPassword, email, phone, veteran, veteran_id, senior, license) VALUES ('{$FirstName}','{$LastName}','{$username}','{$PasswordHashed}','{$ConfirmPasswordHashed}','{$Email}','{$Phone}','{$veteran}','{$veteran_id}','{$senior}','{$LicenseNumber}')";

print_r($query);
$result=mysqli_query($connection,$query);
echo $result;
if ($result){
	if(isset($_SESSION['firstname']))
	{
		unset($_SESSION['firstname']);
	}
	if(isset($_SESSION['lastname']))
	{
		unset($_SESSION['lastname']);
	}
	if(isset($_SESSION['username']))
	{
		unset($_SESSION['username']);
	}
	if(isset($_SESSION['email']))
	{
		unset($_SESSION['email']);
	}
	if(isset($_SESSION['phone']))
	{
		unset($_SESSION['phone']);
	}
	if(isset($_SESSION['veteran']))
	{
		unset($_SESSION['veteran']);
	}
	if(isset($_SESSION['veteran_id']))
	{
		unset($_SESSION['veteran_id']);
	}
	if(isset($_SESSION['senior']))
	{
		unset($_SESSION['senior']);
	}
	if(isset($_SESSION['license']))
	{
		unset($_SESSION['license']);
	}
	if(isset($_SESSION['error']))
	{
		unset($_SESSION['error']);
	}
	$_SESSION['loggedUser']=$username;
     redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/successful_register/");
}else {
	echo("<script language=javascript> alert(\"Failed Query\");	</script>");
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
	
}
}

if (isset($connection)){
mysqli_close($connection);
}
?>


 
