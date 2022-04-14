<?php # delete_user.php 
// This page is for deleting a user record.
// This page is accessed through view_users.php. 

$page_title = 'Delete a User';
require('../Gincludes/config.inc.php');
include('../Gincludes/header.php');
include('../Gincludes/headers.php');
include('../Gincludes/sidebar.php');

if ((isset($_POST['search']))) {
    $username=$_POST['search'];

}elseif ((isset($_GET['search']))) {
    $username=$_GET['search'];
}

else { // No valid username, kill the script.  
    echo '<p class="error">This page has been accessed in error.</p>';
    include('../Gincludes/footers.php');
    exit();
}

require(MYSQL);

// Check if the form has been submitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['sure'] == 'Yes') { // Delete the record.
            
            // Make the query:
            $q = "DELETE FROM users WHERE username= $username LIMIT 1";
            $r = @mysqli_query($dbc, $q);
            if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

                // Print a message:
                echo '<p>The user has been deleted.</p>';
            
            } else { // If the query did not run OK.
                echo '<p class="error">The user could not be deleted due to a system error.</p>';
                // Public message.
                echo '<p>' .mysqli_error($dbc) . '<br>Query: ' . $q . '</p>'; // Debugging message.
            }
        } else { // No confirmation of deletion
        echo '<p>The user has NOT been deleted.</p>';
           }
    } else { // Show the form.
            // Retrieve the user's infomation: 
            $q = "SELECT CONCAT(last_name, ', ', first_name) FROM users WHERE username=$username";
            $r = @mysqli_query($dbc, $q);

            if (mysqli_num_rows($r) == 1) {// Valid user ID, show the form.

                // Get the user's information:
                    $row = mysqli_fetch_array($r, MYSQLI_NUM);

                    // Display the record being deleted:
                    echo '<div class="container-fluid">
                    <div class="row">
                    <div>
                    <div class="col-xl-7 col-lg-6 col-md-5 ml-auto">
                    <div class="row pt-md-5 mt-md-3 mb-5">
                    <a href="manage_users.php" class="btn btn-primary">Go Back</a>
                    <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="row mb-4 align-items-center">
                    <div class="container-fluid bg-white row py-3 mb-4 task-border align-items-center">';
                    echo "<h4>Name: $row[0]</h4>";
                   echo' <br />
                   <div>Are you sure you want to delete this user?</div>';
                      // Create the form:
                     echo '<form action="a_delete_user.php" method="post">
                        <input type="radio" name="sure" value="Yes">Yes
                        <input type="radio" name="sure" value="No" checked="checked">No
                        <input type="submit" name="submit" value="Submit">
                        <input type="hidden" name="username" value="' . $username . '">
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>';
                        
                        
            } else { // Not a valiid username.  
                echo '<p class="error">This page has been accessed in error.</p>';
            }

} // End of the main submission conditional.
mysqli_close($dbc);

include('../Gincludes/footers.php');
include('../Gincludes/footer.php');
?>