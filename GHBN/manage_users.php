<?php # manage_users.php
// This script retrieves all the records from the users table.

$page_title = 'Manage Users';

include('../Gincludes/header.php');
include('../Gincludes/headers.php');
include('../Gincludes/sidebar.php');
// Number of records to show per page:

$display = 10;
// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM users";
	$r = @mysqli_query($dbc, $q);
	$row = @mysqli_fetch_array($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.
// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}
// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';
// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
        break;
    case 'us':
        $order_by = 'username ASC';
        break;
	case 'rd':
		$order_by = 'registration_date ASC';
		break;
	default:
		$order_by = 'registration_date ASC';
		$sort = 'rd';
		break;
}
// Define the query:
$q = "SELECT last_name, first_name, username, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, user_id FROM users ORDER BY $order_by LIMIT $start, $display";
$r = @mysqli_query($dbc, $q); // Run the query.
// Table header:
echo '<div class="container-fluid">
<div class="row mb-5">
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
              <div class="col-xl-12 col-12 mb-4 mb-xl-0">
              <div class="row pt-md-5 mt-md-3 mb-5">
                <h3 class="text-muted text-center mb-3">
                Registered Users</h3>
                <table class="table table-striped bg-light text-center">
                <thead>
                <tr class="text-muted">
                <th><a href="manage_users.php?sort=ln">Last Name</a></th>
                <th><a href="manage_users.php?sort=fn">First Name</a></th>
                <th><a href="manage_users.php?sort=us">Username</a></th>
	            <th><a href="manage_users.php?sort=rd">Date Registered</a></th>
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
            </div>
            ';
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
		
	</tr>
	';
} // End of WHILE loop.
echo '</tbody></table>';
mysqli_free_result($r);
mysqli_close($dbc);
// Make the links to other pages, if necessary.
if ($pages > 1) {
	echo '<br><p>';
	$current_page = ($start/$display) + 1;
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="manage_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="manage_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="manage_users.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	echo '</p>'; // Close the paragraph.
} // End of links section.
include('../Gincludes/footer.php');
include('../Gincludes/footers.php');
?>