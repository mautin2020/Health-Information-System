<?php  
$page_title = 'Patient List';
include('../Gincludes/header.php');
include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');

?>

<section>

<div class="container-fluid">
      <div class="row ml-2 mr-2">
      <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
          
      <div class="row pt-md-5 mt-md-3 mb-5">

        <div class="col-xl-12 p-2">
            
        <div class="card">
                  <div class="card-header bg-info">
                  <i class="fa fa-wheelchair text-light fa-lg mr-3">  Patient List
                      <br> <br></i>
                      
</div>
</div>
</div>                        

                        <?php 
                      include('../Gincludes/pat_list.php');
                      ?>
           </div>  
           </div>  
           </div>  
           </div>  
        
           <!-- setImageModal Modal HTML -->
	<div id="setImageModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
     
      <form id="setimage_form" enctype="multipart/form-data">
            <div class="modal-header bg-warning btn-sm">						
						<h4 class="modal-title text-light">Add Image</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
          <div class="modal-body">
          
          <div class="form-group">
            <input type="hidden" pd_id="pd_id_u" name="pd_id" class="form-control">
            </div>  

            <div class="d-flex justify-content-center">
            <div class="form-group">
            <label for="exampleInputPassword1">Photo</label>
            <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
 
            <div class="kv-avatar center-block" style="width:300px">
                <input id="avatar-2" name="userImage" type="file" class="file-loading">
            </div>

            </div>
            </div>
          	<div class="modal-footer bg-warning">
					<input type="hidden" value="16" name="type">
						<input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-info btn-sm" id="btn-setimager">Add Image</button>
					</div>
				</form>  

            </div>
            </div>
            </div>
            </div>
            </div>
             
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

  <script>
  
  $(document).on('click','.setimage',function(e) {
    var pd_id=$(this).attr("data-pd_id");
    var userImage=$(this).attr("userImage");
           
    $('#pd_id_u').val(pd_id);
    $('#avatar-2').val(userImage);
});

$(document).on('click','#btn-setimager',function(e) {
    var data = $("#setimage_form").serialize();
    $.ajax({
        data: data,
        type: "POST",
        url: "php_action/save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#setImageModal').modal('hide');
                    alert('Data updated successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});
  
  </script>


<?php 

include('../Gincludes/footer.php');
include('../Gincludes/mfoot.php');

?>