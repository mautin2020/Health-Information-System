<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title; ?></title>
	<?php echo '<link rel="title icon" href="images/lasu logo.JPG">'; ?>
    
    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
     <!-- file input css -->
     <link rel="stylesheet" type="text/css" href="assets/fileinput/css/fileinput.min.css">

    <script src="js/ajax.js"></script>    
    <style type ="text/css">

    body {
    font-family: 'Montserrat', sans-serif;
    background-color: #eee; 
}

/* navbar */
.sidebar {
    height: 100vh;
    background:linear-gradient( rgba(39, 90, 230, 0.795), rgba(39, 90, 230, 0.795)),
    url(images/information-system.JPG);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow: 5px 7px 25px #999; 
}

.bottom-border {
    border-bottom: 1px groove #eee;
}

.tooltip-main {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  font-weight: 700;
  background: #f3f3f3;
  border: 1px solid #737373;
  color: #737373;
  margin: 4px 121px 0 5px;
  float: right;
  text-align: left !important;
}

.tooltip-qm {
  float: left;
  margin: -2px 0px 3px 4px;
  font-size: 12px;
}

.tooltip-inner {
  max-width: 236px !important;
  height: 250px;
  font-size: 12px;
  padding: 10px 15px 10px 20px;
  background: #FFFFFF;
  color: rgb(0, 0, 0, .7);
  border: 1px solid #FFFFFF;
  text-align: center;
}

.tooltip.show {
  opacity: 1;
}

.bs-tooltip-auto[x-placement^=bottom] .arrow::before,
.bs-tooltip-bottom .arrow::before {
  border-bottom-color: #f00;
  /* Red */
}

.sidebar-link {
    transition: all .4s;
}
.sidebar-link:hover{
    background-color: #444;
    border-radius: 5px;
}

.appointment-link:hover{
    background-color: #f44336;
    border-radius: 5px;
}

.current {
    background-color: #f44336;
    border-radius: 7px;
    box-shadow: 2px 5px 10px #111;
    transition: all .3s;
}

.currents {
    background-color: #f44336;
    border-radius: 7px;
}

.currents-card {
    background-color: #f48730;
    border-radius: 0px;
}

.current:hover {
    background-color: #f66436;
    border-radius: 7px;
    box-shadow: 2px 5px 20px #111;
    transform: translateY(-1px);

}

.search-input {
    background: transparent;
    border:none;
    border-radius: 0; 
    border-bottom: 2px solid #999;
    transition: all .4s
}

.search-input:focus {
    background: transparent;
    box-shadow: none;
    border-bottom: 2px solid #dc3545;

} 

.search-button {
    border-radius: 50%;
    padding: 10px 16px;
    transition: all .4s
}

.search-button:hover {
    background-color: #eee;
    transform: translateY(-1px);
}

.icon-parent {
    position: relative;
}

.icon-bullet::after {
    content: "";
    position: absolute;
    top: 7px;
    left: 15px;
    height: 12px;
    width: 12px;
    background-color: #f44336;
    border-radius: 50%;
}

.breadcrumb {
        display:inline-block;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.6);
        border-radius: 5px;

        overflow:hidden;
        counter-reset:flag;
    }

    .breadcrumb a {
        display:block;
        float:left;

        text-decoration:none;
        padding: 0 10px 0 60px;

        line-height: 36px;

        background: linear-gradient(#5bc0de, #5bc0de);
        color:white;
        position:relative;
    }

    .breadcrumb a.active, .breadcrumb a:hover {
        background: linear-gradient(#f66436, #f66436);
    }

    .breadcrumb a.active:after, .breadcrumb a:hover:after {
        background: linear-gradient(135deg,#f66436, #f66436);
    }

    .breadcrumb a:after {
        content:'';
        width:36px;
        height:36px;

        background:linear-gradient(135deg,#5bc0de, #5bc0de);


        position:absolute;
        top:0px;

        z-index:1;
        right:-18px;

        -webkit-transform: scale(0.707) rotate(45deg);
        -moz-transform: scale(0.707) rotate(45deg);
        -o-transform: scale(0.707) rotate(45deg);
        transform: scale(0.707) rotate(45deg);

        border-radius: 0 0 0 30px;

        box-shadow: 2px -2px 1px rgba(0,0,0,0.5),
        3px -2px 1px 1px rgba(255,255,255,0.6);

    }

    .breadcrumb a:last-child:after {
        content:none;
    }

    .breadcrumb a:last-child {
        padding-right:20px;
        border-radius: 0 5px 5px 0; 
    }

    .breadcrumb a:before {
        
        width: 20px;
        height:20px;

        background:#0E2F4A;
        font-weight:bold;

        position:absolute;
        top:0px;
        left:30px;

        line-height:20px;
        margin:8px 0;

        border-radius: 100%;
    }

@media (max-width: 768px) {
    .sidebar {
        position: static;
        height: auto;
    }
    .top-navbar {
        position: static
    }
}

/* end of navbar */

/* cards */
.card-common {
    box-shadow: 1px 2px 5px #999;
    transition: all 4s;
}

.card-common:hover{
    box-shadow: 2px 3px 15px #999;
    transform: translateY(-1px);
}
/* end of cards */

/* task-list */
.task-border {
    border-left: 3px solid #f66436
}
/* end of task-list */

#ab1:hover{cursor:pointer;}
.error{
    color:#f44336;
}

.container{
 margin-top: 20px;
}

.content{
 border: 1px solid black;
 padding: 5px;
 margin-bottom: 5px;
}

.content span:hover{
 cursor: pointer;
}

.tooltip-inner{
 text-align: left;
 max-width: 350px;
}


</style>
 
</head>
<body>
    <!-- navbar -->
 <nav class="navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler ml-auto mb-2 bg-light" type="button"
        data-toggle="collapse" data-target="#myNavbar">
            <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="myNavbar">
            <div class="container-fluid">
                <div class="row">
 <!-- top nav -->
 <div class="col-xl-10 col-lg-9 col-md-8 ml-auto bg-primary fixed-top py-2 top-navbar">
                  <div class="row align-items-center">
                    <div class="col-md-4">
                      <h5 class="text-light
                      text-uppercase
                      mb-2 mt-2">Health Information System</h5>
                    </div>
                    <?php
                   echo' <div class="col-md-6">';
                   if ($_SESSION['user_level'] == 1) {
                        
                    echo '<form action="admin_search.php" method="post">
                        <div class="input-group">
                          <input type="text" name="search" class="form-control search-input" 
                          placeholder="enter username">
                          <button type="submit" name="admin_search_submit" class="btn btn-light search-button">
                            <i class= "fa fa-search text-danger"></i></button>
                        </div>
                      </form> 

                    </div>
                    <div class="col-md-2">
                        <ul class="navbar-nav">';
                   }  elseif ($_SESSION['user_level'] !== 1) {
                        
                    echo '

                    </div>
                    <div class="col-md-2">
                        <ul class="navbar-nav">';
                   }
                        ?>
                  <?php 
                  if (isset($_SESSION['user_id'])) {
                     echo '<li class="nav-item ml-md-auto"><a href="logout.php"
                     class="nav-link"> <i class="fa fa-sign-out
                     text-danger fa-lg"></i></a></li>';
                     }
                     ?>
                          
                       </ul>
                       </div>
                       </div>
                       </div>
                
                <!-- end of top nav-->