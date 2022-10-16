<div class="card shadow-sm" style="">
              <div class="card-body">



                <script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "dark",
  title:{
    text: ""
  },
  data: [{        
    type: "line",
        indexLabelFontSize: 16,
    dataPoints: [
     
     /* { y: 414},
      { y: 520, indexLabel: "\u2191 highest",markerColor: "red", markerType: "triangle" },
      { y: 460 },
      { y: 450 },
      { y: 500 },
      { y: 480 },
      { y: 480 },
      { y: 410 , indexLabel: "\u2193 lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
      { y: 500 },
      { y: 480 },*/
      <?php 
      
     
      $product = new Product();
          $stats = " select * from trans_record where transaction_id in (select tid from transaction where status =3 )  ";
                      $gstat = mysqli_query($con,$stats); 

                   
                  
                       while($st = mysqli_fetch_array($gstat)){
                           $qty = $st['quantity'];
                           $prodid = $st['prod_id'];

                          $fetch = $product ->selectproduct($con,$prodid);
                            foreach ($fetch as $pr) {
                               $price = $pr['price'];
                               $total = $price * $qty;
                               ?>
                               { y:<?php echo $total ?> },
                              <?php
                            }
                            
                    
                       }
                

       ?>
     


    ]
  }]
});
chart.render();

}
</script>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                  



              </div> 
              
           </div> 