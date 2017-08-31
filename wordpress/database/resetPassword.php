
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

$name="ms0943";
$pass="uc@ntcr@ck!tm@n5560G";
$db_name="ms0943";
$host="student-db.cse.unt.edu";

$conn = new mysqli($host, $name, $pass, $db_name);


if ($conn->connect_error)
{
	die("Database Connection failed." . $conn->connect_error);
}
 
if (($_POST['submit'])){
	//file_put_contents("log.txt", "post");
	//prepare and bind
	$stmt = $conn->prepare("SELECT email FROM users WHERE username = ? OR email = ?");
	$stmt->bind_param("ss", $input, $input);

	$input = test_input($_POST["usernameemail"]);

	$input = mysql_escape_string($input);
	if (strlen($input) > 50)
	{
		$_SESSION['error']='Your username or email address cannot be more than 50 characters.';
		redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/recover-password/");
	}
	else if (strlen($input) == 0)
	{
		$_SESSION['error']='Your must enter a username or email address.';
		redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/recover-password/");
	}


	if ($stmt->execute())
	{
		$stmt->bind_result($email);
		$count = 0;
		while($stmt->fetch())
		{
			$count = $count + 1;
		}
		if ($count == 1)
		{
			//file_put_contents("log.txt", "creating password");
			$newpassword = md5($email . (string)time());
			$newpassword = mysql_escape_string($newpassword); //this is the new password that the user will enter to log in
			$newpasswordHash = sha1($newpassword . "secure-e-carz-salt"); //this is the hashed password
			
			
			$stmtPass = $conn->prepare("UPDATE users SET Password = ?, ConfirmPassword = ? WHERE username = ? OR email = ?");
			$stmtPass->bind_param("ssss", $newpasswordHash, $newpasswordHash, $input, $input);
			//file_put_contents("log.txt", "executing update");
			if ($stmtPass->execute()) //successfully made new password, now email it
			{
				//file_put_contents("log.txt", "mailing password");
				mail($email, 'Secure-E-Carz Password Reset', "This is your temporary password:\n\t$newpassword\n\nPlease visit your profile and create a new password immediately.", 'From: webmaster@secureecarz.com');
				$_SESSION['passwordSuccess'] = True;
				$_SESSION['email'] = $email;
				if(isset($_SESSION['error']))
				{
					unset($_SESSION['error']);
				}
				redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/recover-password/");
				
			}
			else
			{
				$_SESSION['error']='Something went wrong. Try again later.';
				redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/recover-password/");
			}
		}
		else
		{
			$_SESSION['error']='Username or email not found.';
			redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/recover-password/");
		}
	}
	else
	{
		$_SESSION['error']='Something went wrong. Try again later.';
		redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/recover-password/");
	}
	
}






if (isset($connection)){
mysqli_close($connection);
}
?>


 
