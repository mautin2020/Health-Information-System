<?php # login.php
// This is the login page for the site.
require('../Gincludes/config.inc.php');
$page_title = 'Login';
include('../Gincludes/header.php');

$error = array(
	"email" => "",
	"password" => "",
	"top" => ""
	
);	

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require(MYSQL);
	// Validate the email address:
	if (!empty($_POST['email'])) {
		$e = mysqli_real_escape_string($dbc, $_POST['email']);
	} else {
		$e = FALSE;
		$error["email"] = "You forgot to enter your email!";
	}
	// Validate the password:
	if (!empty($_POST['pass'])) {
		$p = trim($_POST['pass']);
	} else {
		$p = FALSE;
		$error["password"] = "You forgot to enter your password!";
	}
	if ($e && $p) { // If everything's OK.
		// Query the database:
		$q = "SELECT user_id, first_name, last_name, email, user_level, username, pass FROM users WHERE email='$e' AND active IS NULL";
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
		if (@mysqli_num_rows($r) == 1) { // A match was made.
			// Fetch the values:
			list($user_id, $first_name, $last_name, $email, $user_level, $username, $pass) = mysqli_fetch_array($r, MYSQLI_NUM);
			mysqli_free_result($r);
			// Check the password:
			if (password_verify($p, $pass)) {
				// Store the info in the session:
				$_SESSION['user_id'] = $user_id;
				$_SESSION['first_name'] = $first_name;
				$_SESSION['last_name'] = $last_name;
				$_SESSION['email'] = $email;
				$_SESSION['user_level'] = $user_level;
				$_SESSION['username'] = $username;
				
				mysqli_close($dbc);
				// Redirect the user:
				ob_end_clean(); // Delete the buffer.
				header("Location: index.php");
				exit(); // Quit the script.
			} else {
				$error["top"] = "Either the email address and password entered do not match those on file or you have not yet activated your account.";
			}
		} else { // No match was made.
			$error["top"] = "Either the email address and password entered do not match those on file or you have not yet activated your account.";
		}
	} else { // If everything wasn't OK.
		$error["top"] = "Please try again.";
	}
	mysqli_close($dbc);
} // End of SUBMIT conditional.
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
<style type="text/css">
#ab1:hover{cursor:pointer;}

:root {
		--primary: hsla(245, 97%, 63%, 0.65);
		--secondary: hsla(133, 89%, 49%, 0.65);
}

.error{
    color:#f44336;
}

</style>
<body style="background: linear-gradient(135deg, var(--primary), var(--secondary)),
url('images/doctor1.jpg') no-repeat; background-size:cover; height:100vh">
<div class ="container" style="width:400px;margin-top:100px">
<div style= "background: linear-gradient( rgba(255,255,255, 0.795), rgba(255,255,255, 0.795))">
<img src="images/2.jpg" class="card-img-top">
    <form class="form-group" action="login.php" method="post">
    <div><br/>
  
    <div style="float:right; margin: 0px 20px 0px 0px;">
    <a href="register.php" class="btn btn-outline-primary"><i class="fa fa-sign-in text-primary fa-sm mr-3"></i>Sign up here</a></div></div>   
    <div class="card-body">
	
	<small class="errorText text-danger"><?php echo $error["top"]; ?></small><br>
    <label>Email Address :</label><br>
        <input type="email" name="email" class="form-control" placeholder="email">
		<small class="errorText text-danger"><?php echo $error["email"]; ?></small><br>
		
        <label>Password :</label><br>
		<input type="password" name="pass" class="form-control" placeholder="enter password">
		<small class="errorText text-danger"><?php echo $error["password"]; ?></small><br>

        <input type="submit" name="submit" id="ab1" value="Login" class="btn btn-primary">
        <span style="float:right; margin: 0px 10px 0px 0px;"><a href="forgot_password.php"> Forgot Password?</a></span>
</form>

</div>
</div> 
</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</body>
</html>
<?php include('../Gincludes/footer.php') ?>