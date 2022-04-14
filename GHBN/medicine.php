<?php 
// Doctor Schedule

$page_title = 'Medicine List';
include('../Gincludes/header.php');
include('../Gincludes/mhead2.php');
include('../Gincludes/sidebar.php');
?>

<div class="container-fluid">
      <div class="row ml-2 mr-2">
      <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
          
      <div class="row pt-md-5 mt-md-3 mb-5">

        <div class="col-xl-12 p-2">
            
        <div class ="breadcrumb">

        <a href="medicine.php" class="active"><h6><i class="fa fa-bars text-light mr-3"></i>Medicine List</h6></a>
        <a href="add_medicine.php"><h6><i class="fa fa-plus-square text-light mr-3"></i>Add Medicine</h6></a>
        <a href="dispatched_medicinelist.php"><h6><i class="fa fa-bars text-light mr-3"></i>Dispatched Medicine List</h6></a>
        <a href="dispatch_medicine.php"><h6><i class="fa fa-plus-square text-light mr-3"></i>Dispatch Medicine</h6></a>
</div>

                <script type="text/javascript">
                $(document).on('click', 'a', function(){
                $(this).addClass('active').siblings().removeClass('active')
                });
                </script>

</div>                       
</div>
</div>

<?php
include('../Gincludes/footer.php');
include('../Gincludes/mfoot.php');

?>