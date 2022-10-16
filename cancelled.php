<div class="container">
<h5 style="  font-family: 'Syncopate', sans-serif;">My Orders</h5>
<div class="btn-group" >
<button class="btn btn-light text-secondary mb-2" style="font-size:13px" onclick="window.location.href='index.php?MyOrders' ">My Orders</button>


<button class="btn btn-light text-success mb-2" style="font-size:13px" onclick="window.location.href='index.php?Completed' ">Completed</button>

<button class="btn btn-danger mb-2" onclick="window.location.href='index.php?Cancelled' " style="font-size:13px">Cancelled </button>
</div>

<h6 style=" " class="text-danger">Cancelled Orders</h6>
<?php 
$token = $_SESSION['user_id'];
$order = new Order();
$users = new Users();
$fetchorder = $order -> ShowOrders($con,$token,'4');    
$fetchuser = $users->fetchuser($con,$token);

if($fetchorder){

    foreach ($fetchorder as $row) {
        $tid = $row['tid'];
        $reason = $row['reason'];
       foreach ($fetchuser as $user) {
          ?>    
          <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active text-light bg-danger " style="font-size:13px" aria-current="page" href="#"><?php echo 'ORDER NO '.$row['tid']?></a>
  </li>
  
</ul>
<div class="card mb-2 shadow bg-light">


    <div class="card-body">
    <span style="font-size:18" class="text-secondary ">
                            Order Status : 

                            <span style="font-size:20px" class="text-danger">Cancelled</span>
                        </span>
    <div class="card border-danger mb-2">
        <div class="card-body">
            <h6 style="font-size:14px">Reason for Cancelling : 
                <br>
            <?php echo $reason?>
            </h6>
        </div>
    </div>
   

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
    <div class="card  ">
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