<?php #  add_records.php 
// This page is for adding records officer.
// This page is accessed through manage_users.php. 

$page_title = 'Add Records Officer';
// require('../Gincludes/config.inc.php');
include('../Gincludes/header.php');
include('../Gincludes/headers.php');
include('../Gincludes/sidebar.php');

// Check for a valid user ID, throught GET or POST: 
    if ( (isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From manage_users.php
    $id = $_GET['id'];
}elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) { // Form submission.
    $id = $_POST['id'];
}else {// No valid ID, kill the script.
    echo '<p class="error">This page has been accessed in error.</p>';
    include('../Gincludes/footers.php');
    exit();
}

// require(MYSQL);

// Check if the form has been submitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['sure'] == 'Yes') { // Add as Pharmacist
            
            // Make the query:
            $q = "UPDATE users SET user_level=6 WHERE user_id=$id LIMIT 1";
            $r = @mysqli_query($dbc, $q);
            if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

                // Print a message:
                echo '<p>The user has been added as a Records Officer</p>';
            
            } else { // If the query did not run OK.
                echo '<p class="error">The user could not be added as a Records Officer due to a system error.</p>';
                // Public message.
                echo '<p>' .mysqli_error($dbc) . '<br>Query: ' . $q . '</p>'; // Debugging message.
            }
        } else { // No confirmation of deletion
        echo '<p>The user has NOT been added.</p>';
           }
    } else { // Show the form.
            // Retrieve the user's infomation: 
            $q = "SELECT CONCAT(last_name, ', ', first_name) FROM users WHERE user_id=$id";
            $r = @mysqli_query($dbc, $q);

            if (mysqli_num_rows($r) == 1) {// Valid user ID, show the form.

                // Get the user's information:
                    $row = mysqli_fetch_array($r, MYSQLI_NUM);

                    // Display the record being deleted:
                    echo '<div class="container-fluid">
                    <div class="row">
                    <div>
                    <div class="col-xl-7 col-lg-6 col-md-5 pt-3 pl-4 ml-auto">
                    <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="row pt-4 pl-4 mt-5 ml-auto">
                    <a href="manage_users.php" class="btn btn-primary">Go Back</a>
                    <div class="row pt-md-5 mt-md-3 mb-5 pl-4 ml-auto">
                    <div class="row mb-4 align-items-center">
                    <div class="container-fluid bg-white row py-3 mb-4 task-border align-items-center">';
                    echo "<h4>Name: $row[0]</h4>";
                   echo' <br />
                   <div>Are you sure you want to add this user as Records Officer?</div>';
                      // Create the form:
                     echo '<form action="add_records.php" method="post">
                        <input type="radio" name="sure" value="Yes">Yes
                        <input type="radio" name="sure" value="No" checked="checked">No
                        <input type="submit" name="submit" value="Submit">
                        <input type="hidden" name="id" value="' . $id . '">
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>';
                        
                        
            } else { // Not a valiid user ID.  
                echo '<p class="error">This page has been accessed in error.</p>';
            }

} // End of the main submission conditional.
mysqli_close($dbc);

include('../Gincludes/footer.php');
include('../Gincludes/footers.php');
?>   