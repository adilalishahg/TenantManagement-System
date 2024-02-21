function book_tower() {
	var response =
		`<div class="card o-hidden border-0 shadow-lg my-5">
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
												<span class="error-message" id ="tower_error"></span> 
											</div>
											<div class="form-group col-md-6" id='owner_div'>
											Select Owner If You're not
													 <span class="error-message"></span>
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
		</div>`;
	response += `</div> `;

	$(".user_dash").html("");
	$(".user_dash").html(response);
}

function preventFormTower(e) {
	var form = document.querySelector("form");
	$("#cancel").click(function () {
		document.getElementById("book_tower_form").reset();
		$(".error-message").html("");
		return false;
	});
	var formData = $("#book_tower_form").serialize();
	console.log(formData);
	if ($("#tower").val().trim() === "") {
		$("#tower_error").text("Tower Name cannot be empty");
		ret = false;
	} else {
		$("#tower_error").text("");
	}
	$.ajax({
		type: "POST",
		url: ajaxUrl + "book_tower_ajax", // Replace with your server endpoint
		data: formData,
		success: function (response) {
			let res = JSON.parse(response);
			// Handle the success response
			if (res.status == "error") {
				showError(res.errors);
			}
			if (res.status == "success") {
				swal(res.message + "!", res.message, "success");
				document.getElementById("book_tower_form").reset();
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

function get_towers_ajax(data) {
	let row = data.data.towers;
	console.log(row);
	let rows = "";
	row.forEach((user, index) => {
		rows +=
			`<tr>` +
			`<td>` +
			(index + 1) +
			`</td> ` +
			`<td>` +
			user.tower_name +
			`</td> ` +
			`<td><a class='btn btn-info'  onclick="return edit_flat('edit_tower_ajax',` +
			user.id +
			`)">Edit</a> <a class='btn btn-danger'  onclick="delete_tower(` +
			user.id +
			`)">Delete</a></td> ` +
			`</tr>`;
		// console.log(user)
	});
	var response =
		`<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Towers </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tower Name</th> 
                                            <th>option</th>
                                             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Tower Name</th> 
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

function delete_tower(id) {
	$(".loader").show();
	$.post("delete_tower_ajax", { del_id: id }, function (data, status) {
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
		get_towers_ajax(data1);
	});
}
