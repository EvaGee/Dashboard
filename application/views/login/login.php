<!-- recover password popup -->
<!--popup css and JS-->
<style type="text/css">
.navbar-custom{
    background-color: #B33010;
}
.btn{
background-color: #B33010;
}

.error{
color: #B33010;
}
.panel {
    padding:20px !important;
}
.tickets4u{
	height: 60px;
	 background-position: center; 
}

</style>

    <!-- <<Mobile Viewport Code>> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- <<Attched Stylesheets>> -->
    <link rel="stylesheet" href="css/theme.css" type="text/css" />


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="<?php echo base_url(); ?>assets/css/login/css.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://resources.elipa.co/icons.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/login/Js.js"></script>

<!--css and js ends-->

<!-- Basic modal -->
<div id="recover_password" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Reset Password</h5>
            </div>
    <!-------------------------------FORGOT PASSWORD FORM----------------------------->
            <form action="<?php echo base_url(); ?>index.php/Login/send_recover_email" method="post">
                
            <div class="modal-body">

                <div class="form-group">
                    <label for="Email">Email Address</label>
                    <input type="Email" class="form-control" name="Email" required  placeholder="example@example.com">
                </div>

            </div>

            <div class="modal-footer" style="width: 100% !important;">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Send</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /basic modal -->



<div class="content" style="padding-top: 50px;">
<div class="row">
<div class="col-md-4 col-md-offset-4" style="padding: 5px; border: 1px solid #eee;border-radius: 3px;box-shadow:0 2px 2px rgba(0,0,0,0.2),0 1px 5px rgba(0,0,0,0.2),0 0 0 12px rgba(255,255,255,0.4); ">
 
<div class="panel panel-login">
	<div style="text-align: center"><img src="assets/images/logo-login.png"></div>
<div class="panel-heading" style="padding-top: 30px">
    <div class="row">
    <div class="col-xs-6">
    <a href="#" class="active" onclick="asd(1)">Login</a>
    </div>
    <div class="col-xs-6">
    <a href="#" class="active" onclick="asd(2)">Register</a>
    </div>
    </div>
    <hr>
   <div style="text-align: center; width: 100%">
        <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-info alert-styled-left">
            <button type="button" class="close" data-dismiss="alert"></button>          
            <?php echo $this->session->flashdata('success'); ?>
          </div>
         <?php
        endif;?>

        <?php if($this->session->flashdata('false')):?>
          <div class="alert alert-danger alert-styled-left">
            <button type="button" class="close" data-dismiss="alert"></button>          
            <?php echo $this->session->flashdata('false'); ?>
          </div>
         <?php
        endif;?>
    </div>
</div>

<div class="panel panel-login" style="padding: 1px;">
<div class="row">

<div class="col-lg-12">

<!-----------------------LOGIN FORM----------------------------------->
<div id="login">
<form action="<?php echo base_url(); ?>index.php/login" method="post" >
    <div class="form-group">
        <input type="text" name="login_username" id="username" tabindex="1" class="form-control" placeholder="Email" value="" required>
    </div>
    <div class="form-group">
        <input type="password" name="login_password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-primary" value="Log In">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <a href="#" tabindex="5" class="forgot-password" data-toggle="modal" data-target="#recover_password">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</form>
</div>


<!-------------------------------REGISTER FORM-------------------------------------->
<div id="register" style="display: none;">
<form action="<?php echo base_url(); ?>index.php/signup" method="post">
    <div class="form-group">
        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Full Name" value="" required>
    </div>
    <div class="form-group">
        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
    </div>
        <div class="form-group">
        <input type="number" name="phone" id="phone" tabindex="1" class="form-control" placeholder="Phone Number" value="" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" id="sign_password"  tabindex="2" class="form-control" onkeyup='check();' placeholder="Password" required>
    </div>
    <div class="form-group">
        <input type="password" name="confirm-password" id="sign_confirm_password"  tabindex="2" class="form-control" onkeyup='check();' placeholder="Confirm Password" required>
         <span id='message'></span>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-primary" value="Register Now">
            </div>
        </div>
    </div>
</form>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
function asd(a)
{
    if(a==1)
    {
    document.getElementById("login").style.display="block";
    document.getElementById("register").style.display="none";
}
    else{
    document.getElementById("login").style.display="none";
    document.getElementById("register").style.display="block";
}
}

var check = function() {
 
  if (document.getElementById('sign_password').value ==
    document.getElementById('sign_confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
    document.getElementById('register-submit').style.visibility='visible';
    
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    if (document.getElementById('sign_confirm_password').value.length < 6 || (!format.test(document.getElementById('sign_confirm_password').value) && !format.test(document.getElementById('sign_password').value))) {

        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'password Should be atlist 6 charactors with special charactors';
        document.getElementById('register-submit').style.visibility='hidden';

  } else {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
    document.getElementById('register-submit').style.visibility='visible';
    
  }

  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
    document.getElementById('register-submit').style.visibility='hidden';
    
  }  
}
</script>

