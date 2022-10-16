<?php
include_once('Product.php');
class Order extends Product {

    public function PlaceOrder($con,$userid){
        date_default_timezone_set('Asia/Manila');
        $datenow = date('Y-m-d H:i:s');

        $create_transaction = "INSERT INTO `transaction`( `user_id`, `datecreated`, `status`) VALUES ('$userid','$datenow','0')";
        if(mysqli_query($con,$create_transaction)){
            $transid = mysqli_insert_id($con);

            $_SESSION['order_transactionid'] = $transid; 

            $allcart = "select * from cart where user_id = '$userid' ";
            $result = mysqli_query($con,$allcart);

            while($row = mysqli_fetch_array($result)){
                $prodid = $row['prod_id'];
                $qty = $row['quantity'];
                $cartid = $row['cart_id'];

                $trans = "INSERT INTO `trans_record`(`prod_id`, `transaction_id`, `quantity`, `date_ordered`,`user_id`) VALUES ('$prodid','$transid','$qty','$datenow','$userid')";
                mysqli_query($con,$trans);

                $getproductstock = "select stocks from product where prod_id = '$prodid' ";
                $r = mysqli_query($con,$getproductstock);
                while($s = mysqli_fetch_array($r)){
                    $oldstk = $s['stocks'];
                }
                $newstock =$oldstk - $qty;

                $update_stock = "UPDATE `product` SET`stocks`='$newstock' WHERE prod_id = '$prodid' ";
                mysqli_query($con,$update_stock);
                  
                

             


            }

        }

        $delete_cart = "DELETE FROM `cart` WHERE  user_id='$userid' ";
        mysqli_query($con,$delete_cart);
        //
    }


    public function Receipt($con,$transid){

        
        $get_data = "SELECT trans_record.prod_id,trans_record.quantity,trans_record.date_ordered,product.name,product.price FROM `trans_record` INNER join `product` on product.prod_id = trans_record.prod_id and transaction_id = '$transid'; ";
        $result = mysqli_query($con,$get_data);
        
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }

    }


    public function ShowOrders($con,$userid,$status){

        
        if($userid == ''){
            $get_data = "select * from  transaction where status='$status';";
        }else {
            $get_data = "select * from  transaction where user_id = '$userid' and status='$status';";
        }
        $result = mysqli_query($con,$get_data);
        
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }



    }

    
    public function ShowallOrders($con,$userid){
      
      if($userid == ''){
        $get_data = "select * from  transaction where  status in (0,1,2) ";
      }else {
        $get_data = "select * from  transaction where user_id = '$userid' and status in (0,1,2) ";
      }
       
        
        $result = mysqli_query($con,$get_data);
        
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }



    }

    public function ShowItems($con,$transid){

        $get_data = "select * from trans_record where transaction_id = '$transid' ";
        $result = mysqli_query($con,$get_data);
        
        if($result -> num_rows > 0){
            return $result;
        }else {
            return false;
        }



    }

    public function Cancel_Order($con,$transid,$reason){

        $cancelquery = "UPDATE `transaction` SET `status`='4',`reason`='$reason' WHERE tid = '$transid' ";
        mysqli_query($con,$cancelquery);

    }

    public function ChangeStatus($con,$id,$status){

        $query = "UPDATE `transaction` SET `status`='$status' WHERE tid = '$id' ";
        mysqli_query($con,$query);
    }

   
    public function Overallsales($con){

     $query  = "SELECT trans_record.quantity,product.price,transaction.status FROM `trans_record` inner join product on trans_record.prod_id = product.prod_id inner join transaction on trans_record.transaction_id = transaction.tid and transaction.status = '3';";
     $result = mysqli_query($con,$query);
        while ($row= mysqli_fetch_array($result)){
            $qty = $row['quantity'];
            $price = $row['price'];
            $total[] = $price * $qty;
        }

        if(isset($total)){
            echo array_sum($total);
          
        }else {
            echo '0';
        }
       
     


    }

  

}