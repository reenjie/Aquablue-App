<div class="container">
    <style>
        .dd {
            font-size:13px;
        }
    </style>
<div class="card">

    <div class="card-body">
    <h5 style="  font-family: 'Syncopate', sans-serif;">My Account</h5>
    <button class="btn btn-light text-danger" onclick="window.location.href='logout.php'" style="font-size:13px;float:right">LogOut <i class="fas fa-power-off"></i></button>
    <br>
    <?php
    $token = $_SESSION['user_id'];
    $users = new Users();
    $fetch = $users -> fetchuser($con,$token);
        if($fetch){
            foreach ($fetch as $row) {
                if($row['photo'] == ''){
                    $src = 'assets/image_assets/noimage.jpg';
                }else {
                    $src = 'assets/image_assets/'.$row['photo']; 
                }
               ?>
             <form action="action/edit.php" method="post" enctype="multipart/form-data">
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
            <input type="text" class="form-control mb-2 dd" id="uname" value="<?php echo $row['name']?>" name="name" readonly>

            Email        
            <input type="text" class="form-control mb-2 dd" value="<?php echo $row['email']?>" readonly name="email">

           Mobile #       
            <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="11" class="form-control mb-2 dd" value="<?php echo $row['mobile']?>" readonly name="number">

           Delivery Address        
           <textarea id="" cols="30" rows="3" class="form-control mb-2 dd" style="resize:none" name="address" readonly><?php echo $row['address']?></textarea>

           Password 
           <input type="password" class="form-control mb-2 dd" value="<?php echo $row['password']?>" name="password" readonly>
          

           <button type="button" class="btn btn-secondary dd" id="updateacc" >Update</button>
        
           <button type="submit" class="btn btn-success dd d-none" id="saveupdate" name="update_user_account" >Save</button>



        </div>
        
    </div>
    </form>
               <?php
            }


        }

    ?>
  
    </div>
</div>

</div>

<script>
    $('#updateacc').click(function(){
        var data = $(this).html();

        if(data == 'Update'){
            $(this).html('Cancel');
        $('.dd').removeAttr('readonly');
        $('#saveupdate').removeClass('d-none');
        $('#photo').removeClass('d-none');
        }else if (data =='Cancel'){
            $(this).html('Update');
        $('.dd').attr('readonly',true);
        $('#saveupdate').addClass('d-none');
        $('#photo').addClass('d-none');
        }

      
      
    })
</script>