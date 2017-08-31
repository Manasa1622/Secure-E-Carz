
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
	if (strlen($password) < 8 && strlen($password) != 0)
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


 
if (($_POST['submit']))
{

	if(isset($_SESSION['lastActivity']) && (time() - $_SESSION['lastActivity'] > 900)) //if it's been more than 15 minutes since the last activity, kill the session
	{
		session_unset();
		session_destroy();
		redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/"); 
	}
	else
	{
		$_SESSION['lastActivity'] = time(); //update last activity time stamp
		
		//prepare and bind
		$stmt = $conn->prepare("UPDATE users SET FirstName = ?, LastName = ?, Password = ?, ConfirmPassword = ?, email = ?, phone = ?, veteran = ?, veteran_id = ?, senior = ?, license = ? WHERE username = ? AND Password = ?");
		$stmt->bind_param("ssssssssssss", $FirstName, $LastName, $PasswordHashed, $ConfirmPasswordHashed, $Email, $Phone, $Veteran, $Veteran_ID, $Senior, $License, $Username, $CurrentPasswordHashed);
		
		$stmtEmail = $conn->prepare("SELECT FirstName FROM users WHERE email = ? AND username != ?");
		$stmtEmail->bind_param("ss", $Email, $Username);
		

		$Username = $_SESSION['loggedUser'];
		
		
		$FirstName=test_input($_POST["firstname"]);
		$LastName=test_input($_POST["lastname"]);
		$NewPassword=test_input($_POST["newPassword"]);
		$ConfirmNewPassword=test_input($_POST["confirmNewPassword"]);
		$Email=$_POST["email"]; 
		$Phone=test_input($_POST["phone"]); 
		$Veteran=($_POST["veteran"]);
		$Veteran_ID=test_input($_POST["veteran_id"]);
		$Senior=($_POST["senior"]);
		$License=test_input($_POST["license"]); 
		$CurrentPassword=test_input($_POST["currentPassword"]);
		
		//check first name
		$FirstName = mysql_escape_string($FirstName);
		if (strlen($FirstName) > 30)
		{
			//file_put_contents("log.txt", "First Name");
			$_SESSION['error']="First name can be no more than 30 characters.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
			
		}
		if (strlen($FirstName) == 0)
		{
			//file_put_contents("log.txt", "First Name");
			$_SESSION['error']="You must enter a first name.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
			
		}
		
		//check last name
		$LastName = mysql_escape_string($LastName);
		if (strlen($LastName) > 30)
		{
			//file_put_contents("log.txt", "Last Name");
			$_SESSION['error']="Last name can be no more than 30 characters.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}
		else if (strlen($LastName) == 0)
		{
			//file_put_contents("log.txt", "Last Name");
			$_SESSION['error']="You must enter a last name.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}

		//check password
		//make sure password and confirmation match
		$NewPassword = mysql_escape_string($NewPassword); //this should be unnecessary since we're hashing, but can't hurt
		$ConfirmNewPassword = mysql_escape_string($ConfirmNewPassword);
		$CurrentPassword = mysql_escape_string($CurrentPassword);
		$CurrentPasswordHashed = sha1($CurrentPassword . "secure-e-carz-salt");
		
		
		if(invalidPasswords($NewPassword, $ConfirmNewPassword))
		{
			//invalid passwords, redirect
			//file_put_contents("log.txt", "Password");
			$_SESSION['error']="Invalid passwords. Ensure that your passwords match and are at least 8 characters.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}
		if(strlen($NewPassword) == 0) //user is not updating password
		{
			$PasswordHashed = $CurrentPasswordHashed;
			$ConfirmPasswordHashed = $PasswordHashed;
		}
		else //user IS updating
		{
			//valid passwords, hash them
			$PasswordHashed = sha1($NewPassword . "secure-e-carz-salt");
			$ConfirmPasswordHashed = $PasswordHashed;
		}

		//check email
		if (strpos($Email, '@') == False) //invalid Email
		{
			//file_put_contents("log.txt", "Email: " . $Email);
			$_SESSION['error']="Invalid Email address.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}
		else if (strlen($Email) > 50) //invalid Email
		{
			//file_put_contents("log.txt", "Email: " . $Email);
			$_SESSION['error']="Email address can be no more than 50 characters.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}
		else if (strlen($Email) == 0) //invalid Email
		{
			//file_put_contents("log.txt", "Email: " . $Email);
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}
		$Email = mysql_escape_string($Email);

		//Make sure email doesn't already exist in database
		if ($stmtEmail->execute())
			  {
				  //file_put_contents("log.txt", "Executed");
				 $stmtEmail->bind_result($FirstName2);
				 $count = 0;
				 while ($stmtEmail->fetch())
				 {
					 $count = $count + 1;
				 }
				 if($count > 0)
				 {
					$_SESSION['error']="A user with this email address already exists.";
					redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
				 }
			}
		else 
		{
			//file_put_contents("log.txt", "Failed to Execute");
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}

		//check phone
		if (strlen($Phone) > 30 || strlen($Phone) < 10)
		{
			//file_put_contents("log.txt", "Phone");
			$_SESSION['error']="Phone number should be at least 10 digits.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}

		//check veteran
		switch($Veteran)
		{
			case 'Yes': break;
			case 'No': break;
			default: 	echo("<script language=javascript> alert(\"Veteran\");	</script>");
			$_SESSION['error']="Veteran status should be yes or no.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/"); //default occurs if they spoof the value
		}

		//check veteran id
		if ($Veteran == "Yes")
		{
			$error = False;
			if (strlen($Veteran_ID) > 10)
			{
				$error = True;
				$_SESSION['error']="Veteran ID can be no longer than 10 characters.";
			}
			else if (strlen($Veteran_ID) == 0)
			{
				$error = True;
				$_SESSION['error']="If you are a veteran, you must enter a veteran ID.";
			}
			
			if($error == True)
			{
				//file_put_contents("log.txt", "Vet ID");
				redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
			}
		}
		else
		{
			$Veteran_ID = "";
		}

		//check senior
		switch($Senior)
		{
			case 'Yes': break;
			case 'No': break;
			default: 	echo("<script language=javascript> alert(\"Senior\");	</script>");
			$_SESSION['error']="Senior status should be yes or no.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/"); //default occurs if they spoof the value
		}

		//check license
		if (strlen($License) > 15|| strlen($License) < 8)
		{
			//file_put_contents("log.txt", "License");
			$_SESSION['error']="License should be between 8 and 15 characters.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}
		
		//perform update
		if ($stmt->execute()) //successfully updated user info
		{
			$_SESSION['updateSuccess'] = "User information successfully updated.";
			if(isset($_SESSINO['error']))
			{
				unset($_SESSION['error']);
			}
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}
		else {
			$_SESSION['error'] = "Something went wrong. Try again later.";
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/edit-profile/");
		}
	}
}



if (isset($connection)){
mysqli_close($connection);
}
?>


 
