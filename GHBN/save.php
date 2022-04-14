<?php

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

require('../Gincludes/config.inc.php');
require(MYSQL);
if(count($_POST)>0){
	if($_POST['type']==1){
		$sch_date=$_POST['sch_date'];
		$section=$_POST['section'];
		$doctor_name=$_POST['doctor_name'];
		$start_time=$_POST['start_time'];
		$end_time=$_POST['end_time'];
		$D_id=$_POST['D_id'];
		$sql = "INSERT INTO doctor_schedule (sch_date, section, doctor_name, start_time, end_time, user_id)
		VALUES ('$sch_date', '$section', '$doctor_name', '$start_time', '$end_time', '$D_id')";
		if (mysqli_query($dbc, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		}
		mysqli_close($dbc);
	}
}

if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$sch_date=$_POST['sch_date'];
		$section=$_POST['section'];
		$doctor_name=$_POST['doctor_name'];
		$start_time=$_POST['start_time'];
		$end_time=$_POST['end_time'];
		$D_id=$_POST['D_id'];
		$sql = "UPDATE doctor_schedule SET sch_date='$sch_date', section='$section', doctor_name='$doctor_name', start_time='$start_time', end_time='$end_time', user_id='$D_id' WHERE sch_id=$id";
		if (mysqli_query($dbc, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		}
		mysqli_close($dbc);
	}
}

if(count($_POST)>0){
	if($_POST['type']==5){

		$trimmed = array_map('trim', $_POST);
		// Assume invalid values:
		$doctor_name = $D_id = $patient_name = $pd_id = $description = $status = FALSE;

		if (empty($trimmed["doctor_name"])) {
			$error["doctor_name"] = "Doctor Name is required!";
		} else {
			$doctor_name = mysqli_real_escape_string($dbc, $trimmed['doctor_name']);
			// check if doctor name only contains letters and whitespace 
			if (!preg_match('/^[\w .,-]+$/', $trimmed['doctor_name'])) {     
				$error["doctor_name"] = "Only letters are allowed!";
		}
	}
		if (empty($trimmed["D_id"])) {
			$error["D_id"] = "Doctor id cannot be empty!";
		} else {
			$D_id = mysqli_real_escape_string($dbc, $trimmed['D_id']);
			// check if doctor name only contains letters and whitespace 
			if (!preg_match('/^[\d]+$/', $trimmed['D_id'])) {     
				$error["D_id"] = "Only digits are allowed!";
		}
	}

		if (empty($trimmed["patient_name"])) {
			$error["patient_name"] = "Patient Name cannot be empty!";
		} else {
			$patient_name = mysqli_real_escape_string($dbc, $trimmed['patient_name']);
			// check if doctor name only contains letters and whitespace 
			if (!preg_match('/^[\w .,-]+$/', $trimmed['patient_name'])) {     
				$error["patient_name"] = "Enter valid name!";
		}
	}	
		if (empty($trimmed["pd_id"])) {
			$error["pd_id"] = "Patient id cannot be empty!";
		} else {
			$pd_id = mysqli_real_escape_string($dbc, $trimmed['pd_id']);
			// check if doctor name only contains letters and whitespace 
			if (!preg_match('/^[\d]+$/', $trimmed['pd_id'])) {     
				$error["pd_id"] = "Patient id contain digit only!";
		}
	}

		if (empty($trimmed["description"])) {
			$description = "NULL";
		} else {
			$description = mysqli_real_escape_string($dbc, $trimmed['description']);
			// check if doctor name only contains letters and whitespace 
			if (!preg_match('/^[\w .,-]+$/', $trimmed['description'])) {     
				$error["description"] = "Enter valid input!";
		}
	}

		if (empty($trimmed["status"])) {
			$error["status"] = "Select status cannot be empty!";
		} else {
			$status = mysqli_real_escape_string($dbc, $trimmed['status']);
			// check if doctor name only contains letters and whitespace 
			if (!preg_match('/^[a-zA-Z ]*$/', $trimmed['status'])) {     
				$error["status"] = "Select valid status!";
		}
	}
	
	if ($doctor_name && $D_id && $patient_name && $pd_id && $description && $status) { // If everything's OK...

		$sql = "INSERT INTO appointment (doctor_name, user_id, patient_name, pd_id, description, status, appt_date)
		VALUES ('$doctor_name', '$D_id', '$patient_name', '$pd_id', '$description', '$status', CURDATE())";
		if (mysqli_query($dbc, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		} 
	}
		mysqli_close($dbc);
	}
}

if(count($_POST)>0){
	if($_POST['type']==6){
		$bp_systolic=$_POST['bp_systolic'];
		$bp_diastolic=$_POST['bp_diastolic'];
		$pd_id=$_POST['pd_id'];
		$temperature=$_POST['temperature'];
		$pulse=$_POST['pulse'];
		$respiratory_rate=$_POST['respiratory_rate'];
		$weight=$_POST['weight'];
		$height=$_POST['height'];

		$sql = "INSERT INTO vitals (bp_systolic, bp_diastolic, pd_id, temperature, pulse, respiratory_rate, weight, height, vitals_date, vitals_time)
		VALUES ('$bp_systolic', '$bp_diastolic', '$pd_id', '$temperature', '$pulse', '$respiratory_rate', '$weight', '$height', CURDATE(), CURTIME())";
		if (mysqli_query($dbc, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		}
		mysqli_close($dbc);
	}
}

if(count($_POST)>0){
	if($_POST['type']==7){
		$symptoms_title=$_POST['symptoms_title'];
		$symptoms=$_POST['symptoms'];
		$pd_id=$_POST['pd_id'];
		
		$sql = "INSERT INTO symptoms (symptoms_title, symptoms, pd_id, symptoms_date, symptoms_time)
		VALUES ('$symptoms_title', '$symptoms', '$pd_id', CURDATE(), CURTIME())";
		if (mysqli_query($dbc, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		}
		mysqli_close($dbc);
	}
}

if(count($_POST)>0){
	if($_POST['type']==8){
		$BioChemistry=$_POST['BioChemistry'];
		$stool=$_POST['stool'];
		$blood=$_POST['blood'];
		$colonoscopy=$_POST['colonoscopy'];
		$gastroscopy=$_POST['gastroscopy'];
		$urine=$_POST['urine'];
		$xray=$_POST['xray'];
		$sonography=$_POST['sonography'];
		$ECG=$_POST['ECG'];
		$others=$_POST['others'];
		$reconsultation_advice_week=$_POST['reconsultation_advice_week'];
		$reconsultation_advice_date=$_POST['reconsultation_advice_date'];
		$provisional_diagnosis=$_POST['provisional_diagnosis'];
		$final_diagnosis=$_POST['final_diagnosis'];
		$remark=$_POST['remark'];
		$pd_id=$_POST['pd_id'];
		
		$sql = "INSERT INTO patient_diagnosis (BioChemistry, stool, 
		blood, colonoscopy, gastroscopy, urine, xray, sonography, ECG, others, reconsultation_advice_week, 
		reconsultation_advice_date, provisional_diagnosis, final_diagnosis, remark, pd_id, diagnosis_date, diagnosis_time)
		VALUES ('$BioChemistry', '$stool', 
		'$blood', '$colonoscopy', '$gastroscopy', '$urine', '$xray', '$sonography', '$ECG', '$others', '$reconsultation_advice_week', 
		'$reconsultation_advice_date', '$provisional_diagnosis', '$final_diagnosis', '$remark', '$pd_id', CURDATE( ), CURTIME())";
		if (mysqli_query($dbc, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		}
		mysqli_close($dbc);
	}
}

if(count($_POST)>0){
	if($_POST['type']==9){
		$medicine_no=$_POST['medicine_no'];
		$medicine_name=$_POST['medicine_name'];
		$Precaution=$_POST['Precaution'];
		$No_of_Doses=$_POST['No_of_Doses'];
		$pdiag_id=$_POST['pdiag_id'];
		$pd_id=$_POST['pd_id'];
		
		$sql = "INSERT INTO patient_medicine (medicine_no, medicine_name, Precaution, No_of_Doses, pdiag_id, pd_id, medicine_date, medicine_time)
		VALUES ('$medicine_no', '$medicine_name', '$Precaution', '$No_of_Doses', '$pdiag_id', '$pd_id', CURDATE(), CURTIME())";
		if (mysqli_query($dbc, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		}
		mysqli_close($dbc);
	}
}

if(count($_POST)>0){
	if($_POST['type']==10){
		$reason_for_visit=$_POST['reason_for_visit'];
		$pd_id=$_POST['pd_id'];
		
		$sql = "INSERT INTO reason_for_visits (reason_for_visit, pd_id, reason_for_visit_date, reason_for_visit_time)
		VALUES ('$reason_for_visit', '$pd_id', CURDATE(), CURTIME())";
		if (mysqli_query($dbc, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		}
		mysqli_close($dbc);
	}
}

if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM doctor_schedule WHERE sch_id=$id ";
		if (mysqli_query($dbc, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		}
		mysqli_close($dbc);
	}
}

if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM doctor_schedule WHERE sch_id in ($id) ";
		if (mysqli_query($dbc, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($dbc);
		}
		mysqli_close($dbc);
	}
}

?>