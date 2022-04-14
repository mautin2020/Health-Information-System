<?php # doctor_list.php
// This script retrieves all the doctors from the users table.

$page_title = 'Doctor List';
// require('../Gincludes/config.inc.php');
include('../Gincludes/header.php');
include('../Gincludes/headers.php');
include('../Gincludes/sidebar.php');
// Number of records to show per page:
// require(MYSQL);
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
$q = "SELECT last_name, first_name, username, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, user_id FROM users WHERE user_level=2 ORDER BY $order_by LIMIT $start, $display";
$r = @mysqli_query($dbc, $q); // Run the query.
// Table header:
echo '<div class="container-fluid">
<div class="row mb-5">
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
              <div class="col-xl-12 col-12 mb-4 mb-xl-0">
              <div class="row pt-md-5 mt-md-3 mb-5">
                <h3 class="text-muted text-center mb-3">
                Doctor\'s List</h3>
                <table class="table table-striped bg-light text-center">
                <thead>
                <tr class="text-muted">
                <th><a href="doctor_list.php?sort=ln">Last Name</a></th>
                <th><a href="doctor_list.php?sort=fn">First Name</a></th>
                <th><a href="doctor_list.php?sort=us">Username</a></th>
	            <th><a href="doctor_list.php?sort=rd">Date Registered</a></th>
                <th>Remove From Doctor\'s List</th>

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
        <td><a href="remove_doctor.php?id=' . $row['user_id'] . '"><i class="fa fa-trash fa-lg
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
		echo '<a href="doctor_list.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="doctor_list.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="doctor_list.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	echo '</p>'; // Close the paragraph.
} // End of links section.
// include('../Gincludes/footers.php');
include('../Gincludes/footer.php');
?>