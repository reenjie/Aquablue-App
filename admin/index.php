<?php
session_start();
if(!isset( $_SESSION['admin_login'])){
  header('location:../index.php');
}
include '../connection/connect.php';
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
         <div class="container">
         <br><br>
          <h5 style="font-weight: bolder;">DASHBOARD</h5>

          <div class="row">
          
              
           

             

               <div class="col-md-9">
                 <div class="row">
                   <div class="col-md-4">
                   <div class="card shadow border-info">
                    <div class="card-body">
                         <h6 style="font-weight: bolder;text-align: center;" class="text-dark">
                         PRODUCTS <span class="badge bg-light text-dark"> 

                           <?php 
                               $cproducts = " select * from product  ";
                                           $countproduct = mysqli_query($con,$cproducts); 
                                           $allproducts= mysqli_num_rows($countproduct);
                                       echo $allproducts;   

                            ?>
                         </span>
                         </h6>
                    </div> 
                    
                 </div> 
                   </div>

                   <div class="col-md-4">
                   <div class="card shadow border-primary">
                    <div class="card-body">
                         <h6 style="font-weight: bolder;text-align: center;" class="text-dark">
                         CUSTOMERS <span class="badge bg-light text-dark"> 
                           <?php 
                               $ccustomers = " select * from accounts where user_type !='admin'  ";
                                           $ccustom = mysqli_query($con,$ccustomers); 
                                           $allcustomers= mysqli_num_rows($ccustom);
                                   echo $allcustomers;      
                            ?>
                         </span>
                         </h6>
                    </div> 
                    
                 </div>
                   </div>

                   <div class="col-md-4">
                   <div class="card shadow border-success">
                    <div class="card-body">
                         <h6 style="font-weight: bolder;text-align: center;" class="text-dark">
                           ORDERS <span class="badge bg-light text-dark"> <?php 
                               $corders = " select * from trans_record  ";
                                           $countord = mysqli_query($con,$corders); 
                                           $allorders= mysqli_num_rows($countord);
                                 echo $allorders;     

                           ?></span>
                         </h6>
                    </div> 
                    
                 </div> 
                   </div>

                 </div>


                 <div class="card mt-4">

                 <div class="card-body">
                 <script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "",
		horizontalAlign: "left"
	},
	data: [{
		type: "doughnut",
		startAngle: 60,
		//innerRadius: 60,
		indexLabelFontSize: 17,
		indexLabel: "{label} - #percent%",
		toolTipContent: "<b>{label}:</b> {y} (#percent%)",
		dataPoints: [
	

      { y: <?php echo $allproducts ?>, label: "Product", exploded: true },
      { y: <?php echo $allcustomers ?>, label: "Customers" },
      { y: <?php echo $allorders ?>, label: "Sales" }
     
		]
	}]
});
chart.render();

}
</script><div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

                 </div>
                 </div>


                 
              </div> 

              <div class="col-md-3">
              <table>
              <tr><td style="text-align: center;"><canvas id="canvas_tt62960078eb980" width="175" height="175"></canvas></td></tr>
              <tr><td style="text-align: center; font-weight: bold"><a href="//24timezones.com/current_time/philippines_manila_clock.php" style="text-decoration: none" class="clock24" id="tz24-1653997688-cc14848-eyJzaXplIjoiMTc1IiwiYmdjb2xvciI6IjAwOTlGRiIsImxhbmciOiJlbiIsInR5cGUiOiJhIiwiY2FudmFzX2lkIjoiY2FudmFzX3R0NjI5NjAwNzhlYjk4MCJ9" title="Manila time" target="_blank" rel="nofollow">Philippines</a></td></tr>
          </table>
<script type="text/javascript" src="//w.24timezones.com/l.js" async></script>
              </div>
              

              
          
          

          </div>

       
    


        
        </div> 



      </div> 


       <div class="footer shadow">
         
       </div> 
       
      
     
     
     

  </section>





<footer>
    AquaBlue 2022
 </footer>
 

<script src="../bootstrap/js/jquery.js"></script>
<script src="../bootstrap/js/popper.js?v=1"></script>
<script src="../bootstrap/js/sidebar.js"></script>

<?php include_once("../components/footers.php") ?>

</body>
</html>



