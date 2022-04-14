<?php
include('../Gincludes/header.php');
require('../Gincludes/config.inc.php');
require(MYSQL);
if(isset($_POST["patient_id"]))
{

$output= '';
$query = "SELECT first_name FROM patient_details WHERE pd_id = '".$_POST["patient_id"]."'";
$result = mysqli_query($dbc, $query);
$output .='

<div class="table-responsive">
    <table class="table table-bordered">';
while($row = mysqli_fetch_array($result))
{
    $output .='
    <tr>

    <td width="30%"><label>Name</label></td>
    <td width="70%">'.$row["first_name"].'</td>
    </tr>';
}
$output .= '</table></div>';
echo $output;
}

?>