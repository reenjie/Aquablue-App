<div class="container">
<h5 style="  font-family: 'Syncopate', sans-serif;">My Orders</h5>
<div class="btn-group" >
<button class="btn btn-secondary mb-2" style="font-size:13px" onclick="window.location.href='index.php?MyOrders' ">My Orders</button>


<button class="btn btn-light text-success mb-2" style="font-size:13px" onclick="window.location.href='index.php?Completed' ">Completed</button>

<button class="btn btn-light text-danger mb-2" onclick="window.location.href='index.php?Cancelled' " style="font-size:13px">Cancelled </button>
</div>

<div id="note"></div>

<h6 style=" ">Current Orders</h6>
<?php 
$token = $_SESSION['user_id'];
$order = new Order();
$users = new Users();
$fetchorder = $order -> ShowallOrders($con,$token);    
$fetchuser = $users->fetchuser($con,$token);

if($fetchorder){

    foreach ($fetchorder as $row) {
        $tid = $row['tid'];
        $status = $row['status'];
        
       foreach ($fetchuser as $user) {
          ?>    
          <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active text-light bg-info " style="font-size:13px" aria-current="page" href="#"><?php echo 'ORDER NO '.$row['tid']?></a>
  </li>
  
</ul>
<div class="card mb-2 shadow bg-light">

        
    <div class="card-body">
        <?php
        if($status == 0){
            ?>
     <button class="btn border-danger text-danger mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['tid']?>" style="font-size:13px">Cancel Order </button>
     <br>
            <?php
        }else {

        }

        

        ?>
        <span style="font-size:18;" class="text-secondary ">
                            Order Status : 
                            <?php 
                                 if($status == 0){ 
                                    ?>
      <span style="font-size:20px" class="text-danger">Pending</span>
                                    <?php

                                 }else if ($status == 1) {
                                    ?>
                                    <span style="font-size:20px" class="text-primary">Preparing Order for Delivery</span>
                                                                  <?php
                              
                                 }else if ($status == 2) {
                                    ?>
                                    <span style="font-size:20px;font-weight:bolder" class="text-success">On the Way   <i class="fas fa-bell"></i> 
                                <span style="font-size:13px">( Please Prepare exact Amount. )</span>     </span>
                                                                  <?php
                              
                                 }
                            
                            ?>
                          
                        </span>


<div class="modal fade" id="exampleModal<?php echo $row['tid']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<textarea name="" id="cancelreason<?php echo $row['tid']?>" cols="30" style="font-size:13px" rows="5" class="form-control reason"></textarea>


</div>
<div class="modal-footer">

<button type="button" style="font-size:14px" data-id="<?php echo $row['tid']?>" class="btn btn-danger cancelorder">Cancel Order</button>
</div>
</div>
</div>
</div>
<hr>
    <?php
    $fetchitems = $order ->ShowItems($con,$tid);
        foreach ($fetchitems as $item ) {
           $prodid = $item['prod_id'];

           
$fetchproduct = $order -> selectproduct($con,$prodid);
foreach ($fetchproduct as $pr) {
    $qty = $item['quantity'];
    $price = $pr['price'];
    $total[] = $price * $qty;
    $itotal = $price * $qty;
    ?>
    <div class="card ">
<div class="card-body">
<div class="row">
    <div class="col-md-3" style="border-right:1px solid grey">
        <img src="assets/image_assets/noimage.jpg" alt="" style="width:200px;height:auto" class="img-thumbnail form-control">
    </div>
    <div class="col-md-9">
        
        <h6 style="text-align:left">
                            <span style="font-weight:bolder"><?php echo $pr['name']?></span>
                            <br>
                            <span style="letter-spacing:2px">Description</span>
                            <br>

                           <span style="font-size:12px"><?php echo $pr['description']?></span>
                            <br>
                            <span style="font-size:19px"> &#8369;<?php echo number_format($pr['price'])?></span>
                            <br>
                            <span style="font-size:13px" >
                        Qty : <?php echo $item['quantity']?></span> <br>
                            <span style="font-size:13px">Subtotal : &#8369;<?php echo number_format($itotal)?></span>
                            <br>
                            <p style="user-select:none">
                                <br><br>
                            </p>
                       

                            <br>      
                   
                        </h6> 
    </div>
</div>
</div>
</div>
    <?php
}
        }

    ?>

    </div>
</div>

          <?php
       }

       
    }


}else {
    ?>
    <h6 style="text-align:center">

    <img src="https://cdn4.iconfinder.com/data/icons/programming-v-1/256/expand-BG-programming-57-512.png" alt="" style="width:400px">
    <br>
    No Orders Found..
    
    </h6>
    <?php
}

?>



</div>

<script>
    $('.cancelorder').click(function(){
        var id = $(this).data('id');
        var reason = $('#cancelreason'+id).val();

        if(reason == ''){
            $('#cancelreason'+id).addClass('is-invalid').attr('placeholder','Please Provide Reason for Cancelling!');
        }else {
           
            $.ajax({
                url: 'action/edit.php',
                method : "post",
                data : {cancelorder:id,reason:reason},
                success : function (data){
                 $('#note').html('<div class="alert alert-success" role="alert">Order Cancelled Successfully!</div>');
                 $('#exampleModal'+id).modal('hide');
                 setInterval(() => {
                     location.reload();
                 }, 2000);
                }
            })

        }
    })
    $('.reason').keyup(function(){
        $(this).removeClass('is-invalid').removeAttr('placeholder');
    })
</script>