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
								<label for="flatNameInput">First Name</label>
								<input type="text" name="first_name" class="form-control form-control-user" id="first_name" aria-describedby="firstNameHelp" placeholder="Enter First Name...">
								<span class="error-message"></span>
								<?php echo form_error('first_name', '<span class="error">', '</span>'); ?><span class="error-message"></span>

							</div>
							<div class="form-group col-md-6">
								<label for="flatNameInput">Last Name</label>
								<input type="text" name="last_name" class="form-control form-control-user" id="last_name" aria-describedby="lastNameHelp" placeholder="Enter Last Name...">
								<span class="error-message"></span>
								<?php echo form_error('last_name', '<span class="error">', '</span>'); ?><span class="error-message"></span>

							</div>
							<div class="form-group col-md-6">
								<label for="flatNameInput">Email</label>
								<input type="text" name="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Enter Email ...">
								<span class="error-message"></span>
								<?php echo form_error('email', '<span class="error">', '</span>'); ?><span class="error-message"></span>

							</div>
							<div class="form-group col-md-6">
								<label for="flatNameInput">Contact No:</label>
								<input type="text" name="contact_no" class="form-control form-control-user" id="contact_no" aria-describedby="contact_noHelp" placeholder="Enter Contact Number...">
								<span class="error-message"></span>
								<?php echo form_error('contact_no', '<span class="error">', '</span>'); ?><span class="error-message"></span>

							</div>

							<div class="form-group col-md-6">
								<label for="benefitsCheckbox">Role</label>
								<select class="form-select <?php echo form_error('role') ? 'is-invalid' : ''; ?>" id="role" name="role">
									<option value="">Select Type</option>
									<option value="1" <?php echo set_select('role', '1', isset($role) && $role == '1'); ?>>
										Admin
									</option>
									<option value="2" <?php echo set_select('role', '2', isset($role) && $role == '2'); ?>>
										Manager
									</option>
									<option value="3" <?php echo set_select('role', '3', isset($role) && $role == '3'); ?>>
										Customer
									</option>
									<option value="5" <?php echo set_select('role', '5', isset($role) && $role == '5'); ?>>
										Employee
									</option>
								</select><span class="error-message"></span>
								<?php echo form_error('flat_type', '<span class="error">', '</span>'); ?>
							</div>
							<div class="form-group col-md-6">
								<label for="flatNameInput">Password:</label>
								<input type="text" name="password" class="form-control form-control-user" id="password" aria-describedby="passwordHelp" placeholder="Enter Password ...">
								<span class="error-message"></span>
								<?php echo form_error('password', '<span class="error">', '</span>'); ?><span class="error-message"></span>

							</div>
							<div class="form-group col-md-6">
								<label for="flatNameInput">Confirm Password:</label>
								<input type="text" name="confirm_password" class="form-control form-control-user" id="confirm_password" aria-describedby="confirm_passwordHelp" placeholder="Enter Confirm Password...">
								<span class="error-message"></span>
								<?php echo form_error('confirm_password', '<span class="error">', '</span>'); ?><span class="error-message"></span>

							</div>

							<!-- </div> -->
							<!-- <div class="form-row"> -->

							<!-- </div> -->
							<!-- <div class="form-row"> -->


						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<button name="submit" value="save" class="btn btn-primary btn-user btn-block ">
									Save
								</button>
							</div>
							<div class="form-group col-md-6">
								<button name="submit" value="cancel" class="btn btn-danger btn-user btn-block ">
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
<script>
	$(document).ready(function() {
		$('form.user').submit(function(event) {
			event.preventDefault(); // Prevent default form submission

			// Clear previous errors
			$('.error-message').html('');

			// Perform client-side validation
			var isValid = true;

			// Validate Flat Name
			var first_name = $('#first_name').val();

			if (first_name.trim() === '') {
				$('#first_name').next('.error-message').html(
					'<span class="text-danger">First Name is required</span>');

				isValid = false;
			}
			// Validate Flat Name
			var last_name = $('#last_name').val();

			if (last_name.trim() === '') {
				$('#last_name').next('.error-message').html(
					'<span class="text-danger">Last Name is required</span>');

				isValid = false;
			}
			var username = first_name + ' ' + last_name
			// Validate Flat Name
			var email = $('#email').val();

			if (email.trim() === '') {
				$('#email').next('.error-message').html(
					'<span class="text-danger">Email is required</span>');

				isValid = false;
			}
			// Validate Flat Name

			// Validate Flat Name
			var role = $('#role').val();

			if (role.trim() === '') {
				$('#role').next('.error-message').html(
					'<span class="text-danger">Role is required</span>');

				isValid = false;
			}


			// Add more validation checks for other fields if needed

			// If any validation fails, do not proceed with form submission
			if (!isValid) {
				return;
			}

			// Serialize form data
			var formData = $(this).serialize();


			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>user',
				data: formData,
				success: function(response) {
					// Handle successful submission (you can redirect or show a success message)
					swal("User Registered!", username + " registered Successfully!", "success");


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