function invoice_ajax2(data) {
	
}

function pay_invoice(route, id) {
	$(".loader").show();

	// localStorage.setItem("route_selected", val);
	selectFlatPopUp2((id = id), (route = route));
}

function selectFlatPopUp2(
	id = "",
	route = "",
	status = "",
	rent = "",
	user = ""
) {
	openCustomAlert2(
		(modalId = "invoiceModel"),
		(heading = "Pay the invoice"),
		(message = "Click yes to pay the invoice"),
		(handleYes = "handleYes2('" + id + "','" + route + "')")
	);
}
function handleYes2(id, route) {
	console.log(id);
	$.post(route, { id: id }, function (data, status) {
		$(".loader").hide();
		let datas = JSON.parse(data);

		if (datas.status == "error") {
			showError(datas.errors);
		}
		if (datas.status == "success") {
			swal(datas.message + "!", datas.message, "success");
		}
	});
}

function openCustomAlert2(
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
