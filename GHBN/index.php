<?php 
include('../Gincludes/header.php');
if (!isset($_SESSION["user_id"]))
{
   header("location: login.php");
}
// This is the main page for the site. 


// Set the page title and include the HTML header: 
$page_title = 'Lagos State University!';
include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');

// Welcome the user (by name if they are logged in): 

echo '<section>';

if ($_SESSION['user_level'] == 2) {
 
echo '<div class="container-fluid">
<div class="row">
  <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
    <div class="row pt-md-5 mt-md-3 mb-5">
      
      <div class="col-xl-3 col-sm-6 p-2">
        <div class="card card-common">
          <div class="card-body bg-danger">
            <div class="d-flex justify-content-between">
             <i class="fa fa-clock-o fa-3x 
              text-light"></i>
            <div class="text-center text-light">';
                
              date_default_timezone_set('Africa/Lagos');
                $time = date('H:i');
                echo "<h2>" .$time. "</h2>";

                $date = date('F j, Y');
                echo "<p>" .$date. "</p>";
                              
                echo '</div>
            </div>
          </div>
          <div class="card-footer text-light bg-danger">
            
            </div>
        </div>

      </div>
      <div class="col-xl-3 col-sm-6 p-2">
      <div class="card card-common">
          <div class="card-body bg-secondary">
            <div class="d-flex justify-content-between">
              <i class="fa fa-calendar fa-3x 
              text-light"></i>
              <div class="text-right text-light">';
              
              $sql = "SELECT COUNT(*) FROM appointment WHERE appt_date=CURDATE() AND user_id = ($_SESSION[user_id])";
              $result = mysqli_query($dbc, $sql);
              $count = mysqli_fetch_assoc($result)['COUNT(*)'];
              echo "<h3>" .$count. "</h3>";
                
                echo '<p>Todays Appointment</p>
              </div>
            </div>
          </div>
          <div class="card-footer text-light bg-secondary">
          </div>
        </div>

    </div>
    <div class="col-xl-3 col-sm-6 p-2">
    <div class="card card-common">
        <div class="card-body bg-info">
          <div class="d-flex justify-content-between">
            <i class="fa fa-stethoscope fa-3x 
            text-light"></i>
            <div class="text-right text-light">';
                  
            $sql = "SELECT COUNT(*) FROM users WHERE user_level = 2";
            $result = mysqli_query($dbc, $sql);
            $count = mysqli_fetch_assoc($result)['COUNT(*)'];
            echo "<h3>" .$count. "</h3>";
              
              echo '<p>Total Doctors</p>
            </div>
          </div>
        </div>
        <div class="card-footer text-light bg-info">
        </div>
      </div>

  </div>
  <div class="col-xl-3 col-sm-6 p-2">
  <div class="card card-common">
      <div class="card-body bg-warning">
        <div class="d-flex justify-content-between">
          <i class="fa fa-wheelchair fa-3x 
          text-light"></i>
          <div class="text-right text-light">';
          
          $sql = "SELECT COUNT(*) FROM patient_details";
          $result = mysqli_query($dbc, $sql);
          $count = mysqli_fetch_assoc($result)['COUNT(*)'];
          echo "<h3>" .$count. "</h3>";
            
            echo '<p>Total Patients</p>
          </div>
        </div>
      </div>
      <div class="card-footer text-light bg-warning">
      </div>
    </div>

</div>';

            echo '<div class="col-xl-12 col-12 mb-4 mb-xl-0">
            <h3 class="text-primary mb-4">Today Appointment</h3>
            <div class="card">
<div class="card-header bg-info">
</div>
<div class="card-body">
    
    <div class="container">
	<p id="success"></p>
        <div class="table-responsive">
            
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr class="bg-light">
						
						<th class="text-info">#</th>
                        <th class="text-info">Patient Name</th>
                        <th class="text-info">Pd_id</th>
                        <th class="text-info">Pdiag_id</th>
                        <th class="text-info">Status</th>
                        <th class="text-info">Reason for Visit</th>
                        <th class="text-info">Vitals Signs</th>
                        <th class="text-info">Add Symptoms</th>
                        <th class="text-info">Add Diagnosis</th>
                        <th class="text-info">Prescription</th>
                        <th class="text-info">Generate Report</th>
                        
                    </tr>
                </thead>
        <tbody>';      
                
                
                $query = "SELECT a.patient_name, a.pd_id, a.appointment_id, a.status, a.appt_date, g.pdiag_id, g.diagnosis_date FROM appointment AS a LEFT JOIN patient_diagnosis AS g USING (pd_id) WHERE appt_date = CURDATE() AND user_id = ($_SESSION[user_id])";
                $result = @mysqli_query($dbc, $query);
					$i=1;
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				?>
				<tr id="<?php echo $row["appointment_id"]; ?>">
					<td class="bg-primary text-light"><?php echo $i; ?></td>
					          <td><?php echo $row["patient_name"]; ?></td>
                   
                    <td><?php echo $row["pd_id"]; ?></td>

                    <td><?php echo $row["pdiag_id"]; ?></td>
                    
                    <td><?php echo $row["status"]; ?></td>

                    <td><a href="#ReasonForVisit" data-toggle="modal">
                        <i class="fa fa-wheelchair fa-lg text-info ml-4 visit" data-toggle="tooltip"
							          data-pd_id="<?php echo $row["pd_id"]; ?>"
                        data-patient_name="<?php echo $row["patient_name"]; ?>"
                        data-status="<?php echo $row["status"]; ?>"
							          title="Reason for Visit"></i></a></td>

                    <td><a href="#VitalsSign" data-toggle="modal">
                        <i class="fa fa-thermometer fa-lg text-success ml-4 vitalSign" data-toggle="tooltip"
							          data-pd_id="<?php echo $row["pd_id"]; ?>"
                        data-patient_name="<?php echo $row["patient_name"]; ?>"
                        data-status="<?php echo $row["status"]; ?>"
							          title="Vitals Sign"></i></a></td>
                                               
                        <td><a href="#AddSymptoms" data-toggle="modal">
                        <i class="fa fa-user fa-lg text-danger ml-4 symptoms" data-toggle="tooltip"
							          data-pd_id="<?php echo $row["pd_id"]; ?>"
                        data-patient_name="<?php echo $row["patient_name"]; ?>"
                        data-status="<?php echo $row["status"]; ?>"
							          title="Add Symptoms"></i></a></td>

                        <td><a href="#PatientDiagnosis" data-toggle="modal">
                        <i class="fa fa-stethoscope fa-lg text-primary ml-4 diagnosis" data-toggle="tooltip"
							          data-pd_id="<?php echo $row["pd_id"]; ?>"
                        data-patient_name="<?php echo $row["patient_name"]; ?>"
                        data-status="<?php echo $row["status"]; ?>"
							          title="Diagnosis"></i></a></td>

                        <td><a href="#PatientMedicine" data-toggle="modal">
                        <i class="fa fa-plus-square fa-lg text-primary ml-4 medicine" data-toggle="tooltip"
							          data-pd_id="<?php echo $row["pd_id"]; ?>"
                        data-pdiag_id="<?php echo $row["pdiag_id"]; ?>"
                        data-patient_name="<?php echo $row["patient_name"]; ?>"
                        data-status="<?php echo $row["status"]; ?>"
							          title="Add Prescription"></i></a></td>

                        <td><a href="manage_patient.php?id=<?php echo $row['pd_id']; ?>"><i class="fa fa-user-md fa-lg
                        text-info ml-4" data-toggle="tooltip" title="Generate Report"></i></a></td>
                    
                    
                </tr>
                
				<?php
				$i++;
				}
                echo '</div>
                </div>
                </div>';

                echo '</div>
                </div>';
                
                
                

                } else if ($_SESSION['user_level'] == 1) {
                      echo '<h3 class="text-info">Welcome';
                      if (isset($_SESSION['first_name'])) {
                        echo " {$_SESSION['first_name']}";
                    }
                    echo '!</h3> ';
           }
            
               
                ?>

<!-- ReasonForVisit Modal HTML -->
<div id="ReasonForVisit" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="visit_form">
					<div class="modal-header bg-warning">						
						<h4 class="modal-title text-light">Reason for Visit</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id_vi" name="id" class="form-control" required>					
            <input type="hidden" id="pd_id_vi" name="pd_id" class="form-control form-control-sm">
                       
            <div class="form-group">
            <label>Reason for Visit</label>
            <textarea name="reason_for_visit" rows="2" cols="40" class="form-control" maxlength="255" id="reason_for_visit_vi"></textarea>
            </div>

          <div class="modal-footer bg-warning">
					<input type="hidden" value="10" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-success" id="btn-visit">Add Visit</button>
					</div>
          </form>
</div>
</div>
</div>
</div>

<!-- VitalSigns Modal HTML -->
<div id="VitalsSign" class="modal fade">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<form id="vitals_form">
					<div class="modal-header bg-warning">						
						<h4 class="modal-title text-light">Vital Signs</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id_v" name="id" class="form-control" required>					
            <div class="form-group row col-xl-12 col-lg-6 col-md-6">
            
                    <label for="BP Systolic" class="col-sm-2 col-form-label col-form-label-sm">BP Systolic</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="bp_systolic" id="bp_systolic"> </div>

                    <label for="BP Diastolic" class="col-sm-2 col-form-label col-form-label-sm">BP Diastolic</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="bp_diastolic" id="bp_diastolic"> </div>

                    <label for="Temperature" class="col-sm-2 col-form-label col-form-label-sm">Temperature </label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="temperature" id="temperature"> </div></div>
                    
                    <div class="form-group row">
                    
                    <label for="Pulse" class="col-sm-2 col-form-label col-form-label-sm">Pulse </label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="pulse" id="pulse"> <small>bpm</small> </div>

                    
							      <input type="hidden" id="pd_id_v" name="pd_id" class="form-control form-control-sm">
                    </div>
                    
                    <hr>
                    <div class="form-group row">
                    
                    <label for="Respiratory Rate" class="col-sm-2 col-form-label col-form-label-sm">Respiratory Rate </label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="respiratory_rate" id="respiratory_rate"> <small>breaths/m</small> </div>

                    <label for="Weight" class="col-sm-2 col-form-label col-form-label-sm">Weight </label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="weight" id="weight"> <small>Kg</small> </div>

                    <label for="Height" class="col-sm-2 col-form-label col-form-label-sm">Height </label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="height" id="height"> <small>cm</small> </div>
          </div>
          </div>
          <div class="modal-footer bg-warning">
					<input type="hidden" value="6" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-createvitals">Add Vitals</button>
					</div>
   
</form>
</div>
</div>
</div>
</div>


<!-- AddSymptoms Modal HTML -->
<div id="AddSymptoms" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="symptoms_form">
					<div class="modal-header bg-warning">						
						<h4 class="modal-title text-light">Add Symptoms</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id_s" name="id" class="form-control" required>					
            <input type="hidden" id="pd_id_s" name="pd_id" class="form-control form-control-sm">
            
            <div class="form-group">
            <label>Symptom Title</label>
            <input type="text" class="form-control"  name="symptoms_title" id="symptoms_title"> 
            </div>
            
            <div class="form-group">
            <label>Symptoms</label>
            <textarea name="symptoms" rows="2" cols="40" class="form-control" maxlength="255" id="symptoms"></textarea>
            </div>

          <div class="modal-footer bg-warning">
					<input type="hidden" value="7" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-success" id="btn-addsymptoms">Add Symptom</button>
					</div>
          </form>
</div>
</div>
</div>
</div>

<!-- PatientDiagnosis Modal HTML -->
<div id="PatientDiagnosis" class="modal fade">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<form id="diagnosis_form">
					<div class="modal-header bg-warning">
						<h4 class="modal-title text-light">Diagnosis</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id_G" name="id" class="form-control" required>					
            <div class="form-group row col-xl-12 col-lg-6 col-md-6">
            
                    <label for="BioChemistry" class="col-sm-2 col-form-label col-form-label-sm">BioChemistry</label>
                    <div class="col-sm-2">
                    <select name="BioChemistry" id="BioChemistry_G" class="form-control form-control-sm">
                     <option>No</option>
                     <option>Yes</option>
                     </select></div>

                     <label for="stool" class="col-sm-2 col-form-label col-form-label-sm">Stool</label>
                    <div class="col-sm-2">
                    <select name="stool" id="stool_G" class="form-control form-control-sm">
                     <option>No</option>
                     <option>Yes</option>
                     </select></div>
                     
                     <label for="blood" class="col-sm-2 col-form-label col-form-label-sm">Blood</label>
                    <div class="col-sm-2">
                    <select name="blood" id="blood_G" class="form-control form-control-sm">
                     <option>No</option>
                     <option>Yes</option>
                     </select></div></div>

                     <hr>
                    
                    <div class="form-group row">
                    
                    <label for="colonoscopy" class="col-sm-2 col-form-label col-form-label-sm">Colonoscopy</label>
                    <div class="col-sm-2">
                    <select name="colonoscopy" id="Colonoscopy_G" class="form-control form-control-sm">
                     <option>No</option>
                     <option>Yes</option>
                     </select></div>
                    
                     <label for="gastroscopy" class="col-sm-2 col-form-label col-form-label-sm">Gastroscopy</label>
                    <div class="col-sm-2">
                    <select name="gastroscopy" id="Gastroscopy_G" class="form-control form-control-sm">
                     <option>No</option>
                     <option>Yes</option>
                     </select></div>

                     <label for="urine" class="col-sm-2 col-form-label col-form-label-sm">Urine</label>
                    <div class="col-sm-2">
                    <select name="urine" id="Urine_G" class="form-control form-control-sm">
                     <option>No</option>
                     <option>Yes</option>
                     </select></div>

							      <input type="hidden" id="pd_id_G" name="pd_id" class="form-control form-control-sm">
                    </div>
                    
                    <hr>
                    <div class="form-group row">
                    
                    <label for="xray" class="col-sm-2 col-form-label col-form-label-sm">Xray</label>
                    <div class="col-sm-2">
                    <select name="xray" id="Xray_G" class="form-control form-control-sm">
                     <option>No</option>
                     <option>Yes</option>
                     </select></div>

                     <label for="sonography" class="col-sm-2 col-form-label col-form-label-sm">Sonography</label>
                    <div class="col-sm-2">
                    <select name="sonography" id="Sonography_G" class="form-control form-control-sm">
                     <option>No</option>
                     <option>Yes</option>
                     </select></div>

                     <label for="ECG" class="col-sm-2 col-form-label col-form-label-sm">ECG</label>
                    <div class="col-sm-2">
                    <select name="ECG" id="ECG_G" class="form-control form-control-sm">
                     <option>No</option>
                     <option>Yes</option>
                     </select></div>
          </div>

                    <hr>
                    <div class="form-group row">
                      <label for="others" class="col-sm-2 col-form-label col-form-label-sm">Others</label>
                      <div class="col-sm-2">
                     <textarea name="others" rows="2" cols="40" class="form-control form-control-sm" maxlength="255" id="others_G"></textarea>
                      </div>

                      <label for="reconsultation_advice_week" class="col-sm-2 col-form-label col-form-label-sm">Reconsultation Advice Week</label>
                    <div class="col-sm-2">
                    <textarea name="reconsultation_advice_week" rows="2" cols="40" class="form-control form-control-sm" maxlength="255" id="reconsultation_advice_week_G"></textarea>
                      </div>

                      <label for="reconsultation_advice_date" class="col-sm-2 col-form-label col-form-label-sm">Reconsultation Advice Date</label>
                    <div class="col-sm-2">
                    <input type="date" class="form-control form-control-sm" name="reconsultation_advice_date" id="reconsultation_advice_date_G">
                      </div>

                    </div>

                    <hr>
                    
                    <div class="form-group row">
                    <label for="provisional_diagnosis" class="col-sm-2 col-form-label col-form-label-sm">Provisinoal Diagnosis</label>
                    <div class="col-sm-2">
                    <textarea name="provisional_diagnosis" rows="2" cols="40" class="form-control form-control-sm" maxlength="255" id="provisional_diagnosis_G"></textarea>
                      </div>

                    <label for="final_diagnosis" class="col-sm-2 col-form-label col-form-label-sm">Final Diagnosis</label>
                    <div class="col-sm-2">
                    <textarea name="final_diagnosis" rows="2" cols="40" class="form-control form-control-sm" maxlength="255" id="final_diagnosis_G"></textarea>
                      </div>

                      <label for="remark" class="col-sm-2 col-form-label col-form-label-sm">Remark</label>
                    <div class="col-sm-2">
                    <textarea name="remark" rows="2" cols="40" class="form-control form-control-sm" maxlength="255" id="remark_G"></textarea>
                      </div>

                      </div>

          <div class="modal-footer bg-warning">
					<input type="hidden" value="8" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-diagnosis">Add Diagnosis</button>
					</div>
   
</form>
</div>
</div>
</div>
</div>

<!-- PatientMedicine Modal HTML -->
<div id="PatientMedicine" class="modal fade">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<form id="medicine_form">
					<div class="modal-header bg-warning">
						<h4 class="modal-title text-light">Prescription</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
                  <input type="hidden" id="id_M" name="id" class="form-control" required>
                   <input type="hidden" id="pd_id_M" name="pd_id" class="form-control">
                   <input type="hidden" id="pdiag_id_M" name="pdiag_id" class="form-control">
                   <div class="form-group row col-xl-12 col-lg-6 col-md-6">         
                   
                    <label for="medicine_no" class="col-sm-2 col-form-label col-form-label-sm">Medicine Number</label>
                      <div class="col-sm-2">
                     <textarea name="medicine_no" rows="2" cols="40" class="form-control form-control-sm" maxlength="255" id="medicine_no_M"></textarea>
                      </div>

                    <label for="medicine_name" class="col-sm-2 col-form-label col-form-label-sm">Medicine Name</label>
                    <div class="col-sm-2">
                    <textarea name="medicine_name" rows="2" cols="40" class="form-control form-control-sm" maxlength="255" id="medicine_name_M"></textarea>
                      </div>

                      <label for="Precaution" class="col-sm-2 col-form-label col-form-label-sm">Precaution</label>
                    <div class="col-sm-2">
                    <textarea name="Precaution" rows="2" cols="40" class="form-control form-control-sm" maxlength="255" id="Precaution_M"></textarea>
                      </div></div>
                     
                      <hr>
                      <div class="form-group row">

                      <label for="No_of_Doses" class="col-sm-2 col-form-label col-form-label-sm">Number of Doses</label>
                    <div class="col-sm-2">
                    <textarea name="No_of_Doses" rows="2" cols="40" class="form-control form-control-sm" maxlength="255" id="No_of_Doses_M"></textarea>
                      </div>

                    </div>

          <div class="modal-footer bg-warning">
					<input type="hidden" value="9" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-medicine">Add Medicine</button>
					</div>
   
</form>
<div>
<div>
</div>
</div>
</div>
</div>

<?php
mysqli_close($dbc);
include('../Gincludes/mfoot.php');
include('../Gincludes/footer.php');
?>