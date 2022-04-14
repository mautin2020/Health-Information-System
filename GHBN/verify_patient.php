<?php
// This is the patient registration page for the site.
include('../Gincludes/header.php');
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
}

$page_title = 'Verify Patient';

include('../Gincludes/mhead.php');
include('../Gincludes/sidebar.php');
?>

<script defer src="face-api.min.js"></script>
<script defer src="script.js"></script>

<style>
    body {
        display: flex;
        flex-direction: column
    }

    #myImg {
        width: 350px;
        height: 350px;
    }

    .mycontainer {
        margin-top: 5%;
        position: relative;
    }

    .mycontainer2 {
        position: relative;
        justify-content: center;
        align-items: center;
        display: flex;
        flex-direction: column
    }

    canvas {
        position: absolute;
        top: 0;
        left: 0;
    }
</style>

<!-- <script type="text/javascript" src="assets/jquery/jquery.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->

<section>
    <div class="container-fluid">
        <div class="row ml-2 mr-2">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">

                <div class="row pt-md-5 mt-md-3 mb-5">

                    <div class="col-xl-12 p-2">

                        <div class="card mb-3">
                            <div class="card-header bg-info">
                                <i class="fa fa-camera text-light fa-lg mr-3"> Facial Recognition
                                    <br> <br></i>
                            </div>
                        </div>

                        <div class="mycontainer2">
                            <div class="mycontainer">
                                <img src="" id='myImg'>
                            </div>
                            <br />
                            <input type="file" id="myFile" onchange="uploadImage()" accept=".jpg,.jpeg,.png">
                        </div>
                    </div>
                </div>
</section>



<?php include('../Gincludes/footers.php');
include('../Gincludes/footer.php');
