<?php # edit_user.php 
// This page is for editing a use record. 
// This page is accessed through manage_users.php. 

$page_title = 'Edit User';

include('../Gincludes/header.php');
include('../Gincludes/headers.php');
include('../Gincludes/sidebar.php');

// Check for a valid user ID, through GET or POST: 
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From manage_users.php
        $id = $_GET['id'];
    } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) { // Form submission.  
        $id = $_POST['id'];
    } else { // No valid ID, kill the script.  
        echo '<script type="text/javascript">
        alert("This page is accessed in error");
        location="index.php";
        </script>';
        include('../Gincludes/footers.php');
        exit();
    }

    // Check if the form has been submitted: 
        if ($_SERVER['REQUEST_METHOD'] =='POST') {
            $errors = [];

            // Trim all the incoming data:
            $trimmed = array_map('trim', $_POST);
	         // Assume invalid values:
	        // Check for a first name:
                if (preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
                    $fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
                } else {
                    $errors[] = 'You forgot to enter your first name.';
                }
                // Check for a last name:
                    if (preg_match('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
                        $ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);
                    } else {
                        $errors[] = 'You forgot to enter your last name.';
                    }
                    // Check for an email address:
                        if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
                            $e = mysqli_real_escape_string($dbc, $trimmed['email']);
                        } else {
                            $errors[] = 'You forgot to enter your email address.';
                        }

                     // Check for a username:
                        if (preg_match('/^[\w .]+$/', $trimmed['username'])) {
                        $us = mysqli_real_escape_string($dbc, $trimmed['username']);
                        } else {
                        $errors[] = 'You forgot to enter your username.';
                        }
                        
                        if (empty($errors)) { // If everything's OK.

                            // Test for unique email address:
                                $q = "SELECT user_id FROM users WHERE email='$e' AND user_id !=$id";
                                $r = @mysqli_query($dbc, $q); 
                                if (mysqli_num_rows($r) == 0) {

                                    // Make the query: 
                                    $q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e', username='$us' WHERE user_id=$id LIMIT 1";
                                    $r = @mysqli_query($dbc, $q);
                                    if (mysqli_affected_rows($dbc)==1) { // If it ran OK.

                                        // Print a message:
                                        echo '<script type="text/javascript">
                                        alert("Data edited successfully");
                                        location="manage_users.php";
                                        </script>';

                                    } else { // If it did not run OK.
                                        echo '<script type="text/javascript">
                                        alert("The Data could not be changed due to a system error.
                                        We apologize for any incovenience.");
                                        location="index.php";
                                        </script>'; // Public Message
                                        echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>';
                                        // Debuging message.

                                    }
                                } else { // Already registered.
                                    echo '<p class="error">The email address has already been registered.</p>';
                                }

                        } else { // Report the errors.

                            echo '<p class="error">The following error(s) occured:<br>';
                            foreach ($errors as $msg) { // Print each error.
                                echo " . $msg<br>\n";
          } 
              echo '</p><p>Please try again.</p>';

    } // End of if (empty($errors)) IF.
                        
                        
}// End of submit conditional.
    
// Always show the form...

// Retrieve the user's information: 
$q = "SELECT first_name, last_name, email, username FROM users WHERE user_id=$id";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r)== 1) { // valid user ID, show the form.

    // Get the user's information
    $row = mysqli_fetch_array($r, MYSQLI_NUM);

           // Create the form:
            echo '<div class="col-xl-7 col-lg-6 col-md-5 ml-auto mt-5">
            <div class="row pt-md-5 mt-3 md-3 mb-5  pl-4">
            <div class="row mb-4 align-items-center">
            <div class="container-fluid bg-white row py-3 mb-4 task-border align-items-center">
            <h4 class="text-muted p-3 mb-3"> Edit a User</h4> <br/>
              
            <form action="edit_user.php" method="post">
            <p>First Name: <input type="text" name="first_name" class="form-control" maxlength="20"
            value="' . $row[0] . '"></p>
            <p>Last Name: <input type="text" name="last_name" class="form-control" maxlength="40" 
            value="' . $row[1] . '"></p>
            <p>Email Address: <input type="email" name="email" class="form-control" maxlength="60"
            value="' . $row[2] . '"></p>
            <p>Username: <input type="text" name="username" class="form-control" maxlength="20"
            value="' . $row[3] . '"></p>

            <div><p><input type="submit" class="btn btn-primary" name="submit" value="Save Setting"><span style="float:right; margin: 0px 20px 0px 0px;">
            <a href="manage_users.php" class="btn btn-danger"></i>Cancel</a></p></div>
            <input type="hidden" name="id" value="' .$id . '">
            </form>
            </div>
            </div>
            </div>
            </div>
            </div>';
            
} else { // Not a valid user ID.
    echo '<p class="error">This page has been accessed in error.</p>';

}

mysqli_close($dbc);

include('../Gincludes/footer.php');
include('../Gincludes/footers.php');
?>