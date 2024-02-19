function book_flat_ajax(data) {
	const flats = data.data.flats;
	const current_user = data.data.current_user;

	var response = "";
	if (Array.isArray(flats)) {
		flats.forEach((element) => {
			console.log(element);
			flat_stat = "Normal";
			book_stat = "Available";
			if (element.type === "A") {
				flat_stat = "Luxuary";
			}
			if (element.status !== "1") {
				book_stat = "Booked";
			}
			response +=
				`
						<div class="col-xl-4 col-md-6 mb-4 " id="flat_` +
				element.flat_id +
				`">
                            <div class="card border-left-primary shadow h-100 py-4">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                ` +
				flat_stat +
				` Flat</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">RS- ` +
				element.rent +
				` </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                             ` +
				book_stat +
				` </div>
                                        </div>
                                        <div class="col-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Book Now">
                                            <!-- -->
                                            <button id="flat_5" onclick = "selectFlatPopUp('` +
				element.flat_id +
				`','` +
				flat_stat +
				`','` +
				element.rent +
				`','` +
				current_user +
				`')" type="button" class="select-flat flat btn btn-primary btn-sm rounded-circle tooltip-content" data-toggle="modal" data-name="` +
				flat_stat +
				` Flat" data-price="` +
				element.rent +
				`" data-user="` +
				current_user +
				`">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </button>
                                            <!-- <i class="fa-brands fa-flickr"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
		`;
			// flattened = flattened.concat(flattenArray(element));
		});
	}

	$(".row").removeClass("h-100");
	$(".row").html("");
	$(".row").html(response);
}

function preventFormFlat(route_name = "register_flat_ajax") {
	// Your validation or processing logic goes here
	// Gather form data
	let button = true;

	var form = document.querySelector("form");

	// form.addEventListener('submit', function(event) {
	//     // Your custom logic to prevent form submission
	//     console.log(event)
	//     event.preventDefault(); // This line prevents the default form submission behavior
	// });
	$("#cancel").click(function () {
		document.getElementById("book_flat_form").reset();
		$(".error-message").html("");
		return false;
	});
	// alert('asd')
	var formData = $("#book_flat_form").serialize();

	var ret = true;
	if ($("#flatNameInput").val() === "") {
		$("#flat_name_error").text("Flat Name cannot be empty");
		ret = false;
	} else {
		$("#flat_name_error").text("");
	}
	if ($("#flat_type").val() === "") {
		$("#flat_type_error").text("Please Select Flat Type");
		ret = false;
	} else {
		$("#flat_type_error").text("");
	}
	if ($("#status").val() === "") {
		$("#status_error").text("Please Select status");
		ret = false;
	} else {
		$("#status_error").text("");
	}
	if ($("#tower").val() === "") {
		ret = false;
		$("#tower_error").text("Please Select Tower");
	} else {
		$("#tower_error").text("");
	}
	if ($("#owner").val() === "") {
		ret = false;
		$("#owner_error").text("Please Select Owner");
	} else {
		$("#owner_error").text("");
	}
	if ($("#rent").val() === "") {
		ret = false;
		$("#rent_error").text("Please Enter Rent ");
	} else {
		$("#rent_error").text("");
	}
	// if (!ret) {
	// }

	// if (flat_type.trim() === "") {
	// 	$("#flat_type_error").text("Flat Type cannot be empty");
	// 	return false; // Prevent form submission
	// }
	// console.log(flatName)
	// Ajax POST request
	$.ajax({
		type: "POST",
		url: ajaxUrl + route_name, // Replace with your server endpoint
		data: formData,
		success: function (response) {
			let res = JSON.parse(response);
			// Handle the success response
			if (res.status == "error") {
				showError(res.errors);
			}
			if (res.status == "success") {
				swal(res.message + "!", res.message, "success");
				document.getElementById("book_flat_form").reset();
			}
		},
		error: function (error) {
			// Handle the error
			console.log("Ajax request failed");
			console.log(error);
		},
	});

	// Returning false prevents the form from submitting
	return false;
}
function get_flats_ajax(data) {
	let row = data.data.flats;
	console.log(data);
	let rows = "";
	row.forEach((user, index) => {
		// owner_options +=
		// 	`<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`
		var role_user = user.type == "A" ? "Luxuary" : "Normal";
		var status = user.status == 1 ? "Vacant" : "Booked";
		console.log(role_user);
		rows +=
			`<tr>` +
			`<td>` +
			(index + 1) +
			`</td> ` +
			`<td>` +
			user.flat_name +
			`</td> ` +
			`<td>` +
			user.rent +
			`</td> ` +
			`<td>` +
			status +
			`</td> ` +
			`<td>` +
			role_user +
			`</td> ` +
			`<td>` +
			user.tower_name +
			`</td> ` +
			`<td><a class='btn btn-info'  onclick="return edit_flat('edit_flat_ajax',` +
			user.flat_id +
			`)">Edit</a> <a class='btn btn-danger'  onclick="delete_flat(` +
			user.flat_id +
			`)">Delete</a></td> ` +
			`</tr>`;
		// console.log(user)
	});
	console.log(rows);
	var response =
		`<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Flats </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Rent</th>
                                            <th>Status</th>
                                            <th>Flat Type</th>
                                            <th>Tower</th>
                                            <th>option</th>
                                             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Rent</th>
                                            <th>Status</th>
                                            <th>Flat Type</th>
                                            <th>Tower</th>
                                            <th>option</th>
                                             
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       ` +
		rows +
		`
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div> `;
	$(".user_dash").html("");
	$(".user_dash").html(response);

	// Initialize DataTable after adding the HTML to the DOM
	$(document).ready(function () {
		$("#dataTable").DataTable();
	});
}
function selectFlatPopUp(id, status, rent, user) {
	var flatName = $("flat_" + id).data("name");
	var selectedFlatFromPopUp = id;
	var price = $(this).attr("data-price");
	$("#booking_id").val(selectedFlatFromPopUp);
	$("#booker_name").val(user);
	// Set the modal content dynamically
	$("#flatmodalContent").text(
		"Do You want to book flat: " + status + " of rent :" + rent
	);

	// Show the modal
	$("#flatModal").modal("show");
}

function load_flat(data, value = "") {
	var { users, towers } = data;

	let owner_options = (tower_options = "");
	users.forEach((user) => {
		owner_options += `<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`;
	});
	towers.forEach((tower) => {
		tower_options += `<option value="${tower.id}">${tower.tower_name} </option>`;
	});
	var select_owner = select("owner", owner_options);
	var select_tower = select("tower", tower_options);

	var response = flat_html(select_tower, select_owner, data);

	$(".user_dash").html("");
	$(".user_dash").html(response);
}
function flat_html(
	select_tower = "",
	select_owner = "",
	data = "",
	route = "register_flat_ajax"
) {
	let flat_id = data?.flat_id || "false";
	let flat_name = data?.flat_name || "";
	let type = data?.type || "";
	let rent = data?.rent || "";
	let status = data?.status || "";

	return (
		`<div class="card o-hidden border-0 shadow-lg my-5">
	<div class="card-body p-0">
	<!-- Nested Row within Card Body -->
	<div class="row">
		<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
		<div class="col-lg-12">
			<div class="p-5">
				<form class="user" method="post" id="book_flat_form"  onsubmit="return preventFormFlat('register_flat_ajax')">
					<div class="form-row">

						<div class="form-group col-md-6">
							<label for="flatNameInput">Flat Name</label>
							<input type="text" name="flat_name" class="form-control form-control-user" id="flatNameInput" value="${flat_name}" aria-describedby="flatNameHelp" placeholder="Enter Flat Name...">
							<input type="hidden" name="flat_id" value="${flat_id}">
							<span class="error-message" id ="flat_name_error"></span>
						  </div>

						<div class="form-group col-md-6">
							<label for="benefitsCheckbox">Flat Type</label>
							<select class="form-select  id="flat_type" name="flat_type">
								<option value="">Select Type</option>
								<option value="1"   selected="${status == "A" ? "selected" : ""}">
									Luxury
								</option>
								<option value="2"  selected="${status != "A" ? "selected" : ""}">
									Simple
								</option>
							</select><span class="error-message" id ="flat_type_error"></span>
						  </div>
						<div class="form-group col-md-6" id='tower_div'>
						` +
		select_tower +
		`
						</div>
						<div class="form-group col-md-6">
							<label for="Status">Status</label>

							<select class="form-select" id="status" name="status">
								<option value="">Select Status</option>
								<option value="1"    selected="${status == "1" ? "selected" : ""}">
									Vacant</option>
								<option value="2"  selected="${status == "2" ? "selected" : ""}">
									Hired</option>

							</select><span class="error-message" id ="status_error"></span>
						  </div>
						<div class="form-group col-md-6" id='owner_div'>
							` +
		select_owner +
		`
						  </div>
						<div class="form-group col-md-6">
							<label for="exampleInputRent">Rent</label>
							<input type="text" value="${rent}" name="rent" class="form-control form-control-user" id="rent" placeholder="Rent">
							  <span class="error-message" id ="rent_error"></span>
						</div>
					</div>

					<div class="form-row">
						` +
		button("save", "primary", "Save") +
		button("cancel", "danger", "Cancel") +
		`
						 
					</div>
				</form>
				<hr>
			</div>
		</div>
	</div>
	</div>
	</div>`
	);
	response += `</div> `;
}
function edit_flat(route, id) {
	$(".loader").show();
	console.log(route);

	// localStorage.setItem("route_selected", val);

	$.post(route, { id: id }, function (data1, status) {
		$(".loader").hide();
		const headingElement = document.querySelector(
			".h3.mb-0.text-gray-800.route_heading"
		);
		let flatEl = document.querySelector(
			".h3.mb-0.text-gray-800.user_dashboard"
		);
		if (headingElement) {
			console.log("headingElement");
			headingElement.textContent = "Edit Flat";
		}
		if (flatEl) {
			console.log("flatEl");
			flatEl.textContent = "Edit Flat";
		}
		let tower_options = "";
		let owner_options = "";
		let data = JSON.parse(data1);
		data.user_list.forEach((user) => {
			let selected = user.user_id == data.flats.owner_id ? "selected" : "";
			owner_options += `<option value="${user.user_id}" ${selected}>${user.first_name} ${user.last_name} </option>`;
		});

		data.towers_list.forEach((tower) => {
			let selected = tower.id === data.flats.tower_id ? "selected" : "";
			tower_options += `<option value="${tower.id}" ${selected}>${tower.tower_name} </option>`;
		});
		var select_owner = select("owner", owner_options);
		var select_tower = select("tower", tower_options);
		let response = flat_html(
			select_owner,
			select_tower,
			data.flats,
			"update_flat_ajax"
		);

		$(".user_dash").html("");
		$(".user_dash").html(response);
	});
}
function delete_flat(id) {
	$(".loader").show();
	$.post("delete_flat_ajax", { del_id: id }, function (data, status) {
		$(".loader").hide();
		let data1 = JSON.parse(data);
		console.log(data1);
		if (data1.status == "error") {
			showError(data1.errors);
		}
		if (data1.status == "success") {
			swal(data1.message + "!", data1.message, "success");
		}
		// $(".user_dash").html("");
		get_flats_ajax(data1);
	});
}
