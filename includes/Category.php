<?php

class Category {
 
   public function fetchdata(){

        include 'connection/connect.php';

        $query = "Select * from category";
        $result = mysqli_query($con,$query);
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }
        


    }

    
    public function Addcategory($name){
        include 'connection/connect.php';
        date_default_timezone_set('Asia/Manila');
        $datenow = date('Y-m-d H:i:s');
       
        $query = "INSERT INTO `category`(`category_name`, `datecreated`) VALUES ('$name','$datenow')";
        mysqli_query($con,$query);
        
    }



    public function Updatecategory($name,$id){
        include 'connection/connect.php';
        date_default_timezone_set('Asia/Manila');
        $datenow = date('Y-m-d H:i:s');
       
        $query = "UPDATE `category` SET `category_name`='$name' WHERE cat_id = '$id' ";
        mysqli_query($con,$query);  
    }


    public function Deletecategory($id){
        include 'connection/connect.php';
       
       
        $query = "DELETE FROM `category` WHERE cat_id = '$id' ";
        mysqli_query($con,$query);  

    }




    
}
