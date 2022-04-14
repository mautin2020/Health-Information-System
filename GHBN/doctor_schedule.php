<?php 
// Doctor Schedule


$page_title = 'Doctor Schedule';
include('../Gincludes/header.php');
include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');
$error = array(
	"todo" => "",
	"last_name" => "",
	"username" => "",
	"email" => "",
	"password1" => "",
	"top" => "",
	"success" => ""
);	

if ((isset($_POST['time']))) {
    $todo=$_POST['time'];
    $month=$_POST['hour'];
    $day=$_POST['minutes'];
    $year=$_POST['seconds'];
    $time_value="$hour:$minutes:$seconds";
    echo "mm/dd/yyyy format :$date_value<br>";
    $date_value="$year-$month-$dt";
    echo "YYYY-mm-dd format :$date_value<br>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
		
	// Need the database connection:
	
	// Trim all the incoming data:
	
	$trimmed = array_map('trim', $_POST);
	// Assume invalid values:
	$todon = $stotime = $ctotime = $se = $dn = FALSE;

    // Check for a registration number:
    if (!isset($trimmed['todo']) && $trimmed['todo'] ="") {
        $error["todo"] = "Please choose schedule date!";
    } else {
        $todon = mysqli_real_escape_string($dbc, $trimmed['todo']);
   }
}

?>
        <section>
        <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
              <div class="col-xl-12 col-12 mb-4 pt-5 mt-5 mb-xl-0">
                      <h3 class="text-primary mb-4">Doctor's Schedule</h3>
                  
                        <div class="card">
                          <div class="card-header">
                            <div class="col-sm-lg-xl-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add Schedule</span></a> 
                        <a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a>
                        </div>
</div>

<div class="card-body">
    <div>
    <div class="container">
	<p id="success"></p>
        <div class="table-responsive">
            
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr class="bg-info">
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th class="text-light">#</th>
                        <th class="text-light">Date</th>
                        <th class="text-light">Section</th>
                        <th class="text-light">Dr. Name</th>
                        <th class="text-light">Start Time</th>
                        <th class="text-light">Close Time</th>
                        <th class="text-light">D_id</th>
                        <th class="text-light">Action</th>
                    </tr>
                </thead>
				<tbody>
				
                <?php
                
                $query = "SELECT DATE_FORMAT(sch_date, '%b %d, %Y') AS sch_date, section, doctor_name, TIME_FORMAT(start_time, '%l:%i %p') AS start_time, TIME_FORMAT(end_time, '%l:%i %p') AS end_time, sch_id, user_id AS D_id FROM doctor_schedule ORDER BY sch_date";
                $result = @mysqli_query($dbc, $query);
					$i=1;
					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				?>
				<tr id="<?php echo $row["sch_id"]; ?>">
				<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["sch_id"]; ?>">
								<label for="checkbox2"></label>
							</span>
						</td>
					<td><?php echo $i; ?></td>
					<td><?php echo $row["sch_date"]; ?></td>
					<td><?php echo $row["section"]; ?></td>
                    <td><?php echo $row["doctor_name"]; ?></td>
                    <td><?php echo $row["start_time"]; ?></td>
                    <td><?php echo $row["end_time"]; ?></td>
                    <td><?php echo $row["D_id"]; ?></td>
					<td>
						<a href="#editEmployeeModal" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $row["sch_id"]; ?>"
							data-sch_date="<?php echo $row["sch_date"]; ?>"
							data-section="<?php echo $row["section"]; ?>"
                            data-doctor_name="<?php echo $row["doctor_name"]; ?>"
                            data-start_time="<?php echo $row["start_time"]; ?>"
                            data-end_time="<?php echo $row["end_time"]; ?>"
                            data-D_id="<?php echo $row["D_id"]; ?>"
							title="Edit"></i>
						</a>
						<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["sch_id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete"></i></a>
                    </td>
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
			
        </div>
        </div>
        </div>
        </div>
        </div>
    
            </div>
            </div>
            </div>
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form">
					<div class="modal-header bg-warning">						
						<h4 class="modal-title text-light">Add Schedule</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Date</label>
                            <input type="date" id="sch_date" name="sch_date" class="form-control" required data-parsley-pattern="/^(\d{4})-(\d{1,2})-(\d{1,2})/" data-parsley-trigger="keyup" />
                    	</div>
						<div class="form-group">
							<label>Section</label>
							<select name="section" id="section" class="form-control" required />
                                <option></option>
                                <option value="ANC">ANC</option>
                                <option value="Casualty">Casualty</option>
                                <option value="Gynae Clinic">Gynae Clinic</option>
                                <option value="Heart-to-Heart">Heart-to-Heart</option>
                                <option value="G.O.P.D">G.O.P.D</option>
                                <option value="Orthopedic">Orthopedic</option>
                                <option value="Peadiatric">Peadiatric</option>
                                <option value="Physiotherapy">Physiotherapy</option>
                                <option value="SOPD">SOPD</option>
            </select>
                                                    
                        </div>
                        <?php
						echo '<div class="form-group">
							<label>Doctor Name</label>
							<select name="doctor_name" id="doctor_name" class="form-control" required="">
                                <option></option>';
                                $user_id = $_SESSION['user_id'];
                                    $q = "SELECT CONCAT(first_name, ' ', last_name, ' ', user_id) AS doctor_name FROM users WHERE user_level=2";
                                    $r = @mysqli_query($dbc, $q); // Run the query.
                                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
                                    {
                                      echo '<option value = "'.$row['doctor_name'].'">'.$row['doctor_name'].'</option>';
                                    } 
                                    echo '</select>';
                                    echo '</div>';
                        
                            echo '<div class="form-group">
							<label>Doctor Id</label>
							<select name="D_id" id="D_id" class="form-control" required="">
                                <option>select the number in front of doctor name</option>';
                                $user_id = $_SESSION['user_id'];
                                    $q = "SELECT user_id FROM users WHERE user_level=2";
                                    $r = @mysqli_query($dbc, $q); // Run the query.
                                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
                                    {
                                      echo '<option value = "'.$row['user_id'].'">'.$row['user_id'].'</option>';
                                    } 
                                    echo '</select>';
                                    echo '</div>';
                        ?>
						<div class="form-group">
							<label>Start Time</label>
							<input type="time" id="start_time" name="start_time" class="form-control" required data-parsley-pattern="/^\d{1,2}:\d{2}([ap]m)?$/" data-parsley-trigger="keyup" />
                        </div>

                        <div class="form-group">
							<label>End time</label>
							<input type="time" id="end_time" name="end_time" class="form-control" required data-parsley-pattern="/^\d{1,2}:\d{2}([ap]m)?$/" data-parsley-trigger="keyup" />
                        </div>
                        
                        
					</div>
					<div class="modal-footer bg-warning">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add">Add</button>
					</div>
                </form>

			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header bg-warning">						
						<h4 class="modal-title text-light">Edit Schedule</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Date</label>
							<input type="date" id="sch_date_u" name="sch_date" class="form-control" required>
                        </div>
						<div class="form-group">
							<label>Section</label>
							<select name="section" id="section_u" class="form-control" required>
                                <option></option>
                                <option value="ANC">ANC</option>
                                <option value="Casualty">Casualty</option>
                                <option value="Gynae Clinic">Gynae Clinic</option>
                                <option value="Heart-to-Heart">Heart-to-Heart</option>
                                <option value="G.O.P.D">G.O.P.D</option>
                                <option value="Orthopedic">Orthopedic</option>
                                <option value="Peadiatric">Peadiatric</option>
                                <option value="Physiotherapy">Physiotherapy</option>
                                <option value="SOPD">SOPD</option>
            </select>
                    	</div>
                        <?php
						echo '<div class="form-group">
							<label>Doctor Name</label>
							<select name="doctor_name" id="doctor_name_u" class="form-control" required>
                                <option></option>';
                                $user_id = $_SESSION['user_id'];
                                $q = "SELECT CONCAT(first_name, ' ', last_name, ' ', user_id) AS doctor_name FROM users WHERE user_level=2";
                                    $r = @mysqli_query($dbc, $q); // Run the query.
                                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
                                    {
                                      echo '<option value = "'.$row['doctor_name'].'">'.$row['doctor_name'].'</option>';
                                    } 
                                    echo '</select>';
                                    echo '</div>';
                        
                        echo '<div class="form-group">
							<label>Doctor Id</label>
							<select name="D_id" id="D_id_u" class="form-control" required="">
                                <option></option>';
                                $user_id = $_SESSION['user_id'];
                                    $q = "SELECT user_id FROM users AS D_id WHERE user_level=2";
                                    $r = @mysqli_query($dbc, $q); // Run the query.
                                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
                                    {
                                      echo '<option value = "'.$row['user_id'].'">'.$row['user_id'].'</option>';
                                    } 
                                    echo '</select>';
                                    echo '</div>';
                        ?>
						<div class="form-group">
							<label>Start Time</label>
                            <input type="time" id="start_time_u" name="start_time" class="form-control" required>
                              </div>
                        <div class="form-group">
							<label>End Time</label>
                            <input type="time" id="end_time_u" name="end_time" class="form-control" required>
                        </div>					
					</div>
					<div class="modal-footer bg-warning">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info btn-sm" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete Schedule</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Schedule?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>




<?php

include('../Gincludes/footer.php');
include('../Gincludes/mfoot.php');

?>