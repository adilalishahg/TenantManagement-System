function load_user_dashboard(data) {
	let flats = data.booking;
	let res = '<div class="h-100 w-100">';

	res += '	<div class="card shadow mb-4 h-4  ">';
	res += '		<div class="card-header py-3">';
	res +=
		'		 	<h6 class="m-0 font-weight-bold text-primary route_heading">Your Booking Detail</h6>';
	res += "		</div>";
	res += '		<div class="card-body row">';

	if (Array.isArray(flats)) {
		flats.forEach((element) => {
			let button_or_message =
				element.booked == "no"
					? "<span class=' badge badge-secondary'><h4>You are already <br/> Checked Out</h4></span>"
					: `<button class="btn btn-danger rounded-2 " onclick="checkout('` +
					  element.flat_id +
					  `')">CheckOut <i class="fas fa-sign-out-alt fa-1x fa-fw mr-2 text-gray-400"></i></button>`; ////
			let flat_type = element.type == "A" ? "5 Star Room" : "Classic Room";
			res += '<div class="   col-lg-6 mb-4" id="' + element.flat_id + '">';
			res += '<div class="card border-left-warning shadow h-100 py-2">';
			res += '<div class="card-body">';
			res += '<div class="row no-gutters align-items-center">';
			res += '<div class="col mr-2">';
			res +=
				'<div class="text-s font-weight-bold text-primary text-uppercase mb-1">';
			res += "Rent : RS " + element.amount;
			res += "</div>";
			res +=
				'<div class="h5 mb-0 font-weight-bold text-gray-800"> Booked At :' +
				formatTime(element.created_at);
			res += "</div>";
			res +=
				'<div class="h5 mb-0 font-weight-bold text-gray-800"> Flat : ' +
				flat_type;
			res += "<br />This Month Passed Days :  " + element.passedDays;
			res += "<br />Your Spent Days : " + element.spentDays;
			res += "<br />This Month Pending Days : " + element.pendingDays;
			res += "</div>";
			res += "</div>";
			res += `<div class="col-auto">` + button_or_message + `</div>`;
			res += "</div>";
			res += "</div>";
			res += "</div>";
			res += "</div>";
		});
	}
	res += "		</div>";
	res += "	</div>";
	res += "</div>";
	$(".row").html("");
	$(".row").html(res);
	// console.log(res_dashboard)
}

function load_dashboard(data) {
	console.log("data");
	console.log(data);
	const booked_ratio = " " + data.booked.result||"0" + ` /` + data.total_flats||"0" + " ";
	var res_dashboard = `<div class="row">`;
	res_dashboard += card(
		"primary",
		"EARNINGS (MONTHLY)",
		"$" + data.total_monthly?data.total_monthly:"0",
		"fa-calendar"
	);
	res_dashboard += card(
		"primary",
		"EARNINGS (Annual)",
		"$" + data.year||"0",
		"fa-calendar"
	);
	res_dashboard += card(
		"info",
		"Booked/Total Flats",
		booked_ratio||"0",
		"fa-clipboard-list",
		data.ratio||"0"
	);
	res_dashboard += ` </div>`;
	$(".user_dash").html("");
	$(".user_dash").html(res_dashboard);
	// console.log(res_dashboard)
}
function checkout(id) {
	$(".loader").show();
	$.get("checkout_ajax", { id: id }, function (data, status) {
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
