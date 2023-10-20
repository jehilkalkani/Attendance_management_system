<?php 
include('db_connect.php');
if (isset($_POST['submit3'])) {
	$id_no = $_POST['id_no'];
	$name = $_POST['name'];
	$class_id= $_POST['class_id'];
	// $query = "UPDATE `faculty` SET id_no='$id_no',`contact`='$contact',`address`='$address' where email='$email'";
	$save = $conn->query("UPDATE `students` SET `class_id`='$class_id',`name`='$name' WHERE id_no='$id_no'");
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
						<b>List of Student</b>
						<span class="float:right">
							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" data-toggle="modal" data-target="#my1Modal" id="new_student">
								<i class="fa fa-plus"></i> New Student
							</button>
						</span>
						<div id="my1Modal" class="modal fade" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">New Student</h5>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
										<form action="" id="manage-student">
											<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
											<div id="msg" class="form-group"></div>
											<div class="form-group">
												<label for="" class="control-label">ID #</label>
												<input type="text" class="form-control" name="id_no" required>
											</div>
											<div class="form-group">
												<label for="" class="control-label">Name</label>
												<input type="text" class="form-control" name="name"  required>
											</div>
											<div class="form-group">
												<label for="" class="control-label">Class</label>
												<select name="class_id" id="" class="custom-select select2">
													<option value=" "></option>
													<?php
													$class = $conn->query("SELECT c.*,concat(co.course,' ',c.level,'-',c.section) as `class` FROM `class` c inner join courses co on co.id = c.course_id order by concat(co.course,' ',c.level,'-',c.section) asc");
													while($row=$class->fetch_assoc()):
													?>
													<option value="<?php echo $row['id'] ?>" <?php echo isset($class_id) && $class_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['class'] ?></option>
													<?php endwhile; ?>
												</select>
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
									<th class="">Class</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$student = $conn->query("SELECT s.*,concat(co.course,' ',c.level,'-',c.section) as `class` FROM students s inner join `class` c on c.id = s.class_id inner join courses co on co.id = c.course_id order by s.name desc ");
								while($row=$student->fetch_assoc()):
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
										 <p> <b><?php echo $row['class'] ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_faculty" type="button" data-toggle="modal" data-target="#my2Modal<?php echo $i; ?>" >Edit</button>
										<div id="my2Modal<?php echo $i; ?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Manage Student Details</h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<form action="" id="edit-student" method="POST">
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
																<label class="control-label" > Class </label>
																<select name="class_id" id="" class="custom-select select2">
																	<option value=""></option>
																	<?php
																	$class = $conn->query("SELECT c.*,concat(co.course,' ',c.level,'-',c.section) as `class` FROM `class` c inner join courses co on co.id = c.course_id order by concat(co.course,' ',c.level,'-',c.section) asc");
																	while($row1=$class->fetch_assoc()):
																	?>
																	<option value="<?php echo $row1['id'] ?>" <?php echo isset($class_id) && $class_id == $row1['id'] ? 'selected' : '' ?>><?php echo $row1['class'] ?></option>
																	<?php endwhile; ?>
																</select>
															</div>
															<button class="btn btn-sm btn-primary col-sm-3 " name="submit3">Save</button>
														</form>
													</div>
												</div>
											</div>
										</div>
										<button class="btn btn-sm btn-outline-danger delete_student" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
	$('.delete_student').click(function(){
		_conf("Are you sure to delete this student?","delete_student",[$(this).attr('data-id')])
	})
	
	function delete_student($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_student',
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

	$('#manage-student').on('reset',function(){
		$('#msg').html('')
		$('input:hidden').val('')
	})
	$('#manage-student').submit(function(e){
		e.preventDefault()
		$('#msg').html('')
		start_load()
		$.ajax({
			url:'ajax.php?action=save_student',
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
</script>