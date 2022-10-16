<div class="container">
    <style>
        .dd {
            font-size:14px;
        }
    </style>
    <h5 style="  font-family: 'Syncopate', sans-serif;">Register</h5>
    <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php
        if(isset($_SESSION['notmatch'])){
            echo '<div class="alert alert-danger alert-dismissable"  data-bs-dismiss="alert" aria-label="Close" role="alert">
            <span style="font-size:13px">Password Does not Match!</span>
       
            
           </div>';
           unset($_SESSION['notmatch']);
        }else if (isset($_SESSION['alreadyexist'])){
            echo '<div class="alert alert-danger alert-dismissable"  data-bs-dismiss="alert" aria-label="Close" role="alert">
            <span style="font-size:13px">Email already exist.</span>
       
            
           </div>';
            unset($_SESSION['alreadyexist']);
        }else if (isset($_SESSION['registered'])){
            echo '<div class="alert alert-success alert-dismissable"  data-bs-dismiss="alert" aria-label="Close" role="alert">
            <span style="font-size:13px">Registered Successfully! , <a href="login.php?logged"> Click here to Login.</a></span>
       
            
           </div>';
         
            unset($_SESSION['registered']);
        }
        
        ?>
       
            <div class="mb-5" style="font-size:13px" >
            <form action="action/add.php" method="post">
            Name        
            <input type="text" class="form-control mb-2 dd" name="name" autofocus  required>

            Email        
            <input type="text" class="form-control mb-2 dd" name="email" required>

            Mobile #        
            <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control mb-2 dd" maxlength="11" name="number" required>

           Delivery Address        
           <textarea name="address" id="" cols="30" rows="3" class="form-control mb-2 dd" style="resize:none" required></textarea>

           Password 
           <input type="password" class="form-control mb-2 pw dd" name="password" required>
           Reenter Password 
           <input type="password" class="form-control pw dd" name="repassword" required>

           <label for="" style="font-size:13px">Show Password <input type="checkbox" id="check"></label>

           <button type="submit" class="btn btn-primary form-control round-pill mt-4 mb-3 dd" name="register"> Register</button>
            <a href="?Home">I Already have an Account</a>         
            </form>
            </div>
        
    </div>
    <div class="col-md-2"></div>

    </div>
</div>
<script>
    $(document).ready(function(){
      $('#check').click(function(){

        if($(this).prop("checked") == true) {
                      $('.pw').attr('type','text');               
                     }
                else if($(this).prop("checked") == false) {
                         $('.pw').attr('type','password');                  
                    }

    })
    })
  
  </script>