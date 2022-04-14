<?php # login.php
// This is the login page for the site.
require('../Gincludes/config.inc.php');
$page_title = 'Forgot Password';
include('../Gincludes/header.php');

$error = array(
	"email" => "",
	"top" => ""
);	

$success = array(
	"top" => ""
);	

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require(MYSQL);

// Assume nothing:
$uid = FALSE;
// Validate the email address...
if (!empty($_POST['email'])) {
    // Check for the existence of that email address...
    $q = 'SELECT user_id FROM users WHERE email="'.  mysqli_real_escape_string($dbc, $_POST['email']) . '"';
    $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
    if (mysqli_num_rows($r) == 1) { // Retrieve the user ID:
        list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
    } else { // No database match made.
        $error["email"] = "The submitted email address does not match those on file!";
    }
} else { // No email!
    $error["email"] = "You forgot to enter your email address!</p>";
} // End of empty($_POST['email']) IF.
if ($uid) { // If everything's OK.
    // Create a new, random password:
    $p = substr(md5(uniqid(rand(), true)), 3, 15);
    $ph = password_hash($p);
    // Update the database:
    $q = "UPDATE users SET pass='$ph' WHERE user_id=$uid LIMIT 1";
    $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
    if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
        // Send an email:
        $body = "Your password to log into GHB site has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";
        mail($_POST['email'], 'Your temporary password.', $body, 'From: admin@sitename.com');
        // Print a message and wrap up:
        $success["top"] = "Your password has been changed. You will receive the new, temporary password at the email address with which you registered. 
        Once you have logged in with this password, you may change it by going to settings.";
        mysqli_close($dbc);
        include('../Gincludes/footers.php');
        exit(); // Stop the script.
    } else { // If it did not run OK.
        $error["top"] = "Your password could not be changed due to a system error. We apologize for any inconvenience";
    }
} else { // Failed the validation test.
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
<body style="background:url('images/doctor1.jpg') no-repeat; background-size:cover; height:100vh">
<div class ="container" style="width:400px;margin-top:100px">
<div class ="card">
<img src="images/2.jpg" class="card-img-top">
    <form class="form-group" action="forgot_password.php" method="post">
    <div><br/>
  
    <h4 class="text-muted text-center mb-3">Reset Password</h4>
    <p class="text-info text-center">Enter your email address below and your password will be reset.</p>
    <div class="card-body">
    
    <h5 class="errorText text-$success"><?php echo $success["top"]; ?></h5>
    
    <small class="errorText text-danger"><?php echo $error["top"]; ?></small>
    
    <label>Email Address :</label><br>
    <input type="email" name="email" class="form-control" placeholder="email"><br>
    <small class="errorText text-danger"><?php echo $error["email"]; ?></small><br>

    <input type="submit" name="submit" id="ab1" value="Reset My Password" class="btn btn-primary">
</form>

</div>
</div> 
</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</body>
</html>
<?php include('../Gincludes/footer.php') ?>