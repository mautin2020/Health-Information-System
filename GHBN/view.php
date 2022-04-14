<?php
include('../Gincludes/header.php');
include('../Gincludes/headers.php');
require('../Gincludes/config.inc.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
 
    <!-- boostrap css-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
 
<br /> <br /> <br />
<div class="col-md-5 col-sm-5 col-md-offset-4 col-sm-offset-4">
    <a href="index.php" class="btn btn-default">Back</a>
    <table class="table table-bordered">
        <tr>
            <th>S.no</th>
            <th>First Name</th>
            <th>Photo</th>
        </tr>
 
        <?php 
        
        require(MYSQL);
 
         
        $sql = "SELECT first_name, image FROM users WHERE user_level = 0";
        $query = $dbc->query($sql);
 
        $x = 1;
        while ($result = $query->fetch_assoc()) {
            $image = substr($result['image'], 3);
 
            echo "<tr>
                <td>".$x."</td>
                <td>".$result['first_name']."</td>
                <td> <img src='".$image."' style='height:40px; width:40px;' /> </td>
            </tr>";
            $x++;
        }
 
        ?>
    </table>
</div>
 
</body>
</html>