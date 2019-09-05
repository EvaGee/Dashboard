<div class="container">
<div class="row" style="padding-top: 40px">
<div class="col-md-6 col-md-offset-3">
<div class="panel panel-login">
<div class="panel-heading">
<div class="row">
<div class="col-xs-12">
<div class="active">Recover Password</div>
</div>
</div>
<hr>
</div>
<div class="panel-body">
<div class="row">
<div class="col-lg-12">
<div id="recover">

<?php
if (isset($error)){
    echo ("<div class='error'>$error</div>");
}
?>

<form action="<?php echo base_url(); ?>index.php/recover" method="post">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <label for="new_password">New password</label>
                <input type="password" class="form-control" name="new_password" id="new_password" onkeyup='check();' required  placeholder="New Password">
              </div>
           </div>
        </div> 

         <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <label for="confirm_password">Confirm password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" onkeyup='check();' required  placeholder="Confirm Password">
                <span id='message'></span>
              </div>
           </div>
        </div> 

        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                   <button type="submit" name="send" id="send" tabindex="4" class="form-control btn btn-primary">Send</button>
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
<link rel="stylesheet" href="assets/logincss/CSS/css.css" >

<script>
var check = function() {
 
  if (document.getElementById('new_password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
    document.getElementById('send').style.visibility='visible';
    
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    if (document.getElementById('confirm_password').value.length < 6 || (!format.test(document.getElementById('confirm_password').value) && !format.test(document.getElementById('new_password').value))) {

        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'password Should be atlist 6 charactors with special charactors';
        document.getElementById('send').style.visibility='hidden';

  } else {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
    document.getElementById('send').style.visibility='visible';
    
  }

  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
    document.getElementById('send').style.visibility='hidden';
    
  }  
}
</script>