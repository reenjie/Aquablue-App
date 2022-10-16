<?php

class Product {

   public function  fetchdata($con){

        $query = "Select * from product";
        $result = mysqli_query($con,$query);
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }
        


    }

    public function selectproduct($con,$prodid){

        $query = "Select * from product where prod_id = '$prodid' ";
        $result = mysqli_query($con,$query);
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }
        


    }

    public function searchproduct($con,$key){

        $query = "Select * from product where name like '%$key%' ";
        $result = mysqli_query($con,$query);
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }
        


    }


    
    public function Addproduct($con,$name,$desc,$price,$photo,$stocks){
      
        date_default_timezone_set('Asia/Manila');
        $datenow = date('Y-m-d H:i:s');

        $query = "INSERT INTO `product`(`name`, `description`, `price`, `datecreated`,`photo`,`stocks`) VALUES ('$name','$desc','$price','$datenow','$photo','$stocks')";
        mysqli_query($con,$query);

      
        
    }



    public function Updateproduct($con,$name,$desc,$price,$id,$photo,$stocks){
      
       
        if($photo == ''){
            $query = "UPDATE `product` SET `name`='$name',`description`='$desc',`price`='$price',`stocks` = '$stocks' WHERE prod_id = '$id' ";
            mysqli_query($con,$query);  
        }else {
            $query = "UPDATE `product` SET `name`='$name',`description`='$desc',`price`='$price' ,`photo`= '$photo' ,`stocks` = '$stocks' WHERE prod_id = '$id' ";
            mysqli_query($con,$query);  
        }

      
    }


    public function Deleteproduct($con,$id){
      
       
       
        $query = "DELETE FROM `product` WHERE prod_id = '$id' ";
        mysqli_query($con,$query);  

        $deletecart = "DELETE FROM `cart` WHERE prod_id ='$id' ";
        mysqli_query($con,$deletecart);  


    }


    public function Viewproduct_photo($con,$prodid){
      
       
        $query = "Select photo from product where prod_id = '$prodid' ";
        $result = mysqli_query($con,$query);

        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }
        
    }




    
}
