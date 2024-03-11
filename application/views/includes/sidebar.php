<style>
.error-message {
    color: red;
}

.collapse-item:hover {
    cursor: pointer;
}

#edit {
    cursor: pointer;
    background-color: greenyellow;
    color: black;
    border-radius: 5px;
    padding: 5px;
    font-weight: 600;
}

#delete {
    cursor: pointer;
    background-color: red;
    color: white;
    border-radius: 5px;
    padding: 5px;
    font-weight: 600;
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
    <!-- <li class="nav-item">
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
    </li> -->

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <?php


		if ($_SESSION['role'] !=  '3' && $_SESSION['role'] != '5') {
		?>

        <!-- <a class="collapse-item" href="user">User Register</a> -->
        <a class="nav-link collapsed" onclick="loadModule('user_ajax')" href="#" data-toggle="collapse"
            data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">User Register</a>
        <a class="nav-link collapsed" onclick="loadModule('register_flat_ajax')" href="#" data-toggle="collapse"
            data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">Flat Register</a>
        <a class="nav-link collapsed" onclick="loadModule('book_tower_ajax')" href="#" data-toggle="collapse"
            data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">Tower Register</a>
        <a class="nav-link collapsed" onclick="loadModule('reports_ajax')" href="#" data-toggle="collapse"
            data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">Reports</a>
        <!-- <a class="collapse-item" onclick="loadModule('register_flat_ajax')"> Flat Register</a>
            <a class="collapse-item" onclick="loadModule('book_tower_ajax')"> Tower Register</a> -->



        <?php
			if ($_SESSION['role'] == '1') { ?>
        <a class="nav-link collapsed" onclick="loadModule('employees_ajax')" href="#" data-toggle="collapse"
            data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">Employees</a>
        <!-- <a class="collapse-item" onclick="loadModule('employees_ajax')">Employees</a> -->
        <?php }
		} else { ?>

        <a class="nav-link collapsed" onclick="loadModule('book_flat_ajax')" href="#" data-toggle="collapse"
            data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">Book Flat</a>
        <a class="nav-link collapsed" onclick="loadModule('invoice_ajax')" href="#" data-toggle="collapse"
            data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">Invoice</a>
        <!-- <a class="collapse-item" onclick="loadModule('book_flat_ajax')">Book Flat</a> -->
        <?php }
		?>
        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>

        </a> -->
        <!-- <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div> -->
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Modules:</h6>
                <?php


				if ($_SESSION['role'] !=  '3' && $_SESSION['role'] != '5') {
				?>

                    <!-- <a class="collapse-item" href="user">User Register</a> 
                    <a class="collapse-item" onclick="loadModule('user_ajax')">User Register</a>
                    <a class="collapse-item" onclick="loadModule('register_flat_ajax')"> Flat Register</a>
                    <a class="collapse-item" onclick="loadModule('book_tower_ajax')"> Tower Register</a>



                    <?php
					if ($_SESSION['role'] == '1') { ?>
                        <a class="collapse-item" onclick="loadModule('employees_ajax')">Employees</a>
                    <?php }
				} else { ?>

                    <a class="collapse-item" onclick="loadModule('book_flat_ajax')">Book Flat</a>
                <?php }
				?>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>-->

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> -->

    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src=<?php echo base_url("assets/img/undraw_rocket.svg") ?> alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features,
            components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to
            Pro!</a>
    </div> -->
</ul>

<div class="modal fade" id="flatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Book This Flat</h5>
                <input type='hidden' name='booking_id' id='booking_id'>
                <input type='hidden' name='booker_name' id='booker_name'>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- Use a placeholder element to dynamically set the modal content -->
            <div class="modal-body" id="flatmodalContent"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" id="flatBookButton" href="#">Book</a>
            </div>
        </div>
    </div>
</div>
<script>
var ajaxUrl = '<?php echo AURL; ?>';
// Show loader when an AJAX request starts

// Use jQuery to attach an event listener to the form
$(document).ready(function() {
    // Event listener for the popstate event
    let route_selected = localStorage.getItem('route_selected');
    if (route_selected) {
        if (route_selected == 'user_edit_ajax') {
            let user_data = localStorage.getItem('user_data');
            user_edit_ajax(JSON.parse(user_data))
        }
        loadModule(route_selected)
    }
    if (!route_selected || route_selected == '' || route_selected == null) {
        loadModule('main_ajax')
    }

});




$('#flatBookButton').on('click', function() {
    // Add your custom function logic here
    console.log('Logout button clicked for element with ID:', $('#booking_id').val());
    var booking_id = $('#booking_id').val();
    var userName = $('#booker_name').val();
    // Close the modal	
    bookFlat(booking_id, userName)
    // $('#flatModal').modal('hide');
});

function bookFlat(booking_id, userName) {
    $('#flatModal').modal('hide');

    var formData = {
        flatId: booking_id,
        userId: userName,
    }
    $.ajax({
        type: 'POST',
        url: ajaxUrl + 'register_flat',
        data: formData,
        success: function(response) {
            // Handle successful submission (you can redirect or show a success message)
            swal("Flat Registered!", "Flat Registered Successfully!", "success");
            loadModule('book_flat_ajax')

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
}
// $('.select-flat').on('click', function() {

//     // Use the 'this' keyword to reference the clicked element

//     if ($(this).hasClass('flat')) {
//         // Use the 'this' keyword to reference the clicked element
//         clickedElementId = $(this).attr('id');
//         var faltName = $(this).attr('data-name');

//         var price = $(this).attr('data-price');

//         // Set the modal content dynamically
//         $('#flatmodalContent').text('Do You want to book flat: ' + faltName + ' of rent :' +
//             price);

//         // Show the modal
//         $('#flatModal').modal('show');
//     }
// });



function employee_type(val) {
    switch (val) {
        case 1:
            return 'Admin';
            // code block to execute if expression matches value1
            break;
        case 2:
            return 'Manager';
            // code block to execute if expression matches value1
            break;
        case 3:
            return 'Customer';
            // code block to execute if expression matches value1
            break;
        case 4:
            return 'Manager';
            // code block to execute if expression matches value1
            break;
        case 4:
            return 'Employee';
            // code block to execute if expression matches value1
            break;
        default:
            return 'Employee';
    }
}
</script>













<!-- End of Sidebar -->