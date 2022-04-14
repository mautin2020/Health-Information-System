<?php
// Insert.php
	require('../Gincludes/config.inc.php');
    require(MYSQL);
    if(!empty($_POST)) {
        $output = '';
        $name = mysqli_real_escape_string($dbc, $_POST["name"]);
        $address = mysqli_real_escape_string($dbc, $_POST["address"]);
        $gender = mysqli_real_escape_string($dbc, $_POST["gender"]);
        $designation = mysqli_real_escape_string($dbc, $_POST["designation"]);
        $age = mysqli_real_escape_string($dbc, $_POST["age"]);
    }
    $q = "INSERT INTO tbl_employee(name, address, gender, designation, age)
    VALUES('$name', '$address', '$gender', '$designation', '$age')";
    
    if (mysqli_query($dbc, $q)) {
        $output .='<label class="text-success">Data Inserted</label>';
        $select_query="SELECT * FROM tbl_employee ORDER BY id DESC";
        $r = @mysqli_query($dbc, $q); // Run the query.
        $output .= '
        <table class="table table-bordered">
            <tr>
                <th width="70%">Employee Name</th>
                <th width="30%">View</th>
                </tr>
                ';
                while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                    $output .=' 
                        <tr>
                            <td>' . $row["name"] . '</td>
                            <td><input type="button" name="view" value="view" id="' . $row["id"] . '"
                            class="btn btn-info btn-xs view_data" /></td>
                            </tr>
                            ';                
                        }
                        $output .= '</table>';
    }
    echo $output;
}
?>