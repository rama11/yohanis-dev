@extends('layouts.app')

@section('content')
<style type="text/css">
	.dataTables_filter {display: none;}
	.swal2-container {
  z-index: 10000;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
					<div class="card-header card-header-primary card-header-icon">
						<div class="card-icon">
							<i class="material-icons">assignment</i>
						</div>
						<div class="card-title d-flex">
							<h4>Time Sheet</h4>
							<div class="ml-auto">
								@if(Auth::user()->roles == "Supervisor")
								<button class="btn btn-success" onclick="showApproveActivity()">
									<i class="material-icons">task_alt</i> Approve Activity
								</button>
								@else
								<button class="btn btn-success" onclick="showSubmitActivity()">
									<i class="material-icons">grading</i> Submit Activity
								</button>
								<button class="btn btn-primary" data-toggle="modal" data-target="#addActivityModal">
									<i class="material-icons">add</i> Create Activity
								</button>
								@endif
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="toolbar d-flex">
							@if(Auth::user()->roles == "Supervisor")
							<select class="selectpicker2 order-2 p-2" data-style="select-with-transition" multiple title="Filter by PIC" id="filterPIC">
								<option disabled> Multiple Options</option>
								<option value="0">Show All</option>
							</select>
							@endif
							<select class="selectpicker order-1 p-2" data-style="select-with-transition" title="Show 10 item" data-size="5" id="showEntry">
								<option value="10">Show 10 items</option>
								<option value="25">Show 25 items</option>
								<option value="50">Show 50 items</option>
								<option value="100">Show 100 items</option>
								<option value="500">Show 500 items</option>
							</select>
							<select class="selectpicker2 order-2 p-2" data-style="select-with-transition" multiple title="Filter by Customer" id="filterCustomer">
								<option disabled> Multiple Options</option>
								<option value="0">Show All</option>
							</select>
							<select class="selectpicker2 order-3 p-2" data-style="select-with-transition" multiple title="Filter by Project ID" id="filterPID">
								<option disabled> Multiple Options</option>
								<option value="0">Show All</option>
							</select>
							<select class="selectpicker2 order-4 p-2" data-style="select-with-transition" multiple title="Filter by Site Location" id="filterSite">
								<option disabled> Multiple Options</option>
								<option value="0">Show All</option>
								<option value="WFH">WFH</option>
								<option value="WFO">WFO</option>
								<option value="On Site">On Site</option>
							</select>
							<select class="selectpicker2 order-4 p-2" data-style="select-with-transition" multiple title="Filter by Status" id="filterStatus">
								<option disabled> Multiple Options</option>
								<option value="0">Show All</option>
								<option value="Done">Done</option>
								<option value="On Progress">On Progress</option>
								<option value="Pending">Pending</option>
								<option value="Cancel">Cancel</option>
							</select>
							<div class="form-group order-5 ml-auto bmd-form-group">
								<label class="bmd-label-floating">Search</label>
								<input type="text" class="form-control" id="searchTable">
							</div>
						</div>
						<div class="material-datatables">
							<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
								<thead>
									<tr>
										<th>PIC</th>
										<th>Date</th>
										<th class="text-center">Customer ID</th>
										<th>ID Project</th>
										<th>Description Activity</th>
										<th class="text-center">Site Location</th>
										<th class="text-center">Duration</th>
										<th class="text-center">Status</th>
										<th class="text-center">id_customer</th>
										<th class="text-center">id_pid</th>
										<th class="text-center">status</th>
										<th class="text-center">Actions</th>
										<th class="text-center">Approved</th>
										<th class="text-center">Date Sort</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>PIC</th>
										<th>Date</th>
										<th class="text-center">Customer ID</th>
										<th>ID Project</th>
										<th>Description Activity</th>
										<th class="text-center">Site Location</th>
										<th class="text-center">Duration</th>
										<th class="text-center">Status</th>
										<th class="text-center">id_customer</th>
										<th class="text-center">id_pid</th>
										<th class="text-center">status</th>
										<th class="text-center">Actions</th>
										<th class="text-center">Approved</th>
										<th class="text-center">Date Sort</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<!-- end content-->
				</div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Activity</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="get" action="/" class="form-horizontal">
					<div class="row">
						<label class="col-sm-2 col-form-label">Date Time</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control datetimepicker" id="addDateTime">
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Customer</label>
						<div class="col-sm-10">
							<div class="form-group">
								<select class="form-control select2" id="selectCustomer" title="Select Customer" style="width:100%">
									<option disabled selected>Select Customer</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">ID Project</label>
						<div class="col-sm-10">
							<div class="form-group">
								<select class="form-control select2" id="selectPID" title="Select ID Project" style="width:100%">
									<option disabled selected>Select ID Project</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Description Activity</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="addDescription">
								<span class="bmd-help">Please fill in your activities according to what you do</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<select class="selectpicker" data-size="4" data-style="btn btn-primary btn-round" title="Site Location" id="addSiteLocation">
									<option disabled selected>Site Location</option>
									<option value="WFH">WFH</option>
									<option value="WFO">WFO</option>
									<option value="On Site">On Site</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<select class="selectpicker" data-size="11" data-style="btn btn-primary btn-round" title="Duration" id="addDuration">
									<option disabled selected>Duration</option>
									<option value="15 Menit">15 Menit</option>
									<option value="30 Menit">30 Menit</option>
									<option value="1 Jam">1 Jam</option>
									<option value="2 Jam">2 Jam</option>
									<option value="3 Jam">3 Jam</option>
									<option value="4 Jam">4 Jam</option>
									<option value="5 Jam">5 Jam</option>
									<option value="6 Jam">6 Jam</option>
									<option value="7 Jam">7 Jam</option>
									<option value="1 Hari / Lebih">1 Hari / Lebih</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<select class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" title="Status" id="addStatus">
									<option disabled selected>Status</option>
									<option value="Done">Done</option>
									<option value="On Progress">On Progress</option>
									<option value="Pending">Pending</option>
									<option value="Cancel">Cancel</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="createActivity()">Create Activity</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="editActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Activity</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="get" action="/" class="form-horizontal">
					<div class="row">
						<label class="col-sm-2 col-form-label">Date Time</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="editDateTime">
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Customer</label>
						<div class="col-sm-10">
							<div class="form-group">
								<select class="form-control select2" id="selectEditCustomer" title="Select Customer" style="width:100%">
									<option disabled selected>Select Customer</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">ID Project</label>
						<div class="col-sm-10">
							<div class="form-group">
								<select class="form-control select2" id="selectEditPID" title="Select ID Project" style="width:100%">
									<option disabled selected>Select ID Project</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Description Activity</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="editDescription">
								<span class="bmd-help">Please fill in your activities according to what you do</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<select class="selectpicker" data-size="4" data-style="btn btn-primary btn-round" title="Site Location" id="editSiteLocation">
									<option disabled>Site Location</option>
									<option value="WFH">WFH</option>
									<option value="WFO">WFO</option>
									<option value="On Site">On Site</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<select class="selectpicker" data-size="11" data-style="btn btn-primary btn-round" title="Duration" id="editDuration">
									<option disabled>Duration</option>
									<option value="15 Menit">15 Menit</option>
									<option value="30 Menit">30 Menit</option>
									<option value="1 Jam">1 Jam</option>
									<option value="2 Jam">2 Jam</option>
									<option value="3 Jam">3 Jam</option>
									<option value="4 Jam">4 Jam</option>
									<option value="5 Jam">5 Jam</option>
									<option value="6 Jam">6 Jam</option>
									<option value="7 Jam">7 Jam</option>
									<option value="1 Hari / Lebih">1 Hari / Lebih</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<select class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" title="Status" id="editStatus">
									<option disabled>Status</option>
									<option value="Done">Done</option>
									<option value="On Progress">On Progress</option>
									<option value="Pending">Pending</option>
									<option value="Cancel">Cancel</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" id="buttonEditActivity" onclick="editActivity()">Edit Activity</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="submitActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="max-width:1000px">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Submit Activity</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table">
						<thead class=" text-primary">
							<th class="text-center">Date</th>
							<th class="text-center">Customer ID</th>
							<th class="text-center">ID Project</th>
							<th>Description Activity</th>
							<th class="text-center">Site Location</th>
							<th class="text-center">Duration</th>
							<th class="text-center">Status</th>
						</thead>
						<tbody id="tableBodySubmitedActivity">
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="submitActivity()">Submit Activity</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="submitApproveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="max-width:1000px">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Approve Activity</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="accordion" role="tablist">
					<div class="card-collapse">
						<div class="card-header" role="tab" id="headingOne">
							<h5 class="mb-0">
								<a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="collapsed">
									Collapsible Group Item #1
									<i class="material-icons">keyboard_arrow_down</i>
								</a>
							</h5>
						</div>
						<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
							<div class="card-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
							</div>
						</div>
					</div>
					<div class="card-collapse">
						<div class="card-header" role="tab" id="headingTwo">
							<h5 class="mb-0">
								<a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Collapsible Group Item #2
									<i class="material-icons">keyboard_arrow_down</i>
								</a>
							</h5>
						</div>
						<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
							<div class="card-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
							</div>
						</div>
					</div>
					<div class="card-collapse">
						<div class="card-header" role="tab" id="headingThree">
							<h5 class="mb-0">
								<a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									Collapsible Group Item #3
									<i class="material-icons">keyboard_arrow_down</i>
								</a>
							</h5>
						</div>
						<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
							<div class="card-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<!-- <button type="button" class="btn btn-primary ml-auto" onclick="submitActivity()">Submit Activity</button> -->
			</div>
		</div>
	</div>
</div>


@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
	var table
    $(document).ready(function(){
    	$.ajax({
    		url:"{{url('time-sheet/getParameter')}}",
    		success:function(result){
		    	$("#selectCustomer").select2({
		    		dropdownParent: $('#addActivityModal'),
		    		data:result.customer
		    	});

		    	// $("#selectPID").select2({
		    	// 	dropdownParent: $('#addActivityModal'),
		    	// 	data:result.PID
		    	// });

		    	$("#selectEditCustomer").select2({
		    		dropdownParent: $('#editActivityModal'),
		    		data:result.customer
		    	});

		    	$("#selectEditPID").select2({
		    		dropdownParent: $('#editActivityModal'),
		    		data:result.PID
		    	});

		    	$.each(result.PIC,function(key,value){
		    		$("#filterPIC").append('<option value="' + value.text + '">' + value.text + '</option>')
		    	})

		    	$.each(result.customer,function(key,value){
			    	$("#filterCustomer").append('<option value="' + value.id + '">' + value.text + '</option>')
			    	// console.log("ojan ganteng " + value.text)
				});

				$.each(result.PID,function(key,value){
			    	$("#filterPID").append('<option value="' + value.id + '">' + value.text + '</option>')
			    	// console.log("ojan ganteng " + value.text)
				});

				$(".selectpicker2").selectpicker({
					width:"300px"
				});

    		}
    	})

    	$("#selectCustomer").on('change',function(){
    		var idCustomer = this.value
    		$.ajax({
    			url:"{{url('time-sheet/getParameterPID')}}",
    			data:{
    				id_customer:idCustomer
    			},
    			success:function(result){
    				$("#selectPID").select2({
			    		dropdownParent: $('#addActivityModal'),
			    		data:result.PID
			    	});
    			}
    		})
    		console.log(this.value)
    	})

    	$('.datetimepicker').datetimepicker({
			icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-chevron-up",
				down: "fa fa-chevron-down",
				previous: 'fa fa-chevron-left',
				next: 'fa fa-chevron-right',
				today: 'fa fa-screenshot',
				clear: 'fa fa-trash',
				close: 'fa fa-remove'
			}
		});

		if("{{Auth::user()->roles}}" == "Supervisor"){
			var columns = [
				{data:'pic',className:'text-center'},
				{data:'execute_at_formated',orderData:[ 13 ],className:'text-center'},
				{data:'code',className:'text-center'},
				{data:'pid'},
				{data:'activity'},
				{data:'site',className:'text-center'},
				{data:'duration',className:'text-center'},
				{data:'status_html',className:'text-center'},
				{data:'id_customer',visible: false,searchable: true},
				{data:'id_pid',visible: false,searchable: true},
				{data:'status',visible: false,searchable: true},
				{data:'actions',visible: false,className:'text-center',searchable: true},
				{data:'approved',visible: false,className:'text-center',searchable: true},
				{data:'execute_at_sort',targets: [ 1 ] ,visible: false,className:'text-center',searchable: true}
			]
		} else {
			var columns = [
				{data:'pic',visible: false,className:'text-center'},
				{data:'execute_at_formated',orderData:[ 13 ],className:'text-center'},
				{data:'code',className:'text-center'},
				{data:'pid'},
				{data:'activity'},
				{data:'site',className:'text-center'},
				{data:'duration',className:'text-center'},
				{data:'status_html',className:'text-center'},
				{data:'id_customer',visible: false,searchable: true},
				{data:'id_pid',visible: false,searchable: true},
				{data:'status',visible: false,searchable: true},
				{data:'actions',className:'text-center',searchable: true},
				{data:'approved',className:'text-center',searchable: true},
				{data:'execute_at_sort',targets: [ 1 ] ,visible: false,className:'text-center',searchable: true}
			]
		}

        $('#datatables').DataTable({
        	ajax:{
				type:"GET",
				url:"{{url('time-sheet/getData')}}",
				data:{
					id_user:"{{Auth::user()->id}}"
				},
				dataSrc: function (json){
						json.data.forEach(function(data,idex){
							if(data.status == "Done"){
								data.status_html = '<span class="badge badge-pill badge-success">' + data.status + '</span>'
							} else if (data.status == "On Progress"){
								data.status_html = '<span class="badge badge-pill badge-info">' + data.status + '</span>'
							} else if (data.status == "Pending"){
								data.status_html = '<span class="badge badge-pill badge-warning">' + data.status + '</span>'
							} else if (data.status == "Cancel"){
								data.status_html = '<span class="badge badge-pill badge-primary">' + data.status + '</span>'
							}

							if(data.approved == "Not-yet"){
								data.approved = '<button onclick="getCommentActivity(' + data.id + ')" class="btn btn-link btn-warning btn-just-icon"><i class="material-icons">horizontal_rule</i></button>'
							} else if (data.approved == "Approved"){
								data.approved = '<button onclick="getCommentActivity(' + data.id + ')" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">done</i></button>'
							} else {
								data.approved = '<button onclick="getCommentActivity(' + data.id + ')" class="btn btn-link btn-danger btn-just-icon"><i class="material-icons">close</i></button>'
							} 
							data.actions = ""
							if(data.submited == "Not-yet"){
								data.actions = '<button class="btn btn-info btn-sm btn-just-icon like" onclick="showEditActivity(' + data.id + ')"><i class="material-icons">edit</i></button>'
								data.actions += '<button class="btn btn-danger btn-sm btn-just-icon like" onclick="deleteActivity(' + data.id + ')"><i class="material-icons">clear</i></button>'
							}

							data.execute_at_formated = moment(data.execute_at).format('D-MMM-YYYY')
						})
						return json.data
					}
			},
			columns:columns,
			order:[[1,"desc"]],
			responsive: true,
			// searching: false,
			lengthChange: false,
		});
    })

    function createActivity(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To create this activity?",
	        buttonsStyling: false,
	        showCancelButton: true,
			allowOutsideClick: false,
			allowEscapeKey: false,
			allowEnterKey: false,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
	        confirmButtonClass: "btn btn-success",
	        cancelButtonClass: "btn btn-danger"
		}).then((result) => {
			if (result.value){
				console.log(result.value)
		    	$.ajax({
		    		url:"{{url('time-sheet/addActivity')}}",
		    		data:{
		    			addDateTime:$("#addDateTime").val(),
						addCustomerID:$("#selectCustomer").val(),
						addPID:$("#selectPID").val(),
						addDescription:$("#addDescription").val(),
						addSiteLocation:$("#addSiteLocation").val(),
						addDuration:$("#addDuration").val(),
						addStatus:$("#addStatus").val(),
						addUser:"{{Auth::user()->id}}"
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's sending..",
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false,
							customClass: {
								popup: 'border-radius-0',
							},
							didOpen: () => {
								Swal.showLoading()
							}
						})
					},
		    		success:function(result){
		    			Swal.hideLoading()
						Swal.fire({
							title: 'Success!',
							text: 'Activity created',
							icon: 'success',
							confirmButtonText: 'Reload',
						}).then((result) => {
							window.location.reload()
						})
		    		}
		    	})
			}
		})
    }

    function showEditActivity(id_activity){
    	console.log(id_activity)
    	$.ajax({
    		url:"{{url('time-sheet/getActivityEdit')}}",
    		data:{
    			id_activity:id_activity,
    		},
    		success:function(result){

    			$('#editDateTime').datetimepicker({
    				defaultDate: moment(result.execute_at),
    				useCurrent: false ,
					icons: {
						time: "fa fa-clock-o",
						date: "fa fa-calendar",
						up: "fa fa-chevron-up",
						down: "fa fa-chevron-down",
						previous: 'fa fa-chevron-left',
						next: 'fa fa-chevron-right',
						today: 'fa fa-screenshot',
						clear: 'fa fa-trash',
						close: 'fa fa-remove'
					}
				});

    			$("#selectEditCustomer").val(result.id_customer);
				$('#selectEditCustomer').trigger('change'); 
				$("#selectEditPID").val(result.id_pid);
				$('#selectEditPID').trigger('change'); 

				$("#editDescription").val(result.activity)
				$("#editSiteLocation").val(result.site).change()
				$("#editDuration").val(result.duration).change()
				$("#editStatus").val(result.status).change()

				$("#buttonEditActivity").attr('onclick','editActivity(' + id_activity + ')')

    			$("#editActivityModal").modal('show')
    		}
    	})
    }

    function editActivity(id_activity){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To edit this activity?",
	        buttonsStyling: false,
	        showCancelButton: true,
			allowOutsideClick: false,
			allowEscapeKey: false,
			allowEnterKey: false,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
	        confirmButtonClass: "btn btn-success",
	        cancelButtonClass: "btn btn-danger"
		}).then((result) => {
			if (result.value){
				console.log(result.value)
		    	$.ajax({
		    		url:"{{url('time-sheet/editActivity')}}",
		    		data:{
		    			id_activity:id_activity,
		    			editDateTime:$("#editDateTime").val(),
						editCustomerID:$("#selectEditCustomer").val(),
						editPID:$("#selectEditPID").val(),
						editDescription:$("#editDescription").val(),
						editSiteLocation:$("#editSiteLocation").val(),
						editDuration:$("#editDuration").val(),
						editStatus:$("#editStatus").val(),
						editUser:"{{Auth::user()->id}}"
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's sending..",
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false,
							customClass: {
								popup: 'border-radius-0',
							},
							didOpen: () => {
								Swal.showLoading()
							}
						})
					},
		    		success:function(result){
		    			Swal.hideLoading()
						Swal.fire({
							title: 'Success!',
							text: 'Activity edited',
							icon: 'success',
							confirmButtonText: 'Reload',
						}).then((result) => {
							window.location.reload()
						})
		    		}
		    	})
			}
		})
    }

    function deleteActivity(id_activity){
    	console.log(id_activity)
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To delete this activity?",
	        buttonsStyling: false,
	        showCancelButton: true,
			allowOutsideClick: false,
			allowEscapeKey: false,
			allowEnterKey: false,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
	        confirmButtonClass: "btn btn-success",
	        cancelButtonClass: "btn btn-danger"
		}).then((result) => {
			if (result.value){
				console.log(result.value)
		    	$.ajax({
		    		url:"{{url('time-sheet/deleteActivity')}}",
		    		data:{
		    			id_activity:id_activity,
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's deleting..",
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false,
							customClass: {
								popup: 'border-radius-0',
							},
							didOpen: () => {
								Swal.showLoading()
							}
						})
					},
		    		success:function(result){
		    			Swal.hideLoading()
						Swal.fire({
							title: 'Success!',
							text: 'Activity deleted',
							icon: 'success',
							confirmButtonText: 'Reload',
						}).then((result) => {
							window.location.reload()
						})
		    		}
		    	})
			}
		})
    }

    function showSubmitActivity(){
    	$.ajax({
    		url:"{{url('time-sheet/getDataUnsubmited')}}",
    		data:{
    			id_user:"{{Auth::user()->id}}",
    		},
    		success:function(result){
    			console.log(result)
    			$("#tableBodySubmitedActivity").empty()
    			var append = ""
    			$.each(result,function(key,data){
					append += '<tr>'
					append += '	<td class="text-center">' + moment(data.execute_at).format('D-MMM-YYYY') + '</td>'
					append += '	<td class="text-center">' + data.code + '</td>'
					append += '	<td class="text-center">' + data.pid + '</td>'
					append += '	<td>' + data.activity + '</td>'
					append += '	<td class="text-center">' + data.site + '</td>'
					append += '	<td class="text-center">' + data.duration + '</td>'

					if(data.status == "Done"){
						data.status_html = '<span class="badge badge-pill badge-success">' + data.status + '</span>'
					} else if (data.status == "On Progress"){
						data.status_html = '<span class="badge badge-pill badge-info">' + data.status + '</span>'
					} else if (data.status == "Pending"){
						data.status_html = '<span class="badge badge-pill badge-warning">' + data.status + '</span>'
					} else if (data.status == "Cancel"){
						data.status_html = '<span class="badge badge-pill badge-primary">' + data.status + '</span>'
					}

					append += '	<td class="text-center">' + data.status_html + '</td>'
					append += '</tr>'
				});
    			$("#tableBodySubmitedActivity").append(append)
    			$("#submitActivityModal").modal('show')
    		}
    	})
    	
    }

    function submitActivity(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To submite all of this activity?",
	        buttonsStyling: false,
	        showCancelButton: true,
			allowOutsideClick: false,
			allowEscapeKey: false,
			allowEnterKey: false,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
	        confirmButtonClass: "btn btn-success",
	        cancelButtonClass: "btn btn-danger"
		}).then((result) => {
			if (result.value){
				console.log(result.value)
		    	$.ajax({
		    		url:"{{url('time-sheet/submitActivity')}}",
		    		data:{
		    			id_user:"{{Auth::user()->id}}",
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's submitting..",
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false,
							customClass: {
								popup: 'border-radius-0',
							},
							didOpen: () => {
								Swal.showLoading()
							}
						})
					},
		    		success:function(result){
		    			Swal.hideLoading()
						Swal.fire({
							title: 'Success!',
							text: 'All activity submited',
							icon: 'success',
							confirmButtonText: 'Reload',
						}).then((result) => {
							window.location.reload()
						})
		    		}
		    	})
			}
		})
    }

    function showApproveActivity(){
    	$.ajax({
    		url:"{{url('time-sheet/getDataUnapproved')}}",
    		success:function(result){

    			$("#accordion").empty()

    			$.each(result,function(key,data){
    				// console.log(key)

	    			var append = "";

	    			var parameter = "'" + key + "'"

    				append += '<div class="card-collapse">'
					append += '	<div class="card-header" role="tab" id="heading' + key.replace(/\s+/g,"_") + '">'
					append += '		<h5 class="mb-0">'
					append += '			<a data-toggle="collapse" href="#collapse' + key.replace(/\s+/g,"_") + '" aria-expanded="false" aria-controls="collapse' + key.replace(/\s+/g,"_") + '" class="collapsed">'
					append += '				Approvement for ' + key
					append += '				<i class="material-icons">keyboard_arrow_down</i>'
					append += '			</a>'
					append += '		</h5>'
					append += '	</div>'
					append += '	<div id="collapse' + key.replace(/\s+/g,"_") + '" class="collapse" role="tabpanel" aria-labelledby="heading' + key.replace(/\s+/g,"_") + '" data-parent="#accordion" style="">'
					append += '		<div class="card-body">'
					// append += '			asdaf'
					append += '			<div class="table-responsive">'
					append += '				<table class="table">'
					append += '					<thead class=" text-primary">'
					append += '						<tr>'
					append += '							<th class="text-center">Date</th>'
					append += '							<th class="text-center">Customer ID</th>'
					append += '							<th class="text-center">ID Project</th>'
					append += '							<th>Description Activity</th>'
					append += '							<th class="text-center">Site Location</th>'
					append += '							<th class="text-center">Duration</th>'
					append += '							<th class="text-center">Status</th>'
					append += '							<th class="text-center">Action</th>'
					append += '						</tr>'
					append += '					</thead>'
					append += '					<tbody id="table' + key.replace(/\s+/g,"_") + '">'
					append += '					</tbody>'
					append += '					<tfoot>'
					append += '						<tr>'
					append += '							<th colspan="8" class="text-right">'
					append += '								<button class="btn btn-success" onclick="activityApproveAll(' + parameter + ')"><i class="material-icons">task_alt</i> Approve</button>'
					append += '							</th>'
					append += '						</tr>'
					append += '					</tfoot>'
					append += '				</table>'
					append += '			</div>'
					append += '		</div>'
					append += '	</div>'
					append += '</div>'

					$("#accordion").append(append)

					var appendItem = ""
					$.each(data,function(keyItem,dataItem){
						// console.log(dataItem.activity)
						appendItem += '<tr>'

						appendItem += '	<td class="text-center">' + moment(dataItem.execute_at).format('D-MMM-YYYY') + '</td>'
						appendItem += '	<td class="text-center">' + dataItem.code + '</td>'
						appendItem += '	<td class="text-center">' + dataItem.pid + '</td>'
						appendItem += '	<td>' + dataItem.activity + '</td>'
						appendItem += '	<td class="text-center">' + dataItem.site + '</td>'
						appendItem += '	<td class="text-center">' + dataItem.duration + '</td>'

						if(dataItem.status == "Done"){
							dataItem.status_html = '<span class="badge badge-pill badge-success">' + dataItem.status + '</span>'
						} else if (dataItem.status == "On Progress"){
							dataItem.status_html = '<span class="badge badge-pill badge-info">' + dataItem.status + '</span>'
						} else if (dataItem.status == "Pending"){
							dataItem.status_html = '<span class="badge badge-pill badge-warning">' + dataItem.status + '</span>'
						} else if (dataItem.status == "Cancel"){
							dataItem.status_html = '<span class="badge badge-pill badge-primary">' + dataItem.status + '</span>'
						}

						appendItem += '	<td class="text-center">' + dataItem.status_html + '</td>'
						appendItem += '	<td class="text-center">'
						activity = "'" + key + " - " + dataItem.activity + "'"
						appendItem += '		<button class="btn btn-default btn-sm btn-just-icon" onclick="activityComment(' + dataItem.id + ',' + activity + ')"><i class="material-icons">feedback</i></button>'
						appendItem += '	</td>'
						appendItem += '</tr>'
					})
					// console.log(appendItem)
					$("#table" + key.replace(/\s+/g,"_")).append(appendItem)
				});

    			// console.log(append)

		    	$("#submitApproveModal").modal('show')
    		}
    	})
    }

    function activityApproveAll(parameter){
    	console.log(parameter)
    	Swal.fire({
			title: "Are you sure!",
			text: "To approve all of this activity?",
			buttonsStyling: false,
			showCancelButton: true,
			allowOutsideClick: false,
			allowEscapeKey: false,
			allowEnterKey: false,
			confirmButtonText: 'Yes',
			cancelButtonText: 'No',
			confirmButtonClass: "btn btn-success",
			cancelButtonClass: "btn btn-danger"
		}).then((result) => {
			if (result.value){
				console.log(result.value)
				$.ajax({
					url:"{{url('time-sheet/approveAllActivity')}}",
					data:{
						parameter:parameter,
					},
					beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's approving..",
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false,
							customClass: {
								popup: 'border-radius-0',
							},
							didOpen: () => {
								Swal.showLoading()
							}
						})
					},
					success:function(result){
						Swal.hideLoading()
						Swal.fire({
							title: 'Success!',
							text: 'Activity approved',
							icon: 'success',
							confirmButtonText: 'Reload',
						}).then((result) => {
							window.location.reload()
						})
					}
				})
			}
		})
    }

    function activityComment(id,activity){
    	$.ajax({
			url:"{{url('time-sheet/getCommentActivity')}}",
			data:{
				id_activity:id
			},
			success:function(resultComment){

				$("#submitApproveModal").modal('hide')
		    	var html = ""
		    	html += '<small>' + activity + '</small>'
				html += '<input id="input-comment" type="text" value="' + resultComment + '" class="form-control">'

		    	Swal.fire({
					title: 'Input comment for Activity',
					html: html,
					showCancelButton: true,
					confirmButtonClass: 'btn btn-success',
					cancelButtonClass: 'btn btn-danger',
					buttonsStyling: false
				}).then(function(result) {
					if (result.value){
						$.ajax({
							url:"{{url('time-sheet/commentActivity')}}",
							data:{
								id_activity:id,
								comment:$("#input-comment").val()
							},
							beforeSend: function(){
								Swal.fire({
									title: 'Please Wait..!',
									text: "It's commenting..",
									allowOutsideClick: false,
									allowEscapeKey: false,
									allowEnterKey: false,
									customClass: {
										popup: 'border-radius-0',
									},
									didOpen: () => {
										Swal.showLoading()
									}
								})
							},
							success:function(result){
								Swal.hideLoading()
								Swal.fire({
									title: 'Success!',
									text: 'Activity commented',
									icon: 'success',
									confirmButtonText: 'Reload',
								}).then((result) => {
									window.location.reload()
								})
							}
						})
					} else {
						$("#submitApproveModal").modal('show')
					}
				})
			}
		})
    }

    function getCommentActivity(id){
    	$.ajax({
			url:"{{url('time-sheet/getCommentActivity')}}",
			data:{
				id_activity:id
			},
			success:function(resultComment){
				// console.log(resultComment)

		    	var html = ""
		    	html += '<span>' + resultComment + '</span>'

		    	Swal.fire({
					title: 'Comment for this Activity',
					html: html,
					confirmButtonClass: 'btn btn-success',
					buttonsStyling: false
				})
			}
		})
    }

    $("#filterPIC").on('change',function(){
    	if($(this).val() == 0){
	    	$("#datatables").DataTable().columns(0).search('').draw()
    	} else {
	    	$("#datatables").DataTable().columns(0).search($(this).val().join('|'),true, false).draw()
    	}
    })

    $("#filterCustomer").on('change',function(){
    	if($(this).val() == 0){
	    	$("#datatables").DataTable().columns(8).search('').draw()
    	} else {
	    	$("#datatables").DataTable().columns(8).search($(this).val().join('|'),true, false).draw()
    	}
    })

    $("#filterPID").on('change',function(){
    	if($(this).val() == 0){
	    	$("#datatables").DataTable().columns(9).search('').draw()
    	} else {
	    	$("#datatables").DataTable().columns(9).search($(this).val().join('|'),true, false).draw()
    	}
    })

    $("#filterSite").on('change',function(){
    	console.log($(this).val())
    	if($(this).val() == 0){
	    	$("#datatables").DataTable().columns(5).search('').draw()
    	} else {
	    	$("#datatables").DataTable().columns(5).search($(this).val().join('|'),true, false).draw()
    	}
    })

    $("#filterStatus").on('change',function(){
    	if($(this).val() == 0){
	    	$("#datatables").DataTable().columns(10).search('').draw()
    	} else {
	    	$("#datatables").DataTable().columns(10).search($(this).val().join('|'),true, false).draw()
    	}
    })

    $("#searchTable").keydown(function(){
    	if($(this).val() == ''){
	    	$("#datatables").DataTable().search('').draw()
    	} else {
	    	$("#datatables").DataTable().search($(this).val()).draw()
    	}
    })

    $("#showEntry").on('change',function(){
    	$("#datatables").DataTable().page.len(this.value).draw();
    })
</script>
@endsection