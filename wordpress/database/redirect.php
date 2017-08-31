
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
$pass="uc@ntcr@ck!tm@n5560G";
$db_name="ms0943";
$host="student-db.cse.unt.edu";

$conn = new mysqli($host, $name, $pass, $db_name);

if ($conn->connect_error)
{
	die("Database Connection failed." . $conn->connect_error);
}

//CHANGELOG
/*$connection=mysqli_connect($host,$name,$pass,$db_name);
if (mysqli_connect_errno()){
	die("Database Connection failed".
		mysqli_connect_error().
		"(".mysqli_connect_errno().")"
		);
}*/


 
if (($_POST['submit'])){

//prepare and bind
$stmt = $conn->prepare("INSERT INTO users (FirstName, LastName, username, Password, ConfirmPassword, email, phone, veteran, veteran_id, senior, license) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $FirstName, $LastName, $username, $PasswordHashed, $ConfirmPasswordHashed, $Email, $Phone, $veteran, $veteran_id, $senior, $LicenseNumber);

$stmtUser = $conn->prepare("SELECT FirstName FROM users WHERE username = ?");
$stmtUser->bind_param("s", $username);
$stmtEmail = $conn->prepare("SELECT FirstName FROM users WHERE email = ?");
$stmtEmail->bind_param("s", $Email);

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
	//file_put_contents("log.txt", "First Name");
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
if (strlen($FirstName) == 0)
{
	//file_put_contents("log.txt", "First Name");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['username']=$username;
	$_SESSION['email']=$Email;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="You must enter a first name.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
	
}

//check last name
$LastName = mysql_escape_string($LastName);
if (strlen($LastName) > 30)
{
	//file_put_contents("log.txt", "Last Name");
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
else if (strlen($LastName) == 0)
{
	//file_put_contents("log.txt", "Last Name");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['username']=$username;
	$_SESSION['email']=$Email;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="You must enter a last name.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}

//check username
$username = mysql_escape_string($username);
if (strlen($username) > 30)
{
	//file_put_contents("log.txt", "Username");
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
else if (strlen($username) == 0)
{
	//file_put_contents("log.txt", "Username");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['email']=$Email;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="You must enter a username.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}

//Make sure user doesn't already exist in database
if ($stmtUser->execute())
	  {
		  //file_put_contents("log.txt", "Executed");
		 $stmtUser->bind_result($FirstName);
		 $count = 0;
		 while ($stmtUser->fetch())
		 {
			 $count = $count + 1;
		 }
		 if($count > 0)
		 {
			 
			$_SESSION['firstname']=$FirstName;
			$_SESSION['lastname']=$LastName;
			$_SESSION['email']=$Email;
			$_SESSION['phone']=$Phone;
			$_SESSION['veteran']=$veteran;
			$_SESSION['senior']=$senior;
			$_SESSION['veteran_id']=$veteran_id;
			$_SESSION['license']=$LicenseNumber;
			$_SESSION['error']="This username already exists.";
			redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
		 }
	}
else 
{
	//file_put_contents("log.txt", "Failed to Execute");
    redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}

//check password
//make sure password and confirmation match
$Password = mysql_escape_string($Password); //this should be unnecessary since we're hashing, but can't hurt
$ConfirmPassword = mysql_escape_string($ConfirmPassword);
if(invalidPasswords($Password, $ConfirmPassword))
{
	//invalid passwords, redirect
	//file_put_contents("log.txt", "Password");
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
	//file_put_contents("log.txt", "Email: " . $Email);
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
else if (strlen($Email) > 50) //invalid Email
{
	//file_put_contents("log.txt", "Email: " . $Email);
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['username']=$username;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="Email address can be no more than 50 characters.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}
else if (strlen($Email) == 0) //invalid Email
{
	//file_put_contents("log.txt", "Email: " . $Email);
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['username']=$username;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['license']=$LicenseNumber;
	$_SESSION['error']="You must enter an email address.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}
$Email = mysql_escape_string($Email);

//Make sure email doesn't already exist in database
if ($stmtEmail->execute())
	  {
		  //file_put_contents("log.txt", "Executed");
		 $stmtEmail->bind_result($FirstName);
		 $count = 0;
		 while ($stmtEmail->fetch())
		 {
			 $count = $count + 1;
		 }
		 if($count > 0)
		 {
			 
			$_SESSION['firstname']=$FirstName;
			$_SESSION['lastname']=$LastName;
			$_SESSION['username']=$username;
			$_SESSION['phone']=$Phone;
			$_SESSION['veteran']=$veteran;
			$_SESSION['senior']=$senior;
			$_SESSION['veteran_id']=$veteran_id;
			$_SESSION['license']=$LicenseNumber;
			$_SESSION['error']="A user with this email address already exists.";
			redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
		 }
	}
else 
{
	//file_put_contents("log.txt", "Failed to Execute");
    redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}

//check phone
if (strlen($Phone) > 30 || strlen($Phone) < 10)
{
	//file_put_contents("log.txt", "Phone");
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
	case 'Yes': $veteranStatus = True; break;
	case 'No': $veteranStatus = False; break;
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
		//file_put_contents("log.txt", "Vet ID");
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
else //veteran == no
{
	$veteran_id = ""; //they can't have an ID
}

//check senior
switch($senior)
{
	case 'Yes': $seniorStatus = True; break;
	case 'No': $seniorStatus = False; break;
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

if (strlen($LicenseNumber) > 15 || strlen($LicenseNumber) < 8)
{
	//file_put_contents("log.txt", "Phone");
	$_SESSION['firstname']=$FirstName;
	$_SESSION['lastname']=$LastName;
	$_SESSION['username']=$username;
	$_SESSION['email']=$Email;
	$_SESSION['phone']=$Phone;
	$_SESSION['veteran']=$veteran;
	$_SESSION['senior']=$senior;
	$_SESSION['veteran_id']=$veteran_id;
	$_SESSION['error']="License should be between 8 and 15 characters.";
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
}

//$query = "INSERT INTO users(FirstName, LastName, username, Password, ConfirmPassword, email, phone, veteran, veteran_id, senior, license) VALUES ('{$FirstName}','{$LastName}','{$username}','{$PasswordHashed}','{$ConfirmPasswordHashed}','{$Email}','{$Phone}','{$veteran}','{$veteran_id}','{$senior}','{$LicenseNumber}')";

//print_r($query);
//$result=mysqli_query($connection,$query);
//echo $result;
//if insert works
if ($stmt->execute()){
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
	//$_SESSION['loggedUser']=$username;
	//$_SESSION['loggedName'] = $FirstName;
	//$_SESSION['lastActivity'] = time();

	if($veteranStatus == True)
	{
		mail($Email, 'Welcome to Secure-E-Carz!', "Hi, $FirstName!,\n\nYou are now a member of Secure-E-Carz! Thank you for joining!\n\nRegards,\nSecure-E-Carz", 'From: webmaster@secureecarz.com');
		redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/veteran/");
	}
	else if ($seniorStatus == True)
	{
		mail($Email, 'Welcome to Secure-E-Carz!', "Hi, $FirstName!,\n\nYou are now a member of Secure-E-Carz! Thank you for joining!\n\nRegards,\nSecure-E-Carz", 'From: webmaster@secureecarz.com');
		redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/senior/");
	}
	else
	{
		mail($Email, 'Welcome to Secure-E-Carz!', "Hi, $FirstName!,\n\nYou are now a member of Secure-E-Carz! Thank you for joining!\n\nRegards,\nSecure-E-Carz", 'From: webmaster@secureecarz.com');
		redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/successful_register/");
	}
}
else {
	echo("<script language=javascript> alert(\"Failed Query\");	</script>");
	redirect_to("http://students.cse.unt.edu/~ms0943/wordpress/sign-upregister/");
	
}
}



if (isset($connection)){
mysqli_close($connection);
}
?>


 
