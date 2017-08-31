
<?php 
session_start();

function redirect_to($new_location){
   header("Location: ".$new_location);
   exit;
}
$name="ms0943";
$pass="ms0943";
$db_name="ms0943";
$host="student-db.cse.unt.edu";

$conn = new mysqli($host, $name, $pass, $db_name);

if ($conn->connect_error)
{
  //file_put_contents("log.txt", "Dead");
  die("Database Connection failed." . $conn->connect_error);
}

/*$connection=mysqli_connect($host,$name,$pass,$db_name);
if (mysqli_connect_errno()){
   die("Database Connection failed".
      mysqli_connect_error().
      "(".mysqli_connect_errno().")"
      );
}*/

if (($_POST['submituser'])){
echo '<script language="javascript">';
echo 'alert("successflly logged out")';
echo '</script>';
         redirect_to("https://students.cse.unt.edu/~ms0943/wordpress/home/ "); 
     }
else{
  
  echo '<script language="javascript">';
echo 'alert("Sign in required to Logout")';
echo '</script>';
      
   }

if (isset($connection)){
mysqli_close($connection);
}
?>