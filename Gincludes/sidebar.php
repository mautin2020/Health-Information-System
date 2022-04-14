
                <!-- sidebar -->
                <div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
                  <a href="#" class="navbar-brand text-white d-block mx-auto text-center py-1 mb-1
                  bottom-border"><img src="images/lasu logo.png" width="45" class="mr-1">LASU-eHEALTH</a>
                  <div class="bottom-border pb-1">

                  <?php
                  require('config.inc.php');
                  require(MYSQL);
                  $user_id = $_SESSION['user_id'];
                  $q = "SELECT image FROM users WHERE user_id=$user_id";
                  $query = $dbc->query($q);
                  while ($result = $query->fetch_assoc()) {
                  $image = substr($result['image'], 3);
  
                  echo "
                  <img src='".$image."' width='50px' class='rounded-circle'>";
                  }
                  
                  ?> 

                    
                  
                  <?php  
                  if ($_SESSION['user_level'] == 2) {
                   echo '<span class="text-light">Dr.';
                    if (isset($_SESSION['first_name'])) {
                    echo " {$_SESSION['first_name']}";
                    echo '</span> ';
                }
                


                }   else if ($_SESSION['user_level'] !== 2) {
                      echo '<span class="text-light">';
                      if (isset($_SESSION['first_name'])) {
                        echo " {$_SESSION['first_name']}";
                    }
                    echo '</span> ';
           }
                           
                ?>
                  </div>
                                            
                 <?php   
                    echo '<ul class="navbar-nav flex-column mt-1">';
                    if (isset($_SESSION['user_id'])) {
                        ?>
                        
                        <li class="nav-item <?php if($page_title=='General Hospital Badagry!'){echo'current';}?>"><a href="index.php" class="nav-link text-white p-3 mb-2 <?php if($page_title!=='General Hospital Badagry!'){echo'sidebar-link';}?>"><i class="fa fa-home
                        text-light fa-lg mr-3"></i>Dashboard</a></li>
                       
                        <li class="nav-item <?php if($page_title=='User Settings'){echo'current';}?>"><a href="settings.php?user_id=' . $_SESSION['user_id'] . '" title="Settings" class="nav-link text-white p-3 mb-2 <?php if($page_title!=='User Settings'){echo'sidebar-link';}?>"><i class="fa fa-wrench
                        text-light fa-lg mr-3"></i>Settings</a></li>
                        
                        <?php
                        if ($_SESSION['user_level'] == 1) {
                       echo '<li class="nav-item"><a href="doctor_list.php" title="Doctor List" title="doctor\'s list" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fa fa-stethoscope
                        text-light fa-lg mr-3"></i>Doctor List</a></li>';

                        echo '<li class="nav-item"><a href="nurses_list.php" title="Nurses List"class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fa fa-user-md
                        text-light fa-lg mr-3"></i>Nurses List</a></li>';

                        echo '<li class="nav-item"><a href="pharmacist_list.php" title="Pharmacist List" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fa fa-plus-square
                        text-light fa-lg mr-3"></i>Pharmacist List</a></li>';

                        echo '<li class="nav-item"><a href="accounts_list.php" title="Accounts List" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fa fa-money
                        text-light fa-lg mr-3"></i>Accounts List</a></li>';

                        echo '<li class="nav-item"><a href="records_list.php" title="Records List" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fa fa-book
                        text-light fa-lg mr-3"></i>Records List</a></li>';

                        echo '<li class="nav-item"><a href="lab_list.php" title="Lab List" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fa fa-user-plus
                        text-light fa-lg mr-3"></i>Lab Technician</a></li>';

                        echo '<li class="nav-item"><a href="manage_users.php" title="Manage Users" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fa fa-group
                        text-light fa-lg mr-3"></i>Manage Users</a></li>';


                        '</ul>';


                } elseif ($_SESSION['user_level'] == 2){
                    echo '<ul class="navbar-nav flex-column mt-1">';
                    ?>

                    <li class="nav-item <?php if($page_title=='My Schedule'){echo'current';}?>"><a href="myschedule.php" title="My Schedule" class="nav-link text-white p-3 mb-2 <?php if($page_title!=='My Schedule'){echo'sidebar-link';}?>"><i class="fa fa-calendar
                    text-light fa-lg mr-3"></i>My Schedule</a></li>

                    <li class="nav-item <?php if($page_title=='New Schedule'){echo'current';}?>"><a href="doctor_schedule.php" title="Create Schedule" class="nav-link text-white p-3 mb-2 <?php if($page_title!=='New Schedule'){echo'sidebar-link';}?>"><i class="fa fa-calendar-check-o
                    text-light fa-lg mr-3"></i>New Schedule</a></li>

                    <li class="nav-item <?php if($page_title=='Patient List'){echo'current';}?>"><a href="patient_list.php" title="Patient List" class="nav-link text-white p-3 mb-2 <?php if($page_title!=='Patient List'){echo'sidebar-link';}?>"><i class="fa fa-wheelchair
                    text-light fa-lg mr-3"></i>Patient List</a></li>

                    <li class="nav-item <?php if($page_title=='Verify Patient'){echo'current';}?>"><a href="verify_patient.php" title="Verify Patient" class="nav-link text-white p-3 mb-2 <?php if($page_title!=='Patient List'){echo'sidebar-link';}?>"><i class="fa fa-camera
                    text-light fa-lg mr-3"></i>Verify Patient</a></li>

                    <li class="nav-item <?php if($page_title=='Appointments'){echo'current';}?>"><a href="create_appointment.php" title="Appointment" class="nav-link text-white p-3 mb-2 <?php if($page_title!=='Patient List'){echo'sidebar-link';}?>"><i class="fa fa-calendar
                    text-light fa-lg mr-3"></i>Appointment</a></li>
<?php
                    echo '</ul>';
                    
                } 

                elseif ($_SESSION['user_level'] == 6){
                    echo '<ul class="navbar-nav flex-column mt-1">';
                    echo '<li class="nav-item"><a href="pat_reg.php" title="Patient Registration" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fa fa-user
                    text-light fa-lg mr-3"></i>View Appointments</a></li>';
                    echo '</ul>';
                    
                } 
            }
                  ?>
                  </nav>
                </div>
              
                <!-- end of sidebar -->