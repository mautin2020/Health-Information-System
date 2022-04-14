<?php
// Doctor Schedule

$page_title = 'Medicine List';
include('../Gincludes/header.php');
include('../Gincludes/mhead2.php');
include('../Gincludes/sidebar.php');

if(isset($_POST['submit'])){
    $nameArr = $_POST['name'];
    $emailArr = $_POST['email'];
    if(!empty($nameArr)){
        for($i = 0; $i < count($nameArr); $i++){
            if(!empty($nameArr[$i])){
                $name = $nameArr[$i];
                $email = $emailArr[$i];

                $sql = "INSERT INTO multiple (name, email) VALUES ('$nameArr[$i]', '$emailArr[$i]')";
                if (mysqli_query($dbc, $sql)) {
                    echo '<script type="text/javascript">
                    alert("Data inserted successfully");
                    window.open("submit.php","_self")
                    </script>';
                }
            }
        }
    }
}
?>

<section>

<div class="container-fluid">
      <div class="row ml-2 mr-2">
      <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">

      <div class="row pt-md-5 mt-md-3 mb-5">

        <div class="col-xl-12 p-2">
    <form method="post" action="submit.php">

    <div class="form-group fieldGroup">
        <div class="input-group">
            <input type="text" name="name[]" class="form-control" placeholder="Enter name"/>
            <input type="text" name="email[]" class="form-control" placeholder="Enter email"/>
            <div class="input-group-addon">
                <a href="javascript:void(0)" class="btn btn-success addMore"><span><i class="fa fa-plus text-light"></i></span> Add</a>
            </div>
        </div>
    </div>

    <input type="submit" name="submit" class="btn btn-primary" value="SUBMIT"/>

</form>

<!-- copy of input fields group -->
<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
        <input type="text" name="name[]" class="form-control" placeholder="Enter name"/>
        <input type="text" name="email[]" class="form-control" placeholder="Enter email"/>
        <div class="input-group-addon">
            <a href="javascript:void(0)" class="btn btn-danger remove"><span><i class="fa fa fa-trash text-light mr-3"></i></span> Remove</a>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){
    //group add limit
    var maxGroup = 10;

    //add more fields group
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });

    //remove fields group
    $("body").on("click",".remove",function(){
        $(this).parents(".fieldGroup").remove();
    });
});

</script>
