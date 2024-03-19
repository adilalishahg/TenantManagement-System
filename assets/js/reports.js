function load_reports(data) {
	let flats = data.booking;
	let res = '	<div class="card-body p-0">';
	res += '		<div class="row">';
	res += '			<div class="h-100 w-100">';
	res += '				<div class="card shadow mb-4 h-4 p-2">';
	res += '					<div class="form-row">'; 
	res += '						<div class="form-group col-md-2">';
	res += '							<label for="flatNameInput">Start Date</label>';
	res += '							    <input data-provide="datepicker" type="text" name="start_date" value="" class="form-control form-control-user" id="start_date_datepicker" aria-describedby="start_dateHelp" placeholder="Select Start Date...">	';
	res += '							<span class="error-message" id="start_date_error"></span>';
	res += '							<span class="error-message" ></span>';
	res += '						</div >';
	res += '						<div class="form-group col-md-2">';
	res += '							<label for="flatNameInput">End Date</label>';
	res += '							    <input data-provide="datepicker" type="text" name="end_date" value="" class="form-control form-control-user" id="end_date_datepicker" aria-describedby="end_dateHelp" placeholder="Select End Date...">	';
	res += '							<span class="error-message" id="end_date_error"></span>';
	res += '							<span class="error-message" ></span>';
	res += '						</div >';
	res += '						<div class="form-group col-md-2">';
	res += '							<label for="flatNameInput">Name</label>';
	res += '							<input type="text" name="name" value="" class="form-control form-control-user" id="name" aria-describedby="nameHelp" placeholder="Enter First Name...">';
	res += '							<span class="error-message" id="name_error"></span>';
	res += '							<span class="error-message" ></span>';
	res += '						</div >';
	res += '						<div class="form-group col-md-2">'
	res += '							<label for="benefitsCheckbox">Report</label>'
										+'<select class="form-select  " id="report" name="report">'
											+'<option value="">Select Type</option>'
											+'<option value="tower_report">Tower Report</option>'
											+ '<option value="user_report">User Report</option>'
											+'<option value="flat_report">Flat Report</option>' 
											+'<option value="rent_report">Rent Report</option>' 
										+'</select><span class="error-message" id="report_type_error"></span>'
		res += 						'</div>';
		res += 						'<div class="form-group col-md-4"><label for="benefitsCheckbox">Search</label>'
									+'<button name="report_search" id="report_search"  class="btn btn-primary btn-user btn-block ">'
										+'Search</button> ';
									+'</div>';
	
	  res += 					'</div ><hr/>';
	  res += 					'<div class="table-responsive" id="report_table">';
	  res += 					`<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										 
									</thead>
									<tfoot>
										
									</tfoot>
									<tbody></tbody>`;
	  res += 					'</div >';
	  res += 				'</div >';
	  res += 			'</div >';
	  res += 		'</div >';
	  
	  res += 	'</div >';
	  res += '</div >';
	  $(".user_dash").html("");
	  // Append table header to thead
  
	$(".user_dash").html(res);

	$("#report_search").on("click", function () {
		let tableFooter=`<tr>
		<th>#</th>`
		 let start_date = $("#start_date_datepicker").val();
		 let end_date = $("#end_date_datepicker").val();
		 let name = $("#name").val();
		 let report = $("#report").val();
		 $("#start_date_error").text("");
		 $("#end_date_error").text("");
		 $("#report_type_error").text("");
		 if(start_date == ""){
			 $("#start_date_error").text("Select Start Date");
		 } 
		 if(end_date == ""){
			 $("#end_date_error").text("Select End Date");
		 } 
		 if(report == ""){
			 $("#report_type_error").text("Select Report Type");
		 }
		 if(start_date == ""|| end_date == "" || report == ""){
			 return;
		 } 
		 
		 if(report=='tower_report'){
			
			// Define table footer content
				tableFooter += `<th>Tower Name</th>`;	
  
		 }if(report=='flat_report'){
			tableFooter+=`<th>Flat Name</th>`
		 }if(report=='user_report'){
			tableFooter+=`<th>User Name</th>`
		 }if(report=='rent_report'){
			tableFooter+=`<th>Rent Name</th>`
		 }
		 tableFooter+=`<th>Option</th>
					</tr>`
		 $('table tfoot').html("")
		 $('table thead').html("")
	  // Append table footer to tfoot
	  $('table tfoot').append(tableFooter);
	  $('table thead').append(tableFooter);
		 $(".loader").show();
			$.get(report, { start_date: start_date, end_date: end_date, name: name }, function (data, status) {
				$(".loader").hide();
				let data1 = JSON.parse(data);
				console.log(data1.status);
				if(data1.status==0){
					showError(data1.errors);return
				}
				
				if (data1.status == "error") {
					showError(data1.errors);
				}
				if (data1.status == "success") {
					swal(data1.message + "!", data1.message, "success");
				}
				// $(".user_dash").html("");
				get_towers_ajax(data1);
			});
		}) 
} 
