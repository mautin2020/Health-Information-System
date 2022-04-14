<?php # uploadImage.php 
// This page is for upldating userImage. 
// This page is accessed through settings.php. 

$page_title = 'Upload Image';
include('../Gincludes/header.php');
include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');
require('../Gincludes/config.inc.php');

// Check for a valid user ID, through GET or POST: 
    if ((isset($_SESSION['user_id'])) && (is_numeric($_SESSION['user_id']))) { // index.php
        $user_id = $_SESSION['user_id'];
    } else { // No valid ID, kill the script.  
        echo '<script type="text/javascript">
        alert("This page is accessed in error");
        location="index.php";
        </script>';
        exit();
    }
            require(MYSQL);

    $valid = array('success' => false, 'messages' => array());
 
    $type = explode('.', $_FILES['userImage']['name']);
    $type = $type[count($type) - 1];
    $url = '../uploads/' . uniqid(rand()) . '.' . $type;
 
    if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'GIF', 'PNG', 'JPEG', 'JPG'))) {
        if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            if(move_uploaded_file($_FILES['userImage']['tmp_name'], $url)) {
 
                // update the database
                $sql = "UPDATE users SET image = $url WHERE user_id = $user_id";
 
                if($dbc->query($sql) === TRUE) {
                    echo '<script type="text/javascript">
                                        alert("Profile picture added successfully");
                                        location="settings.php";
                                        </script>';
                } 
                else {
                    echo '<script type="text/javascript">
                                        alert("Profile picture Not added");
                                        location="settings.php";
                                        </script>';
                                    }
 
                $dbc->close();
 
            }
            else {
                echo '<script type="text/javascript">
                alert("Error while uploading");
                location="settings.php";
                </script>';;
            }
        }
    }
 
     
    // upload the file 

?>

<div class="container-fluid py-3">
        <div class="row">
            
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row pt-md-5 mt-md-3 mb-5">
              
              <div class="col-xl-12 col-lg-11 col-md-12 col-sm-6 p-2">
                
                  <div class="d-flex justify-content-center">
				  <div class="card card-commons mb-4">
				  <div class="card-header">
                    <h4 class="text-muted">Update Profile</h4>
                </div>
				<div class="card-body task-border">
                <form action = "uploadImage.php" method="post" enctype="multipart/form-data" id="uploadImageForm">
            				
                <div id="messages"></div>

            <div class="form-group">
            <label for="exampleInputPassword1">Photo</label>
            <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
 
            <div class="kv-avatar center-block" style="width:300px">
                <input id="avatar-2" name="userImage" type="file" class="file-loading">
            </div>
          
            </div>
            </div>
            <div class="card-footer">
					    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-success">Update picture</button>
					</div>
                    </form>
        
        <!-- file input -->
    <script src="assets/fileinput/js/plugins/piexif.min.js" type="text/javascript"></script>    
    <script src="assets/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>  
    <script src="assets/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="assets/fileinput/js/fileinput.min.js"></script>
    
    <script type="text/javascript">
        var btnCust = '<button type="button" class="btn btn-light" title="Add picture tags" ' + 
            'onclick="alert(\'Please select picture and click submit button.\')">' +
            '<i class="fa fa-edit text-success"></i>' +
            '</button>'; 
             
        $("#avatar-2").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        browseOnZoneClick: true,
        removeLabel: '',
        removeIcon: '<i class="fa fa-trash text-danger bg-light"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-2',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src="uploads/default-avatar.png" alt="Your Avatar" style="width:200px"><h6 class="text-muted">Click to select</h6>',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "jpeg", "JPG", "PNG", "GIF", "JPEG"]
        });
    </script> 


    			</div>
				</div>
		</div>
	</div>
    </div>


<?php include('../Gincludes/footers.php'); ?>
<?php include('../Gincludes/footer.php') ?>