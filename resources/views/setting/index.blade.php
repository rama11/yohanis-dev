@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
				<div class="card">
					<div class="card-header card-header-tabs card-header-rose">
						<div class="nav-tabs-navigation">
							<div class="nav-tabs-wrapper">
								<span class="nav-tabs-title">Setting :</span>
								<ul class="nav nav-tabs" data-tabs="tabs">
									<li class="nav-item" style="display:{{Auth::user()->roles == 'Supervisor' ? 'none' : 'block'}}">
										<a class="nav-link {{Auth::user()->roles == 'Supervisor' ? '' : 'active'}}" href="#users" data-toggle="tab">
											<i class="material-icons">person</i> Users
											<div class="ripple-container"></div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{Auth::user()->roles == 'Supervisor' ? 'active' : ''}}" href="#customer" data-toggle="tab">
											<i class="material-icons">groups</i> Customer
											<div class="ripple-container"></div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#cutomer_id" data-toggle="tab">
											<i class="material-icons">account_balance_wallet</i> Project ID
											<div class="ripple-container"></div>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane {{Auth::user()->roles == 'Supervisor' ? '' : 'active'}}" id="users">
								<h3>Displayed all users registered in the application</h3>
								<div class="d-flex justify-content-end">
									
									<button class="btn btn-primary" data-toggle="modal" data-target="#addUser">
											<i class="material-icons">add</i> Add User
										<div class="ripple-container"></div>
									</button>
								</div>
								<div class="material-datatables">
									<table id="datatablesUser" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
										<thead>
											<tr>
												<th>ID</th>
												<th>Full Name</th>
												<th>Email</th>
												<th class="text-center">Roles</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>ID</th>
												<th>Full Name</th>
												<th>Email</th>
												<th class="text-center">Roles</th>
												<th class="text-center">Action</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="tab-pane {{Auth::user()->roles == 'Supervisor' ? 'active' : ''}}" id="customer">
								<h3>Displayed all customer registered in the application</h3>
								<div class="d-flex justify-content-end">
									
									<button class="btn btn-primary" data-toggle="modal" data-target="#addCustomer">
											<i class="material-icons">add</i> Add Customer
										<div class="ripple-container"></div>
									</button>
								</div>
								<div class="material-datatables">
									<table id="datatablesCustomer" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
										<thead>
											<tr>
												<th>ID</th>
												<th>Acronym</th>
												<th>Customer Name</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>ID</th>
												<th>Acronym</th>
												<th>Customer Name</th>
												<th class="text-center">Action</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="tab-pane" id="cutomer_id">
								<h3>Displayed all customer id registered in the application</h3>
								<div class="d-flex justify-content-end">
									
									<button class="btn btn-primary" data-toggle="modal" data-target="#addCustomerID">
											<i class="material-icons">add</i> Add Customer ID
										<div class="ripple-container"></div>
									</button>
								</div>
								<div class="material-datatables">
									<table id="datatablesCustomerID" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Customer</th>
												<th>Proejct ID</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Customer</th>
												<th>Project ID</th>
												<th class="text-center">Action</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="get" action="/" class="form-horizontal">
					<div class="row">
						<label class="col-sm-2 col-form-label">Full Name</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="addFullname">
								<!-- <span class="bmd-help">Please fill in your activities according to what you do</span> -->
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="addEmail">
								<!-- <span class="bmd-help">Please fill in your activities according to what you do</span> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<select class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" title="User Roles" id="addRoles">
									<option disabled selected>User Roles</option>
									<option value="Supervisor">Supervisor</option>
									<option value="Tech Support">Tech Support</option>
									<option value="Helpdesk">Helpdesk</option>
									<option value="Project Coordinator">Project Coordinator</option>
									<option value="Admin">Admin</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="createUser()">Add User</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="get" action="/" class="form-horizontal">
					<div class="row">
						<label class="col-sm-2 col-form-label">Acronym</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="addAcronym">
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Customer Name</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="addCustomerName">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="createCustomer()">Add Customer</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="addCustomerID" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Customer ID</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="get" action="/" class="form-horizontal">
					<div class="row">
						<label class="col-sm-2 col-form-label">Customer</label>
						<div class="col-sm-10">
							<select class="form-control select2" id="addCustomerID_ID" title="Select Customer" style="width:100%">
								<option disabled selected>Select Customer</option>
							</select>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">PID</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="addCustomerID_Customer">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="createCustomerID()">Add Customer ID</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="get" action="/" class="form-horizontal">
					<input type="hidden" id="editCustomerID">
					<div class="row">
						<label class="col-sm-2 col-form-label">Acronym</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="editAcronym">
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Customer Name</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="editCustomerName">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="saveEditCustomer()">Save Edited Customer</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="get" action="/" class="form-horizontal">
					<input type="hidden" id="editUserID">
					<div class="row">
						<label class="col-sm-2 col-form-label">Full Name</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="editFullname">
								<!-- <span class="bmd-help">Please fill in your activities according to what you do</span> -->
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="editEmail">
								<!-- <span class="bmd-help">Please fill in your activities according to what you do</span> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<select class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" id="editRoles">
									<option disabled selected>User Roles</option>
									<option value="Supervisor">Supervisor</option>
									<option value="Tech Support">Tech Support</option>
									<option value="Helpdesk">Helpdesk</option>
									<option value="Project Coordinator">Project Coordinator</option>
									<option value="Admin">Admin</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="saveEditUser()">Save Edited User</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="editCustomerIDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Customer ID</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="get" action="/" class="form-horizontal">
					<input type="hidden" id="editCustomerID_ID1">
					<div class="row">
						<label class="col-sm-2 col-form-label">Customer</label>
						<div class="col-sm-10">
							<select class="form-control select2" id="editCustomerID_ID" title="Select Customer" style="width:100%">
								<option disabled selected>Select Customer</option>
							</select>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">PID</label>
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" id="editCustomerID_Customer">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-flex">
				<button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary ml-auto" onclick="saveEditCustomerID()">Save Edited Customer ID</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    	$('#datatablesUser').DataTable({
        	ajax:{
				type:"GET",
				url:"{{url('setting/getUsers')}}",
				dataSrc: function (json){
					json.data.forEach(function(data,idex){
						data.actions = '<button class="btn btn-info btn-just-icon like" onclick="editUser(' + data.id + ')"><i class="material-icons">edit</i></button>'
						data.actions += '<button class="btn btn-danger btn-just-icon like" onclick="deleteUser(' + data.id + ')"><i class="material-icons">clear</i></button>'
					})
					return json.data
				}
			},
			columns:[
				{data:'id'},
				{data:'name'},
				{data:'email'},
				{data:'roles',className:'text-center'},
				{data:'actions',className:'text-center'}
			],
			
			responsive: true,
			searching: false,
			lengthChange: false,
		});

		$('#datatablesCustomer').DataTable({
        	ajax:{
				type:"GET",
				url:"{{url('setting/getCustomer')}}",
				dataSrc: function (json){
					json.data.forEach(function(data,idex){
						data.actions = '<button class="btn btn-info btn-just-icon like" onclick="editCustomer(' + data.id + ')"><i class="material-icons">edit</i></button>'
						data.actions += '<button class="btn btn-danger btn-just-icon like" onclick="deleteCustomer(' + data.id + ')"><i class="material-icons">clear</i></button>'
					})
					return json.data
				}
			},
			columns:[
				{data:'id',className:'text-center'},
				{data:'code',className:'text-center'},
				{data:'customer_name'},
				{data:'actions',className:'text-center'}
			],
			
			responsive: true,
			searching: false,
			lengthChange: false,
		});

		$('#datatablesCustomerID').DataTable({
        	ajax:{
				type:"GET",
				url:"{{url('setting/getCustomerID')}}",
				dataSrc: function (json){
					json.data.forEach(function(data,idex){
						data.actions = '<button class="btn btn-info btn-just-icon like" onclick="editCustomerID(' + data.id + ')"><i class="material-icons">edit</i></button>'
						data.actions += '<button class="btn btn-danger btn-just-icon like" onclick="deleteCustomerID(' + data.id + ')"><i class="material-icons">clear</i></button>'

						data.customer_added = data.customer_i_d.code + " - " + data.customer_i_d.customer_name
					})

					return json.data
				}
			},
			columns:[
				{data:'id',className:'text-center'},
				{data:'customer_added',className:'text-center'},
				{data:'pid'},
				{data:'actions',className:'text-center'}
			],
			
			responsive: true,
			searching: false,
			lengthChange: false,
		});

		$.ajax({
    		url:"{{url('setting/getParameter')}}",
    		success:function(result){
		    	$("#addCustomerID_ID").select2({
		    		dropdownParent: $('#addCustomerID'),
		    		data:result.customer
		    	});

		    	$("#editCustomerID_ID").select2({
		    		dropdownParent: $('#editCustomerIDModal'),
		    		data:result.customer
		    	});
    		}
    	})
    })

    function editCustomer(id_customer){
    	$.ajax({
    		type:"GET",
    		url:"{{url('setting/getEachCustomer')}}",
    		data:{
    			id_customer:id_customer
    		},
    		success:function(result){
    			$("#editCustomerID").val(result.id)
    			$("#editAcronym").val(result.code)
    			$("#editCustomerName").val(result.customer_name)
    		},
    		complete:function(){
		    	$("#editCustomer").modal('show')
    		}

    	})
    }

    function saveEditCustomer(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To edit this customer?",
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
				$.ajax({
		    		type:"GET",
		    		url:"{{url('setting/editCustomer')}}",
		    		data:{
		    			id_customer:$("#editCustomerID").val(),
		    			editAcronym:$("#editAcronym").val(),
		    			editCustomerName:$("#editCustomerName").val()
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's editing..",
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
							text: 'Customer edited',
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

    function deleteCustomer(id_customer){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To delete this customer?",
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
				$.ajax({
		    		type:"GET",
		    		url:"{{url('setting/deleteCustomer')}}",
		    		data:{
		    			id_customer:id_customer
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
							text: 'Customer deleted',
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

    function createUser(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To create this user?",
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
				$.ajax({
		    		url:"{{url('setting/addUsers')}}",
		    		data:{
		    			addFullname:$("#addFullname").val(),
						addEmail:$("#addEmail").val(),
						addRoles:$("#addRoles").val()
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
							text: 'User created',
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

    function editUser(id_user){
    	$.ajax({
    		type:"GET",
    		url:"{{url('setting/getEachUser')}}",
    		data:{
    			id_user:id_user
    		},
    		success:function(result){
    			$("#editUserID").val(result.id)
    			$("#editFullname").val(result.name)
				$("#editEmail").val(result.email)
				$("#editRoles").val(result.roles)
    		},
    		complete:function(){
		    	$("#editUser").modal('show')
    		}

    	})
    }

    function saveEditUser(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To edit this user?",
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
				$.ajax({
		    		type:"GET",
		    		url:"{{url('setting/editUser')}}",
		    		data:{
		    			id_user:$("#editUserID").val(),
		    			editFullname:$("#editFullname").val(),
		    			editEmail:$("#editEmail").val(),
		    			editRoles:$("#editRoles").val()
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's editing..",
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
							text: 'User edited',
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

    function deleteUser(id_user){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To delete this user?",
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
				$.ajax({
		    		type:"GET",
		    		url:"{{url('setting/deleteUser')}}",
		    		data:{
		    			id_user:id_user
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
							text: 'User deleted',
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

    function createCustomer(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To create this customer?",
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
				$.ajax({
		    		url:"{{url('setting/addCustomer')}}",
		    		data:{
		    			addAcronym:$("#addAcronym").val(),
						addCustomerName:$("#addCustomerName").val()
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
							text: 'Customer created',
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

    function editCustomerID(id_customerID){
    	$.ajax({
    		type:"GET",
    		url:"{{url('setting/getEachCustomerID')}}",
    		data:{
    			id_customerID:id_customerID
    		},
    		success:function(result){
    			$("#editCustomerID_ID1").val(result.id);
    			$("#editCustomerID_ID").val(result.customer_i_d.id.toString()).trigger('change');
    			$("#editCustomerID_Customer").val(result.pid)
    		},
    		complete:function(){
		    	$("#editCustomerIDModal").modal('show')
    		}

    	})
    }

    function saveEditCustomerID(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To edit this Customer ID?",
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
				$.ajax({
		    		type:"GET",
		    		url:"{{url('setting/editCustomerID')}}",
		    		data:{
		    			id_customerID:$("#editCustomerID_ID1").val(),
		    			editCustomerID_ID:$("#editCustomerID_ID").val(),
		    			editCustomerID_Customer:$("#editCustomerID_Customer").val(),
		    		},
		    		beforeSend: function(){
						Swal.fire({
							title: 'Please Wait..!',
							text: "It's editing..",
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
							text: 'Customer ID edited',
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

    function deleteCustomerID(id_customerID){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To delete this Customer ID?",
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
				$.ajax({
		    		type:"GET",
		    		url:"{{url('setting/deleteCustomerID')}}",
		    		data:{
		    			id_customerID:id_customerID
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
							text: 'Customer ID deleted',
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

    function createCustomerID(){
    	Swal.fire({
	        title: "Are you sure!",
	        text: "To create this customer ID?",
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
		    	$.ajax({
		    		url:"{{url('setting/addCustomerID')}}",
		    		data:{
		    			addID:$("#addCustomerID_ID").val(),
						addPID:$("#addCustomerID_Customer").val()
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
							text: 'Customer ID created',
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
</script>
@endsection