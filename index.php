<?php
session_start();

if(isset($_SESSION['userid'])){

}else {
    //$_SESSION['userid']

    function getClientIP() {

        if (isset($_SERVER)) {
    
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                return $_SERVER["HTTP_X_FORWARDED_FOR"];
    
            if (isset($_SERVER["HTTP_CLIENT_IP"]))
                return $_SERVER["HTTP_CLIENT_IP"];
    
            return $_SERVER["REMOTE_ADDR"];
        }
    
        if (getenv('HTTP_X_FORWARDED_FOR'))
            return getenv('HTTP_X_FORWARDED_FOR');
    
        if (getenv('HTTP_CLIENT_IP'))
            return getenv('HTTP_CLIENT_IP');
    
        return getenv('REMOTE_ADDR');
    }

    $_SESSION['user_id'] = getClientIP();
    $_SESSION['_ip'] = getClientIP();
    



}


include_once('connection/connect.php');
include_once('includes/Product.php');
include_once('includes/Cart.php');
include_once('includes/Order.php');
include_once('includes/Users.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php include_once("components/headers.php") ?>
<script src="bootstrap/js/jquery.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<body style="font-family: 'Poppins', sans-serif;">

<header>
  <h6>  <a href="?Home" style="text-decoration:none; color:white;">AquaBlue</a></h6>
</header>


<div >
<div class="row">
<div class="col-md-4">

    

<button type="button" onclick="window.location.href='?MyCart' " class="btn btn-danger position-relative mt-2 rounded-pill float-right" style="margin-left:10px;font-size:13px">
My Cart
<div id="cartcount">

</div>

</button>

<?php
 if(isset($_SESSION['userid'])){
    ?>
    <button type="button" onclick="window.location.href='?MyOrders' " class="btn btn-danger position-relative mt-2 rounded-pill ml-2" style="margin-left:10px;font-size:13px">
My Orders
<div id="ordercount">

</div>
</button> 

    <div class="card mt-2">
        <div class="card-body">
        <h6>Hi , <?php echo $_SESSION['username']?>! <span class="text-primary">ツ</span></h6>

        </div>
    </div>

    <?php
}else {
   
}

?>
<!---->


<ul class="list-group  mt-2" style="font-family: 'Poppins', sans-serif;">

<a href="?Products" ><li class="list-group-item" > Products</li></a>
<a href="?About"><li class="list-group-item"> About</li></a>


<?php 
if(isset($_GET['Register'])) {

}else {
if(isset($_SESSION['userid'])){
    ?>
<a href="?MyAccount"> <li class="list-group-item"> My Account</li></a>



    <?php
}else {
    include 'signin.php' ;
}

}


?>





</ul>


</div>

    <div class="col-md-8" id="content">
 
    <?php

if(isset($_GET['Products'])){
    include 'products.php';
}else if (isset($_GET['About'])){
    include 'about.php';
}else if(isset($_GET['Register'])) {
   include 'register.php';
}else if (isset($_GET['MyCart'])){
    include 'mycart.php';
}else if (isset($_GET['MyAccount'])){
    include 'myaccount.php';
}else if (isset($_GET['Success'])){

    if(isset($_SESSION['ordersuccess'])){
        include 'success.php';
        unset($_SESSION['ordersuccess']);
    }else {
        include 'mycart.php';
    }
   
}else if (isset($_GET['MyOrders'])){
    include 'myorders.php';
}else if (isset($_GET['Completed'])){
    include 'completed.php';
}else if (isset($_GET['Cancelled'])){
    include 'cancelled.php';
}
else {
    include 'components/carousel.php' ;
}

?>


    </div>

    <div class="col-md-4">
    <div class="card mt-2">
        <div class="card-body">
    <h6 style="font-size:14px">
        Follow us @: <br>
        <a href="facebook.com" target="_blank">www.Facebook.com/AquaBlue </a> <br>
        <a href="youtube.com" target="_blank">www.Youtube.com/AquaBlue</a>

    </h6>

        </div>
    </div>


    </div>

    <div class="col-md-4">
    <div class="card mt-2">
        <div class="card-body">
    <h6 style="font-size:14px">
       Inquiries :<br>
       TM:
       <span class="text-primary"> #09557652555</span>
       
       <br>
       Smart:
       <span class="text-primary">#09554652555</span>

    </h6>

        </div>
    </div>


    </div>

</div>

</div>

<script>
    $(document).ready(function(){
        countingcart();
    function countingcart() {
      $.ajax({
		 			 url : "action/view.php",
		 			 method: "POST",
		 			 data  : {countcart:1},
		 			  success : function(data){
                        if(data >=1){
                $('#cartcount').html('<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">'+data+'<span class="visually-hidden"></span></span>');
               }else {

               }
		 			   }
		 			 })
    }

  
    })
</script>

<footer>
    AquaBlue 2022
 </footer>

<?php include_once("components/footers.php") ?>
</body>
</html>



