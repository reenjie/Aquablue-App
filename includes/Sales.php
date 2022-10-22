<?php
session_start();


class Sales {

    public function Today($con) {
        
        
        date_default_timezone_set('Asia/Manila'); 
        $datenow = date('Y-m-d');
              $getorders = " select * from trans_record where date_ordered = '$datenow' and transaction_id in (select tid from transaction where status ='3')  ";
                          $gettingor = mysqli_query($con,$getorders); 
                          $countorders= mysqli_num_rows($gettingor);
                         //  $get_id =  mysqli_insert_id($con); 
                       if ($countorders>=1){
                      
                           while($row = mysqli_fetch_array($gettingor)){
                            $user = $row['user_id'];
                            $pid = $row['prod_id'];
                            $qty = $row['quantity'];
                            $query = "Select * from product where prod_id = '$pid' ";
                         
                            $result12 = mysqli_query($con,$query);
                            while($total = mysqli_fetch_array($result12)){
                             $price = $total['price'];
                              
                           
                            }
                            $totals = $qty * $price;
                                               
                          ?>
                           <tr>
                           <tr ><td colspan="5">
                    <h6>Order#  </h6>
                    </td></tr>
                        <th scope="row"></th>
                        <td><?php echo date('F j,Y',strtotime($row['date_ordered'])) ?></td>
                        <td><?php
                            $gettingusername = " select * from accounts where user_id = '$user'  ";
                                        $guser = mysqli_query($con,$gettingusername); 
                                      
                                    
                                         while($ue = mysqli_fetch_array($guser)){
                                          echo $ue['name'];
                                         }
                                  
                         ?></td>
                        <td>
                          <?php 
                              $gettingproduct = " select * from product where prod_id = '$pid' ";
                            $gprod = mysqli_query($con,$gettingproduct); 
                                       
                                      
                                           while($pp = mysqli_fetch_array($gprod)){
                                            echo $pp['name'];
                                           }
                                    
                           ?>
                        </td>
                        <td><?php echo $row['quantity'] ?></td>
                           
                         <td>₱<?php echo number_format($totals) ?></td>
                      </tr>
    
                      <tr>
    
                          <?php
                           }
    
                           ?>
    
                             
                              
                         
                           <?php
                    }else {
                      ?>
    
                      <tr>
                        <td colspan="7"> <h6 style="text-align: center;font-weight: bolder;">No orders yet..</h6></td>
                      </tr>
    
                      <?php
                    }
    
        
       
    }


    public function ShowallOrders($con,$userid){
        date_default_timezone_set('Asia/Manila'); 
        $datenow = date('Y-m-d');
      
        if($userid == ''){
        
          $get_data = "select * from  transaction where  status = 3 and date(datecreated)='$datenow'";
        }else {
          $get_data = "select * from  transaction where user_id = '$userid' and status =3  ";
        }
         
          
          $result = mysqli_query($con,$get_data);
          
          if($result -> num_rows > 0){
              return $result;
          }else {
              return false;
          }
  
  
  
      }

      public function ShowallOrdersSorted($con,$d1,$d2){
        
       
          $get_data = "SELECT * FROM `transaction` WHERE  tid in (select transaction_id from `trans_record` where  date_ordered BETWEEN '$d1' AND '$d2' ) and status = 3; ";
       
         
          
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
    


}

