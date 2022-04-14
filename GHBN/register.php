<?php 
// This is the registration page for the site.
require('../Gincludes/config.inc.php');
$page_title = 'Register';
include('../Gincludes/header.php');

$error = array(
	"first_name" => "",
	"last_name" => "",
	"username" => "",
	"email" => "",
	"password1" => "",
	"top" => "",
	"success" => ""
);	

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
		
	// Need the database connection:
	require(MYSQL);
	// Trim all the incoming data:
	
	$trimmed = array_map('trim', $_POST);
	// Assume invalid values:
	$fn = $ln = $us = $e = $p = FALSE;
	// Check for a first name:
	if (preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
	} else {
		$error["first_name"] = "Please enter your first name!";
	}
	// Check for a last name:
	if (preg_match('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);
	} else {
		$error["last_name"] = "Please enter your last name!";
    }
    // Check for a username:
	if (preg_match('/^[\w .]+$/', $trimmed['username'])) {
		$us = mysqli_real_escape_string($dbc, $trimmed['username']);
	} else {
		$error["username"] = "Please enter your username!";
	}
	// Check for an email address:
	if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string($dbc, $trimmed['email']);
	} else {
		$error["email"] = "Please enter your email!";
	}
	// Check for a password and match against the confirmed password:
	if (strlen($trimmed['password1']) >= 10) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = password_hash($trimmed['password1'], PASSWORD_DEFAULT);
		} else {
			$error["password1"] = "Your password did not match the confirmed password!";
		}
	} else {
		$error["password1"] = "Please enter a valid password!";
	}

	$url = '../uploads/default-avatar.png';

	if ($fn && $ln && $e && $us && $p) { // If everything's OK...
		// Make sure the email address is available:
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
		if (mysqli_num_rows($r) == 0) { // Available.
			// Create the activation code:
			$a = md5(uniqid(rand(), true));
			// Add the user to the database:
			$q = "INSERT INTO users (email, pass, first_name, username, last_name, active, registration_date, image) VALUES ('$e', '$p', '$fn', '$us', '$ln', '$a', NOW(), '$url' )";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
				// Send the email:
				$body = "Thank you for registering. To activate your account, please click on this link:\n\n";
				$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['email'], 'Registration Confirmation', $body, 'From: jamesnathaniel80@localhost');
				// Finish the page:
				$error["success"] = "Thank you for registering! A confirmation email has been sent to your email address. Please click on the link in that email in order to activate your account.";
				exit(); // Stop the page.
			} else { // If it did not run OK.
				$error["top"] = "You could not be registered due to a system error. We apologize for any inconvenience.";
			}
		} else { // The email address is not available.
			$error["email"] = "That email address has already been registered.";
		}
	} else { // If one of the data tests failed.
		$error["top"] = "Please try again.";
	}
	mysqli_close($dbc);
} // End of the main Submit conditional.
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
<style type="text/css">
#ab1:hover{cursor:pointer;}
.error{
    color:#f44336;
}
</style>
<body style="background:url('images/doctor1.jpg') no-repeat; background-size:cover; height:150vh">
<div class ="container" style="width:500px;margin-top:100px">
<div class ="card">
<img src="images/2.jpg" class="card-img-top">

    <form class="form-group" action="register.php" method="post" enctype="multipart/form-data">
    <div>
  
    <div class="card-body">
	
	<small class="errorText text-danger"><?php echo $error["top"]; ?></small><br>
	<h5 class="errorText bg-success text-light"><?php echo $error["success"]; ?></h5><br>

   <label>First Name:</label><br>
   <input type="text" name="first_name" class="form-control"  maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>">
   <small class="errorText text-danger"><?php echo $error["first_name"]; ?></small><br>
   
   <label>Last Name:</label><br>
   <input type="text" name="last_name" class="form-control" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>">
   <small class="errorText text-danger"><?php echo $error["last_name"]; ?></small><br>

   <label>Username:</label><br>
   <input type="text" name="username" class="form-control"  maxlength="20" value="<?php if (isset($trimmed['username'])) echo $trimmed['username']; ?>">
   <small class="errorText text-danger"><?php echo $error["username"]; ?></small><br>
  
   <label>Email Address:</label><br>
   <input type="email" name="email" class="form-control" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>">
   <small class="errorText text-danger"><?php echo $error["email"]; ?></small><br>
  
   <label>Password:</label>
   <input type="password" name="password1" class="form-control" placeholder="At least 10 characters">
   <small class="errorText text-danger"><?php echo $error["password1"]; ?></small><br>

   <label>Confirm Password:</label>
   <input type="password" name="password2" class="form-control" placeholder="Confirm Password">
   <small class="errorText text-danger"><?php echo $error["password1"]; ?></small><br>
 
   <input type="submit" name="submit" id="ab1" value="Register" class="btn btn-primary">

</form>

</div>
</div> 
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</body>
</html>
<?php include('../Gincludes/footer.php') ?>