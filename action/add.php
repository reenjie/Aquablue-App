<?php
session_start();
if(isset($_SESSION['user_id'])){
    $token = $_SESSION['user_id'];
}

include '../connection/connect.php';
include '../includes/Cart.php';
include '../includes/Users.php';
include '../includes/Order.php';
include_once('../includes/Product.php') ;
$cart = new Cart();
$user = new Users();
$order = new Order();
$product = new Product();

if(isset($_POST['addtocart'])){
    $id = $_POST['addtocart'];

    Cart::Addcart($con,$token,$id);
    $cart -> CountCart($con,$token);
}
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $pass = $_POST['password'];
    $repass = $_POST['repassword'];

    if($pass != $repass){
        $_SESSION['notmatch'] = 1;
        ?>
    <script>window.history.back()</script>
        <?php
    }else  {
       $count = $user->CheckUser($con,$email);

       if($count >=1){
        $_SESSION['alreadyexist'] = 1;
        ?>
        <script>window.history.back()</script>
            <?php
       }else {
         $user->Adduser($con,$name,$email,$number,$pass,$address);
         $_SESSION['registered'] = 1;
         ?>
         <script>window.location.href='../index.php?Register'; </script>
             <?php

             $_SESSION['usermail'] = $email;
             $_SESSION['userpass'] = $pass;
       }

    }
}

if(isset($_POST['placeorder'])){
    $_SESSION['ordersuccess'] = 1;

    $order ->PlaceOrder($con,$token);

}

if(isset($_POST['addnewproduct'])){
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

    $product ->Addproduct($con,$name,$desc,$price,$fileName,$stocks);
    $_SESSION['save'] = 3;
    header('location:../admin/products.php');
}