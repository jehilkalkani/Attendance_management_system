<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM faculty where id= ".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
			$$k=$val;
	}
	}
if (isset($_POST['submit2'])) {
	$id_no = $_POST['id_no'];
	$name = $_POST['name'];
	$password = $_POST['password'];
	$password2 = md5($password);
	$email = $_POST['email'];    
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	// $query = "UPDATE `faculty` SET id_no='$id_no',`contact`='$contact',`address`='$address' where email='$email'";
	$save = $conn->query("UPDATE `faculty` SET `name`='$name',`password`='$password',`email`='$email',`contact`='$contact',`address`='$address' where id_no='$id_no'");
	$save = $conn->query("UPDATE `users` SET `password`='$password2' WHERE name = '$name'");
	echo '<script>alert("Data successfully updated!")</script>';

} 
?>
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Faculty</b>
						<span class="float:right">
							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" data-toggle="modal" data-target="#myModal5">
								<i class="fa fa-plus"></i> New Faculty
							</button>
						</span> 
						<div id="myModal5" class="modal fade" role="dialog">
							<div class="modal-dialog">

								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">New Faculty</h5>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
									<form action="" id="new-faculty">
										<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
										<div class="form-group">
											<label for="" class="control-label">ID #</label>
											<input type="text" class="form-control" name="id_no"  required/>
										</div>
										<div class="form-group">
											<label for="" class="control-label">Name</label>
											<input type="text" class="form-control" name="name"   required/>
										</div>
										<div class="form-group">
											<label for="" class="control-label">Password</label>
											<input type="text" class="form-control" name="password"   required/>
										</div>
										<div class="form-group">
											<label for="" class="control-label">Email</label>
											<input type="email" class="form-control" name="email"  required/>
										</div>
										<div class="form-group">
											<label for="" class="control-label">Contact</label>
											<input type="text" class="form-control" name="contact"  required/>
										</div>
										<div class="form-group">
											<label for="" class="control-label">Address</label>
											<textarea name="address" id="address" cols="30" rows="4" class="form-control" required></textarea>
										</div>
										<div class="text-center">
											<button class="btn btn-sm btn-primary col-sm-3 justify-content">Save</button>
										</div>
									</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">ID #</th>
									<th class="">Name</th>
									<th class="">Email</th>
									<th class="">Contact</th>
									<th class="">Address</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$faculty = $conn->query("SELECT * FROM faculty order by id_no ");
								while($row=$faculty->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td>
										<p> <b><?php echo $row['id_no'] ?></b></p>
									</td>
									<td>
										<p> <b><?php echo ucwords($row['name']) ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo $row['email'] ?></b></p>
									</td>

									<td class="">
										 <p> <b><?php echo $row['contact'] ?></b></p>
									</td>
									<td class="">
										 <p><b><?php echo  $row['address'] ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">Edit</button>
										
										<div id="myModal<?php echo $i; ?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Manage Faculty Details</h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<form action="" id="edit-faculty" method="POST">
															<!-- <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>"> -->
															<div class="form-group">
																<label for="" class="control-label" style="margin-left: -27rem;">ID #</label>
																<input type="text" class="form-control" name="id_no" value="<?php echo $row['id_no']; ?> " readonly="readonly" required/>
															</div>
															<div class="form-group">
																<label for="" class="control-label" style="margin-left: -27rem;">Name</label>
																<input type="text" class="form-control" name="name"  value="<?php echo $row['name']; ?>" required/>
															</div>
															<div class="form-group">
																<label for="" class="control-label" style="margin-left: -25.75rem;">Password</label>
																<input type="text" class="form-control" name="password"  value="<?php echo $row['password']; ?>" required/>
															</div>
															<div class="form-group">
																<label for="" class="control-label" style="margin-left: -27rem;">Email</label>
																<input type="email" class="form-control" name="email"  value="<?php echo $row['email']; ?>" required/>
															</div>
															<div class="form-group">
																<label for="" class="control-label" style="margin-left: -26.5rem;">Contact</label>
																<input type="text" class="form-control" name="contact"  value="<?php echo $row['contact']; ?>" required/>
															</div>
															<div class="form-group">
																<label for="" class="control-label" style="margin-left: -26rem;">Address</label>
																<textarea name="address" id="address" cols="30" rows="4" class="form-control" required><?php echo $row['address'];  ?></textarea>
															</div>
															<button class="btn btn-sm btn-primary col-sm-3 " name="submit2">Save</button>
														</form>
													</div>
												</div>
											</div>
										</div>
										<button class="btn btn-sm btn-outline-danger delete_faculty" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>

<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})

	$('.delete_faculty').click(function(){
		_conf("Are you sure to delete this faculty?","delete_faculty",[$(this).attr('data-id')])
	})
	
	$('#new-faculty').on('reset',function(){
		$('#msg').html('')
		$('input:hidden').val('')
	})
	$('#new-faculty').submit(function(e){
		e.preventDefault()
		$('#msg').html('')
		start_load()
		$.ajax({
			url:'ajax.php?action=save_faculty',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully saved.",'success')
						setTimeout(function(){
							location.reload()
						},1000)
				}else if(resp == 2){
				$('#msg').html('<div class="alert alert-danger mx-2">ID # already exist.</div>')
				end_load()
				}	
			}
		})
	})
	// $('#edit-faculty').submit(function(e){
	// 	e.preventDefault()
	// 	$('#msg').html('')
	// 	start_load()
	// 	$.ajax({
	// 		url:'ajax.php?action=edit_faculty',
	// 		data: new FormData($(this)[0]),
	// 	    cache: false,
	// 	    contentType: false,
	// 	    processData: false,
	// 	    method: 'POST',
	// 	    type: 'POST',
	// 		success:function(resp){
	// 			if(resp==1){
	// 				alert_toast("Data successfully saved.",'success')
	// 					setTimeout(function(){
	// 						location.reload()
	// 					},1000)
	// 			}else if(resp == 2){
	// 			$('#msg').html('<div class="alert alert-danger mx-2">ID # already exist.</div>')
	// 			end_load()
	// 			}	
	// 		}
	// 	})
	// })
	function delete_faculty($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_faculty',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>