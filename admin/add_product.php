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

<nav class="navbar bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="#" style=" font-family: 'Syncopate', sans-serif;font-weight:bold">
      <img src="../assets/image_assets/AquaBlue.jpeg" alt="" width="30" height="24" class="d-inline-block align-text-top">
      AquaBlue
    </a>
  </div>
  <a href="myaccount.php" id="myacc" >Account</a>
</nav>

<?php include 'components/sidebar.php'; ?>
 
  <section class="main">
    
  <button class="btn btn-light text-dark" id="slideleft" style="font-size: 10px;"><i class="fas fa-bars"></i></button>

<button class="btn btn-light text-dark d-none" id="slideright" style="font-size: 10px;"><i class="fas fa-bars"></i></button>

      <div class="main_contents">
         <div class="container " >
            
         
            <a href="products.php" class="btn btn-light text-dark border-dark" style="font-size:13px">Back to Products</a>
            <br>

            <form action="../action/add.php" method="post" enctype="multipart/form-data">
                <div class="container">
               
                    <div class="card mt-3 shadow">
                        <div class="card-body">
                        <h5 style="font-weight: bolder;">ADD-PRODUCT</h5>
                      
                            <div class="row">
                              
                                <div class="col-md-8">

                            <h6 style="font-size:14px">
                           
                            Name
                    <input type="text" class="form-control mb-2" style="font-size:13px" name="name" required>

                    Description
                    
                    <textarea name="description" class="form-control mb-2" style="font-size:13px;resize:none" id="" cols="30" rows="5" required></textarea>

                   Price
                    <input type="text" class="form-control mb-2" style="font-size:13px" name="price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>

                   Stocks
                   <input type="text" class="form-control mb-2" style="font-size:13px" name="stocks" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required >
                            </h6>

                                </div>
                                <div class="col-md-3">

                                <h6 style="text-align:center" class="mb-5">
                                <img src="../assets/image_assets/noimage.jpg" alt="" class="img-thumbnail form-control" >
                                <br>
                                <input type="file" name="photo" style="font-size:13px" accept="image/*" class="form-control">
                                </h6>




                                </div>
                            </div>
                           
                          <div class="btn-group" style="float:right">
                       
                         <a href="products.php" class="btn btn-light text-danger border-dark" style="font-size:14px;margin:right:5px">Cancel</a>
                         <button type="submit" name="addnewproduct" class="btn btn-secondary" style="font-size:14px;">Add</button>
                         </div>
                        </div>
                    </div>
                    

                </div>
                </form>

        
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
})


 </script>
<?php include_once("../components/footers.php") ?>

</body>
</html>



