@extends('layouts.app')
@section('title', 'My Profile') 
@section('css')
<style>
	.dataTables_paginate .paginate_button, .dataTables_paginate .paginate_button, .dataTables_paginate .ellipsis {
		 padding: 0px; 
		 border: 0px; 
	}
</style>
@endsection
@section('js')
	<script src="{{ URL::asset('js/plugins/dataTables/datatables.min.js') }}"></script>
@endsection
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            <h2>{{ Session::get('success') }}</h2>
        </div>
    @endif
<div class="row">
	<div class="col-md-12">
		<div class="tabs-container">
			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
				<li><a id="account_tab" href="#account-tab" data-toggle="tab"><span class="fa fa-user"></span><div>My Profile</div></a></li>
				@if($pub)
				<li><a id="pub_tab" href="#pub-tab" data-toggle="tab"><span class="fa fa-credit-card"></span><div>Payment Information</div></a></li>
				@endif
				@if($buyer)
				<li><a id="account_tab" href="#buyer-tab" data-toggle="tab"><span class="fa fa-copy"></span><div>Invoices</div></a></li>
				@endif
				@if($pub)
				<li><a id="pub_earn_tab" href="#pub-earn-tab" data-toggle="tab"><span class="fa fa-money"></span><div>Payments</div></a></li>
				@endif
			</ul>
			<div id="my-tab-content" class="tab-content">
				<div class="tab-pane table-responsive active" id="account-tab">
					<div class="ibox">
						<div class="ibox-content">
							@if($user->status == 0)
							<div class="alert alert-warning">
								<div class="row">
									<div class="col-md-4">
										<h3>Your Attention Is Needed</h3>
									</div>
									<div class="col-md-8">
										<p>Your E-Mail Address Has Not Been Confirmed!</p>
										<a href="/send_confirmation">
											<button class="btn btn-primary">Click Here To Re-Send Confirmation E-Mail</button>
										</a>
									</div>
								</div>
							</div>
							@endif
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<br>
									<h2 class="text-success" align="left" style="font-weight: bold;">Account Contact</h2>
									<form name="profile_form" id="profile_form" class="form-horizontal" role="form" method="POST" action="update_profile">
									{{ csrf_field() }}
										<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
											<label for="name" class="col-md-4 control-label">Name</label>
											<div class="col-sm-8">
												<input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

												@if ($errors->has('name'))
													<span class="help-block">
														<strong>{{ $errors->first('name') }}</strong>
													</span>
												@endif
											</div>
										</div>
										<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
											<label for="email" class="col-sm-4 control-label">Email</label>
											<div class="col-sm-8">
												<input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>                       
												@if ($errors->has('email'))
													<span class="help-block">
														<strong>{{ $errors->first('email') }}</strong>
													</span>
												@endif
											</div>
										</div>
										<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
											<label for="url" class="col-sm-4 control-label">Mobile Phone</label>
											<div class="col-sm-8">
												<input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
												@if ($errors->has('phone'))
													<span class="help-block">
														<strong>{{ $errors->first('phone') }}</strong>
													</span>
												@endif
											</div>
										</div>
										<div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
											<label for="company" class="col-sm-4 control-label">Company Name</label>

											<div class="col-sm-8">
												<input id="company" type="text" class="form-control" name="company" value="{{ $user->company }}">

												@if ($errors->has('company_name'))
													<span class="help-block">
														<strong>{{ $errors->first('company_name') }}</strong>
													</span>
												@endif
											</div>
										</div> 

										<h2 class="text-success" align="left" style="font-weight: bold;">Billing Information</h2>
										<div class="form-group{{ $errors->has('addr') ? ' has-error' : '' }}">
											<label for="addr" class="col-sm-4 control-label">Address</label>
											<div class="col-sm-8">
												<input id="addr" type="text" class="form-control" name="addr" value="{{ $user->addr }}" required>

												@if ($errors->has('addr'))
													<span class="help-block">
														<strong>{{ $errors->first('addr') }}</strong>
													</span>
												@endif
											</div>
										</div>
										<div class="form-group{{ $errors->has('addr2') ? ' has-error' : '' }}">
											<label for="addr2" class="col-sm-4 control-label">Address2</label>
											<div class="col-sm-8">
												<input id="addr2" type="text" class="form-control" name="addr2" value="{{ $user->addr2 }}">

												@if ($errors->has('addr2'))
													<span class="help-block">
														<strong>{{ $errors->first('addr2') }}</strong>
													</span>
												@endif
											</div>
										</div>
										<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
											<label for="city" class="col-sm-4 control-label">City</label>
											<div class="col-sm-8">
												<input id="city" type="text" class="form-control" name="city" value="{{ $user->city }}" required>

												@if ($errors->has('city'))
													<span class="help-block">
														<strong>{{ $errors->first('city') }}</strong>
													</span>
												@endif
											</div>
										</div> 
										<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
											<label for="state" class="col-sm-4 control-label">State</label>
											<div class="col-sm-8">
												<input id="state" type="text" class="form-control" name="state" value="{{ $user->state }}" maxlength="2" required>

												@if ($errors->has('state'))
													<span class="help-block">
														<strong>{{ $errors->first('state') }}</strong>
													</span>
												@endif
											</div>
										</div> 
										<div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
											<label for="zip" class="col-sm-4 control-label">Zip/Postal Code</label>
											<div class="col-sm-8">
												<input id="zip" type="text" class="form-control" name="zip" value="{{ $user->zip }}" required>

												@if ($errors->has('zip'))
													<span class="help-block">
														<strong>{{ $errors->first('zip') }}</strong>
													</span>
												@endif
											</div>
										</div> 
										<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
											<label for="country" class="col-sm-4 control-label">Country</label>
											<div class="col-sm-8">
												<select id="country" class="form-control" name="country" required>
												@foreach($countries as $country)
												<option value="{{ $country->id }}"
												@if($country->id == $user->country_code)
												selected
												@endif
												>{{ $country->country_name }}</option>
												@endforeach
												</select>
												@if ($errors->has('country'))
													<span class="help-block">
														<strong>{{ $errors->first('country') }}</strong>
													</span>
												@endif
											</div>
										</div>    
										<div class="form-group text-center">
											<br><br>
											<input class="btn btn-primary btn-lg" type="submit" name="submit" id="submit" />
										</div>
									</form>
								</div>
								<div class="col-xs-12 col-md-6">
									<br>
									<h2 class="text-success" align="left" style="font-weight: bold;">Change Password</h2>
									<form class="form-horizontal" id="changePassword">
										<div class="form-group">
											<label align="right" class="col-sm-4 control-label">Existing Password</label>
											<div class="col-sm-8"><input placeholder="Password" class="form-control" type="password"> </div>
										</div>
										<div class="form-group">
											<label align="right" class="col-sm-4 control-label">New Password</label>
											<div class="col-sm-8"><input type="password" class="form-control" name="password" placeholder="Change password"></div>
										</div>
										<div class="form-group">
											<label align="right" class="col-sm-4 control-label">Confirm Password</label>
											<div class="col-sm-8"><input type="password" class="form-control" name="password" placeholder="Confirm password"></div>
										</div>
										<br>
										<br>
										<div class="form-group text-center">
											<button type="button" class="btn btn-primary btn-lg">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane table-responsive" id="pub-tab">
					<div class="ibox">
					<div class="ibox-content">
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="panel no-border">
									<div class="panel-body col-md-6">
										<h2 class="text-success" align="left" style="font-weight: bold;">Payment Information</h2>
										<form name="payment_form" id="payment_form" class="form-horizontal" role="form" method="POST" action="">
											<div class="form-group">
												<label class="col-sm-4 control-label">Payment Method</label>    
												<div class="col-sm-8">
													<select class="form-control" required>
														<option>Select</option>
														<option>Paper Check</option>
														<option>Wire-Bank(Fee May Apply)</option>
														<option>ACH</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Minimum Payout</label>    
												<div class="col-sm-8">
													<select class="form-control" required>
														<option>Select</option>
														<option>250</option>
														<option>500</option>
														<option>1000</option>
														<option>5000</option>
													</select>
												</div>
											</div>

											<h2 class="text-success" align="left" style="font-weight: bold;">Tax Info</h2>
											<div class="form-group">
												<label class="col-sm-4 control-label">Tax Status</label>    
												<div class="col-sm-8">
													<select class="form-control" required>
														<option>Select</option>
														<option>Company</option>
														<option>Individual</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Vat/Tax ID</label>
												<div class="col-sm-8"><input placeholder="Vat/Tax ID" class="form-control" type="text"></div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"></label>
												<div class="col-sm-8" align="mid"><input placeholder="Future W9 Form" class="form-control" type="text"></div>    
											</div>
											<br><br>
											<div class="form-group text-center">
											<button type="button" class="btn btn-primary btn-lg">Submit</button>
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="tab-pane table-responsive" id="pub-earn-tab">
					<div class="ibox">
					<div class="ibox-content">
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="panel no-border">
									<div class="panel-body col-md-5">
										<h2 class="text-success"><strong>Account Information</strong></h2>
										<table class="table">
											<thead>
												<tr></tr>
												<tr></tr>
												<tr></tr>
												<tr></tr>
												<tr></tr>
											</thead>
											<tbody>
												<tr>
													<td><strong>Account Status</strong></td>
													<td>Approved</td><!-- Place status of the account -->
												</tr>
												<tr>
													<td><strong>Account Balance</strong></td>
													<td>$250</td><!-- Enter the total monthly payout -->
												</tr>
												<tr>
													<td><strong>Daily Spend</strong></td>
													<td>$300</td> <!-- Status of the payment terms -->
												</tr>
												<tr>
													<td><strong>Monthly Spend </strong></td>
													<td>$300</td><!-- the day the next payment is due -->
												</tr>
												<tr>
													<td><strong>Balance Email Alert</strong></td>
													<td style="padding-left: 0px;">
														<select class="form-control" required="">
															<option>None</option>
															<option>$100</option>
															<option>$200</option>
															<option>$500</option>
															<option>$1000</option>
															<option>$2000</option>
															<option>$5000</option>
															<option>$10000</option>
															<option>$20000</option>
														</select>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12">
								<div class="ibox">
								<div class="panel panel-default">
									<h4 class="p-title">Deposits</h4>
									@if($pub)
									<div class="ibox-content tableSearchOnly">
										<table class="tablesaw tablesaw-stack table-striped table-hover dataTableSearchOnly dateTableFilter" data-tablesaw-mode="stack">
											<thead>
												<tr>
													<th>Date</th>
													<th>Amount</th>
													<th>Status</th>
													<th>Method</th>
												</tr>
											</thead>
											<tbody>
												@if(sizeof($payments))
													@foreach($payments as $payment)
													<tr>
													<td class="text-center"><b class=" tablesaw-cell-label">Date</b>{{ $payment->transaction_date }}</td>
													<td class="text-center"><b class=" tablesaw-cell-label">Amount</b>$ {{ $payment->amount }}</td>
													<td class="text-center"><b class=" tablesaw-cell-label">Status</b>Status</td>
													<td class="text-center"><b class=" tablesaw-cell-label">Method</b>Method</td>
													</tr>
													@endforeach
												@endif
												@if(sizeof($earnings))
													<!--Unpaid Earnings-->
													@foreach($earnings as $earning)
												<tr>
													<td class="text-center"><b class=" tablesaw-cell-label">Date</b>{{ $earning->site_name }}</td>
													<td class="text-center"><b class=" tablesaw-cell-label">Amount</b>$ {{ $earning->earnings }}</td>
													<td class="text-center"><b class=" tablesaw-cell-label">Status</b>Status</td>
													<td class="text-center"><b class=" tablesaw-cell-label">Method</b>Method</td>
												</tr>
													@endforeach
												@endif
											</tbody>
										</table>
									</div>
									@else
										<a href="/sites"><h3>Add Your Sites and Start Earning!</h3></a>
									@endif
								</div>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
				<div class="tab-pane table-responsive" id="buyer-tab">
					<div class="ibox">
						<div class="ibox-content">
							<br>
							@if($buyer)
							<h2 class="text-success"><strong>Account Information</strong></h2>
							<div class="row">
								<div class="col-md-12">
									<div class="panel no-border">
										<div class="panel-body col-xs-12 col-md-6">
											<table class="table">
												<tbody>
													<tr>
														<td><strong>Account Status</strong></td>
														<td>Approved</td>
													</tr>
													<tr>
														<td><strong>Current Balance</strong></td>
														<td>$ {{$balance}}</td>
													</tr>
													<tr>
														<td><strong>Month Date Spent</strong></td>
														<td>$300.00</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="col-xs-12 col-md-6 text-center">
											<a href="/addfunds"><button class="btn btn-md btn-primary">Fund Your Account!</button></a>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<br>
									@if(sizeof($invoices))
									<table class="table">
										<thead>
											<tr>
												<td><strong>Transaction Date</strong></td>
												<td><strong>Deposit Amount</strong></td>
											</tr>
										</thead>
										<tbody>
											@foreach($invoices as $invoice)
											<tr>
												<td>{{ $invoice->transaction_date }}</td>
												<td>$ {{ $invoice->Amount }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									@endif    
									@else
									
									@endif
								</div>
								<br>
							</div>
							<div class="clearfix"></div>
							<div class="row">
								<div class="col-xs-12">
									<div class="panel panel-default">
										<h4 class="p-title">Filter</h4>
										<div class="ibox-content">
											<div class="row">
												<div class="col-xs-12 col-md-5">
													<form name="library_form" method="POST">
														<label>Dates</label>
														<div class="row">
															<div class="col-xs-12 form-group">
																<input hidden="true"
																	   type="text"
																	   name="daterange" />
																<div id="reportrange"
																	 class="form-control">
																	<i class="fa fa-calendar"></i>
																	<span></span>
																</div>
															<label class="error hide"
																   for="dates"></label>
															</div>
														</div>
														<div class="row">
															<div class="col-xs-12 col-md-6">
																<div class="form-group">
																	<button type="submit" class="btn btn-primary btn-block">Submit</button>
																</div>
															</div>

															<div class="col-xs-12 col-md-6">
																<div class="form-group">
																	<button type="submit" class="btn btn-danger 	btn-block" id="resetFilter">Reset Filter</button>
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
									<h4 class="p-title">Invoice History</h4>
										<div class="ibox-content">
											<div class="dataTableSearch">
												<table class="tablesaw tablesaw-stack table-striped table-hover dateTableFilter" data-tablesaw-mode="stack" id="dataTableSearch">
													<thead> 
														<tr>
															<th><input type="checkbox" class="form-check-input checkAll"> Select All</th>
															<th>Date</th>
															<th>Campaign Name</th>
															<th>Number of Creatives</th>
															<th>Type</th>
															<th>Spend</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="text-center col-xs-2"><input type="checkbox" class="form-check-input checkAll"></td>
															<td class="text-center"><b class=" tablesaw-cell-label">Date</b> 01/07/2017</td>
															<td class="text-center"><b class=" tablesaw-cell-label">Campaign Name</b> Bargains</td>
															<td class="text-center"><b class=" tablesaw-cell-label">Number of Creatives</b> 26.0 MB</td>
															<td class="text-center"><b class=" tablesaw-cell-label">Type</b>
																<button class="btn btn-xs btn-success">CPM</button>
															</td>
															<td class="text-center"><b class=" tablesaw-cell-label">Spend</b>125</td>
														</tr>
													</tbody>
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
		</div>     
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#account_tab').click();
	
	$(".checkAll").click(function(event) {   
		if(this.checked) {
			// Iterate each checkbox
			$(':checkbox').each(function() {
				this.checked = true;                        
			});
		} else {
			$(':checkbox').each(function() {
				this.checked = false;                        
			});
		}
	});
});
	
$('.dataTableSearchOnly').DataTable({
	"oLanguage": {
	  "sSearch": "Search Table"
	}, pageLength: 10,
	responsive: true
});
	
$('#dataTableSearch').DataTable({
	pageLength: 10,
	responsive: true,
	dom: '<"html5buttons"B>lTfgitp',
	"columnDefs": [
		{ "orderable": false, "targets": 0 }
	],
	buttons: [
		{ extend: 'copy', },
		{extend: 'csv'},
		{extend: 'excel', title: 'ExampleFile'},
		{extend: 'pdf', title: 'ExampleFile'},

		{extend: 'print',
		 customize: function (win){
			$(win.document.body).addClass('white-bg');
			$(win.document.body).css('font-size', '10px');

			$(win.document.body).find('table')
					.addClass('compact')
					.css('font-size', 'inherit');
		}
		}
	]
});

</script>
   <script type="text/javascript">
       jQuery(document).ready(function ($) {
	       $('.nav-click').removeClass("active");
	       $('#nav_profile').addClass("active");
       });
   </script>
@endsection
