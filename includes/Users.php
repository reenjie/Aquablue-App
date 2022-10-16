<?php

class Users  {
 
   public function fetchdata($con){

      
        $query = "Select * from accounts where user_type ='user' ";
        $result = mysqli_query($con,$query);
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }
        


    }

    public function fetchuser($con,$token){


        $query = "Select * from accounts where user_id = '$token' ";
        $result = mysqli_query($con,$query);
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }
        



    }

    public function CheckUser($con,$email){

        $query = "Select * from accounts where email= '$email' ";
        $result = mysqli_query($con,$query);
        $count = mysqli_num_rows($result);
        
      return $count;
        
    }
    
    public function Adduser($con,$name,$email,$number,$pass,$delivery_address){
      
        date_default_timezone_set('Asia/Manila');
        $datenow = date('Y-m-d H:i:s');
       
        $query = "INSERT INTO `accounts`(`name`, `email`,`mobile` ,`user_type`, `date_registered`, `password`, `address`) 
        VALUES ('$name','$email','$number','user','$datenow','$pass','$delivery_address')";
        mysqli_query($con,$query);
        
    }



    public function Updateuser($con,$name,$email,$number,$pass,$delivery_address,$photo,$id){
        
        date_default_timezone_set('Asia/Manila');
        $datenow = date('Y-m-d H:i:s');
        
        if($photo == ''){
            $query = "UPDATE `accounts` SET `name`='$name',`email`='$email',`password`='$pass',
            `address`='$delivery_address',`mobile`='$number' WHERE user_id = '$id' ";
    mysqli_query($con,$query);  
        }else {
            $query = "UPDATE `accounts` SET `name`='$name',`email`='$email',`password`='$pass',`photo`='$photo',
            `address`='$delivery_address',`mobile`='$number' WHERE user_id = '$id' ";
    mysqli_query($con,$query);  
        }

       
    }


    public function Deleteuser($con,$id){
      
        $query = "DELETE FROM `accounts` WHERE user_id = '$id' ";
        mysqli_query($con,$query);  
        $delete = "DELETE FROM `cart` WHERE user_id = '$id' ";
        mysqli_query($con,$delete);  

    }




    
}
