<?php # manage_patient.php 
// This page is for editing a use record. 
// This page is accessed through manage_users.php. 

$page_title = 'Manage Patient';

include('../Gincludes/header.php');
include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');

// Check for a valid user ID, through GET or POST: 
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From manage_users.php
        $id = $_GET['id'];
    } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) { // Form submission.  
        $id = $_POST['id'];
    } else { // No valid ID, kill the script.  
              
        echo '<script type="text/javascript">
        alert("This page is accessed in error");
        location="index.php";
        </script>';
        include('../Gincludes/footers.php');
    }
    
    echo '<section>
        <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
            <div class="col-xl-12 col-12 mb-4 pt-5 mt-5 ml-4 pl-4 mr-5 pr-5 mb-xl-0">
            
            <div class="jumbotron bg-light">
            
            <p class="lead bg-info text-info">Hospital Management System, Hospital Management System Hospital Management System Hospital Management System Hospital Management System.</p>
            <hr class="my-4">
            
            <div class="table-wrapper">
            
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr class="bg-info">
						
						<th class="text-light">#</th>
                        <th class="text-light">Patient Name</th>
                        <th class="text-light">Pd_id</th>
                        <th class="text-light">Gender</th>
                        <th class="text-light">Age</th>
                        <th class="text-light">Patient Address</th>
                        <th class="text-light">Date of Birth</th>
                        <th class="text-light">DID</th>
                        <th class="text-light">Appt. Date</th>
                        
                        
                        
                    </tr>
                </thead>
            <tbody>';     

            $query = "SELECT CONCAT(first_name,' ',last_name) AS patient_name, p.pd_id, p.gender, p.age, p.patient_address, p.date_of_birth, a.user_id, a.description, a.appt_date FROM patient_details AS p INNER JOIN appointment AS a USING (pd_id) WHERE pd_id = $id AND appt_date = CURDATE() LIMIT 1";
                $result = @mysqli_query($dbc, $query);
                $i=1; 
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>
				<tr id="<?php echo $row["pd_id"]; ?>">
					<td class="bg-primary text-light"><?php echo $i; ?></td>
					<td><?php echo $row["patient_name"]; ?></td>
                    <td><?php echo $row["pd_id"]; ?></td>
                    <td><?php echo $row["gender"]; ?></td>
                    <td><?php echo $row["age"]; ?></td>
                    <td><?php echo $row["patient_address"]; ?></td>
                    <td><?php echo $row["date_of_birth"]; ?></td>
                    <td><?php echo $row["user_id"]; ?></td>
                    <td><?php echo $row["appt_date"]; ?></td>
                    
                </tr>
                </tbody>
                </table>
				<?php
				$i++;
        }        
        
        $q = "SELECT reason_for_visit FROM reason_for_visits WHERE pd_id=$id AND reason_for_visit_date = CURDATE() ORDER BY reason_for_visit_time DESC LIMIT 1";
        $r = @mysqli_query($dbc, $q);
        
        if (mysqli_num_rows($r)== 1) { // valid user ID, show the form.
        
            // Get the user's information
            $row = mysqli_fetch_array($r, MYSQLI_NUM);
        
               echo '<div class="col-xl-6 col-6 mb-4 mt-5 mr-5 pr-5 mb-xl-0">
                <div class="form-group">
          
                <form action="manage_patient.php" method="post">
                                <label>Patient Reason for Visit</label>
                                <textarea name="reason_for_visit" rows="2" cols="40" class="form-control" maxlength="255" id="reason_for_visit_vi">
                                '.$row[0] . '</textarea>
                                </div>
                    </div>
                    </form>';
        } else {
          echo '<script type="text/javascript">
          alert("This page is accessed in error");
          location="index.php";
          </script>';
          include('../Gincludes/footers.php');
      }
      
      
      $q = "SELECT BP_systolic, BP_Diastolic, Temperature, pulse, respiratory_rate, weight, height, vitals_date FROM vitals WHERE pd_id=$id AND vitals_date = CURDATE() ORDER BY vitals_time DESC LIMIT 1";
      $r = @mysqli_query($dbc, $q);
      
      if (mysqli_num_rows($r)== 1) { // valid user ID, show the form.
      
          // Get the pateint's information
          $row = mysqli_fetch_array($r, MYSQLI_NUM);

                    echo '<div class="col-xl-12 col-lg-11 col-md-8 col-sm-7 mb-4 mt-5 mr-5 pr-5 mb-xl-0">
                    <div class="card">
                    <div class="card-header bg-info text-light">
                    <span>Vitals</span>
                    </div>
                    <hr>
                    
                    <form action="manage_patients.php">
                    <div class="form-group row">
                    

                    <label for="BP Systolic" class="col-sm-2 col-form-label col-form-label-sm">BP Systolic</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="bp_systolic" id="bp_systolic_v" value="' . $row[0] . '">
                    </div>

                    <label for="BP Diastolic" class="col-sm-2 col-form-label col-form-label-sm">BP Diastolic</label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control form-control-sm" name="bp_diastolic" id="bp_diastolic" value="' . $row[1] . '"> </div>

                    <label for="Temperature" class="col-sm-2 col-form-label col-form-label-sm">Temperature </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control form-control-sm" name="temperature" id="temperature" value="' . $row[2] . '"> </div>

                    <label for="Pulse" class="col-sm-1 col-form-label col-form-label-sm">Pulse </label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control form-control-sm" name="pulse" id="pulse" value="' . $row[3] . '"> <small>bpm</small> </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                    
                    <label for="Respiratory Rate" class="col-sm-2 col-form-label col-form-label-sm">Respiratory Rate </label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="respiratory_rate" id="respiratory_rate_v" value="' . $row[4] . '"> <small>breaths/m</small> </div>

                    <label for="Weight" class="col-sm-2 col-form-label col-form-label-sm">Weight </label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="weight" id="weight_v" value="' . $row[5] . '"> <small>Kg</small> </div>

                    <label for="Height" class="col-sm-2 col-form-label col-form-label-sm">Height </label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" name="height" id="height" value="' . $row[6] . '"> <small>cm</small> </div>

   
</form>
                    </div>
                    </div>
                    </div>';
      } else {
        echo '<script type="text/javascript">
        alert("Please add vital sign");
        location="index.php";
        </script>';
        include('../Gincludes/footers.php');
    }
                   echo '<div>
                    <div class="col-xl-12 col-lg-11 col-md-8 col-sm-7 mb-4 mt-5 mr-5 pr-5 mb-xl-0">
                    <div class="row align-items-center mb-5">
        
              <div id="accordion">
                <div class="card mb-3">
                  <div class="card-header">
                    <button class="btn btn-block bg-info text-light
                    text-left" data-toggle="collapse" 
                    data-target="#collapseOne">
                      Symptoms
                    </button>
                  </div>
                  <div class="collapse show" id="collapseOne" 
                  data-parent="#accordion">
                    <div class="card-body">';
                                       
                    // Table header:
                    echo '<table class="table table-striped text-center">
                    <thead class="bg-info">
                    <tr class="text-light">
                    <th>Symptoms Title</th>
                    <th>Symptoms</th>
                    <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $q = "SELECT symptoms_title, symptoms, symptoms_date FROM symptoms WHERE pd_id=$id AND symptoms_date = CURDATE() ORDER BY symptoms_time DESC LIMIT 1";
                    $r = @mysqli_query($dbc, $q);

                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { 
                    echo '<tr>';?>

                    <td><?php echo $row["symptoms_title"]; ?></td>
                    <td><?php echo $row["symptoms"]; ?></td>
                    <td><?php echo $row["symptoms_date"]; ?></td>
                    </tr>


                   <?php
                    }
                    echo '</tbody></table>';
                    echo '</div>
                  </div>
                </div>            

                <div id="accordion">
                <div class="card mb-3">
                  <div class="card-header">
                    <button class="btn btn-block bg-info text-light
                    text-left" data-toggle="collapse" 
                    data-target="#collapseOne">
                      Diagnostic
                    </button>
                  </div>
                  <div class="collapse show" id="collapseOne" 
                  data-parent="#accordion">
                    <div class="card-body">';
                   
                    // Table header:
                    echo '<table class="table table-striped text-center table-sm">
                    <thead class="bg-info">
                    <tr class="text-light">
                    <th>BioChemistry</th>
                    <th>Stool</th>
                    <th>Blood</th>
                    <th>Colonoscopy</th>
                    <th>Gastroscopy</th>
                    <th>Urine</th>
                    <th>Xray</th>
                    <th>Sonography</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $q = "SELECT BioChemistry, stool, blood, colonoscopy, gastroscopy, urine, xray, sonography FROM patient_diagnosis WHERE pd_id=$id AND diagnosis_date = CURDATE() ORDER BY diagnosis_time DESC LIMIT 1";
                    $r = @mysqli_query($dbc, $q);

                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { 
                    echo '<tr>';?>

                    <td><?php echo $row["BioChemistry"]; ?></td>
                    <td><?php echo $row["stool"]; ?></td>
                    <td><?php echo $row["blood"]; ?></td>
                    <td><?php echo $row["colonoscopy"]; ?></td>
                    <td><?php echo $row["gastroscopy"]; ?></td>
                    <td><?php echo $row["urine"]; ?></td>
                    <td><?php echo $row["xray"]; ?></td>
                    <td><?php echo $row["sonography"]; ?></td>
                    </tr>

                    <?php
                    }
                    echo '</tbody></table>
                    
                    <table class="table table-striped text-center table-sm">
                    <thead class="bg-info">
                    <tr class="text-light">
                    <th>ECG</th>
                    <th>Others</th>
                    <th>Reconsultation Advice WK</th>
                    <th>Reconsultation Advice Date</th>
                    <th>Final Diagnosis</th>
                    <th>Remark</th>
                    <th>Prov. Diagnosis</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $q = "SELECT ECG, others, reconsultation_advice_week, reconsultation_advice_date, final_diagnosis, remark, provisional_diagnosis FROM patient_diagnosis WHERE pd_id=$id AND diagnosis_date = CURDATE() ORDER BY diagnosis_time DESC LIMIT 1";
                    $r = @mysqli_query($dbc, $q);

                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { 
                    echo '<tr>';?>

                    <td><?php echo $row["ECG"]; ?></td>
                    <td><?php echo $row["others"]; ?></td>
                    <td><?php echo $row["reconsultation_advice_week"]; ?></td>
                    <td><?php echo $row["reconsultation_advice_date"]; ?></td>
                    <td><?php echo $row["final_diagnosis"]; ?></td>
                    <td><?php echo $row["remark"]; ?></td>
                    <td><?php echo $row["provisional_diagnosis"]; ?></td>
                    </tr>

                    <?php
                    }
                    echo '</tbody></table>
                    
                    </div>
                  </div>
                </div>  

                <div id="accordion">
                <div class="card mb-3">
                  <div class="card-header">
                    <button class="btn btn-block bg-info text-light
                    text-left" data-toggle="collapse" 
                    data-target="#collapseOne">
                      Prescription
                    </button>
                  </div>
                  <div class="collapse show" id="collapseOne" 
                  data-parent="#accordion">
                    <div class="card-body">
                    <table class="table table-striped text-center table-sm">
                    <thead class="bg-info">
                    <tr class="text-light">
                    <th>Medicine Number</th>
                    <th>Medicine Name</th>
                    <th>Precaution</th>
                    <th>Number of Doses</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $q = "SELECT medicine_no, medicine_name, Precaution, No_of_Doses FROM patient_Medicine WHERE pd_id=$id AND medicine_date = CURDATE() ORDER BY medicine_time DESC LIMIT 1";
                    $r = @mysqli_query($dbc, $q);

                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { 
                    echo '<tr>';?>

                    <td><?php echo $row["medicine_no"]; ?></td>
                    <td><?php echo $row["medicine_name"]; ?></td>
                    <td><?php echo $row["Precaution"]; ?></td>
                    <td><?php echo $row["No_of_Doses"]; ?></td>
                    </tr>

                    <?php
                    }
                    echo '</tbody></table>
                    </div>
                  </div>
                </div>  

                
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>';
?>

</div>
</div>
</div>
</div>

                        

<?php 
mysqli_close($dbc);
include('../Gincludes/mfoot.php');
include('../Gincludes/footer.php');  
?>