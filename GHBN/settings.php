<?php # settings.php 
// This page is for setting a use record. 
// This page is accessed through index.php. 

$page_title = 'User Settings';
include('../Gincludes/header.php');
include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');


$error = array(
	"first_name" => "",
	"last_name" => "",
	"username" => "",
	"email" => "",
	"top" => ""
);	

// Check for a valid user ID, through GET or POST: 
    if ((isset($_SESSION['user_id'])) && (is_numeric($_SESSION['user_id']))) { // index.php
        $user_id = $_SESSION['user_id'];
    } else { // No valid ID, kill the script.  
        echo '<script type="text/javascript">
        alert("This page is accessed in error");
        location="index.php";
        </script>';
        include('../Gincludes/footers.php');
        include('../Gincludes/footer.php');
        exit();
    }
            
        // Check if the form has been submitted: 
        if ($_SERVER['REQUEST_METHOD'] =='POST') {
                   
            // Trim all the incoming data:
            $trimmed = array_map('trim', $_POST);
	         // Assume invalid values:
	        // Check for a first name:
                if (preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
                    $fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
                } else {
                    $error["first_name"] = "First name cannot be empty."; 
                }
                // Check for a last name:
                    if (preg_match('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
                        $ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);
                    } else {
                        $error["last_name"] = "Last name cannot be empty.";
                    }

                 // Check for a username:
	                if (preg_match('/^[\w .]+$/', $trimmed['username'])) {
		            $us = mysqli_real_escape_string($dbc, $trimmed['username']);
	                } else {
		                $error["username"] = "Username cannot be empty.";
	                }
                    // Check for an email address:
                        if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
                            $e = mysqli_real_escape_string($dbc, $trimmed['email']);
                        } else {
                            $error["email"] = "Email address cannot be empty.";
                        }
                        
                        if ($fn && $ln && $e && $us) { // If everything's OK.

                            // Test for unique email address:
                                $q = "SELECT user_id FROM users WHERE email='$e' AND user_id !=$user_id";
                                $r = @mysqli_query($dbc, $q); 
                                if (mysqli_num_rows($r) == 0) {

                                    // Make the query: 
                                    $q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e', username='$us' WHERE user_id=$user_id LIMIT 1";
                                    $r = @mysqli_query($dbc, $q);
                                    if (mysqli_affected_rows($dbc)==1) { // If it ran OK.

                                        // Print a message:
                                        echo '<script type="text/javascript">
                                        alert("Settings saved successfully");
                                        location="settings.php";
                                        </script>';

                                    } else { // If it did not run OK.

                                        echo '<script type="text/javascript">
                                        alert("The settings could not be changed due to a system error.
                                        We apologize for any incovenience.");
                                        location="index.php";
                                        </script>'; // Public Message
                                        echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>';
                                        // Debugging message.

                                    }
                                } else { // Already registered.
                                    $error["email"] = "The email address has already been registered.";
                                
                                }

                            } else { // Report the errors.
                                $error["top"] = "Please try again.";
                } 
                        
}// End of submit conditional.


?>

<section>
      <div class="container-fluid">
        <div class="row">
            
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row pt-md-5 mt-md-3 mb-5">
              
              <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 p-2">
                
                  <div class="d-flex justify-content-center">
                <?php

                $q = "SELECT image FROM users WHERE user_id=$user_id";
                $query = $dbc->query($q);
                while ($result = $query->fetch_assoc()) {
                    $image = substr($result['image'], 3);
                  
                    echo "
                    <img src='".$image."' height='180px' width='180px' class='rounded-circle mr-3 mb-2'>";
                }
                ?> 
                </div>
                <div class="d-flex justify-content-center">
                <a href="uploadImage.php" class="btn btn-light btn-sm mb-2">Update Profile</a> 
                </div>
                   
                <?php 
                 $q = "SELECT CONCAT(first_name,' ',last_name) AS name FROM users WHERE user_id=$user_id";
                 $query = $dbc->query($q);
                 while ($result = $query->fetch_assoc()) {
                     ?>
                     <div class="d-flex justify-content-center">
                     <h5 class="text-muted"><?php echo $result["name"]; ?></h5>
                 </div>

                 <hr>
                    <?php
                 }              
                ?>

                <?php 
                 $q = "SELECT email FROM users WHERE user_id=$user_id";
                 $query = $dbc->query($q);
                 while ($result = $query->fetch_assoc()) {
                     ?>
                     <div class="d-flex justify-content-center">
                     <small class="text-primary"> <i class="fa fa-envelope
                       text-muted fa-lg mr-3 mb-2"></i><?php echo $result["email"]; ?></small>
                 </div>

                 <div class="d-flex justify-content-center">
                 <small><a href="change_password.php"><i class="fa fa-lock
                       text-muted fa-lg mr-3"></i>Change Password</a></small>
                 </div>

                 <?php
                 }              
                ?>
                </div>
                
                <?php
                $q = "SELECT username, email, first_name, last_name FROM users WHERE user_id=$user_id";
                $r = @mysqli_query($dbc, $q);
                 
                if (mysqli_num_rows($r)== 1) { // valid user ID, show the form.
      
                // Get the pateint's information
                $row = mysqli_fetch_array($r, MYSQLI_NUM);

                echo '<div class="col-xl-9 col-lg-9 col-md-6 col-sm-6 p-2">
                <div class="card card-commons mb-4 mr-4 ml-4">
                <div class="card-header">
                    <h3 class="text-muted">Account Settings</h3>
                </div>
                <div class="card-body task-border">


                <form action="settings.php" method="post">
                    <div class="d-flex justify-content-center">
                      
                <div class="col-4">
                <label class="text-secondary text-right">Username<span class="text-danger"> *</span> :</label>
                </div>
                
                <div class="form-group col-7">
                <input type="text" name="username" class="form-control" maxlength="20"
                value="' . $row[0] . '">
                <small class="errorText text-danger"><?php echo $error["username"]; ?></small><br>
                </div>   
                </div>
                
                <div class="d-flex justify-content-center">
                <div class="col-4">
                <label class="text-secondary text-right">Email<span class="text-danger"><strong> *</strong></span> :</label>
                </div>
                
                <div class="form-group col-7">
                <input type="text" name="email" class="form-control" maxlength="20"
                value="' . $row[1] . '">
                <small class="errorText text-danger"><?php echo $error["email"]; ?></small><br>
                </div>   
                </div>

                </div>
                </div>

                <div class="card card-commons task-border mr-4 ml-4">
                  <h4 class="text-muted ml-3 mt-3">Other Information</h4>
                
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                    <div class="col-4">
                <label class="text-secondary text-right">First Name<span class="text-danger"> *</span> :</label>
                </div>
                
                <div class="form-group col-7">
                <input type="text" name="first_name" class="form-control" maxlength="20"
                value="' . $row[2] . '">
                <small class="errorText text-danger"><?php echo $error["first_name"]; ?></small><br>
                </div>   
                </div>

                <div class="d-flex justify-content-center">
                    <div class="col-4">
                <label class="text-secondary text-right">Last Name<span class="text-danger"> *</span> :</label>
                </div>
                
                <div class="form-group col-7">
                <input type="text" name="last_name" class="form-control" maxlength="20"
                value="' . $row[3] . '">
                <small class="errorText text-danger"><?php echo $error["last_name"]; ?></small><br>
                </div>   
                </div>

                <div class="col-12">
                <input type="submit" class="btn btn-success btn-sm ml-5" name="submit" value="Save">
                <input type="hidden" name="user_id" value="'.$user_id .'">
                </form>
                </div>';

                } else { // Not a valid user ID.
                
                    echo '<script type="text/javascript">
                    alert("This page is accessed in error");
                    location="index.php";
                    </script>'; // Public Message
                }

                ?>
                </div>
                  
                </div>

                </div>
                           
                               
                    </div>
                  </div>
                  
                </div>
</section>
            
<!-- Add profileModal HTML -->
<div id="profileModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                
                	<form action = "uploadImage.php" method="post" enctype="multipart/form-data" id="uploadImageForm">
                		<div class="modal-header bg-warning">						
						<h4 class="modal-title text-light">Update Profile</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
                    <div class="d-flex justify-content-center">
                    <div id="messages"></div>

            <div class="form-group">
            <label for="exampleInputPassword1">Photo</label>
            <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
 
            <div class="kv-avatar center-block" style="width:300px">
                <input id="avatar-2" name="userImage" type="file" class="file-loading">
            </div>
          
            </div>
            </div>
            <div class="modal-footer bg-warning">
					    <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-success btn-sm">Update picture</button>
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
<?php 
mysqli_close($dbc);
?>
<?php include('../Gincludes/footers.php'); ?>
<?php include('../Gincludes/footer.php') ?>