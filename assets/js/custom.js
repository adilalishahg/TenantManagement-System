function notification(
	message,
	duration = 2000,
	close = true,
	gravity = "top",
	position = "center",
	backgroundColor = "linear-gradient(to right, #ff416c,#ff4b2b)"
) {
	Toastify({
		text: message,
		duration: duration,
		close: close,
		gravity: gravity,
		position: position,
		backgroundColor: backgroundColor,
	}).showToast();
}

function select(val = "", data = "") {
	return (
		`<label for="` +
		val +
		`">` +
		capitalizeFirstLetter(val) +
		`</label>
		<select class="form-select" id="` +
		val +
		`" name="` +
		val +
		`">
					<option value="">Select ` +
		capitalizeFirstLetter(val) +
		`</option>
					` +
		data +
		` 
				</select>
				<span class="error-message"  id = "` +
		val +
		`_error"></span>`
	);
}

function input_field(
	label = "",
	type = "text",
	name = "",
	placeholder = "Enter Here",
	value = ""
) {
	return (
		`<div class="form-group col-md-6">
								<label for="flatNameInput">` +
		label +
		`</label>
								<input type="` +
		type +
		`" name="` +
		name +
		`"  value="` +
		value +
		`" class="form-control form-control-user" id="` +
		name +
		`" aria-describedby="` +
		name +
		`Help" placeholder="` +
		placeholder +
		`">
								<span class="error-message" id ="` +
		name +
		`_error"></span>
							 <span class="error-message"></span>

							</div>`
	);
}

function card(
	type = "primary",
	text = "",
	value = "",
	font_awesome = "",
	ratio = false
) {
	let conflict = (ratio_resp = resp = "");
	if (!ratio) {
		conflict =
			'<div class="h5 mb-0 font-weight-bold text-gray-800"> ' +
			value +
			" </div>";
	} else {
		conflict +=
			`<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
									` +
			value +
			`
								</div>
							</div>
							<div class="col">
								<div class="progress progress-sm mr-2">
									<div class="progress-bar bg-info" role="progressbar" style="width: ` +
			ratio +
			`%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>`;
	}
	resp +=
		`<div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-` +
		type +
		` shadow h-100 py-2">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-` +
		type +
		` text-uppercase mb-1">
									` +
		text +
		`</div>
									` +
		conflict +
		`
								</div>
								 
								<div class="col-auto">
									<i class="fas ` +
		font_awesome +
		` fa-2x text-gray-300"></i>
								</div>
							</div>
						</div>
					</div>
				</div>`;
	return resp;
}

function button(value, btn, name) {
	return (
		`<div class="form-group col-md-6">
					<button name="submit"   id="` +
		value +
		`" value="` +
		value +
		`" class="btn btn-` +
		btn +
		` btn-user btn-block ">
						` +
		name +
		`
					</button>
				</div>
						`
	);
}

function capitalizeFirstLetter(str) {
	return str.replace(/\b\w/g, function (match) {
		return match.toUpperCase();
	});
}
function showError(errors) {
	Object.keys(errors).forEach((key) => {
		if (errors[key] !== undefined) {
			console.log(key);
			$("#" + key + "_error").text(errors[key]);
		} else {
			$("#" + key + "_error").text("");
		}
		// console.log(`${key}: ${errors[key]}`);
	});
}
function checkTimeDifference(time) {
	var currentTimestamp = Date.now();
	var oneHourInMilliseconds = 3600 * 1000;
	var timeDifference = currentTimestamp - time;
	var isOneHourPassed = timeDifference >= oneHourInMilliseconds;
	console.log(timeDifference);
	if (isOneHourPassed) {
		localStorage.removeItem("route_selected");
		localStorage.removeItem("login_time");
		$.get("logout_ajax", function (data, status) {
			if (data) {
				window.location.href = "login";
			}
		});
	} else {
		localStorage.setItem("login_time", Date.now());
	}
}
function loadModule(val) {
	remove_empty_message_classes();
	$(".loader").show();

	localStorage.setItem("route_selected", val);
	let loginTime = localStorage.getItem("login_time");
	if (loginTime) {
		checkTimeDifference(loginTime);
	} else {
		localStorage.setItem("login_time", Date.now());
	} 
	$.get(val, function (data, status) {
		$(".loader").hide();
		const headingElement = document.querySelector(
			".h3.mb-0.text-gray-800.route_heading"
		);
		let flatEl = document.querySelector(
			".h3.mb-0.text-gray-800.user_dashboard"
		);
		var data = JSON.parse(data);
		
		if (val == "main_ajax") {
			if (headingElement) {
				console.log("headingElement");
				headingElement.textContent = "Dashboard";
				var res_route_html = load_dashboard(data);
			}
			if (flatEl) {
				console.log("flatEl");
				flatEl.textContent = "Dashboard";
				var res_route_html = load_user_dashboard(data);
			}
		} else if (val == "register_flat_ajax") {
			headingElement.textContent = "Book Flat";
			load_flat(data);
		}else if (val == "reports_ajax") {
			headingElement.textContent = "Reports";
			load_reports(data);
		} else if (val == "book_tower_ajax") {
			headingElement.textContent = "Book Tower";
			book_tower(data);

			// $('#tower_div').html(select_tower)
		} else if (val == "get_flats_ajax") {
			if (flatEl) {
				flatEl.textContent = "Flats";
			} else {
				headingElement.textContent = "Flats";
			}
			get_flats_ajax(data);
		} else if (val == "invoice_ajax") {
			if (flatEl) {
				flatEl.textContent = "Invoice";
			} else {
				headingElement.textContent = "Invoice";
			}
			 
			testing_invoice_ajax(data);
		} else if (val == "get_all_flats_ajax") {
			if (flatEl) {
				flatEl.textContent = " All Flats";
			} else {
				headingElement.textContent = " All Flats";
			}
			get_all_flats_ajax(data);
		} else if (val == "get_towers_ajax") {
			if (flatEl) {
				flatEl.textContent = "Towers";
			} else {
				headingElement.textContent = "Towers";
			}
			get_towers_ajax(data);
		} else if (val == "get_all_towers_ajax") {
			if (flatEl) {
				flatEl.textContent = "All Towers";
			} else {
				headingElement.textContent = "All Towers";
			}
			get_towers_ajax(data);
		} else if (val == "profile_ajax") {
			if (flatEl) {
				flatEl.textContent = "Profile";
			} else {
				headingElement.textContent = "Profile";
			}
			profile_ajax(data);
			localStorage.setItem("route_selected", val);
			// let owner_options = (tower_options = "");
			// data.forEach((user) => {
			// 	owner_options += `<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`;
			// });
			// var select_owner = select("owner", owner_options);
			// // var select_tower = (select('tower', tower_options))

			// $("#owner_div").html(select_owner);
			// $('#tower_div').html(select_tower)
			// console.log(select_owner)
		} else if (val == "employees_ajax") {
			headingElement.textContent = "Employees List";
			var { users } = data;
			let rows = "";
			users.forEach((user, index) => {
				// owner_options +=
				// 	`<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`
				var role_user = employee_type(user.type);
				rows +=
					`<tr>` +
					`<td>` +
					(index + 1) +
					`</td> ` +
					`<td>` +
					user.first_name +
					` ` +
					user.last_name +
					`</td> ` +
					`<td>` +
					user.email +
					`</td> ` +
					`<td>` +
					user.contact_no +
					`</td> ` +
					`<td>` +
					role_user +
					`</td> ` +
					`<td><a class='btn btn-info'  onclick="edit_employee(` +
					user.user_id +
					`)">Edit</a> <a class='btn btn-danger'  onclick="delete_employee(` +
					user.user_id +
					`)">Delete</a></td> ` +
					`</tr>`;
				// console.log(user)
			});
			console.log(rows);
			show_employees(rows);

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
		} else if (val == "user_ajax") {
			headingElement.textContent = "User Registration";
			user_ajax();

			let owner_options = (tower_options = "");
			console.log(data);
			data.users.forEach((user) => {
				owner_options += `<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`;
			});

			var select_owner = select("owner", owner_options);
			// var select_tower = (select('tower', tower_options))

			$("#owner_div").html(select_owner);
			// $('#tower_div').html(select_tower)
			// console.log(select_owner)
		} else if (val == "book_flat_ajax") {
			flatEl.textContent = "Book Flat From Given";
			book_flat_ajax(data);

			let owner_options = (tower_options = "");

			data.data.users.forEach((user) => {
				owner_options += `<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`;
			});

			var select_owner = select("owner", owner_options);
			// var select_tower = (select('tower', tower_options))

			$("#owner_div").html(select_owner);
			// $('#tower_div').html(select_tower)
			// console.log(select_owner)
		}
	});
}
function add_empty_message_classes() {
	$(".row").each(function () {
		// Check and add the class '.align'
		if (!$(this).hasClass("align-content-center")) {
			$(this).addClass("align-content-center");
		}

		// Check and add the class '.center'
		if (!$(this).hasClass("h-100")) {
			$(this).addClass("h-100");
		}

		// Check and add the class '.margin'
		if (!$(this).hasClass("justify-content-center")) {
			$(this).addClass("justify-content-center");
		}
		// Check and add the class '.margin'
		if (!$(this).hasClass("justify-content-center")) {
			$(this).addClass("justify-content-center");
		}
	});
}
function handleYesN(id,route,model_id='',load_module='') {
	 
	$("#"+model_id).modal("hide");
	$.post(route, { id: id }, function (data, status) {
		$(".loader").hide();
		let data1 = JSON.parse(data);

		if (data1.status == "error") {
			showError(data1.errors);
		}
		if (data1.status == "success") {
			swal(data1.message + "!", data1.message, "success");
		}
		
	});
	// if(route=='pay_invoice_ajax'){
		loadModule(load_module)
// 
	// }
}
 
function openCustomAlert(
	modalId = "",
	heading = "",
	message = "",
	handleYes = ""
) {
	// Create a unique ID for the modal

	// Remove existing modal if any
	$("#" + modalId).remove();

	// Create dynamic modal HTML
	const modalHtml = `
		<div class="modal fade" id="${modalId}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">${heading}</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					${message}
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
						<button type="button" class="btn btn-primary" onclick="${handleYes}">Yes</button>
					</div>
				</div>
			</div>
		</div>
	`;

	// Append modal HTML to the body
	$("body").append(modalHtml);

	// Show the modal
	$("#" + modalId).modal("show");
}

function pop_message_box(
	id = "",
	heading = "",
	headingText = "",
	hidden1 = "",
	hidden2 = "",
	modalContent = "",
	submitButton = ""
) {
	return (
		`
	<div class="modal fade" id="` +
		id +
		`" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="` +
		heading +
		`">` +
		headingText +
		`</h5>
					<input type='hidden' name='` +
		hidden1 +
		`' id='` +
		hidden1 +
		`'>
					<input type='hidden' name='` +
		hidden2 +
		`' id='` +
		hidden2 +
		`'>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<!-- Use a placeholder element to dynamically set the modal content -->
				<div class="modal-body" id="` +
		modalContent +
		`"></div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" id="` +
		submitButton +
		`" href="#">Book</a>
				</div>
			</div>
		</div>
	</div>`
	);
}
function remove_empty_message_classes() {
	$(".row").each(function () {
		// Check and add the class '.align'
		if ($(this).hasClass("align-content-center")) {
			$(this).removeClass("align-content-center");
		}
		// Check and add the class '.align'
		if ($(this).hasClass("h-100")) {
			$(this).removeClass("h-100");
		}

		// Check and add the class '.center'
		if ($(this).hasClass("h-100")) {
			$(this).removeClass("h-100");
		}

		// Check and add the class '.margin'
		if ($(this).hasClass("justify-content-center")) {
			$(this).removeClass("justify-content-center");
		}
		// Check and add the class '.margin'
		if ($(this).hasClass("justify-content-center")) {
			$(this).removeClass("justify-content-center");
		}
	});
}
function formatTime(inputTime) {
	const date = new Date(inputTime);

	const options = {
		day: "2-digit",
		month: "2-digit",
		year: "numeric",
		hour: "2-digit",
		minute: "2-digit",
		hour12: true,
	};

	return new Intl.DateTimeFormat("en-GB", options).format(date);
}
function testing_invoice_ajax(data){
	let row = data.data;
	console.log(data);
	let rows = "";
	row.forEach((user, index) => {
		// owner_options +=
		// 	`<option value="${user.user_id}">${user.first_name} ${user.last_name} </option>`
		// var role_user = user.type == "A" ? "Luxuary" : "Normal";
		let pay_status = user.paid=='yes' ? "<span class='bg-warning text-danger px-5 py-2 rounded  text-primary font-weight-bolder m-1 '>Paid</span>" : `<a class='btn btn-info rounded m-1 px-5'  onclick="return pay_invoice('pay_invoice_ajax',` +
		user.id +
		`)">Pay</a>`;
 		rows +=
			`<tr>` +
			`<td>` +
			(index + 1) +
			`</td> ` +
			`<td>` +
			formatTime(user.created_at)+
			`</td> ` +
			`<td>` +
			user.amount +
			`<td>${pay_status}</td>` +
			`</tr>`;
			/*<td>${pay_status}<a class='btn btn-danger'  onclick="delete_invoice(` +
			  user.id +
			  `)">Delete</a></td> */
		// console.log(user)
	});
	var response =
		`<div class="card shadow mb-4 w-100">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Flats </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Booking Date</th>
                                            <th>Rent</th> 
                                            <th>option</th>
                                             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
										<th>#</th>
										<th>Booking Date</th>
										<th>Rent</th> 
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
	$(".row").html("");
	$(".row").html(response);

	// Initialize DataTable after adding the HTML to the DOM
	document.addEventListener("DOMContentLoaded", function() {
		// Code to execute when the DOM is fully loaded
		$("#dataTable").DataTable();
	 
	});

}

function pay_invoice(route, id) {
	 
	$(".loader").show();

	// localStorage.setItem("route_selected", route);
	selectFlatPopUp2((id = id), (route = route),'invoice_ajax');
}
function selectFlatPopUp2(
	id = "",
	route = "", 
	load_module=''
) {
	// openCustomAlert2(
	// 	(modalId = "invoiceModel"),
	// 	(heading = "Pay the invoice"),
	// 	(message = "Click yes to pay the invoice"),
	// 	(handleYes = "handleYes2('" + id + "','" + route + "')")
	// );
	openCustomAlert(
		modalId = "invoiceModel",
		heading = "Pay the invoice",
		message = "Click yes to pay the invoice",
		handleYes = "handleYesN('" + id + "','" + route + "','invoiceModel','" + load_module + "')"
	)
	 
}
