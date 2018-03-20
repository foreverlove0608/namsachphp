<?php 
  include_once('functions/action_user.php');
  $user = new user();
  if (isset($_POST['save'])) {
    $error = $user->register();
  } else {
    $error = '';
  }
?>
<div style="height: 150px;"></div>
<form class="form-horizontal" method="POST" action="">
<fieldset>

<!-- Form Name -->
<legend>Register Yourself</legend>
<label style="color: red;"><?php echo $error;?></label>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Username:</label>  
  <div class="col-md-4">
  <input id="name" name="name" type="text" placeholder="John" class="form-control input-md" required=""  value="<?php echo (isset($_POST['name']))?$_POST['name']:'' ;?>">
    
  </div>
</div>

<!-- email input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email:</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="email" placeholder="johndoe@example.com" class="form-control input-md" required=""  value="<?php echo (isset($_POST['email']))?$_POST['email']:'' ;?>">
    
  </div>
</div>

<!-- number input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="phone">Phone:</label>  
  <div class="col-md-4">
  <input id="phone" name="phone" type="number" placeholder="098" class="form-control input-md" value="<?php echo (isset($_POST['phone']))?$_POST['phone']:'' ;?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="address">Address:</label>  
  <div class="col-md-4">
  <input id="address" name="address" type="text" placeholder="New York" class="form-control input-md" value="<?php echo (isset($_POST['address']))?$_POST['address']:'' ;?>">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password1">Password:</label>
  <div class="col-md-4">
    <input id="password1" name="password1" type="password" placeholder="***" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password2">Comfirm Password:</label>
  <div class="col-md-4">
    <input id="password2" name="password2" type="password" placeholder="***" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-8">
    <button type="submit" id="save" name="save" class="btn btn-success">Register</button>
  </div>
</div>

</fieldset>
</form>
