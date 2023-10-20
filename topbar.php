<!-- <style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style> -->
<?php 
include 'db_connect.php';
$name = $_SESSION['login_name'];
if (isset($_POST['submit1'])) {
	$password = $_POST['password'];
	$password2 = md5($password);
	$username = $_POST['username'];    
	$save = $conn->query("UPDATE `users` SET `username`='$username',`password`='$password2' WHERE name = '$name'");
	echo '<script>alert("Data successfully updated!")</script>';

} 
?>
<div id="myModal1" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Manage Acoount</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form method="POST" id="manage-faculty">
					<div class="form-group">
						<label for="" class="control-label">Username</label>
						<input type="text" class="form-control" name="username" required/>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Password</label>
						<input type="password" class="form-control" name="password" required/>
					</div>
					<div class="text-center">
						<button class="btn btn-sm btn-primary col-sm-3 justify-content" name="submit1">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  		
  		</div>
      <div class="col-md-4 float-left text-white">
        <large><b><?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : '' ?></b></large>
      </div>
      <!-- <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-cog"></i> Manage Account
			</button> -->
	  	<div class="float-right">
        <div class=" dropdown mr-4">
            <a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> </a>
              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -7rem; top: 1.5rem; ">
                <button class="dropdown-item" id="manage_account" data-toggle="modal" data-target="#myModal1"><i class="fa fa-cog"></i> Manage Account</button> 
                <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
              </div>
        </div>
      </div>
  </div>
  
</nav>

<<script>
</script>