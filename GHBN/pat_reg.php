<?php
// This is the patient registration page for the site.

$page_title = 'Patient Registration';
include('../Gincludes/header.php');
include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');

$error = array(
    "first_name" => "",
    "last_name" => "",
    "patient_address" => "",
    "state" => "",
    "telephone_number" => "",
    "occupation" => "",
    "gender" => "",
    "date_of_birth" => "",
    "age" => "",
    "cn" => "",
    "fln" => "",
	"top" => "",
	"success" => ""
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	// Need the database connection:

	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);
	// Assume invalid values:
	$fn = $ln = $st = $gd = $dob = $ag = $ad = $tn = $cn = $occ = $fln = $tn2 = FALSE;

    // Check for a first name:
    if (empty($trimmed["first_name"])) {
        $error["first_name"] = "First Name is required!";
    } else {
        $fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
        // check if first name only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z ]*$/', $trimmed['first_name'])) {
            $error["first_name"] = "Only letters are allowed!";
    }
}

    // Check for a last name:
        if (empty($trimmed["last_name"])) {
            $error["last_name"] = "Last Name is required!";
        } else {
            $ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);
            // check if last name only contains letters and whitespace
            if (!preg_match('/^[a-zA-Z ]*$/', $trimmed['last_name'])) {
                $error["last_name"] = "Only letters are allowed!";
        }
    }

    // Check for patient address:

    if (empty($trimmed["patient_address"])) {
        $error["patient_address"] = "Patient Address is required!";
    } else {
        $ad = mysqli_real_escape_string($dbc, $trimmed['patient_address']);
        // check if address does not contain unnecessary input
        if (!preg_match('/^[\w .,-]+$/', $trimmed['patient_address'])) {
            $error["patient_address"] = "Apostrophe, quotes and other characters not allowed!";
    }
}

	// Check for a valid state in Nigeria:
    $validStates = array("Abia", "Abuja", "Adamawa", "Akwa-Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno",
    "Cross-River", "Delta", "Ebonyi", "Edo", "Ekiti",  "Enugu", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano",
    "Kastina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nassarawa", "Niger", "Ogun", "Ondo", "Osun", "Oyo", "Plateu", "River", "Sokoto", "Taraba",
    "Yobe", "Zamfara");

      if (in_array($trimmed['state'], $validStates)) {
        $st = mysqli_real_escape_string($dbc, $trimmed['state']);
        } else {
            $error["state"] = "Select valid state!";
        }

    // Check for a telephone number:

        if (empty($trimmed["telephone_number"])) {
            $error["telephone_number"] = "Enter Phone number!";
          } else {
            $tn = mysqli_real_escape_string($dbc, $trimmed['telephone_number']);
            // check if telephone number contain only number
            if (!preg_match('/^[\d]+$/',$trimmed['telephone_number'])) {
                $error["telephone_number"] = "Phone number should contain digits only!";
            }
          }

    // Check for telephone number 2

    if (empty($trimmed["telephone_number2"])) {
        $error["telephone_number"] = "Enter Phone number!";
      } else {
        $tn2 = mysqli_real_escape_string($dbc, $trimmed['telephone_number2']);
        // check if telephone number contain only number
        if (!preg_match('/^[\d]+$/',$trimmed['telephone_number2'])) {
            $error["telephone_number"] = "Phone number should contain digits only!";
        }
      }

   // Check for patient gender:
    $validGender = array("Male", "Female");

    if (in_array($trimmed['gender'], $validGender)) {
        $gd = mysqli_real_escape_string($dbc, $trimmed['gender']);
        } else {
            $error["gender"] = "Choose valid gender!";
         }

         // check for age
         if (empty($trimmed["age"])) {
            $error["age"] = "Enter Patient Age!";
          } else {
            $ag = mysqli_real_escape_string($dbc, $trimmed['age']);
            // check if age contain only number
            if (!preg_match('/^[\d]+$/',$trimmed['age'])) {
                $error["age"] = "Age should contain digits only!";
            }
          }

    // Check for patient occupation:

        if (empty($trimmed["occupation"])) {
            $error["occupation"] = "Patient Occupation required!";
        } else {
            $occ = mysqli_real_escape_string($dbc, $trimmed['occupation']);
            // check if occupation only contains letters and whitespace
            if (!preg_match('/^[A-Z \'.-]{2,30}$/i', $trimmed['occupation'])) {
                $error["occupation"] = "Only letters and white space allowed!";
        }
    }

    // Check for NHIS number

    if (empty($trimmed["card_no"])) {
        $cn = "NULL";
      } else {
        $cn = mysqli_real_escape_string($dbc, $trimmed['card_no']);
        // check if NHIS contain only number
        if (!preg_match('/^[\d]+$/',$trimmed['card_no'])) {
            $error["cn"] = "Card Number should contain digits only!";
        }
      }

    // Check for fullname

    if (empty($trimmed["fullname"])) {
        $error["fln"] = "Person to contact fullname!";
    } else {
        $fln = mysqli_real_escape_string($dbc, $trimmed['fullname']);
        // check if fullname only contains letters and whitespace
        if (!preg_match('/^[a-zA-Z ]*$/', $trimmed['fullname'])) {
            $error["fln"] = "Only letters and white space allowed!";
    }
}

$url = '../uploads/default-avatar.png';

                // Check date of birth

                if (empty($trimmed["date_of_birth"])) {
                    $error["date_of_birth"] = "Patient date of birth cannot be empty!";
                } else {
                    $dob = mysqli_real_escape_string($dbc, $trimmed['date_of_birth']);
                }

                if ($fn && $ln && $st && $gd && $dob && $ag && $cn && $ad && $tn && $occ && $fln && $tn2) { // If everything's OK...

                    // Add the patient to the database:
                    $q = "INSERT INTO patient_details (first_name, last_name, state, gender, date_of_birth, age, card_no, patient_address, telephone_number, occupation, contact_fullname, telephone_number2, userImage, registration_date) VALUES ('$fn', '$ln', '$st', '$gd', '$dob', '$ag', '$cn', '$ad', '$tn', '$occ', '$fln', '$tn2', '$url', NOW() )";
                    $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
                    if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

                        echo '<script type="text/javascript">
                        alert("Patient added successfully");
                        window.open("pat_reg.php","_self")
                        </script>';
                    exit(); // Stop the page.

			} else { // If it did not run OK.
				echo '<script type="text/javascript">
                        alert("Patient could not be added due to system error");
                        window.open("pat_reg.php","_self")
                        </script>';
            }
        } else { // If one of the data tests failed.
            $error["top"] = "Please try again!";
		}
    mysqli_close($dbc);
}
// End of the main Submit conditional.

?>

<section>
      <div class="container-fluid">
      <div class="row ml-2 mr-2">
      <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
      <form action="pat_reg.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

      <div class="row pt-md-5 mt-md-3 mb-5">

        <div class="col-xl-12 p-2">

        <div class="card">
                  <div class="card-header bg-info">
                  <i class="fa fa-wheelchair text-light fa-lg mr-3">  Patient Registration
                      <br> <br></i>

</div>
</div>
<small class="errorText text-danger justify-content-center"><?php echo $error["top"]; ?></small><br>
</div>


    <div class="col-xl-5 col-lg-5 col-sm-6 p-2">
<h5>Patient's Personal Information</h5>
<hr>

<div class="row ml-1 mb-3">

<div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">First Name
    </div>

<div class="col-md-7 d-flex justify-content-between mr-1"><input type="text" name="first_name" class="form-control" maxlength="20" id="firstname"
        value= "<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" required pattern="[A-Za-z]{2,}">

        <small class="errorText text-danger"><?php echo $error["first_name"]; ?></small><br>

        <div class="invalid-feedback">
          <small>Please Enter Valid Name</small>
        </div>
    </div>
</div>

<div class="row ml-1 mb-3">

<div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">Last Name
    </div>

<div class="col-md-7 d-flex justify-content-between mr-1"><input type="text" name="last_name" class="form-control" maxlength="40" id="lastname"
        value= "<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" required pattern="[A-Za-z]{2,}">

        <small class="errorText text-danger"><?php echo $error["last_name"]; ?></small><br>

        <div class="invalid-feedback">
          <small>Please Enter Valid Name</small>
        </div>
    </div>
</div>

<div class="row ml-1 mb-3">

<div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">State
    </div>

<div class="col-md-7 d-flex justify-content-between mr-1"><select name="state" class="form-control" id="state" required>

    <option>Select State</option>
    <option value="Abia"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Abia')) echo ' selected="selected"';?>>Abia</option>
    <option value="Abuja"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Abuja')) echo ' selected="selected"';?>>Abuja</option>
    <option value="Adamawa"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Adamawa')) echo ' selected="selected"';?>>Adamawa</option>
    <option value="Akwa-Ibom"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Akwa-Ibom')) echo ' selected="selected"';?>>Akwa-Ibom</option>
    <option value="Anambra"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Anambra')) echo ' selected="selected"';?>>Anambra</option>
    <option value="Bauchi"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Bauchi')) echo ' selected="selected"';?>>Bauchi</option>
    <option value="Bayelsa"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Bayelsa')) echo ' selected="selected"';?>>Bayelsa</option>
    <option value="Benue"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Benue')) echo ' selected="selected"';?>>Benue</option>
    <option value="Borno"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Borno')) echo ' selected="selected"';?>>Borno</option>
    <option value="Cross-River"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Cross-River')) echo ' selected="selected"';?>>Cross-River</option>
    <option value="Delta"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Delta')) echo ' selected="selected"';?>>Delta</option>
    <option value="Ebonyi"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Ebonyi')) echo ' selected="selected"';?>>Ebonyi</option>
    <option value="Edo"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Edo')) echo ' selected="selected"';?>>Edo</option>
    <option value="Ekiti"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Ekiti')) echo ' selected="selected"';?>>Ekiti</option>
    <option value="Enugu"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Enugu')) echo ' selected="selected"';?>>Enugu</option>
    <option value="Gombe"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Gombe')) echo ' selected="selected"';?>>Gombe</option>
    <option value="Imo"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Imo')) echo ' selected="selected"';?>>Imo</option>
    <option value="Jigawa"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Jigawa')) echo ' selected="selected"';?>>Jigawa</option>
    <option value="Kaduna"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Kaduna')) echo ' selected="selected"';?>>Kaduna</option>
    <option value="Kano"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Kano')) echo ' selected="selected"';?>>Kano</option>
    <option value="Kastina"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Kastina')) echo ' selected="selected"';?>>Kastina</option>
    <option value="Kebbi"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Kebbi')) echo ' selected="selected"';?>>Kebbi</option>
    <option value="Koggi"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Koggi')) echo ' selected="selected"';?>>Koggi</option>
    <option value="Kwara"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Kwara')) echo ' selected="selected"';?>>Kwara</option>
    <option value="Lagos"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Lagos')) echo ' selected="selected"';?>>Lagos</option>
    <option value="Nassarawa"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Nassarawa')) echo ' selected="selected"';?>>Nassarawa</option>
    <option value="Niger"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Niger')) echo ' selected="selected"';?>>Niger</option>
    <option value="Ogun"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Ogun')) echo ' selected="selected"';?>>Ogun</option>
    <option value="Ondo"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Ondo')) echo ' selected="selected"';?>>Ondo</option>
    <option value="Osun"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Osun')) echo ' selected="selected"';?>>Osun</option>
    <option value="Oyo"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Oyo')) echo ' selected="selected"';?>>Oyo</option>
    <option value="Plateu"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Plateu')) echo ' selected="selected"';?>>Plateu</option>
    <option value="River"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'River')) echo ' selected="selected"';?>>River</option>
    <option value="Sokoto"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Sokoto')) echo ' selected="selected"';?>>Sokoto</option>
    <option value="Taraba"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Taraba')) echo ' selected="selected"';?>>Taraba</option>
    <option value="Yobe"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Yobe')) echo ' selected="selected"';?>>Yobe</option>
    <option value="Zamfara"<?php if (isset($trimmed['state']) && ($trimmed['state'] == 'Zamfara')) echo ' selected="selected"';?>>Zamfara</option>
    </select>

    <small class="errorText text-danger"><?php echo $error["state"]; ?></small><br>

    <div class="invalid-feedback">
          <small>State Cannot be empty</small>
        </div>
    </div>
</div>

    <div class="row ml-1 mb-3">

<div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">Gender
    </div>

<div class="col-md-7 d-flex justify-content-between mr-1"><select name="gender" class="form-control" id="gender" required>
    <option></option>
    <option value="Male"<?php if (isset($trimmed['gender']) && ($trimmed['gender'] == 'Male')) echo ' selected="selected"';?>>Male</option>
    <option value="Female"<?php if (isset($trimmed['gender']) && ($trimmed['gender'] == 'Female')) echo ' selected="selected"';?>>Female</option>
    </select>

       <small class="errorText text-danger"><?php echo $error["gender"]; ?></small><br>

       <div class="invalid-feedback">
          <small>Select Gender</small>
        </div>
    </div>
</div>

<div class="row ml-1 mb-3">

    <div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">Birth Date
        </div>

    <div class="col-md-7 d-flex justify-content-between mr-1"><input type="date" name="date_of_birth" class="form-control" id="dob"
        value= "<?php if (isset($trimmed['date_of_birth'])) echo $trimmed['date_of_birth']; ?>" required pattern="/^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/">

        <small class="errorText text-danger"><?php echo $error["date_of_birth"]; ?></small><br>

        <div class="invalid-feedback">
          <small>Select Patient Date of birth</small>
        </div>

        </div>
    </div>

    <div class="row ml-1 mb-3">

    <div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">Age
        </div>

    <div class="col-md-7 d-flex justify-content-between mr-1"><input type="number" name="age" class="form-control" id="age"
        value= "<?php if (isset($trimmed['age'])) echo $trimmed['age']; ?>" required>

        <small class="errorText text-danger"><?php echo $error["age"]; ?></small><br>


        </div>
    </div>

<br>
<h5>For NHIS</h5>
<hr>

<div class="row ml-1 mb-3">

<div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">Card No
    </div>

<div class="col-md-7 d-flex justify-content-between mr-1"><input type="text" name="card_no" class="form-control" id="card_no"
    value= "<?php if (isset($trimmed['card_no'])) echo $trimmed['card_no']; ?>">
    <small class="errorText text-danger"><?php echo $error["cn"]; ?></small><br>
    </div>
</div>

</div>
<!-- End of first column -->

<div class="col-xl-5 col-lg-5 col-sm-6 p-2">
<h5>General Information</h5>
<hr>

<div class="row ml-1 mb-3">

<div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">Address
    </div>

<div class="col-md-7 d-flex justify-content-between mr-1"><textarea name="patient_address" rows="2" cols="40" class="form-control" maxlength="255" id="address"
        value= "<?php if (isset($trimmed['patient_address'])) echo $trimmed['patient_address']; ?>" required pattern="/^[a-zA-Z0-9]*$/"></textarea>

        <small class="errorText text-danger"><?php echo $error["patient_address"]; ?></small><br>

        <div class="invalid-feedback">
          <small>Enter valid address</small>
        </div>

    </div>
</div>

<div class="row ml-1 mb-3">

<div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">Mobile
    </div>

<div class="col-md-7 d-flex justify-content-between mr-1">
    <input type="text" name="telephone_number" maxlength="11" class="form-control" id="telephonenumber"
    value= "<?php if (isset($trimmed['telephone_number'])) echo $trimmed['telephone_number']; ?>" required patttern="([\d]{3}-[\d]{3}-[\d]{4}-[\d]{3})?">

    <small class="errorText text-danger"><?php echo $error["telephone_number"]; ?></small><br>

    <div class="invalid-feedback">
          <small>Enter valid phone number</small>
        </div>

    </div>
</div>

<div class="row ml-1 mb-3">

<div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">Occupation
    </div>

<div class="col-md-7 d-flex justify-content-between mr-1"><input type="text" name="occupation" class="form-control" maxlength="30" id="occupation"
        value= "<?php if (isset($trimmed['occupation'])) echo $trimmed['occupation']; ?>" required pattern="[A-Za-z]{2,}">

        <small class="errorText text-danger"><?php echo $error["occupation"]; ?></small><br>

        <div class="invalid-feedback">
          <small>Enter occupation with correct syntax</small>
        </div>
    </div>
</div>

<br>

<h5>Person to Contact in case of Emmergency</h5>
<hr>

<div class="row ml-1 mb-3">

<div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">Fullname
    </div>

<div class="col-md-7 d-flex justify-content-between mr-1"><input type="text" name="fullname" class="form-control" id="fullname"
    value= "<?php if (isset($trimmed['fullname'])) echo $trimmed['fullname']; ?>" required pattern="^(?:((([^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]'’,\-.\s])){1,}(['’,\-\.]){0,1}){2,}(([^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]'’,\-. ]))*(([ ]+){0,1}(((([^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]'’,\-\.\s])){1,})(['’\-,\.]){0,1}){2,}((([^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]'’,\-\.\s])){2,})?)*)$">

    <small class="errorText text-danger"><?php echo $error["fln"]; ?></small><br>

    <div class="invalid-feedback">
          <small>Enter fullname with correct value</small>
        </div>

    </div>
</div>

<div class="row ml-1 mb-3">

<div class="col-md-4 d-flex justify-content-between badge badge-info w-75 pt-3 pb-2 mr-2">Mobile
    </div>

<div class="col-md-7 d-flex justify-content-between mr-1"><input type="text" name="telephone_number2" maxlength="11" class="form-control" id="telephonenumber2"
    value= "<?php if (isset($trimmed['telephone_number2'])) echo $trimmed['telephone_number2']; ?>" required patttern="/^(0|\+234)\d{11}$/">
    <br>

    <small class="errorText text-danger"><?php echo $error["telephone_number"]; ?></small><br>

    <div class="invalid-feedback">
          <small>Enter valid phone number</small>
        </div>

    </div>
</div>
</div>

<!-- End of second column -->


<div class="col-xl-12 p-2">
<div class="d-flex justify-content-center mr-1">
<button type="submit" name="submit" class="btn btn-success btn-sm bg-info"><i class="fa fa-plus text-light mr-1"></i>Add</button>
</div>

</div>


    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</section>


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

<script>
    $(document).ready(function(){

        $("#dob").change(function(){
           var value = $("#dob").val();
            var dob = new Date(value);
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000) + 1);
            if(isNaN(age)) {

            // will set 0 when value will be NaN
             age=0;

            }
            else{
              age=age;
            }
            $('#age').val(age);

        });

    });
    </script>

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
        removeIcon: '<i class="fa fa-trash text-danger"></i>',
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

<?php include('../Gincludes/footers.php');
include('../Gincludes/footer.php'); ?>
