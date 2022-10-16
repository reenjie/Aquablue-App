<div class="card shadow mt-4">
 
      <div class="card-body">
        <form action="login.php" method="post">
          <h6 style="text-align:center; font-family: 'Amatic SC', cursive;font-size:20px" class="text-primary">SignIn</h6>
          <?php
    if(isset($_SESSION['credentialsnotmatch'])){
      echo '<div class="alert alert-danger alert-dismissable"  data-bs-dismiss="alert" aria-label="Close" role="alert">
     <span style="font-size:13px">You have entered an incorrect Email or Password!</span>

     
    </div>';

      unset($_SESSION['credentialsnotmatch']);
    }
  ?>

          Email
          <input type="text" class="form-control" autofocus required  style="font-size:13px" name="email">

          Password
          <input type="password" class="form-control pp" required style="font-size:13px" name="pass">

          <label for="" style="font-size:13px">Show Password <input type="checkbox" id="check"></label>
          <br>

          <a href="?Register" style="font-size:19px">Register here</a>
          <button type="submit" name="login" class="btn btn-info mt-3" style="float:right;font-size:14px">
            LOGIN
          </button>
          </form>
      </div>
  </div>

  <script>
    $(document).ready(function(){
      $('#check').click(function(){

        if($(this).prop("checked") == true) {
                      $('.pp').attr('type','text');               
                     }
                else if($(this).prop("checked") == false) {
                         $('.pp').attr('type','password');                  
                    }

    })
    })
  
  </script>