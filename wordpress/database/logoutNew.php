
<?php 

session_start();

function redirect_to($new_location){
	header("Location: ".$new_location);
	exit;
}
 
if (($_POST['submit'])){
	//unset($_SESSION['loggedName']);
	session_unset();
	session_destroy();
	redirect_to('https://students.cse.unt.edu/~ms0943/wordpress/log-out/');
}

?>


 
