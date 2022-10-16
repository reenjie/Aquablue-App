<?php
session_start();
include '../connection/connect.php';
include_once ('../includes/Order.php');
$order = new Order();
?>
<!DOCTYPE html>
<html lang="en">

<?php $admin=1; include_once("../components/headers.php") ?>
<body>

<nav class="navbar bg-secondary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="#" style=" font-family: 'Syncopate', sans-serif;font-weight:bold">
      <img src="../assets/image_assets/AquaBlue.jpeg" alt="" width="30" height="24" class="d-inline-block align-text-top">
      AquaBlue
    </a>
  </div>
  <a href="myaccount.php" id="myacc" >Account</a>
</nav>
<br>
<br>


<?php include 'components/sidebar.php'; ?>
 
  <section class="main">
    
  <button class="btn btn-light text-dark" id="slideleft" style="font-size: 10px;position:fixed;top:60px"><i class="fas fa-bars"></i></button>

<button class="btn btn-light text-dark d-none" id="slideright" style="font-size: 10px;position:fixed;top:60px"><i class="fas fa-bars"></i></button>

      <div class="main_contents">
        <br><br>
         <div class="container">
         
          <h5 style="font-weight: bolder;">SALES</h5>
    

          <div class="container">

          <div class="row">

          <div class="col-md-4">
            <div class="card shadow">
              <div class="card-body">
              <h1 style="font-weight:bold;font-size:50px;text-decoration:underline">
            &#8369;<?php 
            
            $order->Overallsales($con);
            ?>
          </h1>
              </div>
            </div>
           
            
          </div>
          <div class="col-md-8">
            <?php include 'etc.php'?>
          </div>


          <div class="col-md-12">
            
          <div class="card shadow-sm mt-3">
               <div class="card-body">
                      
                      <div class="container">
                           <div class="row">
                              <div class="col-md-2"></div> 
                                <div class="col-md-8">
                                    
                                    <div class="row">
                                       <div class="col-sm-5"><input type="date" id="d1" name="" class="form-control"></div> 
                                        <div class="col-sm-1">To</div> 
                                        
                                       <div class="col-sm-5"> <input type="date" id="d2" name="" class="form-control"></div> 
                                       
                                    </div> 
                                    


                                </div> 
                                  <div class="col-md-2"></div> 
                              
                           </div> 
                           


                      </div> 
                      
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
              <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script type="text/javascript">
                           
                      $(document).ready(function() {
                            $('#d2').change(function() { 
                              var d1 = $('#d1').val();
                              var d2 = $(this).val();

                              if(d1 == ''){
                               Swal.fire(
                            'Invalid Selection',
                            'Please fill all fields on filtering',
                            'error'
                          )
                              } else {

                                  window.location.href='sales.php?sort&d1='+d1+'&d2='+d2;


                              }     
                            })       
                         });         
                                 
                         </script>         



               </div> 
               
            </div> 

             <div class="card shadow-sm mt-3">
                <div class="card-body">
                    
                   <div class="container">

<?php 
  if(isset($_GET['sort'])){
    $d1 = $_GET['d1'];
    $d2 = $_GET['d2'];
      ?>
            <h6 style="font-weight: bolder;" id="defaultsort"> Sorting from <?php echo date('F j, Y',strtotime($d1))  ?> to <?php echo date('F j, Y',strtotime($d2))  ?> </h6>

             <div class="table-responsive"> 
             
                     <table class="table">
  <thead>
    <tr>
      <th scope="col">Order_no</th>
      <th scope="col">Date-Ordered</th>
      <th scope="col">Name</th>
      <th scope="col">Product</th>
       <th scope="col">Qty</th>
      
        <th scope="col">Amount Paid</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    date_default_timezone_set('Asia/Manila'); 
    $datenow = date('Y-m-d');
          $getorders = " select * from trans_record where  date_ordered BETWEEN '$d1' AND '$d2' and  transaction_id in (select tid from transaction where status ='3') ";
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
                    <th scope="row"><?php echo ''.$row['order_id'] ?></th>
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
                      
                     <td>₱<?php echo number_format($totals)?></td>
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

     ?>
   
      
      
   
  </tbody>
</table>
</div>
      <?php
  }else {
    ?>
          <h6 id="defaultsort"> As of today <?php echo date('F j, Y') ?></h6>

           <div class="table-responsive">
           
                     <table class="table">
  <thead>
    <tr>
      <th scope="col">Order_no</th>
      <th scope="col">Date-Ordered</th>
      <th scope="col">Name</th>
      <th scope="col">Product</th>
       <th scope="col">Qty</th>
      
        <th scope="col">Amount Paid</th>
    </tr>
  </thead>
  <tbody>
    <?php 
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
                    <th scope="row"><?php echo ''.$row['order_id'] ?></th>
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

     ?>
   
      
      
   
  </tbody>
</table>
</div> 
    <?php
  }


 ?>
              
                   </div> 
                   

                </div> 
                
             </div>
          </div>
          </div>

          </div>

       
    


        
        </div> 



      </div> 


       <div class="footer shadow">
         
       </div> 
       
      
     
     
     

  </section>





<footer>
    AquaBlue 2022
 </footer>
 

<script src="../bootstrap/js/jquery.js"></script>
<script src="../bootstrap/js/popper.js?v=1"></script>
<script src="../bootstrap/js/sidebar.js"></script>

<?php include_once("../components/footers.php") ?>

</body>
</html>



