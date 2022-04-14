<?php
//fetch.php
if(isset($_POST["sch_id"])) {
    require('../Gincludes/config.inc.php');
    #include('../Gincludes/header.php');
    #include('../Gincludes/headers.php');
    #include('../Gincludes/sidebar.php');
    require(MYSQL);
    $q = "SELECT * FROM doctor_schedule WHERE sch_id = '".$_POST["sch_id"]."'";
    $r = @mysqli_query($dbc, $q); // Run the query.
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

        $data["sch_date"] = $row["sch_date"];
        $data["section"] = $row["section"];
        $data["doctor_name"] = $row["doctor_name"];
        $data["start_time"] = $row["start_time"];
        $data["end_time"] = $row["end_time"];
}

echo json_encode($data);
}
?>