<?php

class Cart {
    

 



   public function fetchdata($con,$userid){

    

        $query = "SELECT cart.quantity,cart.cart_id , product.prod_id,product.name,product.description,product.price,product.stocks FROM cart INNER JOIN product ON cart.prod_id = product.prod_id and cart.user_id = '$userid'; ";
        $result = mysqli_query($con,$query);
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }
        


    }

    
    public static function Addcart($con,$userid,$prod_id){


 
        date_default_timezone_set('Asia/Manila');
        $datenow = date('Y-m-d H:i:s');

        $checkproduct = "Select stocks from product where prod_id = '$prod_id' ";
        $result_check = mysqli_query($con,$checkproduct);

        while($pr = mysqli_fetch_array($result_check)){
            $stocks = $pr['stocks'];
        }



        $check = "Select * from cart where prod_id ='$prod_id' and user_id ='$userid' ";
        $result = mysqli_query($con,$check);
        $count = mysqli_num_rows($result);
        if($count >=1){

            while ($row = mysqli_fetch_array($result)){
                $qty = $row['quantity'];
                $cartid = $row['cart_id'];

              
            }
           if($stocks <= $qty){

           }else {
            $totalqty = $qty + 1;
            $query = "UPDATE `cart` set `quantity` = '$totalqty' where cart_id = '$cartid' ";
            mysqli_query($con,$query);
           }
            

        }else {

        $query = "INSERT INTO `cart`(`prod_id`, `quantity`, `user_id`) VALUES ('$prod_id','1','$userid')";
        mysqli_query($con,$query);

        }
       
        

        

        
    }

    

    public function CountCart($con,$userid){

        $query = "Select * from cart where user_id = '$userid' ";
        $result = mysqli_query($con,$query);

        $count = mysqli_num_rows($result);

        if($count >=1){
            while ($row = mysqli_fetch_array($result)) {
               $qty[] = $row['quantity'];
            }
            echo array_sum($qty);
        }else {

        }
        

    }



    public function UpdateCart_Quantity($con,$qty,$id){
      
        date_default_timezone_set('Asia/Manila');
        $datenow = date('Y-m-d H:i:s');
       

        $query = "UPDATE `cart` SET `quantity` = '$qty' WHERE cart_id = '$id' ";
        mysqli_query($con,$query);  
    }


    public function Deletecart($con,$id){
       
       
        $query = "DELETE FROM `cart` WHERE cart_id = '$id' ";
        mysqli_query($con,$query);  

    }
    public function Deletecart_Outofstock($con,$id){
       
       
        $query = "DELETE FROM `cart` WHERE prod_id = '$id' ";
        mysqli_query($con,$query);  

    }


    public function Update_excidingCart($con,$id,$qty){
       
       
        $query = "UPDATE `cart` SET `quantity` = '$qty' WHERE cart_id = '$id' ";
        mysqli_query($con,$query);  

    }




    
}
