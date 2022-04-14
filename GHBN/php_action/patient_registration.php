<?php 
// This is the patient registration page for the site.

$page_title = 'Patient Registration';
include('../../Gincludes/header.php');
require('../../Gincludes/config.inc.php');

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
    require(MYSQL);
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);
	// Assume invalid values:
	$fn = $ln = $st = $gd = $dob = $ag = $ad = $tn = $cn = $occ = $fln = $tn2 = $url = FALSE;
    
    // Check for a first name:
    if (empty($trimmed['first_name'])) {
        $error["first_name"] = "Please enter your first name!";
        }
	if (!preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
        $error["first_name"] = "Name must be letters only!";
	} else {
        $fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
	}
    // Check for a last name:
    if (empty($trimmed['last_name'])) {
        $error["last_name"] = "Please enter your last name!";
        }
	if (!preg_match('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
        $error["last_name"] = "Last name should be letters only!";
	} else {
		$ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);
    }

    // Check for patient address:
        if (empty($trimmed['patient_address'])) {
            $error["patient_address"] = "Please enter patient address!";
        }
        if (!preg_match('/^[\w . ,]+$/', $trimmed['patient_address'])) {
            $error["patient_address"] = "Special characters are not allowed in address!";
            } else {
                $ad = mysqli_real_escape_string($dbc, $trimmed['patient_address']);
            }
   

	// Check for a valid state in Nigeria:
    $validStates = array("Abia", "Abuja", "Adamawa", "Akwa-Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", 
    "Cross-River", "Delta", "Ebonyi", "Edo", "Ekiti",  "Enugu", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano",
    "Kastina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nassarawa", "Niger", "Ogun", "Ondo", "Osun", "Oyo", "Plateu", "River", "Sokoto", "Taraba",
    "Yobe", "Zamfara");
      
    if (empty($trimmed['state'])) {
        $error["state"] = "Please select patient state!";
        }
        if (!in_array($trimmed['state'], $validStates)) {
            $error["state"] = "Select valid state!";
        } else {
            $st = mysqli_real_escape_string($dbc, $trimmed['state']);
        }
    
    // Check for a telephone number:

        if (empty($trimmed['telephone_number'])) {
            $error["telephone_number"] = "Please enter patient phone number!";
            }
        if (!preg_match('/^234[0-9]{11}/', $trimmed['telephone_number'])) {
            $error["telephone_number"] = "Please Check the number and try again!";
        } else {
        $tn = mysqli_real_escape_string($dbc, $trimmed['telephone_number']);
    } 
    
    // Check for telephone number 2

    if (empty($trimmed['telephone_number2'])) {
        $error["telephone_number"] = "Please enter person to contact number!";
        }
    if (!preg_match('/^234[0-9]{11}/', $trimmed['telephone_number2'])) {
        $error["telephone_number"] = "Please Check the number and try again!";
    } else {
    $tn2 = mysqli_real_escape_string($dbc, $trimmed['telephone_number2']);
} 
    
   // Check for patient gender:
    $validGender = array("Male", "Female");

    if (empty($trimmed['gender'])) {
        $error["gender"] = "Patient gender cannot be empty!";
    }
        if (!in_array($trimmed['gender'], $validGender)) {
            $error["gender"] = "Choose valid gender!";
         } else {
            $gd = mysqli_real_escape_string($dbc, $trimmed['gender']);
         }   

         if (empty($trimmed['age'])) {
            $error["age"] = "Patient age cannot be empty!";
        }
    if (!preg_match('/^[\d]+$/', $trimmed['age'])) {
        $error["age"] = "Input valid age!";
    } else {
        $ag = mysqli_real_escape_string($dbc, $trimmed['age']);
    }

    // Check for an occupation:
        if (empty($trimmed['occupation'])) {
            $error["occupation"] = "Please enter occupation!";
        }
	if (!preg_match('/^[A-Z \'.-]{2,30}$/i', $trimmed['occupation'])) {
        $error["occupation"] = "Occupation should be letters only!";
	} else {
		$occ = mysqli_real_escape_string($dbc, $trimmed['occupation']);
    }

    // Check for NHIS number
    if (isset($trimmed['card_no']) && $trimmed['card_no'] != "") {
        if (!preg_match('/^[\d]+$/',$trimmed['card_no'])) {
            $error["cn"] = "NHIS contain digits only!";
            } else {
                $cn = mysqli_real_escape_string($dbc, $trimmed['cn']);
            }
        }
    
            // Check for fullname
            if (empty($trimmed['fullname'])) {
                $error["fln"] = "Please enter contact fullname!";
            }

            if (!preg_match('/^[\w . -]+$/', $trimmed['fullname'])) {
                $error["fln"] = "Use proper character for fullname!";
                } else {
                    $fln = mysqli_real_escape_string($dbc, $trimmed['fullname']);
                }

    $type = explode('.', $_FILES['userImage']['name']);
    $type = $type[count($type) - 1];
    $url = '../uploads/' . uniqid(rand()) . '.' . $type;

     if (isset($trimmed['userImage']) && $trimmed['userImage'] !="") {
    
        if(!in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'GIF', 'JPG', 'JPEG', 'PNG'))) {
        echo '<script type="text/javascript">
                    alert("Form not submitted invalid image type");
                    location="../pat_reg.php";
                    </script>';
    }

    elseif (!is_uploaded_file($_FILES['userImage']['tmp_name'])) {

        echo '<script type="text/javascript">
                    alert("Error While Uploading");
                    location="../pat_reg.php";
                    </script>';
    }

    elseif (move_uploaded_file($_FILES['userImage']['tmp_name'], $url)) {
        $url = mysqli_real_escape_string($dbc, $trimmed['userImage']);
    } else {
        $url = '../uploads/default-avatar.png';
    }
}

	if ($fn && $ln && $st && $gd && $dob && $ag && $cn && $ad && $tn && $occ && $fln && $tn2 && $url) { // If everything's OK...
				
			// Add the patient to the database:
			$q = "INSERT INTO patient_details (first_name, last_name, state, gender, date_of_birth, age, card_no, patient_address, telephone_number, occupation, contact_fullname, telephone_number2, userImage, registration_date) 
            VALUES ('$fn', '$ln', '$st', '$gd', '$dob', '$ag', '$cn', '$ad', '$tn', '$occ', '$fln', '$tn2', '$url', NOW() )";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
				
                echo '<script type="text/javascript">
                alert("Patient added successfully");
                location="../pat_reg.php";
                </script>';
				exit(); // Stop the page.
			} else { // If it did not run OK.
                echo '<script type="text/javascript">
                alert("Patient could not be added due to system error");
                location="../pat_reg.php";
                </script>';
			}
		} else { // If one of the data tests failed.
            $error["top"] = "Please try again!";
	}
    mysqli_close($dbc);
}
// End of the main Submit conditional.
?>