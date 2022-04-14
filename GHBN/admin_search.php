<?php # admin_search.php 
// This page is for searching an admin user record. 
// This page is accessed through headers.php. 

$page_title = 'Search User';
require('../Gincludes/config.inc.php');
include('../Gincludes/header.php');
include('../Gincludes/headers.php');
include('../Gincludes/sidebar.php');

if ((isset($_POST['admin_search_submit']))) {
    $username=$_POST['search'];

}elseif ((isset($_GET['admin_search_submit']))) {
    $username=$_GET['search'];
}

else { // No valid username, kill the script.  
    echo '<p class="error">This page has been accessed in error.</p>';
    include('../Gincludes/footers.php');
    exit();
}
require(MYSQL);
  
// Check if the form has been submitted: 
    if ($_SERVER['REQUEST_METHOD'] =='POST') {
        $errors = [];

        // Trim all the incoming data:
        $trimmed = array_map('trim', $_POST);
        // Assume invalid values:

        // Check for a username:
            if (preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['search'])) {
                $username = mysqli_real_escape_string($dbc, $trimmed['search']);
                } else {
                $errors[] = 'Enter your username.';
                }
            
                if (empty($errors)) { // If everything's OK.

    $q= "SELECT last_name, first_name, username, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, user_id FROM users where username ='$username' LIMIT 1";
    $r = @mysqli_query($dbc, $q);
    if (mysqli_affected_rows($dbc)==1) { // If it ran OK.
        
        echo '<div class="container-fluid">
        <div class="row mb-5">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
              <div class="col-xl-12 col-12 mb-4 mb-xl-0">
              <div class="row pt-md-5 mt-md-3 mb-5">
              <span> <a href="manage_users.php" class="btn btn-primary">Go Back</a></span>
                <h2 class="text-muted text-center mb-3">
                Result</h2>
                <table class="table table-striped bg-light text-center">
                <thead>
                <tr class="text-muted">
                <th>Last Name</th>
                <th>First Name</th>
                <th>Username</th>
	            <th>Date Registered</th>
                <th>Add as Doctor</th>
                <th>Add as Nurse</th>
                <th>Add as Pharmacist</th>
                <th>Add as Account</th>
                <th>Add as Records</th>
                <th>Add as Lab</th>
	            <th>Edit</th>
                <th>Delete</th>

            </tr>
            </thead>
            <tbody>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>';
            // Fetch and print all the records....
            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                echo '<td>' . $row['last_name'] . '</td>
                <td>' . $row['first_name'] . '</td>
                <td>' . $row['username'] . '</td>
                <td>' . $row['dr'] . '</td>
                <td><a href="add_doctor.php?id=' . $row['user_id'] . '"><i class="fa fa-stethoscope fa-lg
                text-info mr-2"></i></a></td>
                <td><a href="add_nurses.php?id=' . $row['user_id'] . '"><i class="fa fa-user-md fa-lg
                text-primary mr-2"></i></a></td>
                <td><a href="add_pharmacist.php?id=' . $row['user_id'] . '"><i class="fa fa-plus-square fa-lg
                text-warning mr-2"></i></a></td>
                <td><a href="add_account.php?id=' . $row['user_id'] . '"><i class="fa fa-money fa-lg
                text-secondary mr-2"></i></a></td>
                <td><a href="add_records.php?id=' . $row['user_id'] . '"><i class="fa fa-book fa-lg
                text-info mr-2"></i></a></td>
                <td><a href="add_lab.php?id=' . $row['user_id'] . '"><i class="fa fa-user-plus fa-lg
                text-primary mr-2"></i></a></td>
                <td><a href="edit_user.php?id=' . $row['user_id'] . '"><i class="fa fa-edit fa-lg
                text-success mr-2"></i></a></td>
		        <td><a href="delete_user.php?id=' . $row['user_id'] . '"><i class="fa fa-trash fa-lg
                text-danger mr-2"></i></a></td>
                
	            </tr>';
            } // End of WHILE loop.
            echo '</tbody></table>';
            mysqli_free_result($r);
            mysqli_close($dbc);
        } else {
            echo '<p class="error">Invalid Username.</p>';
        }
    }
}
include('../Gincludes/footer.php');
include('../Gincludes/footers.php');
            
?>