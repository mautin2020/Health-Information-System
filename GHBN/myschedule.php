<?php # settings.php 
// This page is for setting a use record. 
// This page is accessed through index.php. 

$page_title = 'My Schedule';
include('../Gincludes/header.php');
include('../Gincludes/headers.php');
include('../Gincludes/sidebar.php');

?>
<div class="row mb-5">
</div>
      <div class="container-fluid">
        <div class="row">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
          <div class="row align-items-center pt-3 mt-5 mb-5">
            <div class="col-xl-12">
              <div class="card ml-5 mt-5 pt-3 pl-3">           
                <div class="card-body">
                <h5 class="text-primary"><?php echo date("F", strtotime('m')); ?> Schedule</h5>
                        </div>
                        <div class="table-wrapper">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr class="bg-info">
                
                                <th class="text-light">#</th>
                                <th class="text-light">Date</th>
                                <th class="text-light">Section</th>
                                <th class="text-light">Start Time</th>
                                <th class="text-light">Close Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        <?php 
                        
                        $query = "SELECT DATE_FORMAT(sch_date, '%b %d, %Y') AS sch_date, section, TIME_FORMAT(start_time, '%l:%i %p') AS start_time, TIME_FORMAT(end_time, '%l:%i %p') AS end_time, sch_id FROM doctor_schedule WHERE user_id = ($_SESSION[user_id])";
                        $result = @mysqli_query($dbc, $query);
                        $i=1;
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>   
                    <tr id="<?php echo $row["sch_id"]; ?>">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["sch_date"]; ?></td>
                        <td><?php echo $row["section"]; ?></td>
                        <td><?php echo $row["start_time"]; ?></td>
                        <td><?php echo $row["end_time"]; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    mysqli_close($dbc);
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

<?php include('../Gincludes/footers.php'); ?>
<?php include('../Gincludes/footer.php') ?>