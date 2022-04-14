<?php  
 //fetch.php  
 if(isset($_POST["pd_id"]))  
 {  
      $output = '';  
      require('../Gincludes/config.inc.php');
     require(MYSQL);
      $query = "SELECT u.image, d.doctor_name, d.section, a.pd_id FROM users AS u INNER JOIN doctor_schedule AS d USING (user_id) INNER JOIN appointment AS a USING (user_id) WHERE appt_date = CURDATE() AND pd_id='".$_POST["pd_id"]."' ORDER BY appointment_id DESC";  
      $result = mysqli_query($dbc, $query);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output = ' 
           <div class="d-flex justify-content-center">
           <h6><strong>Appointment Details</strong></h6>
           </div>
           
           <div class="d-flex justify-content-center">
           <img src="uploads/'.$row["image"].'" height="70px" width="70px" class="rounded-circle mb-4"/>  
           </div>

           <div class="d-flex justify-content-center mb-0">
           <p><strong>Doctor\'s Name</strong></p>
           </div>

           <div class="d-flex justify-content-center">
           <h5><strong>'.$row['doctor_name'].'</stong></h5>
           </div>
                
           <div class="d-flex justify-content-center">
           <h5><strong>'.$row['section'].'</stong></h5>
           </div>

        ';  
      }  
      echo $output;  
 }  
 ?>  