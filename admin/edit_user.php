<?php
session_start();

include_once('../includes/Users.php');
include '../connection/connect.php';
$users = new Users();
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
            
         
            <a href="accounts.php" class="btn btn-light text-dark border-dark mb-2" style="font-size:13px">Back to Accounts</a>
            <br>

            <?php
            if(isset($_GET['edit'])){
                $id = $_GET['id'];
                
                
                $fetch = $users->fetchuser($con,$id);
                    if($fetch){
                        foreach ($fetch as $row) {
                            if($row['photo'] == ''){
                                $src = '../assets/image_assets/noimage.jpg';
                            }else {
                                $src = '../assets/image_assets/'.$row['photo']; 
                            }
                           ?>
                         <form action="../action/edit.php" method="post" enctype="multipart/form-data" style="font-size:14px">
                              <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo $src?>" alt="" style="width:300px;" class="img-thumbnail">
            
                        <input type="file" name="photo" class="d-none form-control" id="photo" accept="image/*" style="font-size:13px">
                    </div>
                    <div class="col-md-8">
                            <?php
                            if(isset($_SESSION['success'])){
                                echo '<div class="alert alert-success alert-dismissable"  data-bs-dismiss="alert" aria-label="Close" role="alert">
                                <span style="font-size:13px">Account Updated Successfully!</span>
                           
                                
                               </div>';
                            unset($_SESSION['success']);
                            }
                            
                            ?>
                    Name        
                        <input type="text" class="form-control mb-2 dd" id="uname" value="<?php echo $row['name']?>" name="name"  style="font-size:13px">
            
                        Email        
                        <input type="text" class="form-control mb-2 dd" value="<?php echo $row['email']?>"  name="email" style="font-size:13px">
            
                       Delivery Address        
                       <textarea id="" cols="30" rows="3" class="form-control mb-2 dd" style="resize:none" name="address"  style="font-size:13px"><?php echo $row['address']?></textarea>
            
                     <input type="hidden" name="pass" value="<?php echo $row['password']?>">
                            <input type="hidden" name="token" value="<?php echo $row['user_id']?>">
                       <button type="submit" class="btn btn-secondary dd" id="updateacc" name="updateuser" >Update</button>
                    
                      
            
            
            
                    </div>
                    
                </div>
                </form>
                           <?php
                        }
            
            
                    }
                
            }else {

            }
              
            ?>
    


        
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



