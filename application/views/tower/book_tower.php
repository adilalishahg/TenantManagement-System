<?php include_once(APPPATH . "views/includes/header.php"); ?>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Sidebar -->
		<?php include_once(APPPATH . "views/includes/sidebar.php"); ?>
		<!-- End of Sidebar -->
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<!-- <?php print_r($users); ?> -->
				<!-- Topbar -->
				<?php include_once(APPPATH . "views/includes/navbar.php"); ?>
				<!-- End of Topbar -->
				<div class="d-sm-flex align-items-center justify-content-between mb-2">
					<h1 class="h3 mb-0 text-gray-800">Tower Registration</h1>
				</div>
				<!-- Begin Page Content -->
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
							<div class="col-lg-12">
								<div class="p-5">
									<form class="user" method="post" action="<?php echo base_url(); ?>book_flat">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="exampleInputEmail">Tower Name</label>
												<input type="text" name="tower" class="form-control form-control-user" id="tower" aria-describedby="tower" placeholder="Enter Tower Name...">
												<span class="error-message"></span><?php echo form_error('tower', '<span class="error">', '</span>'); ?>
											</div>
											<div class="form-group col-md-6">
												<label for="benefitsCheckbox">Select Owner If You're not</label>
												<select class="form-select" id="role" name="role">
													<option value="">Select Owner </option>
													<?php foreach ($users as $user) {
													?>
														<option value="<?php echo  $user['user_id']; ?>" <?php echo set_select('role', '1', isset($role) && $role == '1'); ?>>
															<?php echo  ucfirst($user['first_name']) . ' ' . ucfirst($user['last_name']); ?>
														</option>
													<?php } ?>
												</select>
												<?php echo form_error('benefits', '<span class="error">', '</span>'); ?>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<button name="submit" value="save" class="btn btn-primary btn-user btn-block ">
													Save
												</button>
											</div>
											<div class="form-group col-md-6">
												<button name="submit" value="save" class="btn btn-danger btn-user btn-block ">
													Cancel
												</button>
											</div>
										</div>
									</form>
									<hr>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End of Main Content -->
			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Your Website 2021</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
	<script>
		$(document).ready(function() {
			$('form.user').submit(function(event) {
				event.preventDefault(); // Prevent default form submission
				// Clear previous errors
				$('.error-message').html('');
				// Perform client-side validation
				var isValid = true;
				// Validate Flat Name
				var flatName = $('#tower').val();
				if (flatName.trim() === '') {
					$('#tower').next('.error-message').html(
						'<span class="text-danger">Tower Name is required</span>');
					isValid = false;
				}
				if (!isValid) {
					return;
				}
				// Serialize form data
				var formData = $(this).serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url(); ?>book_tower',
					data: formData,
					success: function(response) {
						// Handle successful submission (you can redirect or show a success message)
						swal("Tower Registered!", "Tower Registered Successfully!", "success");
					},
					error: function(xhr, status, error) {
						swal("Oops!", "Something went wrong", "error");
						var errors = JSON.parse(xhr.responseText);
						$('.error-message').html('');
						// Display errors for each field
						$.each(errors, function(key, value) {
							$('#' + key).next('.error-message').html(
								'<span class="text-danger">' + value + '</span>');
						});
					}








				});
			});
		});
	</script>
	<?php include_once(APPPATH . "views/includes/footer.php"); ?>