<?php
session_start();
include_once('../includes/Product.php');
include_once('../includes/Users.php');
include_once('../includes/Order.php');
include '../connection/connect.php';
$product = new Product();
$order = new Order();
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
<br>
<br>


<?php include 'components/sidebar.php'; ?>
 
  <section class="main">
    
  <button class="btn btn-light text-dark" id="slideleft" style="font-size: 10px;position:fixed;top:60px"><i class="fas fa-bars"></i></button>

<button class="btn btn-light text-dark d-none" id="slideright" style="font-size: 10px;position:fixed;top:60px"><i class="fas fa-bars"></i></button>
      <div class="main_contents">
         <div class="container " >
          <br><br>
          <h5 style="font-weight: bolder;">ORDERS</h5>
          <?php
          if(isset( $_SESSION['save'])){
              if( $_SESSION['save'] ==  1){
                echo '<div class="alert alert-success alert-dismissable"  data-bs-dismiss="alert" role="alert" style="font-size:13px">
                Status Changed Successfully!
                <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              }else if( $_SESSION['save'] == 2){
                echo '<div class="alert alert-success alert-dismissable"  data-bs-dismiss="alert" role="alert" style="font-size:13px">
                Product Deleted Successfully!
                <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              }else if( $_SESSION['save'] == 3){
                echo '<div class="alert alert-success alert-dismissable"  data-bs-dismiss="alert" role="alert" style="font-size:13px">
                Product Added Successfully!
                <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              }
         
            unset( $_SESSION['save']);
          }
          
          ?>
        <div class="btn-group" >
<button class="btn btn-light text-secondary mb-2" style="font-size:13px" onclick="window.location.href='orders.php' ">My Orders</button>


<button class="btn btn-light text-success mb-2" style="font-size:13px" onclick="window.location.href='completed.php' ">Completed</button>

<button class="btn btn-danger mb-2" onclick="window.location.href='cancelled.php' " style="font-size:13px">Cancelled </button>
</div>
      <div class="table-responsive">
          <table class="table table-bordered  table-sm table-striped " style="font-size:13px" id="mytable">
  <thead>
    <tr class="table-danger">
    <th scope="col">Action</th>
      <th scope="col">Qty</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Subtotal</th>
      
    </tr>
  </thead>
  <tbody >
          <?php
         
          
          $token='';
          $fetchorder = $order->ShowOrders($con,$token,'4');
       if($fetchorder){

       
          foreach ($fetchorder as $row) {
            $tid = $row['tid'];
            $status = $row['status'];
            $uid = $row['user_id'];   
            
            $fetchuser = $user ->fetchuser($con,$uid);
            if($fetchuser){

            
              foreach ($fetchuser as $usern) {
                ?>  
                <tr class="table-danger"><td colspan="5"></td></tr>
                <tr class="bg-light">
                  <td colspan="3" class=" text-danger"><?php echo $usern['name']?>
                  <br>
                  Date-Ordered: <?php echo date('F j,Y',strtotime($row['datecreated']))?>
                  <br>
                  <?php
                  if($status == 0){
                    ?>
    <button class="btn btn-success mt-3 confirm" style='font-size:14px' data-id ='<?php echo $tid?>' >Confirm</button>
                <button class="btn btn-danger mt-3 cancel" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $tid?>" style='font-size:14px' data-id ='<?php echo $tid?>'>Cancel</button>

                <div class="modal fade" id="exampleModal<?php echo $tid?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" id="exampleModalLabel">Cancelling Order</h6>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

     <h6 style="font-size:14px">
        Reason :
     </h6>
<textarea name="" id="cancelreason<?php echo $tid?>" cols="30" style="font-size:13px" rows="5" class="form-control reason"></textarea>


</div>
<div class="modal-footer">

<button type="button" style="font-size:14px" data-id="<?php echo $tid?>" class="btn btn-danger cancelorder">Cancel Order</button>
</div>
</div>
</div>
</div>
                    <?php
                  }else if ($status == 1){
                    ?>
                    <button class="btn btn-primary mt-3 otw" style='font-size:14px;' data-id ='<?php echo $tid?>' >On the Way</button> 
                    <?php
                  }else if ($status == 2){
                    ?>
                    <button class="btn btn-light text-success mt-3 markcomplete" style='font-size:14px;' data-id ='<?php echo $tid?>' >Mark as Complete <i class="fas fa-info-circle"></i></button> 
                    <?php
                  }
                  ?>
              
                </td>
                <td colspan="2">
                  <h6>
                      <div class="card border-danger">
                          <div class="card-body">
                  <h6 style="font-size:13px">Reason for Cancelling : <?php echo $row['reason']?></h6>
                          </div>
                      </div>
                  </h6>
                </td>
                
                </tr>
    
                <?php
              }

            }else {
              
            }

          

              $fetchitems = $order->ShowItems($con,$tid);
            if($fetchitems){
              foreach($fetchitems as $items){
                $prodid = $items['prod_id'];

                $fetchproduct = $order -> selectproduct($con,$prodid);
                    foreach ($fetchproduct as $pr) {
                        $qty = $items['quantity'];
                        $price = $pr['price'];
                        $total[] = $price * $qty;
                        $itotal = $price * $qty;

                        ?>

                        <tr>
                      <td></td>
                        <td><?php echo $items['quantity']?></td>
                        <td><?php echo $pr['name']?></td>
                        <td>&#8369;<?php echo number_format($pr['price'])?></td>
                        <td>&#8369;<?php echo number_format($itotal)?></td>
                        </tr>
                       

                      <?php

                    }

              }


            }
            
        
            
        }
      }else {
       ?>
      <tr>
        <td colspan="5">
        <h6 style="text-align:center">
        No Orders Found
        </h6>
        </td>
      </tr>
       <?php
      }
              
          
          
          ?>
    <tr class="table-danger"><td colspan="5"></td></tr>
  </tbody>
</table>
</div>
       
    


        
        </div> 



      </div> 


       <div class="footer shadow">
         
       </div> 
       
      
     
     
     

  </section>





<footer>
    AquaBlue 2022
 </footer>
 
 <script src="../bootstrap/js/jquery.js?v=1"></script>
<link rel="stylesheet" href="../DataTables/datatables.css">
<script src="../DataTables/datatables.js"></script>
<script src="../bootstrap/js/popper.js?v=1"></script>
<script src="../bootstrap/js/sidebar.js"></script>
<script>
  $('.confirm').click(function(){
 var id = $(this).data('id');

 $.ajax({
   url: '../action/edit.php',
   method: "post",
   data :{changestatus:1,id:id},
   success : function(data){

    location.reload();

   }
 })
 

})
$('.otw').click(function(){
 var id = $(this).data('id');

 $.ajax({
   url: '../action/edit.php',
   method: "post",
   data :{changestatus:2,id:id},
   success : function(data){

    location.reload();

   }
 })
 

})
$('.markcomplete').click(function(){
 var id = $(this).data('id');

 $.ajax({
   url: '../action/edit.php',
   method: "post",
   data :{changestatus:3,id:id},
   success : function(data){

    location.reload();

   }
 })
 

})

/*$('.cancel').click(function(){
 var id = $(this).data('id');

 $.ajax({
   url: '../action/edit.php',
   method: "post",
   data :{changestatus:4,id:id},
   success : function(data){

    location.reload();

   }
 })
 

}) */

$('.cancelorder').click(function(){
        var id = $(this).data('id');
        var reason = $('#cancelreason'+id).val();

        if(reason == ''){
            $('#cancelreason'+id).addClass('is-invalid').attr('placeholder','Please Provide Reason for Cancelling!');
        }else {
           
            $.ajax({
                url: '../action/edit.php',
                method : "post",
                data : {cancelorder:id,reason:reason},
                success : function (data){
               
                 $('#exampleModal'+id).modal('hide');
                 location.reload();
                
                }
            })

        }
    })




$(document).ready(function(){

  let table = new DataTable('#mytable', {
      
      "search": {
     "caseInsensitive": false
   }
 
 });
$('.inkey').keyup(function(){
  var val = $(this).val();
  var id = $(this).data('id');

  if(val == 'DELETE' || val =='delete'){
   window.location.href='../action/delete.php?deleteproduct='+id;
  }


})





});


 </script>
<?php include_once("../components/footers.php") ?>

</body>
</html>



