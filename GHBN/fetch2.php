<?php  
 //fetch.php  
 if(isset($_POST["pd_id"]))  
 {  
      $output = '';  
      require('../Gincludes/config.inc.php');
     require(MYSQL);
      $query = "SELECT * FROM patient_details WHERE pd_id='".$_POST["pd_id"]."'";  
      $result = mysqli_query($dbc, $query);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output = '  
                <p><img src="uploads/'.$row["userImage"].'" class="img-responsive img-thumbnail" /></p>  
                <p><Strong>Patient Address : </strong><br />'.$row['patient_address'].'</p>  
                <p><strong>Telephone Number : </strong>'.$row['telephone_number'].'</p>  
                <p><strong>Gender : </strong>'.$row['gender'].'</p>  
                <p><strong>Age : </strong>'.$row['age'].' Years</p>  
                <p><strong>State : </strong>'.$row['state'].'</p>  
                <p><strong>NHIS : </strong>'.$row['card_no'].'</p>  
                <p><strong>Occupation : </strong>'.$row['occupation'].'</p>  
                <p><strong>Person to Contact : </strong>'.$row['contact_fullname'].'</p>  
                <p><strong>Person to Contact Phone : </strong>'.$row['telephone_number2'].'</p>

           ';  
      }  
      echo $output;  
 }  
 ?>  