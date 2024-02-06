<style>
	.error-message {
		color: red;
	}

	.collapse-item:hover {
		cursor: pointer;
	}
</style>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#" onclick="loadModule('main_ajax')">
		<div class="sidebar-brand-icon rotate-n-15">
			<!-- <i class="fas fa-laugh-wink"></i> -->
			<i class="fas  fa-building"></i>
		</div>
		<div class="sidebar-brand-text mx-3">R.M.S <sup>*</sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<!-- <a class="nav-link" href="<?php echo base_url(); ?>"> -->
		<a class="nav-link" href="#" onclick="loadModule('main_ajax')">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Interface
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-fw fa-cog"></i>
			<span>Components</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Custom Components:</h6>
				<a class="collapse-item" href="buttons.html">Buttons</a>
				<a class="collapse-item" href="cards.html">Cards</a>
			</div>
		</div>
	</li>

	<!-- Nav Item - Utilities Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Utilities</span>
		</a>
		<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Custom Utilities:</h6>
				<a class="collapse-item" href="utilities-color.html">Colors</a>
				<a class="collapse-item" href="utilities-border.html">Borders</a>
				<a class="collapse-item" href="utilities-animation.html">Animations</a>
				<a class="collapse-item" href="utilities-other.html">Other</a>
			</div>
		</div>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Addons
	</div>
	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
			<i class="fas fa-fw fa-folder"></i>
			<span>Pages</span>
		</a>
		<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Modules:</h6>
				<?php if ($_SESSION['role'] !=  '3' && $_SESSION['role'] != '5') {
				?>

					<!-- <a class="collapse-item" href="user">User Register</a> -->
					<a class="collapse-item" onclick="loadModule('user_ajax')">User Register</a>
					<a class="collapse-item" onclick="loadModule('book_flat_ajax')"> Flat Register</a>
					<a class="collapse-item" onclick="loadModule('book_tower_ajax')"> Tower Register</a>
					<a class="collapse-item" onclick="loadModule('employees_ajax')"> Employees</a>


				<?php } else { ?>

					<a class="collapse-item" href="register_flat">Register Flat</a>
				<?php }
				?>
				<a class="collapse-item" href="forgot-password.html">Forgot Password</a>
				<div class="collapse-divider"></div>
				<h6 class="collapse-header">Other Pages:</h6>
				<a class="collapse-item" href="404.html">404 Page</a>
				<a class="collapse-item" href="blank.html">Blank Page</a>
			</div>
		</div>
	</li>

	<!-- Nav Item - Charts -->
	<li class="nav-item">
		<a class="nav-link" href="charts.html">
			<i class="fas fa-fw fa-chart-area"></i>
			<span>Charts</span></a>
	</li>

	<!-- Nav Item - Tables -->
	<li class="nav-item">
		<a class="nav-link" href="tables.html">
			<i class="fas fa-fw fa-table"></i>
			<span>Tables</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

	<!-- Sidebar Message -->
	<div class="sidebar-card d-none d-lg-flex">
		<img class="sidebar-card-illustration mb-2" src=<?php echo base_url("assets/img/undraw_rocket.svg") ?> alt="...">
		<p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features,
			components, and more!</p>
		<a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to
			Pro!</a>
	</div>
</ul>
<script>
	// Use jQuery to attach an event listener to the form
	let route_selected = localStorage.getItem('route_selected');
	$(document).ready(function() {
		console.log(route_selected)
		if (route_selected) {
			loadModule(route_selected)
		}
		if (!route_selected || route_selected == '' || route_selected == null) {
			loadModule('main_ajax')
		}

	});


	function showError(errors) {
		Object.keys(errors).forEach(key => {
			if (errors[key] !== undefined) {
				console.log(key)
				$("#" + key + "_error").text(errors[key]);
			} else {
				$("#" + key + "_error").text("");
			}
			// console.log(`${key}: ${errors[key]}`);
		});

	}

	function preventFormUser(e) {

		var form = document.querySelector('form');
		$('#cancel').click(function() {
			document.getElementById("book_user_form_new").reset();
			$('.error-message').html('')
			return false;
		})
		const url = ("<?php echo AURL; ?>user_ajax")
		var formData = $('#book_user_form_new').serialize();
		$.ajax({
			type: "POST",
			url: url, // Replace with your server endpoint
			data: formData,
			success: function(response) {
				let res = JSON.parse(response);
				// Handle the success response 
				if (res.status == 'error') {
					// console.log(res)
					showError(res.errors)
				}
				if (res.status == 'success') {
					swal(res.message + "!", res.message, "success");
					document.getElementById("book_tower_form").reset();

				}

			},
			error: function(error) {
				// Handle the error
				console.log("Ajax request failed");
				console.log(error);
			}
		});
		return false
	}

	function preventFormTower(e) {
		var form = document.querySelector('form');
		$('#cancel').click(function() {
			document.getElementById("book_tower_form").reset();
			$('.error-message').html('')
			return false;
		})
		var formData = $('#book_tower_form').serialize();
		console.log(formData)
		if ($("#tower").val().trim() === "") {
			$("#tower_error").text("Tower Name cannot be empty");
			ret = false;

		} else {
			$("#tower_error").text("");

		}
		$.ajax({
			type: "POST",
			url: "<?php echo AURL; ?>book_tower_ajax", // Replace with your server endpoint
			data: formData,
			success: function(response) {
				let res = JSON.parse(response);
				// Handle the success response 
				if (res.status == 'error') {
					showError(res.errors)
				}
				if (res.status == 'success') {
					swal(res.message + "!", res.message, "success");
					document.getElementById("book_tower_form").reset();

				}

			},
			error: function(error) {
				// Handle the error
				console.log("Ajax request failed");
				console.log(error);
			}
		});

		// Returning false prevents the form from submitting
		return false;
	}

	function preventFormFlat(e) {
		// Your validation or processing logic goes here
		// Gather form data
		let button = true;

		var form = document.querySelector('form');

		// form.addEventListener('submit', function(event) {
		//     // Your custom logic to prevent form submission
		//     console.log(event)
		//     event.preventDefault(); // This line prevents the default form submission behavior
		// });
		$('#cancel').click(function() {
			document.getElementById("book_flat_form").reset();
			$('.error-message').html('')
			return false;
		})
		// alert('asd')
		var formData = $('#book_flat_form').serialize();
		console.log(formData)
		var ret = true;
		if ($("#flatNameInput").val().trim() === "") {
			$("#flat_name_error").text("Flat Name cannot be empty");
			ret = false;

		} else {
			$("#flat_name_error").text("");

		}
		if ($("#flat_type").val().trim() === "") {
			$("#flat_type_error").text("Please Select Flat Type");
			ret = false;

		} else {
			$("#flat_type_error").text("");

		}
		if ($("#status").val().trim() === "") {
			$("#status_error").text("Please Select status");
			ret = false;

		} else {
			$("#status_error").text("");

		}
		if ($("#tower").val().trim() === "") {
			ret = false;
			$("#tower_error").text("Please Select Tower");

		} else {
			$("#tower_error").text("");

		}
		if ($("#owner").val().trim() === "") {
			ret = false;
			$("#owner_error").text("Please Select Owner");

		} else {
			$("#owner_error").text("");

		}
		if ($("#rent").val().trim() === "") {
			ret = false;
			$("#rent_error").text("Please Enter Rent ");

		} else {
			$("#rent_error").text("");

		}

		// if (!ret) {
		// 	return false;
		// }

		// if (flat_type.trim() === "") {
		// 	$("#flat_type_error").text("Flat Type cannot be empty");
		// 	return false; // Prevent form submission
		// }
		// console.log(flatName)
		// Ajax POST request
		$.ajax({
			type: "POST",
			url: "book_flat_ajax", // Replace with your server endpoint
			data: formData,
			success: function(response) {
				let res = JSON.parse(response);
				// Handle the success response 
				if (res.status == 'error') {
					showError(res.errors)
				}
				if (res.status == 'success') {
					swal(res.message + "!", res.message, "success");
					document.getElementById("book_flat_form").reset();

				}

			},
			error: function(error) {
				// Handle the error
				console.log("Ajax request failed");
				console.log(error);
			}
		});

		// Returning false prevents the form from submitting
		return false;
	}


	function button(value, btn, name) {
		return `<div class="form-group col-md-6">
					<button name="submit"   id="` + value + `" value="` + value + `" class="btn btn-` + btn + ` btn-user btn-block ">
						` + name + `
					</button>
				</div>
						`;
	}


	function capitalizeFirstLetter(str) {
		return str.replace(/\b\w/g, function(match) {
			return match.toUpperCase();
		});
	}

	function select(val = '', data = '') {

		return `<label for="` + (val) + `">` + capitalizeFirstLetter(val) + `</label>
		<select class="form-select" id="` + val + `" name="` + val + `">
					<option value="">Select ` + capitalizeFirstLetter(val) + `</option>
					` + data + ` 
				</select>
				<span class="error-message"  id = "` + val + `_error"></span>`
	}

	function loadModule(val) {

		localStorage.setItem('route_selected', val)
		$.get(val, function(data, status) {
			const headingElement = document.querySelector('.h3.mb-0.text-gray-800.route_heading');
			var data = JSON.parse(data);
			if (val == 'main_ajax') {
				headingElement.textContent = 'Dashboard';
				var res_route_html = load_dashboard(data)
				console.log(res_route_html)
			} else if (val == 'book_flat_ajax') {
				headingElement.textContent = 'Book Flat';
				load_tower()
				var {
					users,
					towers
				} = data

				let owner_options = tower_options = '';
				users.forEach((user) => {
					owner_options +=
						`<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`
				})
				towers.forEach((tower) => {
					tower_options +=
						`<option value="${tower.id}">${tower.tower_name} </option>`
				})
				var select_owner = (select('owner', owner_options))
				var select_tower = (select('tower', tower_options))

				$('#owner_div').html(select_owner)
				$('#tower_div').html(select_tower)
				// console.log(select_owner)
			} else if (val == 'book_tower_ajax') {
				headingElement.textContent = 'Book Tower';
				book_tower()

				let owner_options = tower_options = '';
				data.forEach((user) => {
					owner_options +=
						`<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`
				})
				var select_owner = (select('owner', owner_options))
				// var select_tower = (select('tower', tower_options))

				$('#owner_div').html(select_owner)
				// $('#tower_div').html(select_tower)
				// console.log(select_owner)
			} else if (val == 'employees_ajax') {
				headingElement.textContent = 'Employees List';
				show_employees()

				// let owner_options = tower_options = '';
				// data.forEach((user) => {
				// 	owner_options +=
				// 		`<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`
				// })

				// var select_owner = (select('owner', owner_options))
				// // var select_tower = (select('tower', tower_options))

				// $('#owner_div').html(select_owner)
				// $('#tower_div').html(select_tower)
				// console.log(select_owner)
			} else if (val == 'user_ajax') {
				headingElement.textContent = 'User Registration';
				user_ajax()

				let owner_options = tower_options = '';
				console.log(data)
				data.users.forEach((user) => {

					owner_options +=
						`<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`
				})

				var select_owner = (select('owner', owner_options))
				// var select_tower = (select('tower', tower_options))

				$('#owner_div').html(select_owner)
				// $('#tower_div').html(select_tower)
				// console.log(select_owner)
			}
		})
	}

	function card(type = 'primary', text = '', value = '', font_awesome = '', ratio = false) {
		let conflict = ratio_resp = resp = ''
		if (!ratio) {
			conflict = '<div class="h5 mb-0 font-weight-bold text-gray-800"> ' + value + ' </div>';
		} else {
			conflict += `<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
									` + value + `
								</div>
							</div>
							<div class="col">
								<div class="progress progress-sm mr-2">
									<div class="progress-bar bg-info" role="progressbar" style="width: ` + ratio + `%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>`;
		}
		resp += `<div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-` + type + ` shadow h-100 py-2">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-` + type + ` text-uppercase mb-1">
									` + text + `</div>
									` + conflict + `
								</div>
								 
								<div class="col-auto">
									<i class="fas ` + font_awesome + ` fa-2x text-gray-300"></i>
								</div>
							</div>
						</div>
					</div>
				</div>`;
		return resp
	}

	function load_dashboard(data) {
		const booked_ratio = ' ' + data.booked + ` /` + data.total_flats + ' '
		var res_dashboard = `<div class="row">`;
		res_dashboard += card('primary', 'EARNINGS (MONTHLY)', '$' + data.year, 'fa-calendar');
		res_dashboard += card('primary', 'EARNINGS (Annual)', '$' + data.year, 'fa-calendar');
		res_dashboard += card('info', 'Booked/Total Flats', booked_ratio, 'fa-clipboard-list', data.ratio);
		res_dashboard += ` </div>`;
		$('.user_dash').html('');
		$('.user_dash').html(res_dashboard);
		console.log(res_dashboard)

	}

	function load_tower() {

		var response = `<div class="card o-hidden border-0 shadow-lg my-5">
		<div class="card-body p-0">
		<!-- Nested Row within Card Body -->
		<div class="row">
			<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
			<div class="col-lg-12">
				<div class="p-5">
					<form class="user" method="post" id="book_flat_form"  onsubmit="return preventFormFlat()">
						<div class="form-row">

							<div class="form-group col-md-6">
								<label for="flatNameInput">Flat Name</label>
								<input type="text" name="flat_name" class="form-control form-control-user" id="flatNameInput" aria-describedby="flatNameHelp" placeholder="Enter Flat Name...">
								<span class="error-message" id ="flat_name_error"></span>
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
								</select><span class="error-message" id ="flat_type_error"></span>
     						 </div>
							<div class="form-group col-md-6" id='tower_div'>
								 
							</div>
							<div class="form-group col-md-6">
								<label for="Status">Status</label>

								<select class="form-select" id="status" name="status">
									<option value="">Select Status</option>
									<option value="1" <?php echo set_select('status', '1', isset($status) && $status == '1'); ?>>
										Vacant</option>
									<option value="2" <?php echo set_select('status', '2', isset($status) && $status == '2'); ?>>
										Hired</option>

								</select><span class="error-message" id ="status_error"></span>
	  						</div>
							<div class="form-group col-md-6" id='owner_div'>

	  						</div>
							<div class="form-group col-md-6">
								<label for="exampleInputRent">Rent</label>
								<input type="text" name="rent" class="form-control form-control-user" id="rent" placeholder="Rent">
		  						<span class="error-message" id ="rent_error"></span>
							</div>
						</div>

						<div class="form-row">
							 ` + button('save', 'primary', 'Save') + button('cancel', 'danger', 'Cancel') + `
							 
						</div>
					</form>
					<hr>
				</div>
			</div>
		</div>
		</div>
		</div>`;
		response += `</div> `;
		$('.user_dash').html('');
		$('.user_dash').html(response);
	}

	function book_tower() {
		var response = `<div class="card o-hidden border-0 shadow-lg my-5">
		<div class="card-body p-0">
		<!-- Nested Row within Card Body -->
		<div class="row">
			<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
			<div class="col-lg-12">
				<div class="p-5">
					<form class="user" method="post" id="book_tower_form"  onsubmit="return preventFormTower()">
					<div class="form-row">
											<div class="form-group col-md-6">
												<label for="exampleInputEmail">Tower Name</label>
												<input type="text" name="tower" class="form-control form-control-user" id="tower" aria-describedby="tower" placeholder="Enter Tower Name...">
												<span class="error-message" id ="tower_error"></span><?php echo form_error('tower', '<span class="error">', '</span>'); ?>
											</div>
											<div class="form-group col-md-6" id='owner_div'>
											Select Owner If You're not
													<?php echo form_error('type', '<span class="error">', '</span>'); ?><span class="error-message"></span>
												</div>
										</div>
						<div class="form-row">
							 ` + button('save', 'primary', 'Save') + button('cancel', 'danger', 'Cancel') + `
						</div>
					</form>
					<hr>
				</div>
			</div>
		</div>
		</div>
		</div>`;
		response += `</div> `;




		$('.user_dash').html('');
		$('.user_dash').html(response);
	}

	function input_field(label = '', type = 'text', name = '', placeholder = 'Enter Here') {

		return `<div class="form-group col-md-6">
								<label for="flatNameInput">` + label + `</label>
								<input type="` + type + `" name="` + name + `" class="form-control form-control-user" id="` + name +
			`" aria-describedby="` + name + `Help" placeholder="` + placeholder + `">
								<span class="error-message" id ="` + name + `_error"></span>
								<?php echo form_error('first_name', '<span class="error">', '</span>'); ?><span class="error-message"></span>

							</div>`
	}

	function show_employees() {
		var response = ` <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                    	                    </tr>
                                         
                                    </tbody>
                                </table>
                            </div>`;
		$('.card-body').html('');
		$('.card-body').html(response);
	}

	function user_ajax() {
		var response = `<div class="card o-hidden border-0 shadow-lg my-5">
			<div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
					<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
					<div class="col-lg-12">
						<div class="p-5">
							<form  method='post' id="book_user_form_new"  onsubmit="return preventFormUser()">
								<div class	="form-row">
									` + input_field(label = 'First Name', type = 'text', name = 'first_name', placeholder =
				'Enter First Name...') + `
									` + input_field(label = 'Last Name', type = 'text', name = 'last_name', placeholder = 'Enter Last Name...') + `
									` + input_field(label = 'Email', type = 'email', name = 'email', placeholder = 'Enter Email...') + `
									` + input_field(label = 'Contact No:', type = 'text', name = 'contact_no', placeholder =
				'Enter Contact Number...') + `
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
										</select><span class="error-message"  id ="role_error"></span>
										<?php echo form_error('flat_type', '<span class="error">', '</span>'); ?>
									</div>` +
			input_field(label = 'Password', type = 'password', name = 'password', placeholder =
				'Enter Confirm Password...') + `` +
			input_field(label = 'Confirm Password', type = 'password', name = 'confirm_password', placeholder =
				'Enter Password...') + ` 
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
		</div>`;
		$('.user_dash').html('');



		$('.user_dash').html(response);
	}
</script>

<!-- End of Sidebar -->