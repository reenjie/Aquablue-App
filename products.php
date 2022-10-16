
<div class="container" style="" id="products">
<h5 style="  font-family: 'Syncopate', sans-serif;">Products</h5>
    <input type="text" style="font-size:14px" class="form-control searchproduct mb-2 mt-3" placeholder="Search for Product Name">
  

<div id="contents">
<div class="row">
 
    <?php
   $products = new Product();
   $fetch = $products -> fetchdata($con);

   if($fetch){
    foreach($fetch as $row){
      $pid = $row['prod_id'];
      $stock = $row['stocks'];

            $fetchphoto = $products -> Viewproduct_photo($con,$pid);

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
    <p class="card-text"><?php echo $row['description']?> <br><span style="font-size:11px">Available Stocks : <?php echo $stock?></span>  <span class="text-danger" style="font-weight:bolder;font-size:17px;float:right"> &#8369;<?php echo number_format($row['price'])?></span></p>
    
  </div>
  
  <div class="card-body">
    <?php 
    if($stock == 0){
      ?>
  <h6 class="text-danger" style="font-weight:bolder;font-size:12px;text-align:center">Out of Stock</h6>
      <?php
    }else {
      ?>
  <button class="btn btn-primary round-pill form-control addtocart" style="font-size:13px " data-id="<?php echo $row['prod_id']?>"  >Order</button>
      <?php
    }
    
    ?>
   
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
    

    
    
    
    ?>
 



</div>
</div>
</div>

<script >
  
  $(document).ready(function(){
    $('.searchproduct').keyup(function(){
      var val = $(this).val();

      $.ajax({
        url:'action/view.php',
        method:"post",
        data :{searchkey:val},
        success: function(data){
          $('#contents').html(data);

        }
      })

    })
   
    $('.addtocart').click(function(){
      var id = $(this).data('id');
      
      $(this).html('Adding ..');
     $.ajax({
		 			 url : "action/add.php",
		 			 method: "POST",
		 			 data  : {addtocart:id},
		 			  success : function(data){
              $('.addtocart').html('Order');
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