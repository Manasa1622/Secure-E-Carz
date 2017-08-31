# Secure-E-Carz
#AN E-COMMERCE WEBSITE
# WebSiteProject

SECURE-E-CARZZ
DRIVE YOUR DREAMZZZZ!!!
Group : 5560G

PROJECT URL:
------------------------------------------------
https://students.cse.unt.edu/~ms0943/wordpress/
------------------------------------------------

FUNCTIONALITY OVERVIEW:
Website consists of the following pages:
>Home - First page for a User
>Who we are??? - Information about our site (Secure-E-Carz)
>Special Offer!!! - Gives details about the offers (for Veterans/Seniors) available at SecureE-Carz
>Vehicles - Different categories of vehicles available for rent at our store
>Sign-up/Register - If a new user wants to signup, he can do here
>Login - A registered user can login here
>Logout - A logged in user can logout here 
>Contact Us - Information needed  to contact us
>Edit Profile - A registered user can change his profile details (except username) here
>Languages Available - English

DATABASE CREDENTIALS:
• Username : ms0943
• Credentials : ********************

ADMIN URL:
If we want to add/update some vehicle information, we do that by adding/updating the code present in vehicles.php. The following is the directory path:
	Wordpress -> database -> vehicles.php
or, it can be done directly in wordpress by editing the vehicles page by uploading the desired  image to media folder and then adding it to the page.

SAMPLE USER DETAILS:
>FirstName: Secure-E-Carz
*Must be between 0-30 Characters
>LastName: Demo
*Must be between 0-30 Characters
>UserName: DemoUser
*Must be unique
>Password: Demo@secureecarz
>Confirm Password: Demo@secureecarz
*Must be greater than 8 characters 
>Email: secureecarzdemo@gmail.com (Password : driveyourdreams)
*Must contain @ and . 
*Must be unique
*Must be valid to receive a mail after registration and also to reset password
>Phone Number: 9876543210
* Must be exactly 10 digits
>Veteran: No
If yes, Veteran Id:
>Senior: No
>License Number: 12345678
*Must contain 8 digits

UNIQUE FEATURES OF SECURE-E-CARZ:
• One day Rentals
• Automatic logout after 15 minutes of inactivity
• Responsive logo : Redirection to homepage when clicked on logo
• Email alerts on New user registration 
• For a unsuccessful login, if user wants to change his password he can enter his username/email to receive a new password via email
• He can use the above password which is recieved via email to change his password using Edit Profile page where other fields are retrieved automatically
• If user selects 
	a) veteran - He will be redirected to a page where VETERAN coupon code is present along with login
	b) senior - He will be redirected to a page where SENIOR coupon code is present along with login
• A 5% discount is available at checkout page for Veteran or Senior using the coupon codes (like VETERAN or SENIOR)
• Paypal Sandbox is used for Testing
	a) Buyer : untsecureecarzdemo@gmail.com (Password : *********)
		 b) Facilitator : ***********@gmail.com (Password :******)
• Once he is done with the payment, clicking on Return to merchant clear the cart and will be redirected to home page
	
*** The same credentials as Database can be used for Wordpress login which is our Admin URL

