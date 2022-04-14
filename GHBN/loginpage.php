<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
<style type="text/css">
#ab1:hover{cursor:pointer;}
.error{
    color:#f44336;
}
</style>
<body style="background:url('images/doctor1.jpg') no-repeat; background-size:cover; height:100vh">
<div class ="container" style="width:400px;margin-top:100px">
<div class ="card">
<img src="images/2.jpg" class="card-img-top">
    <form class="form-group" action="login.php" method="post">
    <div><br/>
   <p class = "error">

    </p>
    <div style="float:right; margin: 0px 20px 0px 0px;">
    <a href="register.php" class="btn btn-outline-primary"><i class="fa fa-sigin-in text-light fa-sm mr-3"></i>Sign up here</a></div></div>   
    <div class="card-body">
    <label>Email Address :</label><br>
        <input type="email" name="email" class="form-control" placeholder="email"><br>
        
        <label>Password :</label><br>
        <input type="password" name="pass" class="form-control" placeholder="enter password"><br>
        <input type="submit" name="submit" id="ab1" value="Login" class="btn btn-primary">
        <span style="float:right; margin: 0px 10px 0px 0px;"><a href="forgot_password.php"> Forgot Password?</a></span>
</form>

</div>
</div> 
</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</body>
</html>