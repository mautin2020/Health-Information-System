<?php 
// Doctor Schedule


$page_title = 'Create Appointment';
include('../Gincludes/header.php');
include('../Gincludes/mhead2.php');
include('../Gincludes/sidebar.php');

$error = array(
    "doctor_name" => "",
    "D_id" => "",
    "patient_name" => "",
    "pd_id" => "",
    "description" => "",
    "status" => "",
    "gender" => "",
    "date_of_birth" => "",
    "age" => "",
    "cn" => "",
    "fln" => "",
	"top" => "",
	"success" => ""
);	

?>

<section>

<div class="container-fluid">
      <div class="row ml-2 mr-2">
      <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
          
      <div class="row pt-md-5 mt-md-3 mb-5">

        <div class="col-xl-12 p-2">
            
        <div class="card">
                  <div class="card-header bg-info">
                  <i class="fa fa-calendar text-light fa-lg mr-3">  Appointment Dashboard
                      <br> <br></i>
                      
</div>
</div>
</div>                        

<div class="col-xl-3 col-lg-3 col-sm-6 p-2">
<div class="card">
    <div class ="card-header currents">
        <small class="text-light">Today's Schedule</small>
</div>
<div class="class-body currents-card">
<small>
<div class="table-responsive">
<table class="table table-striped table-hover table-sm">
<thead>
<tr>
<th class="text-light">#</th>
<th class="text-light">Dr. Name</th>
<th class="text-light">Section</th>
<th class="text-light">Start Time</th>
<th class="text-light">Close Time</th>
</tr>
</thead>
<tbody>
<?php
                
                $query = "SELECT DATE_FORMAT(sch_date, '%b %d, %Y') AS sch_date, section, doctor_name, TIME_FORMAT(start_time, '%l:%i %p') AS start_time, TIME_FORMAT(end_time, '%l:%i %p') AS end_time, sch_id, user_id AS D_id FROM doctor_schedule WHERE sch_date = CURDATE() ORDER BY sch_date";
                $result = @mysqli_query($dbc, $query);
					$i=1;
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                ?>
                
                <tr class="text-light" id="<?php echo $row["sch_id"]; ?>">
					<td><?php echo $i; ?></td>
                    <td><?php echo $row["doctor_name"]; ?></td>
                    <td><?php echo $row["section"]; ?></td>
                    <td><?php echo $row["start_time"]; ?></td>
                    <td><?php echo $row["end_time"]; ?></td>
                    </tr>
                    <?php
				$i++;
				}
				?>
</tbody>
</table>
            </small>

</div>
</div>      
</div>      
</div>      

<div class="col-xl-6 col-lg-6 col-sm-6 p-2">
    <div class="row ml-1">
            
    <div class="col-xl-12 p-2 bg-info fixed-postion">
<div class="d-flex justify-content-center mr-1">
<a href="pat_reg.php" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-plus text-light"></i> Add New Patient</a>
</div>

</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>


           <?php
           $query ="SELECT CONCAT(first_name, ' ',last_name) AS name, userImage, pd_id, patient_address, telephone_number, gender, date_of_birth, age, state, card_no, occupation, contact_fullname, telephone_number2, registration_date FROM patient_details ORDER BY registration_date DESC";
            $result = mysqli_query($dbc, $query);  
                ?>
           <div class="container">  
                   <div class="table-responsive">  
                     <table id="appointment_table" class="display">  
                          <thead>  
                                    <tr> <td class="bg-info text-light">PID</td>
                                    <td class="bg-info text-light">Name</td>  
                                    <td class="bg-info text-light">Age</td>  
                                    <td class="bg-info text-light">Gender</td> 
                                    <td class="bg-info text-light">Book Appointment</td> 
                                    
                                </tr>  
                          </thead>
                         <?php  
                          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            ?>   
                            
                               <tr>  
                                    <td><?php echo $row["pd_id"]; ?></td>  
                                    <td><a href="#" class="hover" pd_id="<?php echo $row["pd_id"]; ?>"><?php echo $row["name"]; ?></a></td>
                                    <td><?php echo $row["age"]; ?></td>  
                                    <td><?php echo $row["gender"]; ?></td> 

                                    <td><a href="#Addappointment" data-toggle="modal">
                                    <i class="material-icons createappointment"
							        data-pd_id="<?php echo $row["pd_id"]; ?>"
							        data-name="<?php echo $row["name"]; ?>"
							        data-age="<?php echo $row["age"]; ?>"
                                    data-gender="<?php echo $row["gender"]; ?>"
                                    title="Create Appointment">
                                    </i></a> 
                          </td></tr>
                          
                          <?php        
                                
                          }  
                          ?>   
                          
                     </table>  
                </div>  
           </div> 
                        </div>
                        </div> 
            
            <div class="col-xl-3 col-lg-6 col-sm-6 p-2">
            <div class="card ml-3">
            
            <div class ="card-header currents mb-3">
            <small class="text-light">Today's Appointment</small>
            </div>
           <?php
           $query = "SELECT a.patient_name, p.userImage, p.pd_id FROM appointment AS a INNER JOIN patient_details AS p USING (pd_id) WHERE appt_date = CURDATE() ORDER BY appointment_id DESC";
                $result = mysqli_query($dbc, $query);
                while($row = mysqli_fetch_array($result)) {
                    
                    echo'<a href="#" class="hoverer" pd_id='.$row["pd_id"].'><div class="mb-4 ml-3 appointment-link"><img src="uploads/'.$row["userImage"].'" height="40px" width="40px" class="rounded-circle mr-3">
                    <span>'.$row["patient_name"].'</span></div></a>';
                    
                    }
                    ?>      
        
        </div>

</div>
</div>
    
<!-- Appointment Modal HTML -->
<div id="Addappointment" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="appointment_form">
					<div class="modal-header bg-warning">						
						<h4 class="modal-title text-light">Create Appointment</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">                 
                    <small class="errorText text-danger justify-content-center"><?php echo $error["top"]; ?></small>
                        <?php
						echo '<div class="form-group">
							<label>Doctor Name</label>
							<select name="doctor_name" id="doctor_name_a" class="form-control" required>
                                <option></option>';
                                $user_id = $_SESSION['user_id'];
                                $q = "SELECT doctor_name FROM doctor_schedule WHERE sch_date = CURDATE()";
                                    $r = @mysqli_query($dbc, $q); // Run the query.
                                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
                                    {
                                      echo '<option value = "'.$row['doctor_name'].'">'.$row['doctor_name'].'</option>';
                                    } 
                                    echo '</select>';
                                    echo '<small class="errorText text-danger"><?php echo $error["doctor_name"]; ?></small>';
                                    echo '</div>';

                                    echo '<div class="form-group">
							<label>Doctor Id</label>
							<select name="D_id" id="D_id_a" class="form-control" required="">
                                <option></option>';
                                $user_id = $_SESSION['user_id'];
                                    $q = "SELECT user_id FROM doctor_schedule AS D_id WHERE sch_date = CURDATE()";
                                    $r = @mysqli_query($dbc, $q); // Run the query.
                                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
                                    {
                                      echo '<option value = "'.$row['user_id'].'">'.$row['user_id'].'</option>';
                                    } 
                                    echo '</select>';
                                    echo '<small class="errorText text-danger"><?php echo $error["D_id"]; ?></small>';
                                    echo '</div>';

                            echo '<div class="form-group">
							<label>Patient Name</label>
                            <input type="text" name="patient_name" class="form-control" id="name_a" readonly>
                            <small class="errorText text-danger"><?php echo $error["patient_name"]; ?></small>
                                   

                            </div>';

                            echo '<div class="form-group">
                            <label>Patient ID</label>
                            <input type="text" name="pd_id" class="form-control" id="pd_id_a" readonly>
                            <small class="errorText text-danger"><?php echo $error["pd_id"]; ?></small>
                                   
							</div>';

                        ?>
                            <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="2" cols="40" class="form-control" maxlength="255" id="description"></textarea>
                            <small class="errorText text-danger"><?php echo $error["description"]; ?></small>
                                   
                            </div>

                            <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" id="status">
                            <option value="Schedule">Schedule</option>
                            <option value="Schedule">In Progress</option>
                            <option value="Schedule">Missed Appointment</option>
                                </select>
                            <small class="errorText text-danger"><?php echo $error["status"]; ?></small>
                                   

                            </div>
					<div class="modal-footer bg-warning">
					<input type="hidden" value="5" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success btn-sm" id="btn-createappointment">Create Appointment</button>
					</div>
				</form>
			</div>
		</div>
    </div>
</div>
</div>
</div>

<script>
    $(document).on('click','.createappointment',function(e) {
    var pd_id=$(this).attr("data-pd_id");
    var name=$(this).attr("data-name");
    var age=$(this).attr("data-age");
    var gender=$(this).attr("data-gender");
    $('#pd_id_a').val(pd_id);
    $('#name_a').val(name);
    $('#age_a').val(age);
    $('#gender_a').val(gender);
});

$(document).on('click','#btn-createappointment',function(e) {
    var data = $("#appointment_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#Addappointment').modal('hide');
                    alert('Appointment Added Successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});
</script>

<script>  
 $(document).ready(function(){  
   var table = $('#appointment_table').DataTable();
});  
$(document).ready(function(){
           $('.hover').popover({  
                title:fetchData,
                html:true,  
                placement:'right'  
           });  
           function fetchData(){  
                var fetch_data = '';  
                var element = $(this);  
                var pd_id = element.attr("pd_id");  
                $.ajax({  
                     url:"fetch2.php",  
                     method:"POST",  
                     async:false,  
                     data:{pd_id:pd_id},  
                     success:function(data){  
                          fetch_data = data;  
                     }  
                });  
                return fetch_data;  
           }  
      });  

      $(document).ready(function(){
           $('.hoverer').tooltip({  
                title:fetchData,
                html:true,  
                placement:'right'  
           });  
           function fetchData(){  
                var fetch_data = '';  
                var element = $(this);  
                var pd_id = element.attr("pd_id");  
                $.ajax({  
                     url:"fetch3.php",  
                     method:"POST",  
                     async:false,  
                     data:{pd_id:pd_id},  
                     success:function(data){  
                          fetch_data = data;  
                     }  
                });  
                return fetch_data;  
           }  
      });  
 </script>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('keyup', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<?php
mysqli_close($dbc);
include('../Gincludes/footer.php');
include('../Gincludes/mfoot.php');

?>