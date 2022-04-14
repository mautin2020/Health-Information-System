<?php  
 
 $query ="SELECT CONCAT(first_name, ' ',last_name) AS name, userImage, pd_id, patient_address, telephone_number, gender, date_of_birth, age, state, card_no, occupation, contact_fullname, telephone_number2, registration_date FROM patient_details ORDER BY registration_date DESC";
 $result = mysqli_query($dbc, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.material.min.css" />  
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script>  
            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.20/js/dataTables.material.min.js"></script>            
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css" />  

           <script src="assets/fileinput/js/plugins/piexif.min.js" type="text/javascript"></script>    
    <script src="assets/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>  
    <script src="assets/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="assets/fileinput/js/fileinput.min.js"></script>
    
     </head>  
      <body>  
           <div class="container">  
                   <div class="table-responsive">  
                     <table id="patient_list" class="table table-striped table-bordered">  
                          <thead>  
                               <tr> <td class="bg-info text-light">PID</td>
                                   <td class="bg-info text-light">Image</td>  
                                    <td class="bg-info text-light">Name</td>  
                                    <td class="bg-info text-light">Gender</td>  
                                    <td class="bg-info text-light">Birth_Date</td>
                                    <td class="bg-info text-light">Age</td>  
                                    <td class="bg-info text-light">Tel. No</td>  
                                    <td class="bg-info text-light">Patient_Address</td>
                                    <td class="bg-info text-light">State</td>
                                    <td class="bg-info text-light">Occupation</td>
                                    <td class="bg-info text-light">NHIS</td>
                                    <td class="bg-info text-light">Person_to_Contact</td>
                                    <td class="bg-info text-light">Person_to_Contact Phone</td>
                                    <td class="bg-info text-light">Registration Date</td>
                                    <td class="bg-info text-light">Add Image</td>
                                </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                               $image = substr($row['userImage'], 3);
                               echo '  
                               <tr>  
                                    <td>'.$row["pd_id"].'</td>  
                                    <td> <img src="'.$image.'" style="height50px; width:50px;"/> </td>  
                                    <td>'.$row["name"].'</td>  
                                    <td>'.$row["gender"].'</td>  
                                    <td>'.$row["date_of_birth"].'</td>  
                                    <td>'.$row["age"].'</td>  
                                    <td>'.$row["telephone_number"].'</td>  
                                    <td>'.$row["patient_address"].'</td>  
                                    <td>'.$row["state"].'</td>  
                                    <td>'.$row["occupation"].'</td>  
                                    <td>'.$row["card_no"].'</td>  
                                    <td>'.$row["contact_fullname"].'</td>  
                                    <td>'.$row["telephone_number2"].'</td>  
                                    <td>'.$row["registration_date"].'</td>  
                                    <td><a href ="set_image.php?pd_id=' .$row['pd_id'] . '"><i class="fa fa-edit fa-lg
                                    text-success ml-3"></i><a/></td>
                              
                               </tr>  
                               ';  
                          }  
                          ?>  
                          
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#patient_list').DataTable();  
 });  
 </script>  