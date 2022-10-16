<div class="container">
<h5 style="  font-family: 'Syncopate', sans-serif;">My Cart</h5>
    <div class="row">
       
        <div class="col-md-8" style="height:500px;overflow-y:scroll">


        <?php 
        $token = $_SESSION['user_id'];
                          $cart = new Cart();
                          $products = new Product();
                          $fetch = $cart -> fetchdata($con,$token);
                       
                          if($fetch){
                           foreach($fetch as $row){
                                  $id = $row['prod_id'];
                                  $qty = $row['quantity'];
                                  $price = $row['price'];
                                  $total[] = $price * $qty;
                                  $itotal = $price * $qty;
                                  $stocks = $row['stocks'];
                                  $cid = $row['cart_id'];
                                

                                  $fetchphoto = $products -> Viewproduct_photo($con,$id);
                      
                                  foreach ($fetchphoto as $sp) {
                                      $photo = $sp['photo'];
                      
                                      if($photo == ''){
                                        $src = 'assets/image_assets/noimage.jpg';
                                      }else {
                                        $src = 'assets/product_images/'.$photo;
                                      }
                                  }
                                 
                            ?>

<div class="card mt-2 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                        <img src="<?php echo $src?>" alt="" class="img-thumbnail form-control" style="height:auto;width:300px;">
                        </div>
                        <div class="col-md-8">
                        
                            <div class="row">
                                <div class="col-md-6">
                                <h6 style="text-align:left">
                                    <span style="font-weight:bolder"><?php echo $row['name']?></span>
                                    <br>
                                    <span style="font-size:11px">Stocks: <?php echo $stocks?></span>
                                    <span style="letter-spacing:2px">Description</span>
                                    <br>

                                   <span style="font-size:12px"><?php echo $row['description']?></span>
                                    <br>
                                    <span style="font-size:19px"> &#8369;<?php echo number_format($row['price'])?></span>
                                    <br>
                                    <span style="font-size:13px">Subtotal : &#8369;<?php echo number_format($itotal)?></span>
                                    <br>

                                </h6> 
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    if($stocks == 0){
                                        ?>
                                <h6 class="text-danger" style="font-weight:bolder;font-size:12px;">Out of Stock <br>  <span style="font-size:11px" >Removing item <i class="fas fa-spinner fa-spin"></i></span></h6> 
                              
                                        <script>
                                            setInterval(function(){
                                                location.reload();
                                            },1000);
                                        </script>
                                
                                        <?php

                              $cart -> Deletecart_Outofstock($con,$id);
                                    }else if ($stocks < $qty){
                                        $nqty =  $qty - $stocks ;
                                       $newqty = $qty - $nqty;
                                      
                             $cart ->Update_excidingCart($con,$cid,$newqty);

                             ?>
                             <h6 class="text-success" style="font-weight:bolder;font-size:12px;">Updating <i class="fas fa-spinner fa-spin"></i> </h6> 
                           
                                     <script>
                                         setInterval(function(){
                                             location.reload();
                                         },1000);
                                     </script>
                             
                                     <?php
                                    }
                                    
                                    else {
                                     
                                        ?>
                                      
     <h6 style="font-size:14px" class="mt-3 mb-3">
                                  <button class="btn btn-light plus"  style="padding: 2px" data-id="<?php echo $row['cart_id']?>" data-stocks ="<?php echo $stocks ?>" data-qty = "<?php echo $row['quantity']?>"><i class="fas fa-plus-circle"></i></button>
                            
                                 
                                <input type="text"  style="width: 40px; text-align: center;outline: none;border:1px solid #bdbfc0;font-weight: bolder;cursor: default;" class="changeqty" data-stocks ="<?php echo $stocks ?>" name=""  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" data-id="<?php echo $row['cart_id']?>" value="<?php echo $row['quantity']?>"  >



                                <button class="btn btn-light minus" style="padding: 2px;" data-id="<?php echo $row['cart_id']?>" data-qty = "<?php echo $row['quantity']?>"><i class="fas fa-minus-circle"></i></button>

                                </h6>

                              
                                        <?php
                                    }
                                    ?>
                                   <button class="btn btn-light text-danger mt-5 removefromcart" data-id="<?php echo $row['cart_id']?>" style="font-size:13px">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
               

                </div>
            </div>


                            <?php

                           }
                          
                           ?>
        
                           <?php
                        }else {
                             ?>
                            <h6 style="text-align:center" class="mb-5">
                            <img src="https://th.bing.com/th/id/OIP.tr-g8hu0-qTz2Wzk8QDAOAHaFX?pid=ImgDet&rs=1" alt="" style="widht:300px;height:300px">
                            <br>
                            No ITEMS yet.
                     </h6>
                             <?php
                        }
                         
                         
                         ?>

        
           

        </div>
        <div class="col-md-4">
        <div class="card mt-3">
     <div class="card-body">
            <h6>
                        CHECKOUT
                        <hr>
                        Total : <span style="float:right">&#8369;<?php
                            if(isset($total)){
                                echo number_format(array_sum($total));
                            }else {
                                echo '0';
                            }
                      ?></span>  <br>
                        Delivery Fee : <span style="float:right">&#8369;<?php echo number_format('100')?></span>
            </h6>
            <br>
            <?php
             if(isset($total)){
                if(isset($_SESSION['userid'])){
                    echo '<button class="btn btn-dark form-control placeorder" style="font-size:15px">PLACE ORDER</button>';
                }else {
                    echo '<button class="btn btn-secondary form-control " style="font-size:15px" disabled>PLACE ORDER</button>
                    
                 <h6 class="text-danger mt-2" style="font-size:13px">Sign in First to Order </h6>
                   
                    '; 
                }

               
            }else {
                echo '<button class="btn btn-secondary form-control " style="font-size:15px" disabled>PLACE ORDER</button>'; 
            }
            ?>
            

     
        </div>
        </div>
        </div>

    </div>
  
</div>

<script>
$('.placeorder').click(function(){
    $(this).html('Placing Order <i class="fas fa-spinner fa-spin-pulse"></i>');
    $(this).removeClass('btn-dark').addClass('btn-success');
    $(this).attr('disabled',true);
   

    $.ajax({
              url: 'action/add.php',
              method: "POST",
              data : {placeorder : 1},
              success : function(data){
                
                setInterval(function(){
            window.location.href='?Success';
                },2000);
                     
              }
       })
    

})
$('.removefromcart').click(function(){
       var id = $(this).data('id');
       $.ajax({
              url: 'action/delete.php',
              method: "POST",
              data : {removecart : id},
              success : function(data){
              countingcart();
              cartview();
                     
              }
       })
})

$('.changeqty').keyup(function(){
    var qty = $(this).val();
    var id = $(this).data('id');
    var stocks = $(this).data('stocks');
    if(qty >= stocks){
        $('.plus').attr('disabled',true).append('<span style="font-size:11px;position:absolute" class="text-danger">Out of stock</span>');
       }else {
    $.ajax({
              url: 'action/edit.php',
              method: "POST",
              data : { updatequantity:id,src:2,qty:qty},
              success : function(data){
              countingcart();
              cartview();
                     
              }
       })
    }

});

$('.plus').click(function(){
       var id = $(this).data('id');
       var qty = $(this).data('qty');
       var stocks = $(this).data('stocks');

       if(qty >= stocks){
        $('.plus').attr('disabled',true).append('<span style="font-size:11px;position:absolute" class="text-danger">Out of stock</span>');
       }else {
        $.ajax({
              url: 'action/edit.php',
              method: "POST",
              data : { updatequantity:id,src:1,qty:qty},
              success : function(data){
              countingcart();
              cartview();
                     
              }
       })
       }
     
    
})

$('.minus').click(function(){
       var id = $(this).data('id');
       var qty = $(this).data('qty');

       $.ajax({
              url: 'action/edit.php',
              method: "POST",
              data : { updatequantity : id,src:0,qty:qty},
              success : function(data){
              countingcart();
              cartview();
                     
              }
       })
})


function countingcart() {
      $.ajax({
		 			 url : "action/view.php",
		 			 method: "POST",
		 			 data  : {countcart:1},
		 			  success : function(data){
                                           
                                        
               if(data >=1){
                $('#cartcount').html('<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">'+data+'<span class="visually-hidden"></span></span>');
               }else {
                     $('#cartcount').html('');
               }
             
		 			   }
		 			 })
    }

   
    function cartview(){
        $.ajax({
		 			 url : "action/view.php",
		 			 method: "POST",
		 			 data  : {viewcart:1},
		 			  success : function(data){
                                    $('#content').html(data);
                                  
		 			   }
		 			 })
    }

</script>