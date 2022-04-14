<?php

include('../Gincludes/header.php');
include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');
require('../Gincludes/config.inc.php');
    
    $user_id = $_SESSION['user_id'];
    require(MYSQL);
       
     $valid = array('success' => false, 'messages' => array());
 
    $type = explode('.', $_FILES['userImage']['name']);
    $type = $type[count($type) - 1];
    $url = '../uploads/' . uniqid(rand()) . '.' . $type;
 
    if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'GIF', 'JPG', 'JPEG', 'PNG'))) {
        if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            if(move_uploaded_file($_FILES['userImage']['tmp_name'], $url)) {
 
                // insert into database
                $sql = "UPDATE users SET image = '$url' WHERE user_id=$user_id";
 
                if($dbc->query($sql) === TRUE) {
                    $valid['success'] = true;
                    $valid['messages'] = "Successfully Uploaded";
                } 
                else {
                    $valid['success'] = false;
                    $valid['messages'] = "Error while uploading";
                }
 
                $dbc->close();
 
            }
            else {
                $valid['success'] = false;
                $valid['messages'] = "Error while uploading";
            }
        }
    
 
    echo json_encode($valid);
 
    // upload the file 
}

include('../Gincludes/footer.php') ?>