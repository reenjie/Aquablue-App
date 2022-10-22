<?php
session_start();
include '../connection/connect.php';
include_once ('../includes/Order.php');
include_once ('../includes/Sales.php');
include_once('../includes/Users.php');
$order = new Order();
$sales = new Sales();
$user = new Users();
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
<!-- <br>
<br> -->


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
        
          $fetchorder = $sales->ShowallOrdersSorted($con,$d1,$d2);
          if($fetchorder){
          
             foreach ($fetchorder as $row) {
               $tid = $row['tid'];
               $status = $row['status'];
               $uid = $row['user_id'];   


               $fetchuser = $user ->fetchuser($con,$uid);
               foreach ($fetchuser as $usern) {
                 ?>  
                 <tr colspan="5" class="table-primary"><td >
                 <h6>Order#<?php echo $row['tid']?>  </h6>
                 </td></tr>
               
                   <td  class=" text-success"><?php echo $usern['name']?> 
                   <br>
                   Date-Ordered: <?php echo date('F j,Y',strtotime($row['datecreated']))?>
                
               
                 </td>
                 
               
     
                 <?php
               }
 
              
               $fetchitems = $sales->ShowItems($con,$tid);
               if($fetchitems){
                 foreach($fetchitems as $items){
                  
                  $prodid = $items['prod_id'];

                  $fetchproduct = $order -> selectproduct($con,$prodid);
                      foreach ($fetchproduct as $pr) {
                          $qty = $items['quantity'];
                          $price = $pr['price'];
                        
                          $itotal = $price * $qty;
  
                          ?>
  
                          <tr>
                        <td></td>
                          <td><?php echo $items['quantity']?></td>
                          <td><?php echo $pr['name']?></td>
                          <td>&#8369;<?php echo number_format($pr['price'])?></td>
                          <td>&#8369;<?php echo number_format($itotal)?></td>
                          <td style="color:gray;font-weight:bold">&#8369;<?php echo number_format($itotal)?></td>
                          </tr>
                         
  
                        <?php
  
                      }

                 }



             }

            }
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
      <th scope="col">Qty</th>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
      <th scope="col">SubTotal</th>
        <th scope="col">Amount Paid</th>
    </tr>
  </thead>
  <tbody>
<!-- Today -->
<?php  
$token = '';
            $fetchorder = $sales->ShowallOrders($con,$token);
            if($fetchorder){
            
               foreach ($fetchorder as $row) {
                 $tid = $row['tid'];
                 $status = $row['status'];
                 $uid = $row['user_id'];   


                 $fetchuser = $user ->fetchuser($con,$uid);
                 foreach ($fetchuser as $usern) {
                   ?>  
                   <tr colspan="5" class="table-primary"><td >
                   <h6>Order#<?php echo $row['tid']?>  </h6>
                   </td></tr>
                 
                     <td  class=" text-success"><?php echo $usern['name']?> 
                     <br>
                     Date-Ordered: <?php echo date('F j,Y',strtotime($row['datecreated']))?>
                  
                 
                   </td>
                   
                 
       
                   <?php
                 }
   
                
                 $fetchitems = $sales->ShowItems($con,$tid);
                 if($fetchitems){
                   foreach($fetchitems as $items){
                    
                    $prodid = $items['prod_id'];

                    $fetchproduct = $order -> selectproduct($con,$prodid);
                        foreach ($fetchproduct as $pr) {
                            $qty = $items['quantity'];
                            $price = $pr['price'];
                          
                            $itotal = $price * $qty;
    
                            ?>
    
                            <tr>
                          <td></td>
                            <td><?php echo $items['quantity']?></td>
                            <td><?php echo $pr['name']?></td>
                            <td>&#8369;<?php echo number_format($pr['price'])?></td>
                            <td>&#8369;<?php echo number_format($itotal)?></td>
                            <td style="color:gray;font-weight:bold">&#8369;<?php echo number_format($itotal)?></td>
                            </tr>
                           
    
                          <?php
    
                        }

                   }



               }

              }
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



