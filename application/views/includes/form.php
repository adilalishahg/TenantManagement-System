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
								<label for="exampleInputEmail">Flat Area</label>
								<input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
								<?php echo form_error('email', '<span class="error">', '</span>'); ?>
							</div>
							<div class="form-group col-md-6">
								<label for="exampleInputPassword">Standard</label>
								<input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
								<?php echo form_error('password', '<span class="error">', '</span>'); ?>
							</div>
							<!-- </div> -->
							<!-- <div class="form-row"> -->
							<div class="form-group col-md-6">
								<label for="exampleInputEmail">Location</label>
								<input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
								<?php echo form_error('email', '<span class="error">', '</span>'); ?>
							</div>
							<div class="form-group col-md-6">
								<label for="exampleInputPassword">Description</label>
								<input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
								<?php echo form_error('password', '<span class="error">', '</span>'); ?>
							</div>
							<!-- </div> -->
							<!-- <div class="form-row"> -->
							<div class="form-group col-md-6">
								<label for="benefitsCheckbox">Benefits</label>

								<select class="form-select" id="role" name="role">
									<option value="">Select Role</option>
									<option value="1" <?php echo set_select('role', '1', isset($role) && $role == '1'); ?>>
										Admin</option>
									<option value="2" <?php echo set_select('role', '2', isset($role) && $role == '2'); ?>>
										Manager</option>
									<option value="3" <?php echo set_select('role', '3', isset($role) && $role == '3'); ?>>
										User</option>
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