function show_employees(rows) {
	var response =
		`<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Employees </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Tower</th>
                                            <th>Status</th>
                                            <th>Rent</th>
                                             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
										<th>#</th>
										<th>Name</th>
										<th>Type</th>
										<th>Tower</th>
										<th>Status</th>
										<th>Rent</th>
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
