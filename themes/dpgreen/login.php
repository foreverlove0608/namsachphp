<?php 
  include_once('functions/action_user.php');
  $user = new user();
  if (isset($_POST['login'])) {
    $error = $user->login();
  } else {
    $error = '';
  }
?>
<div class="container">
  <div style="height: 150px;"></div>
  <h1>Login:</h1><br><br><br><br><br>
  <span style="color: red;"><?php echo $error;?></span>
<form action="" method="POST">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" name="email" class="form-control" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" name="password" class="form-control" id="pwd">
  </div>
  <button type="submit" class="btn btn-default" name="login">Submit</button>
</form>
</div>
<?php 
  // $sql = "SELECT * FROM  config_languages Where languages_code = 'vn'";
  // $result = mysqli_query($conn_vn, $sql);
  // $row = mysqli_fetch_assoc($result);
  // echo $row['google_map'];
?>