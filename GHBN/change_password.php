<?php # change_password.php
// This page allows a logged-in user to change their password.

$page_title = 'Change Your Password';
include('../Gincludes/header.php');
include('../Gincludes/headers.php');
include('../Gincludes/sidebar.php');

// If no user_id session variable exists, redirect the user:
if (!isset($_SESSION['user_id'])) {
	$url = BASE_URL . 'login.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}

$error = array(
	"password1" => "",
	"top" => ""
);	

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	

	// Check for a new password and match against the confirmed password:
	$p = FALSE;
	if (strlen($_POST['password1']) >= 10) {
		if ($_POST['password1'] == $_POST['password2']) {
			$p = password_hash($_POST['password1'], PASSWORD_DEFAULT);
		} else {
			$error["password1"] = "Your password did not match the confirmed password!";
		}
	} else {
		echo $error["password1"] = "Please enter a valid password!";
	}
	if ($p) { // If everything's OK.
		// Make the query:
		$q = "UPDATE users SET pass='$p' WHERE user_id={$_SESSION['user_id']} LIMIT 1";
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
			// Send an email, if desired.
			echo '<h3>Your password has been changed.</h3>';
			mysqli_close($dbc); // Close the database connection.
			include('../Gincludes/footer.php'); // Include the  footer.
			exit();
		} else { // If it did not run OK.
			$error["password1"] = "Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.";
		}
	} else { // Failed the validation test.
		$error["top"] = "Please try again.";
	}
	mysqli_close($dbc); // Close the database connection.
} // End of the main Submit conditional.
?>
<section>
<div class="container-fluid py-3">
        <div class="row">
            
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row pt-md-5 mt-md-3 mb-5">
              
              <div class="col-xl-12 col-lg-11 col-md-12 col-sm-6 p-2">
                
                  <div class="d-flex justify-content-center">
				  <div class="card card-commons mb-4">
				  <div class="card-header">
                    <h4 class="text-muted">Change Your Password</h4>
                </div>
				<div class="card-body task-border">
			
			<small class="errorText text-danger"><?php echo $error["top"]; ?></small>

            <form action="change_password.php" method="post">
			<p>New Passwod: <input type="password" name="password1" size="20" placeholder="At least 10 characters" class="form-control"></p>
			<small class="errorText text-danger"><?php echo $error["password1"]; ?></small>
			
			<p>Confirm New Passwod: <input type="password" name="password2" size="20" class="form-control"></p>
			<small class="errorText text-danger"><?php echo $error["password1"]; ?></small>

			<hr>
			
            <p><input type="submit" class="btn btn-primary btn-sm" name="submit" value="Change Password"><span style="float:right; margin: 0px 20px 0px 20px;">
            <a href="index.php" class="btn btn-danger btn-sm"></i>Cancel</a></p></div></p>
            
            </form>
			</div>
			</div>
            </div>
            </div>
            </div>
            </div>
			</div>
			</div>

        
<?php include('../Gincludes/footer.php'); ?>
<?php include('../Gincludes/footers.php'); ?>