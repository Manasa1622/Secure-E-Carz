<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
</head>


<h1> New User ?? Register Here !!</h1>
<form name=registration action="http://students.cse.unt.edu/~ms0943/wordpress/database/example.php" method="post" onSubmit="return ValidationForm()">
<script language="JavaScript">

function ValidationForm()
 {
        var ro = /^[A-Za-z ]+$/;
         if (!ro.test(document.registration.firstname.value))
              {
         	alert("Invalid Name Format ");
  		  return false;
             	}
        var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
           if(!re.test(document.registration.email.value))
                {
                        alert("Please enter valid email address");
                        return false;
                }
           if(document.registration.password.value != document.registration.confirmpassword.value)
                {
                        alert("Password and Confirm Password fields should be same");
                        return false;
                }
             
           else {
                        return  true;
                }
  }
 </script>

<h4> All Fields are Mandatory * </h4>
 <!--<td><input type="text" name="fname" size="40" required></td></tr>-->
First Name: <input type="text" name="firstname" value=""  required/> <br \>
Last Name: <input type="text" name="lastname" value="" required/> <br \>  
User Name: <input type="text" name="username" value="" required/> <br \> 
Password: <input type="password" name="password" value="" required/> <br \> 
Confirm Password: <input type="password" name="confirmpassword" value="" required/> <br \> 
Email: <input type="text" name="email" value="" required/> <br \> 
Phone Number : <input type="text" name="phone" value="" required="" /> <br \> 
Are You a Veteran?<br \> <input type="radio" name="veteran" value="Yes" required> Yes <br>
<input type="radio" name="veteran" value="No" required> No <br>
 Are You a Senior Citizen ?<br \> <input type="radio" name="senior" value="Yes" requ> Yes <br>
 <input type="radio" name="senior" value="No"> No <br>
 License Number: <input type="text" name="license" value=""/> <br \>
 <input type="submit" name="submit" value="Submit"> <br \>
 </form>
 </div>
 </div>
 </div>

</body>
</html>
