function load_reports(data) {
	let flats = data.booking;
	let res = '	<div class="card-body p-0">';
	res += '		<div class="row">';
	res += '			<div class="h-100 w-100">';
	res += '				<div class="card shadow mb-4 h-4 p-2">';
	res += '					<div class="form-row">'; 
	res += '						<div class="form-group col-md-2">';
	res += '							<label for="flatNameInput">Start Date</label>';
	res += '							    <input data-provide="datepicker" type="text" name="start_date" autocomplete="off" value="" class="form-control form-control-user" id="start_date_datepicker" aria-describedby="start_dateHelp" placeholder="Select Start Date...">	';
	res += '							<span class="error-message" id="start_date_error"></span>';
	res += '							<span class="error-message" ></span>';
	res += '						</div >';
	res += '						<div class="form-group col-md-2">';
	res += '							<label for="flatNameInput">End Date</label>';
	res += '							    <input data-provide="datepicker" type="text" name="end_date" autocomplete="off" value="" class="form-control form-control-user" id="end_date_datepicker" aria-describedby="end_dateHelp" placeholder="Select End Date...">	';
	res += '							<span class="error-message" id="end_date_error"></span>';
	res += '							<span class="error-message" ></span>';
	res += '						</div >';
	res += '						<div class="form-group col-md-2">';
	res += '							<label for="flatNameInput">Name</label>';
	res += '							<input type="text" name="name" value="" class="form-control form-control-user" autocomplete="off" id="name" aria-describedby="nameHelp" placeholder="Enter First Name...">';
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
		let tableHeadFoot='';
		let tableHeader=`<tr id='tbl_head'>
		<th>#</th>`;
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
				tableHeadFoot += `<th>Tower Name</th>`;	
				tableHeadFoot += `<th>Owner Name</th>`;	
				tableHeadFoot += `<th>Total Flats</th>`;	
				tableHeadFoot += `<th>Revenue</th>`;	
				tableHeadFoot += `<th>Register Date</th>`;	
				tableHeadFoot += `<th>Options</th>`;	
  
		 }if(report=='flat_report'){
			tableHeadFoot+=`<th>Flat Name</th><th>Owner Name</th><th>Status</th><th>Rent</th><th>Type</th><th>Option</th>`
		 }if(report=='user_report'){
			tableHeadFoot+=`<th>User Name</th>`
			tableHeadFoot+=`<th>Email</th>`
			tableHeadFoot+=`<th>Contact No</th>`
			tableHeadFoot+=`<th>Type</th>`
			tableHeadFoot+=`<th>Options</th>`
		 }if(report=='rent_report'){
			tableHeadFoot+=`<th>Rental Name</th>`
			tableHeadFoot+=`<th>Flat Name</th>`
			tableHeadFoot+=`<th>Tower Name</th>`
			tableHeadFoot+=`<th>Flat Type</th>`
			tableHeadFoot+=`<th>Room Fare</th>`
			tableHeadFoot+=`<th>Rent Charged</th>`
			tableHeadFoot+=`<th>Rent Days</th>`
			tableHeadFoot+=`<th>Status</th>`
		 }
		 tableHeadFoot+=`
					</tr>`
		 $('table tfoot').html("")
		 $('table thead').html("")
		
		
	  // Append table footer to tfoot
	//   let tblRows='<tr><td>1</td><td>asds</td><td>opt</td></tr>'
	//   $('table tbody').append(tblRows);
	$(".loader").show();
	if($('table thead').html()==''){
		$('table thead').append(tableHeader+tableHeadFoot);
	}
	$.get('report', { type: report,start_date: start_date, end_date: end_date, name: name }, function (data, status) {
		$(".loader").hide();
				let data1 = JSON.parse(data);
				console.log(data1.report)
				if(data1.report&&data1.report.length>0){
				let tr='';
				data1.report.map((data,index)=>{
					if(report=='tower_report'){
						let owner = data.username||data.first_name+' '+data.last_name
						let earning = (data.tower_earning&&data.tower_earning!='')>0?data.tower_earning:0; 
						 tr +=`<tr></tr>
						<td>${index+1}</td>
						<td>${data.tower_name}</td>
						<td>${owner}</td>
						<td>${data.flat_total}</td>
						<td>${earning}</td>
						<td>${data.created_at}</td> `
						+
						`<td><a class='btn btn-info'  onclick="return edit_tower_ajax('edit_tower_ajax',` +
						data.id +
						`)">Edit</a> <a class='btn btn-danger'  onclick="delete_tower(` +
						data.id +
						`)">Delete</a></td> ` +`</tr>` 
					} 
					if(report=='flat_report'){
						let owner = data.username||data.first_name+' '+data.last_name
							let earning = (data.flat_earning&&data.rent!='')>0?data.rent:0; 
							let status = (data.status=='1'?'Vacant':'Booked'); 
							let type = (data.type=='A'?'Five Star':'Normal'); 
							 tr +=`<tr></tr>
							<td>${index+1}</td>
							<td>${data.flat_name}</td>
							<td>${owner}</td> 
							<td>${status}</td> 
							<td>${earning}</td>
							<td>${type}</td> 
							<td><a class='btn btn-info'  onclick="return edit_flat('edit_flat_ajax',` +
							data.flat_id +
							`)">Edit</a> <a class='btn btn-danger'  onclick="delete_flat(` +
							data.flat_id +
							`)">Delete</a></td></tr>`;
						
						}
					if(report=='user_report'){
						let username = data.username||data.first_name+' '+data.last_name
						let role = selectUserRole(data.type);
							tr +=`<tr></tr>
							<td>${index+1}</td>
							<td>${username}</td> 
							<td>${data.email}</td>
							<td>${data.contact_no}</td>  
							<td>${role}</td>  
							<td> <a class='btn btn-info'  onclick="return edit_employee(` +
							data.user_id +
							`)">Edit</a> <a class='btn btn-danger'  onclick="delete_employee(` +
							data.user_id +
							`)">Delete</a></td> ` +`</tr>` ;
			
					}
					if(report=='rent_report'){
						let timeDiff = getDateDifference(data.created_at, data.updated_at)
						let totalDays = getCurrentMonthDays()
						let charged= Math.round(data.amount*(timeDiff.days/30) )
						if(isNaN(charged) || charged =='Infinity'){charged=0}
						let username = data.username||data.first_name+' '+data.last_name
						let flat_type = data.flat_type=='A'?'Luxury':'Normal'
						let paid = data.paid=='yes'?'Paid':`<a onclick="return checkout(${data.flat_id})" class="btn btn-info">Pay</a>` 
							 tr +=`<tr></tr>
							<td>${index+1}</td>
							<td>${username}</td> 
							<td>${data.flat_name}</td>  
							<td>${data.tower_name}</td>  
							<td>${flat_type}</td>  
							<td>${data.amount}</td>
							<td>${charged}</td>
							<td>${timeDiff.days}</td>
							<td>${paid}</td>  
							</tr>` ;
						
						}
				}) 
					$('table tbody').html('');
					$('table tbody').append(tr);
					 
					// $('table tfoot').append(tableFooter+tableHeadFoot);
				}else{
					$('table tbody').html('');
					$('table tbody').append(`<tr>No Data Found</tr>`);

				}
				if(data1.status==0){
					
					$('table tbody').html('');
					$('table tbody').append(`<tr>No Data Found</tr>`);
					showError(data1.errors);return
				}
				
				if (data1.status == "error") {
					showError(data1.errors);
				}
				if (data1.status == "success") {
					swal(data1.message + "!", data1.message, "success");
				}
				// $(".user_dash").html("");
				// get_towers_ajax(data1);
			});
		}) 
} 
