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
								<label for="flatNameInput">Flat Name</label>
								<input type="text" name="flat_name" class="form-control form-control-user" id="flatNameInput" aria-describedby="flatNameHelp" placeholder="Enter Flat Name...">
								<span class="error-message"></span>
								<?php echo form_error('flat_name', '<span class="error">', '</span>'); ?><span class="error-message"></span>

							</div>

							<div class="form-group col-md-6">
								<label for="benefitsCheckbox">Flat Type</label>
								<select class="form-select <?php echo form_error('flat_type') ? 'is-invalid' : ''; ?>" id="flat_type" name="flat_type">
									<option value="">Select Type</option>
									<option value="1" <?php echo set_select('flat_type', '1', isset($flat_type) && $flat_type == '1'); ?>>
										Luxury
									</option>
									<option value="2" <?php echo set_select('flat_type', '2', isset($flat_type) && $flat_type == '2'); ?>>
										Simple
									</option>
								</select>
								<?php echo form_error('flat_type', '<span class="error">', '</span>'); ?><span class="error-message"></span>
							</div>
							<div class="form-group col-md-6">
								<label for="Tower">Tower</label>

								<select class="form-select" id="tower" name="tower">
									<option value="">Select Tower</option>
									<option value="1" <?php echo set_select('tower', '1', isset($tower) && $tower == '1'); ?>>
										Luxury</option>
									<option value="2" <?php echo set_select('tower', '2', isset($tower) && $tower == '2'); ?>>
										Simple</option>

								</select>
								<?php echo form_error('type', '<span class="error">', '</span>'); ?><span class="error-message"></span>
							</div>
							<div class="form-group col-md-6">
								<label for="Status">Status</label>

								<select class="form-select" id="status" name="status">
									<option value="">Select Status</option>
									<option value="1" <?php echo set_select('status', '1', isset($status) && $status == '1'); ?>>
										Vacant</option>
									<option value="2" <?php echo set_select('status', '2', isset($status) && $status == '2'); ?>>
										Hired</option>

								</select>
								<?php echo form_error('type', '<span class="error">', '</span>'); ?><span class="error-message"></span>
							</div>
							<div class="form-group col-md-6">
								<label for="Owner">Owner</label>

								<select class="form-select" id="owner" name="owner">
									<option value="">Select Owner</option>
									<option value="1" <?php echo set_select('owner', '1', isset($owner) && $owner == '1'); ?>>
										User1</option>
									<option value="2" <?php echo set_select('owner', '2', isset($owner) && $owner == '2'); ?>>
										User2</option>

								</select>
								<?php echo form_error('type', '<span class="error">', '</span>'); ?><span class="error-message"></span>
							</div>
							<div class="form-group col-md-6">
								<label for="exampleInputRent">Rent</label>
								<input type="text" name="rent" class="form-control form-control-user" id="rent" placeholder="Rent">
								<?php echo form_error('rent', '<span class="error">', '</span>'); ?>
								<span class="error-message"></span>
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
			var flatName = $('#flatNameInput').val();

			if (flatName.trim() === '') {
				$('#flatNameInput').next('.error-message').html(
					'<span class="text-danger">Flat Name is required</span>');

				isValid = false;
			}
			// Validate Flat Name
			var flat_type = $('#flat_type').val();

			if (flat_type.trim() === '') {
				$('#flat_type').next('.error-message').html(
					'<span class="text-danger">Flat Type is required</span>');

				isValid = false;
			}
			// Validate Flat Name
			var towerName = $('#tower').val();

			if (towerName.trim() === '') {
				$('#tower').next('.error-message').html(
					'<span class="text-danger">Tower Name is required</span>');

				isValid = false;
			}
			// Validate Flat Name
			var statusName = $('#status').val();

			if (statusName.trim() === '') {
				$('#status').next('.error-message').html(
					'<span class="text-danger">Flat Status is required</span>');

				isValid = false;
			}
			// Validate Flat Name
			var ownerName = $('#owner').val();

			if (ownerName.trim() === '') {
				$('#owner').next('.error-message').html(
					'<span class="text-danger">Flat Owner is required</span>');

				isValid = false;
			}
			// Validate Flat Name
			var rent = $('#rent').val();

			if (rent.trim() === '') {
				$('#rent').next('.error-message').html(
					'<span class="text-danger">Rent amount is required</span>');

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
				url: '<?php echo base_url(); ?>book_flat',
				data: formData,
				success: function(response) {
					// Handle successful submission (you can redirect or show a success message)
					swal("Flat Registered!", "Flat Registered Successfully!", "success");


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