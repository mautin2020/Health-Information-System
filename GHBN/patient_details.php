<?php # patient_details.php 
// This page is for patient details. 
// This page is accessed through pat_reg.php. 

$page_title = 'Patient Details';
include('../Gincludes/header.php');
include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');

if(isset($_POST['submit'])){
    // Fetching variables of the form which travels in URL
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $state = $_POST['state'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $patient_address = $_POST['patient_address'];
    $telephone_number = $_POST['telephone_number'];
    $occupation = $_POST['occupation'];
    $fullname = $_POST['fullname'];
    $telephone_number2 = $_POST['telephone_number2'];
    }
    else{
 	echo '<script type="text/javascript">
    alert("Please fill all required field");
    location="pat_reg.php";
    </script>';
    }
?>



<section>
      <div class="container-fluid">
      <div class="row ml-2 mr-2">
      <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
          
      <div class="row pt-md-5 mt-md-3 mb-5">

        <div class="col-xl-12 p-2">

        <?php 
                 $q = "SELECT CONCAT(first_name,' ',last_name) AS name FROM patient_details WHERE first_name=$first_name";
                 $query = $dbc->query($q);
                 while ($result = $query->fetch_assoc()) {
                     ?>
        <div class="card">         
        <div class="card-header bg-info">
                     <h5 class="text-light"><?php echo $result["name"]; ?></h5>
                     <?php

                 }
                     ?>
</div>
</div>
</div>                        

</section>

<?php include('../Gincludes/footers.php'); ?>
<?php include('../Gincludes/footer.php') ?>