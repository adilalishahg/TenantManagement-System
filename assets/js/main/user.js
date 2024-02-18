function user_ajax() {
	var response =
		`<div class="card o-hidden border-0 shadow-lg my-5">
			<div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
					<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
					<div class="col-lg-12">
						<div class="p-5">
							<form  method='post' id="book_user_form_new"  onsubmit="return preventFormUser()">
								<div class	="form-row">
									` +
		input_field(
			(label = "First Name"),
			(type = "text"),
			(name = "first_name"),
			(placeholder = "Enter First Name...")
		) +
		`
									` +
		input_field(
			(label = "Last Name"),
			(type = "text"),
			(name = "last_name"),
			(placeholder = "Enter Last Name...")
		) +
		`
									` +
		input_field(
			(label = "Email"),
			(type = "email"),
			(name = "email"),
			(placeholder = "Enter Email...")
		) +
		`
									` +
		input_field(
			(label = "Contact No:"),
			(type = "text"),
			(name = "contact_no"),
			(placeholder = "Enter Contact Number...")
		) +
		`
									<div class="form-group col-md-6">
										<label for="benefitsCheckbox">Role</label>
										<select class="form-select  " id="role" name="role">
											<option value="">Select Type</option>
											<option value="1"  >
												Admin
											</option>
											<option value="2" >
												Manager
											</option>
											<option value="3" >
												Customer
											</option>
											<option value="5"  >
												Employee
											</option>
										</select><span class="error-message"  id ="role_error"></span>
										 
									</div>` +
		input_field(
			(label = "Password"),
			(type = "password"),
			(name = "password"),
			(placeholder = "Enter Confirm Password...")
		) +
		`` +
		input_field(
			(label = "Confirm Password"),
			(type = "password"),
			(name = "confirm_password"),
			(placeholder = "Enter Password...")
		) +
		` 
							</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<button name="submit" value="save" class="btn btn-primary btn-user btn-block ">
											Save
										</button>
									</div>
									<div class="form-group col-md-6">
										<button name="submit" value="cancel" id="cancel" class="btn btn-danger btn-user btn-block ">
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
	$(".user_dash").html("");
	$(".user_dash").html(response);
}

function delete_employee(id) {
	$.ajax({
		type: "POST",
		url: "employees_ajax", // Replace with your server endpoint
		data: {
			del_id: id,
		},
		success: function (response) {
			let res = JSON.parse(response);

			if (res.status == "success") {
				swal(res.message + "!", res.message, "success");
				loadModule("employees_ajax");
				// user_edit_ajax(res.data);
			}
		},
		error: function (error) {
			// Handle the error
			console.log("Ajax request failed");
			console.log(error);
		},
	});
}

function preventFormUser(e) {
	// console.log("asd");
	var form = document.querySelector("form");
	$("#cancel").click(function () {
		document.getElementById("book_user_form_new").reset();
		$(".error-message").html("");
		return false;
	});
	const url = ajaxUrl + "user_ajax";
	var formData = $("#book_user_form_new").serialize();
	$.ajax({
		type: "POST",
		url: url, // Replace with your server endpoint
		data: formData,
		success: function (response) {
			let res = JSON.parse(response);
			// Handle the success response
			if (res.status == "error") {
				// console.log(res)
				showError(res.errors);
			}
			if (res.status == "success") {
				swal(res.message + "!", res.message, "success");
				document.getElementById("book_user_form_new").reset();
			}
		},
		error: function (error) {
			// Handle the error
			console.log("Ajax request failed");
			console.log(error);
		},
	});
	return false;
}
function preventFormProfile(e) {
	const selectedAvatar = document.getElementById("selectedAvatar");
	const customFile2 = document.getElementById("customFile2");
	const last_name = document.getElementById("last_name").value;
	const first_name = document.getElementById("first_name").value;
	const formData = new FormData(document.getElementById("user_profile"));

	// var form = document.querySelector("form");
	$("#cancel").click(function () {
		document.getElementById("user_profile").reset();
		$(".error-message").html("");
		return false;
	});

	// Append the image file to the FormData object
	if (customFile2.files && customFile2.files[0]) {
		formData.append("image", customFile2.files[0]);
	}
	console.log(formData);
	const url = ajaxUrl + "profile_ajax";
	// var formData = $("#user_profile").serialize();
	// const fileInput = document.querySelector('input[name="profile_img"]');
	// const fileInput2 = document.querySelector('input[name="customFile2"]');
	// console.log(fileInput2);
	// console.log("fileInput2");
	// console.log(fileInput);
	// // Append the image file to the FormData object
	// // if (fileInput.files && fileInput.files[0]) {
	// // 	formData.append("customFile2", fileInput.files[0]);
	// // }
	// console.log(formData);
	// return;

	$.ajax({
		type: "POST",
		url: url, // Replace with your server endpoint
		data: formData,
		contentType: false,
		processData: false,
		success: function (response) {
			let res = JSON.parse(response);
			// Handle the success response
			if (res.status == "error") {
				showError(res.errors);
			}
			if (res.status == "success") {
				swal(res.message + "!", res.message, "success");
				$(".error-message").html("");
				$("#profile_user_name").html(first_name + " " + last_name);
				// $(".error-message").hide();
			}
		},
		error: function (error) {
			// Handle the error
			console.log("Ajax request failed");
			console.log(error);
		},
	});
	return false;
}

function preventFormUserUpdate(e) {
	var form = document.querySelector("form");
	$("#cancel").click(function () {
		document.getElementById("edit_user_form").reset();
		$(".error-message").html("");
		return false;
	});
	const url = ajaxUrl + "employees_ajax";
	var formData = $("#edit_user_form").serialize();
	$.ajax({
		type: "POST",
		url: url, // Replace with your server endpoint
		data: formData,
		success: function (response) {
			let res = JSON.parse(response);
			// Handle the success response
			if (res.status == "error") {
				// console.log(res)
				showError(res.errors);
			}
			if (res.status == "success") {
				swal(res.message + "!", res.message, "success");
				// document.getElementById("book_tower_form").reset();
				document.getElementById("edit_user_form").reset();
			}
		},
		error: function (error) {
			// Handle the error
			console.log("Ajax request failed");
			console.log(error);
		},
	});
	return false;
}

function edit_employee(id) {
	$.ajax({
		type: "POST",
		url: "employees_ajax", // Replace with your server endpoint
		data: {
			id: id,
		},
		success: function (response) {
			let res = JSON.parse(response);

			if (res.status == "success") {
				user_edit_ajax(res.data);
			}
		},
		error: function (error) {
			// Handle the error
			console.log("Ajax request failed");
			console.log(error);
		},
	});
}
function image_address(img) {
	// Check if source ends with a valid image file extension
	var allowedExtensions = ["jpg", "jpeg", "png", "gif"];

	// Create a regular expression pattern based on allowed extensions
	var pattern = new RegExp("\\.(" + allowedExtensions.join("|") + ")$", "i");

	if (pattern.test(img)) {
		return true;
	}
	return false;
}
function profile_ajax(data) {
	// console.log(data.profile_img);
	var img_profile = image_address(data.profile_img)
		? data.profile_img
		: "https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg";
	var profile_res = "";
	localStorage.setItem("route_selected", "profile_ajax");
	// document.getElementById("user_dashboard").innerHTML = "Profile";
	profile_res += `<div class="container-fluid ">`;
	profile_res += `	<div class="card o-hidden border-0 shadow-lg my-5">`;
	profile_res += `		<div class="card-body p-0">`;
	profile_res += `			<div class="row">`;
	profile_res += `				<div class="col-lg-12">`;
	profile_res += `					<div class="p-5">`;
	profile_res += `						<form class="profile" id="user_profile"   onsubmit="return preventFormProfile()"  enctype="multipart/form-data">`;
	profile_res += `							<div class="form-row">`;
	profile_res += `								<div class="align-content-center container d-flex flex-column justify-content-center">`;
	profile_res += `									<div class="d-flex justify-content-center  mb-4" style = '	flex-direction:column;align-items: center;'>`;
	profile_res +=
		`										<img id="selectedAvatar" name="profile_img" src="` +
		img_profile +
		`" class="rounded-circle mb-2" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder">`;
	profile_res += `										<div class="d-flex justify-content-center">`;
	profile_res += `											<div class="btn btn-primary btn-rounded">`;
	profile_res += `												<label class="form-label text-white m-1" for="customFile2">Choose file</label>`;
	profile_res += `												<input type="file" class="form-control d-none" id="customFile2" onchange="displaySelectedImage(event, 'selectedAvatar')">`;
	profile_res += `											</div>`;
	profile_res += `										</div>`;
	profile_res += `									</div>`;
	profile_res += `								</div>`;
	profile_res += `							</div>`;
	profile_res += `							<div class="form-row">`;
	profile_res += input_field(
		(label = "First Name"),
		(type = "text"),
		(name = "first_name"),
		(placeholder = "Enter First Name..."),
		(value = data.first_name)
	);
	profile_res += input_field(
		(label = "Last Name"),
		(type = "text"),
		(name = "last_name"),
		(placeholder = "Enter Last Name..."),
		(value = data.first_name)
	);
	profile_res += input_field(
		(label = "Email"),
		(type = "text"),
		(name = "email"),
		(placeholder = "Enter Email..."),
		(value = data.email)
	);
	profile_res += input_field(
		(label = "Contact No"),
		(type = "text"),
		(name = "contactno"),
		(placeholder = "Enter Contact No..."),
		(value = data.contact_no)
	);
	profile_res += input_field(
		(label = "Password"),
		(type = "password"),
		(name = "password"),
		(placeholder = "Enter Password No..."),
		(value = data.plainPassword)
	);
	profile_res += input_field(
		(label = "Confirm password"),
		(type = "password"),
		(name = "confirm_password"),
		(placeholder = "Enter Confirm Password No..."),
		(value = data.plainPassword)
	);
	profile_res += `						</div>`;
	profile_res += `							<div class="form-row">`;
	profile_res += `								<div class="form-group col-md-6">`;

	profile_res += `									<button name="submit" value="save" class="btn btn-primary btn-user btn-block ">Save</button>`;
	profile_res += `								</div>`;
	profile_res += `								<div class="form-group col-md-6">`;
	profile_res += `									<button name="reset" value="reset" id='cancel'  class="btn btn-danger btn-user btn-block ">Reset</button>`;
	profile_res += `								</div>`;
	profile_res += `							</div>`;
	profile_res += `						</form>`;
	profile_res += `						<hr>`;
	profile_res += `					</div>`;
	profile_res += `				</div>`;
	profile_res += `			</div>`;
	profile_res += `		</div>`;
	profile_res += `	</div>`;
	profile_res += `</div>`;
	$(".row").html("");
	$(".user_dash").html("");
	$(".row").html(profile_res);
	// console.log(profile_res)
	$(".user_dash").html(profile_res);
}
function displaySelectedImage(event, elementId) {
	const selectedImage = document.getElementById(elementId);
	const profile_img_nav = document.getElementById("profile_img_nav");
	const fileInput = event.target;

	if (fileInput.files && fileInput.files[0]) {
		const reader = new FileReader();

		reader.onload = function (e) {
			selectedImage.src = e.target.result;
			profile_img_nav.src = e.target.result;
			console.log(selectedImage);
		};

		reader.readAsDataURL(fileInput.files[0]);
	}
}
function user_edit_ajax(data) {
	localStorage.setItem("route_selected", "user_edit_ajax");
	localStorage.setItem("user_data", JSON.stringify(data));
	document.getElementById("route_heading").innerHTML = "Edit User	";
	var response =
		`<div class="card o-hidden border-0 shadow-lg my-5">
			<div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
					<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
					<div class="col-lg-12">
						<div class="p-5">
							<form  method='post' id="edit_user_form"  onsubmit="return preventFormUserUpdate()">
								<div class	="form-row"><input type='hidden' name = 'edit_id' value ='` +
		data.user_id +
		`' />
									` +
		input_field(
			(label = "First Name"),
			(type = "text"),
			(name = "first_name"),
			(placeholder = "Enter First Name..."),
			(value = data.first_name)
		) +
		`
									` +
		input_field(
			(label = "Last Name"),
			(type = "text"),
			(name = "last_name"),
			(placeholder = "Enter Last Name..."),
			(value = data.last_name)
		) +
		`
									` +
		input_field(
			(label = "Email"),
			(type = "email"),
			(name = "email"),
			(placeholder = "Enter Email..."),
			(value = data.email)
		) +
		`
									` +
		input_field(
			(label = "Contact No:"),
			(type = "text"),
			(name = "contact_no"),
			(placeholder = "Enter Contact Number..."),
			(value = data.contact_no)
		) +
		`
									<div class="form-group col-md-6">
										<label for="benefitsCheckbox">Role</label>
										<select class="form-select   id="role" name="role">
											<option value="">Select Type</option>
											<option value="1" ` +
		(data.type == 1 ? "selected" : "") +
		` >
												Admin
											</option>
											<option value="2"  ` +
		(data.type == 2 ? "selected" : "") +
		`>
												Manager
											</option>
											<option value="3" ` +
		(data.type == 3 ? "selected" : "") +
		` >
												Customer
											</option>
											<option value="5"` +
		(data.type == 5 ? "selected" : "") +
		` >
												Employee
											</option>
										</select><span class="error-message"  id ="role_error"></span>
										 
									</div>` +
		input_field(
			(label = "Password"),
			(type = "password"),
			(name = "password"),
			(placeholder = "Enter Confirm Password..."),
			""
		) +
		`` +
		input_field(
			(label = "Confirm Password"),
			(type = "password"),
			(name = "confirm_password"),
			(placeholder = "Enter Password..."),
			""
		) +
		` 
							</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<button name="submit" value="update" class="btn btn-primary btn-user btn-block ">
											Update
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
	$(".user_dash").html("");
	$(".user_dash").html(response);
}
