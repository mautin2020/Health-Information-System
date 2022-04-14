<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title; ?></title>
	<link rel="title icon" href="images/lasu logo.jpg">
    
    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapiz.com/css?family=Montserrat" rel="stylesheet">
    <style type ="text/css">
    body {
    font-family: 'Montserrat', sans-serif;
    background-color: #eee; 
}

/* navbar */
.sidebar {
    height: 100vh;
    background:linear-gradient( rgba(39, 90, 230, 0.795), rgba(39, 90, 230, 0.795)),
    url(images/information-system.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow: 5px 7px 25px #999; 
}

.bottom-border {
    border-bottom: 1px groove #eee;
}

.sidebar-link {
    transition: all .4s;
}
.sidebar-link:hover{
    background-color: #444;
    border-radius: 5px;
}

.current {
    background-color: #f44336;
    border-radius: 7px;
    box-shadow: 2px 5px 10px #111;
    transition: all .3s;
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
                      mb-2 mt-2">Hospital Management System</h5>
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
                   }  elseif ($_SESSION['user_level'] == 6) {
                        
                    echo '<form action="patient_search.php" method="post">
                        <div class="input-group">
                          <input type="text" name="search" class="form-control search-input" 
                          placeholder="enter patient registration no">
                          <button type="submit" name="patient_search_submit" class="btn btn-light search-button">
                            <i class= "fa fa-search text-danger"></i></button>
                        </div>
                      </form> 

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