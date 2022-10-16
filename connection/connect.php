<?php

$servername='localhost';
$username='root';
$password='';
$dbname='ecom';

if($con = mysqli_connect($servername, $username, $password,$dbname)){
   //CONNECTED
   
}else {
    echo $con -> connect_error();
}
