<?php 
  function list_user () {
    global $conn_vn;
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn_vn, $sql) or die(mysqli_error($conn_vn));
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
  }

  $rows = list_user();

?>
<div class="container" style="margin-top: 190px;">
  <h2>Basic Table</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Date</th>
        <th>State</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($rows as $row) {?>
      <tr>
        <td><?php echo $row['user_name'];?></td>
        <td><?php echo $row['user_email'];?></td>
        <td><?php echo $row['user_phone'];?></td>
        <td><?php echo $row['user_address'];?></td>
        <td><?php echo $row['created_date'];?></td>
        <td><?php echo $row['state'];?></td>
        <?php if (isset($_SESSION['user_email_stc'])) {?>
        <td>Sua | Xoa</td>
        <?php } else {?>
        <td>No</td>
        <?php } ?>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
