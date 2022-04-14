<?php

include('../../Gincludes/header.php');
require('../../Gincludes/config.inc.php');
    
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
                    echo '<script type="text/javascript">
                    alert("Image Added Successfully");
                    location="../settings.php";
                    </script>';
                } 
                else {
                    echo '<script type="text/javascript">
                    alert("Error While Uploading");
                    location="../settings.php";
                    </script>';
                }
 
                $dbc->close();
 
            }
            else {
                echo '<script type="text/javascript">
                alert("Error While Uploading");
                location="../settings.php";
                </script>';
            }
        }
    
 
    echo json_encode($valid);
 
    // upload the file 
}

include('../../Gincludes/footer.php') ?>