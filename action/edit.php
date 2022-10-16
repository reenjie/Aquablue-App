<?php
session_start();
$token = $_SESSION['user_id'];
include '../connection/connect.php';
include '../includes/Cart.php';
include '../includes/Users.php';
include '../includes/Order.php';
include_once('../includes/Product.php') ;
$order = new Order();
$cart = new Cart();
$user = new Users();
$product = new Product();

if(isset($_POST['updatequantity'])){
    $id = $_POST['updatequantity'];
    $qty = $_POST['qty'];
    $src = $_POST['src'];



    if($src == 1){
        //increase
        
        $total = $qty + 1;
        $cart ->UpdateCart_Quantity($con,$total,$id);


    }else if($src == 2) {
    //update
    if($qty == 0){
        $cart ->Deletecart($con,$id);
    }else {
        $cart ->UpdateCart_Quantity($con,$qty,$id);
    }
   
    }else {
        //decrease
        $total = $qty - 1;
        if($total <= 0){
            $cart ->Deletecart($con,$id);
        }else {
            $cart ->UpdateCart_Quantity($con,$total,$id);
        }
        
    }
}

if(isset($_POST['update_user_account'])){
  

    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $pass = $_POST['password'];
     
    $_SESSION['username'] = $name;
                $image_name = $_FILES['photo']['name'];
                $tmp_name   = $_FILES['photo']['tmp_name'];
                $size       = $_FILES['photo']['size'];
                $type       = $_FILES['photo']['type'];
                $error      = $_FILES['photo']['error'];
                                                                                                                                    
                $fileName =basename($_FILES['photo']['name']);
        
   
	
	$uploads_dir = '../assets/image_assets';
	move_uploaded_file($tmp_name , $uploads_dir .'/'.$fileName);

  
        $user->Updateuser($con,$name,$email,$number,$pass,$address,$fileName,$token);
    
    $_SESSION['success'] = 1;
    ?>
        <script>
                window.history.back();
        </script>
    <?php

   


}

if(isset($_POST['cancelorder'])){
    $id = $_POST['cancelorder'];
    $reason = $_POST['reason'];
    $_SESSION['save'] = 1;

   
    $order->Cancel_Order($con,$id,$reason);
}

if(isset($_POST['updateproduct'])){
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];

    $image_name = $_FILES['photo']['name'];
    $tmp_name   = $_FILES['photo']['tmp_name'];
    $size       = $_FILES['photo']['size'];
    $type       = $_FILES['photo']['type'];
    $error      = $_FILES['photo']['error'];
                                                                                                                        
    $fileName =basename($_FILES['photo']['name']);



$uploads_dir = '../assets/product_images';
move_uploaded_file($tmp_name , $uploads_dir .'/'.$fileName);

    $product ->Updateproduct($con,$name,$desc,$price,$id,$fileName,$stocks);
    $_SESSION['save'] = 1;
    header('location:../admin/products.php');
    
}

if(isset($_POST['updateuser'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pass = $_POST['pass'];
    $fileName = '';
    $token = $_POST['token'];

    $user->Updateuser($con,$name,$email,$pass,$address,$fileName,$token);

    $_SESSION['save'] = 1;
    header('location:../admin/accounts.php');


}
if(isset($_POST['changestatus'])){
    $stat = $_POST['changestatus'];
    $id = $_POST['id'];
    $order->ChangeStatus($con,$id,$stat);

    $_SESSION['save'] = 1;
}