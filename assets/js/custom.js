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
		} else if (val == "get_towers_ajax") {
			if (flatEl) {
				flatEl.textContent = "Towers";
			} else {
				headingElement.textContent = "Towers";
			}
			get_towers_ajax(data);
		} else if (val == "profile_ajax") {
			if (flatEl) {
				flatEl.textContent = "Profile";
			} else {
				headingElement.textContent = "Profile";
			}
			profile_ajax(data);

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
