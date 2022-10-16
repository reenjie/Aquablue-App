<?php
session_start();
$token = $_SESSION['user_id'];
include '../connection/connect.php';
include '../includes/Cart.php';
include_once('../includes/Product.php') ;
include_once('../includes/Users.php') ;
$cart = new Cart();
$product = new Product();
$users = new Users();
if(isset($_POST['removecart'])){
    $id = $_POST['removecart'];

    $cart -> Deletecart($con,$id,$token);
}

if(isset($_GET['deleteproduct'])){
    $id = $_GET['deleteproduct'];
    $product ->Deleteproduct($con,$id);
    $_SESSION['save']=2;
    header('location:../admin/products.php');

}
if(isset($_GET['deleteuser'])){

    $id = $_GET['deleteuser'];
    $users->Deleteuser($con,$id);
    $_SESSION['save']=2;
    header('location:../admin/accounts.php');

}


