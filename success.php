<?php 
$transid = $_SESSION['order_transactionid'];
//

$order = new Order();
?>
<div class="container">
   
<h6 style="font-size:13px;font-weight:normal" class="mt-4">Please Prepare the Exact Amount if your Order Arrive. <br> </h6>
<div class="card">
    <div class="card-body">
    <div class="container">
    <table class="table table-striped table-sm mb-5 table-bordered mt-5" style="font-size:14px">
  <thead>
    <tr>
      <th scope="col">Qty</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
    
    </tr>
  </thead>
  <tbody>
      <?php 
      $fetch = $order->Receipt($con,$transid);
      if($fetch){
        foreach ($fetch as $row) { 
         $dateord = $row['date_ordered'];

           ?>
        <tr>
      <th scope="row"><?php echo $row['quantity']?></th>
      <td><?php echo $row['name']?></td>
      <td>&#8369;<?php echo number_format($row['price'])?></td>
     
    </tr>
           <?php
        }
      }else {

      }
      ?>
    
   
  </tbody>
</table>
<h6 style="font-size:13px;position:absolute;top:10px;right:10px">Date-Ordered : <?php echo date('F j,Y',strtotime($dateord))?></h6>
    </div>
    </div>
</div>



</div>