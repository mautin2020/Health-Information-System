<?php # uploadImage.php 
// This page is for updating userImage. 
// This page is accessed through settings.php. 

$page_title = 'Patient Image';
include('../Gincludes/header.php');
include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');

if ((isset($_GET['pd_id'])) && (is_numeric($_GET['pd_id']))) { // From manage_users.php
    $pd_id = $_GET['pd_id'];
} elseif ((isset($_POST['pd_id'])) && (is_numeric($_POST['pd_id']))) { // Form submission.  
    $pd_id = $_POST['pd_id'];
} else {
    echo '<script type="text/javascript">
            alert("Page Access in Error");
            location="../patient_list.php";
            </script>';
            include('../Gincludes/footers.php');
            exit();
}


if ($_SERVER['REQUEST_METHOD'] =='POST') {
    

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
                    location="patient_list.php";
                    </script>';
                } 
                else {
                    echo '<script type="text/javascript">
                    alert("Error While Uploading");
                    location="patient_list.php";    
                    </script>';
                }
 
                $dbc->close();
 
            }
            else {
                echo '<script type="text/javascript">
                alert("Error While Uploading");
                location="patient_list.php";
                </script>';
            }
        } 
    }  else {
        echo '<script type="text/javascript">
        alert("Only Image Are allowed");
        location="patient_list.php";
        </script>';
    }
} 

 
    // upload the file 


echo '<section>

<div class="container-fluid py-3">
        <div class="row">
            
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row pt-md-5 mt-md-3 mb-5">
              
              <div class="col-xl-12 col-lg-11 col-md-12 col-sm-6 p-2">
                
                  <div class="d-flex justify-content-center">
				  <div class="card card-commons mb-4">
				  <div class="card-header">
                    <h4 class="text-muted">Set Image</h4>
                </div>
				<div class="card-body task-border">
        
        <div id="messages"></div>
 
        <form action="php_action/setImager.php" method="POST" enctype="multipart/form-data">
          
           <div class="form-group">
            <label for="exampleInputPassword1">Photo</label>
            <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
 
            <div class="kv-avatar center-block" style="width:300px">
                <input id="avatar-2" name="userImage" type="file" class="file-loading">
            </div>
          </div>
          <div class="card-footer">
          <button type="submit" class="btn btn-success btn-sm">Submit</button>
          <input type="hidden" name="pd_id" value="' .$pd_id . '">
             </form>
             </div>';

?>
      
    </div>
    </div>
            </div>
            </div>
            </div>
            </div>
			</div>
			</div>
     
    <!-- jquery -->
    <script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
    <!-- bootsrap js -->
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- file input -->
    <script src="assets/fileinput/js/plugins/piexif.min.js" type="text/javascript"></script>    
    <script src="assets/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>  
    <script src="assets/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="assets/fileinput/js/fileinput.min.js"></script>
 
    <script type="text/javascript">
        var btnCust = '<button type="button" class="btn btn-info" title="Add picture tags" ' + 
            'onclick="alert(\'Please select picture and click submit button.\')">' +
            '<i class="fa fa-edit text-light"></i>' +
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
</body>
</html>
</section>

<?php include('../Gincludes/footers.php'); ?>
<?php include('../Gincludes/footer.php') ?>