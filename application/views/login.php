<?php include_once("includes/header.php"); ?>
<script>
	localStorage.removeItem("route_selected");
</script>

<body class="bg-gradient-primary">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-10 col-lg-12 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"><?php echo TITLE; ?></h1>
									</div>
									<form class="user" method="post" action="<?php echo base_url(); ?>login">
										<div class="form-group">
											<input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
											<?php echo form_error('email', '<span class="error">', '</span>'); ?>
										</div>
										<div class="form-group">
											<input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
											<?php echo form_error('password', '<span class="error">', '</span>'); ?>
										</div>
										<div class="form-group">
											<div class="custom-control custom-checkbox small">
												<input type="checkbox" name="rememberme" class="custom-control-input" id="customCheck">
												<label class="custom-control-label  pl-4" for="customCheck">Remember
													Me</label>
											</div>
										</div>
										<button href="login" name="submit" value="login" class="btn btn-primary btn-user btn-block">
											Login
										</button>
										<hr>
										<!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
									</form>
									<hr>
									<div class="text-center">
										<a class="small" href="forgot">Forgot Password?</a>
									</div>
									<div class="text-center">
										<a class="small" href="register">Create an Account!</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>
	<?php
	if (isset($userDoesNotExist)) {
		print_r($userDoesNotExist);
		print_r($error_message);
		// Your JavaScript code to show the toast
	?>
		<script>
			$(document).ready(function() {
				// Check if there is a saved remember-me token
				var rememberMeToken = $.cookie('rememberMeToken');

				if (rememberMeToken) {
					// Auto-fill the login form with saved credentials
					$('#exampleInputEmail').val(rememberMeToken.username);
					$('#exampleInputPassword').val(rememberMeToken.password);
					$('#customCheck').prop('checked', true);
				}

				// Event handler for the login button
				$('#loginButton').on('click', function() {
					var username = $('#exampleInputEmail').val();
					var password = $('#exampleInputPassword').val();
					var rememberMe = $('#customCheck').prop('checked');

					// Your login logic here (validate credentials, etc.)
					// ...

					// Save remember-me token if checkbox is checked
					if (rememberMe) {
						$.cookie('rememberMeToken', {
							username: username,
							password: password
						}, {
							expires: 7
						}); // Expires in 7 days
					} else {
						// Remove the remember-me token if checkbox is unchecked
						$.removeCookie('rememberMeToken');
					}

					// Perform the actual login logic
					// ...

					// For demonstration purposes, let's log the username and password
					console.log('Username:', username);
					console.log('Password:', password);
				});
			});
			var error_message = '<?php
									if (isset($userDoesNotExist)) {
										echo $error_message;
									}
									?>';
			console.log(error_message)
			// JavaScript code to show the toast


			document.addEventListener("DOMContentLoaded", function() {
				// Your JavaScript code here
				notification(message = error_message)
			});

			// function notification(message, duration = 2000, close = true, gravity = 'top', position = 'center',
			//     backgroundColor = 'linear-gradient(to right, #ff416c, #ff4b2b)') {
			//     Toastify({
			//         text: message,
			//         duration: duration, // Duration in milliseconds
			//         close: close,

			//         gravity: gravity, // Position: "top", "bottom", "left", "right"
			//         position: position, // Position
			within the gravity: "center", "left", "right"
			//         backgroundColor: backgroundColor, // Customize the background color
			//     }).showToast();
			// }
		</script>
	<?php
	}
	?>

	<?php include_once("includes/footer.php"); ?>