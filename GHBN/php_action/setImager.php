<?php

include('../../Gincludes/header.php');
require('../../Gincludes/config.inc.php');
        
    if ((isset($_GET['pd_id'])) && (is_numeric($_GET['pd_id']))) { // From manage_users.php
        $pd_id = $_GET['pd_id'];
    } elseif ((isset($_POST['pd_id'])) && (is_numeric($_POST['pd_id']))) { // Form submission.  
        $pd_id = $_POST['pd_id'];
    } else {
        echo '<script type="text/javascript">
                alert("Page Access in Error");
                location="../patient_list.php";
                </script>';
    }
       
    if ($_SERVER['REQUEST_METHOD'] =='POST') {
    require(MYSQL);

    $pd_id = $_POST['pd_id'];

    $valid = array('success' => false, 'messages' => array());
    
    $type = explode('.', $_FILES['userImage']['name']);
    $type = $type[count($type) - 1];
    $url = '../uploads/' . uniqid(rand()) . '.' . $type;
 
    if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'GIF', 'JPG', 'JPEG', 'PNG'))) {
        if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            if(move_uploaded_file($_FILES['userImage']['tmp_name'], $url)) {
 
                // insert into database
                $sql = "UPDATE patient_details SET userImage = '$url' WHERE pd_id = $pd_id";
 
                if($dbc->query($sql) === TRUE) {
                    echo '<script type="text/javascript">
                    alert("Image Added Successfully");
                    location="../patient_list.php";
                    </script>';
                } 
                else {
                    echo '<script type="text/javascript">
                    alert("Error While Uploading");
                    
                    </script>';
                }
 
                $dbc->close();
 
            }
            else {
                echo '<script type="text/javascript">
                alert("Error While Uploading");
                location="../patient_list.php";
                </script>';
            }
        }
    
 
    echo json_encode($valid);
 
    // upload the file 
}  else {
    echo '<script type="text/javascript">
    alert("Invalid Image");
    location="../patient_list.php";
    </script>';
}

    } else {
        echo '<script type="text/javascript">
                alert("Page Access in Error");
                location="../patient_list.php";
                </script>';
    }

include('../../Gincludes/footer.php') ?>