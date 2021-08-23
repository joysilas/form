<?php

session_start(); ob_clean();

include('lib/connect.inc.php');

if(isset($_SESSION['user_id'])){}else{ header("location: login.php"); }

$user = $_SESSION['user_id'];

$sql = $db->query("SELECT * FROM users WHERE sn='$user' ")or die('cannot connect');
$data = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list of users</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2>List Of Users</h2>       
  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>sn</th>
        <th>Surname</th>
        <th>Othernames</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM users WHERE status = 1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while($data = $result->fetch_assoc()):
    ?>
    <tbody>
      <tr>
        <td><?php echo $data['sn'] ?></td>
        <td><?php echo ucwords($data['surname']) ?></td>
        <td><?php echo ucwords($data['othernames']) ?></td>
        <td><?php echo $data['email'] ?></td>
        <td><button type="button" class="btn btn-primary btn-block mb-2" data-toggle="modal" data-target="#userList<?php echo $data['sn'] ?>">Profile</button></td>
      </tr>
    </tbody>

    <div class="modal fade" id="userList<?php echo $data['sn']?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">user info <?php echo ucwords($data['sn']); ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form method="post" enctype="multipart/form-data">
				<div>
					<div class="col-lg-12 col-md-12 col-12 mb-2">
            <!-- <?php print_r($data) ?> -->
            <?php
              foreach($data as $x =>$x_value){
                echo ucwords("<b>".$x."</b>" .":". " " . " " ."$x_value");
                echo "<br>" , "<br>";
              }
            ?>
					</div>
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>

    <?php endwhile;?>
  </table>
</div>


</body>

    <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
	<script src="bootstrap/js/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</html>