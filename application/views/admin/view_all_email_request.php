<?php

?>
<div id="min-height" class="container-fluid">
	<?php
	if(isset($_SESSION['response'])){
		?>
		<div class="alert alert-<?= $_SESSION['response']['type'] ?>"><?= $_SESSION['response']['message'] ?></div>
		<?php
	}
	?>
	<div class='card' style="    width: fit-content;">
		<div class='card-body'  style="    width: fit-content;" >
			<table id="email-requests" class='table table-borderd'>
				<thead>
					<tr>
						<th>REQUEST ID</th>
						<th>FIRST NAME</th>
						<th>LAST NAME</th>
						<th>EMAIL ADDRESS</th>
						<th>CNIC NO.</th>
						<th>CNIC EXPIRY</th>
						<th>DATE OF BIRTH</th>
						<th>MOBILE NO.</th>
						<th>WHATSAPP NO.</th>
						<th>ADDRESS</th>
						<th>ROLE</th>
						<th>STATUS</th>
						<th colspan="2">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($email_requests as $email_request) {
					?>
						<tr>
							<td><?= $email_request->REQUEST_ID??'-' ?></td>
							<td><?= $email_request->FIRST_NAME??'-' ?></td>
							<td><?= $email_request->LAST_NAME??'-' ?></td>
							<td><?= $email_request->EMAIL??'-' ?></td>
							<td><?= $email_request->CNIC_NO??'-' ?></td>
							<td><?= formatDate($email_request->CNIC_EXPIRY)??'-' ?></td>
							<td><?= formatDate($email_request->DATE_OF_BIRTH)??'-' ?></td>
							<td>
								<?= $email_request->MOBILE_NO??'-' ?>
							</td>
							<td>
								<?= $email_request->WHATSAPP_NO??'-' ?>
							</td>
							<td>
								<textarea style="width: 12rem" class="form-control" cols="30" rows="2"><?= urldecode($email_request->ADDRESS)??'-' ?></textarea>
							</td>
							<td><?= $email_request->ROLE == 1 ? 'STUDENT' : ($email_request->ROLE == 2 ? 'FACULTY' : 'STAFF') ?></td>
							<td><?= $email_request->REQUEST_STATUS_ID == 1 ? '<div class="badge badge-primary">SUBMITTED</div>' : ($email_request->REQUEST_STATUS_ID == 2 ? '<div class="badge badge-secondary">RECEIVED</div>' : ($email_request->REQUEST_STATUS_ID == 3 ? '<div class="badge badge-success">ACCOUNT CREATED</div>' : '<div class="badge badge-danger">REJECTED</div>')) ?></td>
							<td colspan="2">
								<a type="button" data-toggle="modal" data-target="#change-request-status-modal<?= $email_request->REQUEST_ID ?>" class="btn btn-sm btn-danger">Change Status</a>
							</td>
						</tr>
							<div class="modal fade" id="change-request-status-modal<?= $email_request->REQUEST_ID ?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										</div>
										<div class="modal-body">
											<form id="change-request-status-form" action="<?= base_url() . 'AdminPanel/officialEmailRequestHandler' ?>" method="post">
												<div class="row">
													<div class="col-md-12">
														<input type="hidden" id="request_id" name="request_id" value="<?= $email_request->REQUEST_ID ?>" />
														<div class="form-group">
															<label>REQUEST STATUS</label>
															<select id="request_status" name="request_status" class="form-control request_status">
																<option value="1" <?= $email_request->REQUEST_STATUS_ID == 1 ? 'selected' : '' ?>>SUBMITTED</option>
																<option value="2" <?= $email_request->REQUEST_STATUS_ID == 2 ? 'selected' : '' ?>>RECIEVED</option>
																<option value="3" <?= $email_request->REQUEST_STATUS_ID == 3 ? 'selected' : '' ?>>ACCOUNT CREATED</option>
																<option value="4" <?= $email_request->REQUEST_STATUS_ID == 4 ? 'selected' : '' ?>>REJECTED</option>
															</select>
														</div>
														<div class="form-group official_email_field" style="display: none;">
															<label for="official_email">OFFICIAL EMAIL</label>
															<input type="email" class="form-control" id="official_email" name="official_email" placeholder="Enter Official Email Address" value="<?= $email_request->OFFICIAL_EMAIL_CREATED??'' ?>" />
														</div>
														<div class="form-group">
															<label for="remarks">REMARKS</label>
															<input type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks for the user" value="<?= $email_request->REMARKS??'' ?>" />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<button class="btn btn-success" type="submit">Save</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
<script>
	$(document).ready(function() {

	$(".request_status").on('change', function() {
		if($(this).val() == 3){
			$(".official_email_field").show();
		}
		else {
			$(".official_email_field").hide();
		}
	})


	});
		new DataTable('#email-requests');

</script>
