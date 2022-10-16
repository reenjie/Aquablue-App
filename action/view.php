<?php
session_start();
$token = $_SESSION['user_id'];
include '../connection/connect.php';
include '../includes/Cart.php';
include '../includes/Product.php';
$cart = new Cart();
$product = new Product();


if(isset($_POST['countcart'])){
    $cart -> CountCart($con,$token);
}

if(isset($_POST['viewcart'])){
    include '../mycart.php';
   
}
if(isset($_POST['searchkey'])){
    $val = $_POST['searchkey'];
    $fetch = $product -> searchproduct($con,$val);

echo '<div class="row">';
  

  if($fetch){
   foreach($fetch as $row){
     $pid = $row['prod_id'];

           $fetchphoto = $product -> Viewproduct_photo($con,$pid);

           foreach ($fetchphoto as $sp) {
               $photo = $sp['photo'];

               if($photo == ''){
                 $src = 'assets/image_assets/noimage.jpg';
               }else {
                 $src = 'assets/product_images/'.$photo;
               }
           }


     ?>
    
   <div class="col-md-4 mt-2 mb-2">
   <div class="card shadow" >
 <img src="<?php echo $src?>" style="height:300px" class="card-img-top" alt="...">
 <div class="card-body"  style="height:120px;overflow-y:scroll" id="det">
   <h6 class="card-title"><?php echo $row['name']?></h6>
   <p class="card-text"><?php echo $row['description']?> <br>  <span class="text-danger" style="font-weight:bolder;font-size:17px;float:right"> &#8369;<?php echo number_format($row['price'])?></span></p>
   
 </div>
 
 <div class="card-body">
  <button class="btn btn-primary round-pill form-control addtocart" style="font-size:13px " data-id="<?php echo $row['prod_id']?>"  >Order</button>
 </div>
</div>
   </div>
         
  
   
   
     <?php

   }
  }else {
     ?>
 <h6 style="text-align:center"> 
   <img src="https://th.bing.com/th/id/OIP.gbM6SEVrF-9ikGH_2KvtywFJC9?pid=ImgDet&rs=1" alt="">
 </h6>
     <?php
  }
   echo '</div>';
?>
  <script >

$(document).ready(function(){
 /* $('.searchproduct').keyup(function(){
    var val = $(this).val();

    $.ajax({
      url:'action/view.php',
      method:"post",
      data :{searchkey:val},
      success: function(data){
        $('#contents').html(data);

      }
    })

  }) */
 
  $('.addtocart').click(function(){
    var id = $(this).data('id');
 
   $.ajax({
          url : "action/add.php",
          method: "POST",
          data  : {addtocart:id},
           success : function(data){
          
            countingcart();
            }
          })
   

  });


 function countingcart() {
    $.ajax({
          url : "action/view.php",
          method: "POST",
          data  : {countcart:1},
           success : function(data){
             if(data >=1){
              $('#cartcount').html('<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">'+data+'<span class="visually-hidden"></span></span>');
             }else {

             }
           
            }
          })
  }


});
</script>

<?php
}