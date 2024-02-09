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

function preventFormFlat(e) {
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
	console.log(formData);
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
		url: ajaxUrl + "register_flat_ajax", // Replace with your server endpoint
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

function selectFlatPopUp(id, status, rent, user) {

    var flatName = $("flat_" + id).data("name");
    var selectedFlatFromPopUp = id;
    var price = $(this).attr('data-price');
    $('#booking_id').val(selectedFlatFromPopUp)
    $('#booker_name').val(user)
    // Set the modal content dynamically
    $('#flatmodalContent').text('Do You want to book flat: ' + status + ' of rent :' +
        rent);

    // Show the modal
    $('#flatModal').modal('show');
}
