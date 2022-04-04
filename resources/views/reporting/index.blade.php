@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
				<div class="card">
					<div class="card-header card-header-text card-header-warning">
						<div class="card-text">
							<h4 class="card-title">Reporting Time Sheet</h4>
							<p class="card-category">Reporting is displayed for all time-sheets and used for decision making</p>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-3 cards">
								<div class="card card-pricing card-raised">
									<div class="card-body">
										<h6 class="card-category">Standart Reporting</h6>
										<div class="card-icon icon-primary">
											<i class="material-icons">person</i>
										</div>
										<h3 class="card-title">User</h3>
										<p class="card-description">
											This report will display all time-sheets related to the selected user
										</p>
										<button class="btn btn-primary btn-round" data-toggle="modal" data-target="#generateReportUser">Generate Report</button>
									</div>
								</div>
							</div>
							<div class="col-lg-3 cards">
								<div class="card card-pricing card-raised">
									<div class="card-body">
										<h6 class="card-category">Standart Reporting</h6>
										<div class="card-icon icon-primary">
											<i class="material-icons">groups</i>
										</div>
										<h3 class="card-title">Customer</h3>
										<p class="card-description">
											All time-sheets will be displayed according to the currently selected customer
										</p>
										<button class="btn btn-primary btn-round" data-toggle="modal" data-target="#generateReportCustomer">Generate Report</button>
									</div>
								</div>
							</div>
							<div class="col-lg-3 cards">
								<div class="card card-pricing card-raised">
									<div class="card-body">
										<h6 class="card-category">Standart Reporting</h6>
										<div class="card-icon icon-primary">
											<i class="material-icons">account_balance_wallet</i>
										</div>
										<h3 class="card-title">Project ID</h3>
										<p class="card-description">
											The time-sheet will be filtered according to the selected customer id
										</p>
										<button class="btn btn-primary btn-round" data-toggle="modal" data-target="#generateReportCustomerID">Generate Report</button>
									</div>
								</div>
							</div>
							<div class="col-lg-3 cards">
								<div class="card card-pricing card-raised">
									<div class="card-body">
										<h6 class="card-category">Standart Reporting</h6>
										<div class="card-icon icon-primary">
											<i class="material-icons">task</i>
										</div>
										<h3 class="card-title">Approval</h3>
										<p class="card-description">
											The number of improvements will be displayed across the selected time-sheet
										</p>
										<button class="btn btn-primary btn-round" data-toggle="modal" data-target="#generateReportApproved">Generate Report</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="generateReportUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Generate Report User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="row">
						<label class="col-sm-2 col-form-label">Start Date</label>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control datepicker" id="reportUserStart">
							</div>
						</div>
						<label class="col-sm-2 col-form-label">End Date</label>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control datepicker" id="reportUserEnd">
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">User</label>
						<div class="col-sm-10">
							<div class="form-group">
								<select class="form-control select2" id="reportUserSelected" title="Select User" style="width:100%">
									<option disabled selected>Select User</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="generateReportUser()">Generate Report</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="generateReportCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Generate Report Customer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="row">
						<label class="col-sm-2 col-form-label">Start Date</label>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control datepicker" id="reportCustomerStart">
							</div>
						</div>
						<label class="col-sm-2 col-form-label">End Date</label>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control datepicker" id="reportCustomerEnd">
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Customer</label>
						<div class="col-sm-10">
							<div class="form-group">
								<select class="form-control select2" id="reportCustomerSelected" title="Select Customer" style="width:100%">
									<option disabled selected>Select Customer</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="generateReportCustomer()">Generate Report</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="generateReportCustomerID" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Generate Report Customer ID</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="row">
						<label class="col-sm-2 col-form-label">Start Date</label>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control datepicker" id="reportCustomerIDStart">
							</div>
						</div>
						<label class="col-sm-2 col-form-label">End Date</label>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control datepicker" id="reportCustomerIDEnd">
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Customer ID</label>
						<div class="col-sm-10">
							<div class="form-group">
								<select class="form-control select2" id="reportCustomerIDSelected" title="Select Customer" style="width:100%">
									<option disabled selected>Select Customer</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="generateReportCustomerID()">Generate Report</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="generateReportApproved" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Generate Report Approved</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="row">
						<label class="col-sm-2 col-form-label">Start Date</label>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control datepicker" id="reportApprovedStart">
							</div>
						</div>
						<label class="col-sm-2 col-form-label">End Date</label>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control datepicker" id="reportApprovedEnd">
							</div>
						</div>
					</div>
					<!-- <div class="row">
						<label class="col-sm-2 col-form-label">Customer ID</label>
						<div class="col-sm-10">
							<div class="form-group">
								<select class="form-control select2" id="reportCustomerIDSelected" title="Select Customer" style="width:100%">
									<option disabled selected>Select Customer</option>
								</select>
							</div>
						</div>
					</div> -->
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="generateReportApproved()">Generate Report</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.datepicker').datetimepicker({
			format: 'DD/MM/YYYY',
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

		$('#reportUserEnd').datetimepicker({
			useCurrent: false //Important! See issue #1075
		});

		$.ajax({
			url:"{{url('reporting/getParameter')}}",
			success:function(result){
				$("#reportUserSelected").select2({
		    		dropdownParent: $('#generateReportUser'),
		    		data:result.user
		    	});

		    	$("#reportCustomerSelected").select2({
		    		dropdownParent: $('#generateReportCustomer'),
		    		data:result.customer
		    	});

		    	$("#reportCustomerIDSelected").select2({
		    		dropdownParent: $('#generateReportCustomerID'),
		    		data:result.customerID
		    	});
			}
		})

		$("#reportUserStart").on("dp.change", function (e) {
			$('#reportUserEnd').data("DateTimePicker").minDate(e.date);
		});

		$("#reportUserEnd").on("dp.change", function (e) {
			$('#reportUserStart').data("DateTimePicker").maxDate(e.date);
		});

		$("#reportCustomerStart").on("dp.change", function (e) {
			$('#reportCustomerEnd').data("DateTimePicker").minDate(e.date);
		});

		$("#reportCustomerEnd").on("dp.change", function (e) {
			$('#reportCustomerStart').data("DateTimePicker").maxDate(e.date);
		});

		$("#reportCustomerIDStart").on("dp.change", function (e) {
			$('#reportCustomerIDEnd').data("DateTimePicker").minDate(e.date);
		});

		$("#reportCustomerIDEnd").on("dp.change", function (e) {
			$('#reportCustomerIDStart').data("DateTimePicker").maxDate(e.date);
		});

		$("#reportApprovedStart").on("dp.change", function (e) {
			$('#reportApprovedEnd').data("DateTimePicker").minDate(e.date);
		});

		$("#reportApprovedEnd").on("dp.change", function (e) {
			$('#reportApprovedStart').data("DateTimePicker").maxDate(e.date);
		});
    })

    function generateReportUser(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To create this report?",
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
		    		url:"{{url('reporting/generate/reportUser')}}",
		    		data:{
		    			reportUserStart:$("#reportUserStart").val(),
						reportUserEnd:$("#reportUserEnd").val(),
						reportUserSelected:$("#reportUserSelected").val()
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's creating..",
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
		    		success:function(resultAjax){
		    			Swal.hideLoading()
						Swal.fire({
							title: 'Success!',
							text: 'Report created',
							icon: 'success',
							// confirmButtonText: 'Reload',
							confirmButtonText: '<a style="color:#fff;" href="' + resultAjax + '">Get Report</a>',
						}).then((result) => {
							window.location.u()
						})
		    		}
		    	})
			}
		})
    }

    function generateReportCustomer(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To create this report?",
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
		    		url:"{{url('reporting/generate/reportCustomer')}}",
		    		data:{
		    			reportCustomerStart:$("#reportCustomerStart").val(),
						reportCustomerEnd:$("#reportCustomerEnd").val(),
						reportCustomerSelected:$("#reportCustomerSelected").val()
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's creating..",
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
		    		success:function(resultAjax){
		    			Swal.hideLoading()
						Swal.fire({
							title: 'Success!',
							text: 'Report created',
							icon: 'success',
							// confirmButtonText: 'Reload',
							confirmButtonText: '<a style="color:#fff;" href="' + resultAjax + '">Get Report</a>',
						}).then((result) => {
							window.location.u()
						})
		    		}
		    	})
			}
		})
    }

    function generateReportCustomerID(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To create this report?",
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
		    		url:"{{url('reporting/generate/reportCustomerID')}}",
		    		data:{
		    			reportCustomerIDStart:$("#reportCustomerIDStart").val(),
						reportCustomerIDEnd:$("#reportCustomerIDEnd").val(),
						reportCustomerIDSelected:$("#reportCustomerIDSelected").val()
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's creating..",
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
		    		success:function(resultAjax){
		    			Swal.hideLoading()
						Swal.fire({
							title: 'Success!',
							text: 'Report created',
							icon: 'success',
							// confirmButtonText: 'Reload',
							confirmButtonText: '<a style="color:#fff;" href="' + resultAjax + '">Get Report</a>',
						}).then((result) => {
							window.location.u()
						})
		    		}
		    	})
			}
		})
    }

    function generateReportApproved(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To create this report?",
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
		    		url:"{{url('reporting/generate/reportApproved')}}",
		    		data:{
		    			reportApprovedStart:$("#reportApprovedStart").val(),
						reportApprovedEnd:$("#reportApprovedEnd").val(),
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's creating..",
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
		    		success:function(resultAjax){
		    			Swal.hideLoading()
						Swal.fire({
							title: 'Success!',
							text: 'Report created',
							icon: 'success',
							// confirmButtonText: 'Reload',
							confirmButtonText: '<a style="color:#fff;" href="' + resultAjax + '">Get Report</a>',
						}).then((result) => {
							window.location.u()
						})
		    		}
		    	})
			}
		})
    }
</script>
@endsection