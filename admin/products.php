<?php
session_start();
include_once('../includes/Product.php');
include '../connection/connect.php';
$product = new Product();
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
           <br>
          <br>
          <h5 style="font-weight: bolder;">PRODUCTS</h5>
          <?php
          if(isset( $_SESSION['save'])){
              if( $_SESSION['save'] ==  1){
                echo '<div class="alert alert-success alert-dismissable"  data-bs-dismiss="alert" role="alert" style="font-size:13px">
                Product Updated Successfully!
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
          <button class="btn btn-dark mb-3 mt-4" onclick="window.location.href='add_product.php' " style="font-size:13px">Add</button>
      <div class="table-responsive">
          <table class="table table-bordered table-sm table-striped " style="font-size:13px" id="mytable">
  <thead>
    <tr>
    <th scope="col">Action</th>
      <th scope="col">No</th>
      <th scope="col">Photo</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Stocks</th>
    </tr>
  </thead>
  <tbody >
    <?php
    $fetchproduct = $product->fetchdata($con);

    if($fetchproduct){
        foreach ($fetchproduct as $row) {
          $pid = $row['prod_id'];

            $fetchphoto = $product -> Viewproduct_photo($con,$pid);

            foreach ($fetchphoto as $sp) {
                $photo = $sp['photo'];

                if($photo == ''){
                  $src = '../assets/image_assets/noimage.jpg';
                }else {
                  $src = '../assets/product_images/'.$photo;
                }
            }

          ?>
           <tr>
      <td>
        <div class="btn-group">
          <button class="btn btn-light text-primary" onclick="window.location.href='edit_product.php?edit&id=<?php echo $row['prod_id']?>' " style="font-size:13px"><i class="fas fa-edit"></i></button>

          <button class="btn btn-light text-danger" style="font-size:13px;"><i class="fas fa-trash" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $pid?>"></i></button>

      


<div class="modal fade" id="exampleModal<?php echo $pid?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-danger" id="exampleModalLabel">Confirm Delete</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
   
      <h6 style="font-size:14px">Please type "DELETE" to confirm.</h6>
     
      <input type="text" class="form-control inkey" style="text-transform:uppercase;font-size:14px" data-id="<?php echo $pid?>" >

      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>
        
        </div>
      </td>
      <td><?php echo $row['prod_id']?></td>
      <td>
            <img src="<?php echo $src?>" alt="" style="width:100px;height:100px">

      </td>
      <td><?php echo $row['name']?></td>
      <td><?php echo $row['description']?></td>
      <td>&#8369;<?php echo number_format($row['price'])?></td>
      <td><?php echo $row['stocks']?></td>
    </tr>

          <?php
        }

    }

    ?>
   
   
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



