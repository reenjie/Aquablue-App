<?php
session_start();
include 'connection/connect.php';


if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $check = " Select * from accounts where email = '$email' and password ='$pass' ";
    $result = mysqli_query($con,$check);
    $count = mysqli_num_rows($result);
    if($count >=1){
        $_SESSION['userid'] = 1;
        while($row = mysqli_fetch_array($result)){
            $usertype = $row['user_type'];

            if($usertype == 'admin'){
                $_SESSION['admin_login'] = 1 ;
            
                $_SESSION['admin_id'] = $row['user_id'];
                header('location:admin/');
            }else {
                $_SESSION['user_id'] = $row['user_id'];
                $id = $row['user_id'];
                $_SESSION['username'] = $row['name'];
                
        $userip = $_SESSION['_ip'];

        $getcartitems = "select * from cart where user_id ='$userip' ";
        $getcart = mysqli_query($con,$getcartitems);
        $countingcarts = mysqli_num_rows($getcart);
        if($countingcarts >=1){
            while($row = mysqli_fetch_array($getcart)){
              $cartid = $row['cart_id'];

              $givetouser = "UPDATE `cart` set `user_id` = '$id' where cart_id = '$cartid'  ";
              mysqli_query($con,$givetouser);

    
            }

        }
        header('location:index.php?MyCart');
               
            }
           
        }

        

      
    }else {
        $_SESSION['credentialsnotmatch']= 1;
        ?>
    <script>
        window.history.back();
    </script>
        <?php
    }

}


if(isset($_GET['logged'])){
    $email = $_SESSION['usermail'];
    $pass = $_SESSION['userpass'];

    $check = " Select * from accounts where email = '$email' and password ='$pass' ";
    $result = mysqli_query($con,$check);
    $count = mysqli_num_rows($result);
    if($count >=1){
        $_SESSION['userid'] = 1;
        while($row = mysqli_fetch_array($result)){
            $_SESSION['user_id'] = $row['user_id'];
            $id = $row['user_id'];
            $_SESSION['username'] = $row['name'];
        }

        $userip = $_SESSION['_ip'];

        $getcartitems = "select * from cart where user_id ='$userip' ";
        $getcart = mysqli_query($con,$getcartitems);
        $countingcarts = mysqli_num_rows($getcart);
        if($countingcarts >=1){
            while($row = mysqli_fetch_array($getcart)){
              $cartid = $row['cart_id'];

              $givetouser = "UPDATE `cart` set `user_id` = '$id' where cart_id = '$cartid'  ";
              mysqli_query($con,$givetouser);

    
            }

        }
        

        header('location:index.php?MyCart');
    }



}