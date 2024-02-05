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
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#"
        onclick="loadModule('main_ajax')">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Modules:</h6>
                <?php if ($_SESSION['role'] !=  '3' && $_SESSION['role'] != '5') {
				?>

                <!-- <a class="collapse-item" href="user">User Register</a> -->
                <a class="collapse-item" onclick="loadModule('register_flat_ajax')">User Register</a>
                <a class="collapse-item" onclick="loadModule('book_flat_ajax')"> Flat Register</a>
                <a class="collapse-item" onclick="loadModule('book_tower_ajax')"> Tower Register</a>


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
        <img class="sidebar-card-illustration mb-2" src=<?php echo base_url("assets/img/undraw_rocket.svg") ?>
            alt="...">
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

function preventFormSubmission(e) {
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
    console.log(val)
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
					<form class="user" method="post" id="book_flat_form"  onsubmit="return preventFormSubmission()">
						<div class="form-row">

							<div class="form-group col-md-6">
								<label for="flatNameInput">Flat Name</label>
								<input type="text" name="flat_name" class="form-control form-control-user" id="flatNameInput" aria-describedby="flatNameHelp" placeholder="Enter Flat Name...">
								<span class="error-message" id ="flat_name_error"></span>
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
								</select><span class="error-message" id ="flat_type_error"></span>
								<?php echo form_error('flat_type', '<span class="error">', '</span>'); ?><span class="error-message"></span>
							</div>
							<div class="form-group col-md-6" id='tower_div'>
								 
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

								</select><span class="error-message" id ="status_error"></span>
								<?php echo form_error('type', '<span class="error">', '</span>'); ?><span class="error-message"></span>
							</div>
							<div class="form-group col-md-6" id='owner_div'>
							
								<?php echo form_error('type', '<span class="error">', '</span>'); ?><span class="error-message"></span>
							</div>
							<div class="form-group col-md-6">
								<label for="exampleInputRent">Rent</label>
								<input type="text" name="rent" class="form-control form-control-user" id="rent" placeholder="Rent">
								<?php echo form_error('rent', '<span class="error">', '</span>'); ?>
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
</script>

<!-- End of Sidebar -->