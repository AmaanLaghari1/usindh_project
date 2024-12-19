<?php

?>
<div id="min-height" class="container-fluid">
	<div class='card' style="    width: fit-content;">
		<div class='card-body'  style="    width: fit-content;" >
			<div>
				<label for="roleFilter">Filter by Role:</label>
				<select id="roleFilter" class="form-control" style="width: 200px; display: inline-block;">
					<option value="">All</option>
					<option value="STUDENT">Student</option>
					<option value="FACULTY">Faculty</option>
					<option value="STAFF">Staff</option>
				</select>
			</div>

			<table class="table table-bordered" style="width: fit-content" id="email-requests">
				<thead>
					<tr>
						<th>ID</th>
						<th>ROLE</th>
						<th>FIRST NAME</th>
						<th>LAST NAME</th>
						<th>EMAIL ADDRESS</th>
						<th>CNIC NO.</th>
						<th>DATE OF BIRTH</th>
						<th>MOBILE NO.</th>
						<th>WHATSAPP NO.</th>
						<th>REQUEST STATUS</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($email_requests as $email_request){
					?>
					<tr>
						<td><?= $email_request->REQUEST_ID??'-' ?></td>
						<td><?= $email_request->ROLE == 1 ? 'STUDENT' : ($email_request->ROLE == 2 ? 'FACULTY' : 'STAFF') ?></td>
						<td><?= $email_request->FIRST_NAME??'-' ?></td>
						<td><?= $email_request->LAST_NAME??'-' ?></td>
						<td><?= $email_request->EMAIL??'-' ?></td>
						<td><?= $email_request->CNIC_NO??'-' ?></td>
						<td><?= formatDate($email_request->DATE_OF_BIRTH)??'-' ?></td>
						<td><?= $email_request->MOBILE_NO??'-' ?></td>
						<td><?= $email_request->WHATSAPP_NO??'-' ?></td>
						<td>
							<?= $email_request->REQUEST_STATUS_ID == 1 ? '<div class="badge badge-primary">SUBMITTED</div>' : ($email_request->REQUEST_STATUS_ID == 2 ? '<div class="badge badge-secondary">RECEIVED</div>' : ($email_request->REQUEST_STATUS_ID == 3 ? '<div class="badge badge-success">ACCOUNT CREATED</div>' : '<div class="badge badge-danger">REJECTED</div>')) ?>
						</td>
						<td>
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
														<option value="2" <?= $email_request->REQUEST_STATUS_ID == 2 ? 'selected' : '' ?>>RECEIVED</option>
														<option value="3" <?= $email_request->REQUEST_STATUS_ID == 3 ? 'selected' : '' ?>>ACCOUNT CREATED</option>
														<option value="4" <?= $email_request->REQUEST_STATUS_ID == 4 ? 'selected' : '' ?>>REJECTED</option>
													</select>
												</div>
												<div class="form-group official_email_field" style="display: none;">
													<label for="official_email">OFFICIAL EMAIL</label>
													<input type="email" class="form-control" id="official_email" name="official_email" placeholder="Enter Official Email Address" value="<?= $email_request->OFFICIAL_EMAIL_CREATED??'' ?>" />
													<?php
													if($email_request->OFFICIAL_EMAIL_CREATED != ''){
													?>
														<a type="button" data-toggle="modal" data-target="#delete-email-modal<?= $email_request->REQUEST_ID ?>" class="btn btn-sm btn-danger mt-5">Delete Email</a>
													<?php
													}
													?>
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

					<!--		DELETE OFFICIAL EMAIL MODAL			-->
					<div class="modal fade" id="delete-email-modal<?= $email_request->REQUEST_ID ?>">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									Are you sure to delete this email?
								</div>
								<div class="modal-body">
									<form method="post" action="<?= base_url() . 'AdminPanel/deleteOfficialEmail' ?>">
										<input type="hidden" name="application_id" value="<?= $email_request->REQUEST_ID??'' ?>" />
										<div class="small"><i><b>Note:</b> this will also change the status of application to Received.</i></div>
										<button type="submit" class="btn btn-sm btn-success">Yes</button>
										<button type="button" class="btn btn-sm btn-danger mx-1" data-dismiss="modal">Cancel</button>
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

<!--Datatable CDN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
<!--Datatable PDF CDN-->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<!-- Sweatalert2 CDN-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
<?php
if(isset($_SESSION['response'])){
?>
<script>
	Swal.fire({
	title: "<?= $_SESSION['response']['title']??'' ?>",
	text: "<?= $_SESSION['response']['message']??'' ?>",
	icon: "<?= $_SESSION['response']['type'] ?>"
	});
</script>
<?php
}
?>
<script>
	$(document).ready(function() {
		// On page load, check each .request_status value
		$('.request_status').each(function() {
			const parentContainer = $(this).closest('.modal-body');
			if ($(this).val() == 3) {
				parentContainer.find('.official_email_field').show();
			} else {
				parentContainer.find('.official_email_field').hide();
			}
		});

		// Add event listener for future changes
		$(document).on('change', '.request_status', function() {
			const parentContainer = $(this).closest('.modal-body');
			if ($(this).val() == 3) {
				parentContainer.find('.official_email_field').show();
			} else {
				parentContainer.find('.official_email_field').hide();
			}
		});
	});


	$('#email-requests').DataTable({
		scrollX: true, // Enable horizontal scrolling
		dom: 'Bfrtip', // Add export buttons
		buttons: [
			{
				extend: 'pdfHtml5',
				text: 'Download PDF',
				orientation: 'landscape', // Use landscape orientation for wider tables
				pageSize: 'A4', // Set page size to A3 for more space
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
				}
			}
		],
		columnDefs: [
			{ targets: [2, 3], width: '100px' },
			{ targets: [6, 7], width: '140px' },
			{ targets: [8, 9], width: '110px' },
		]
	});

	let table = new DataTable('#email-requests');
	//
	$('#roleFilter').on('change', function() {
		const selectedRole = $(this).val();

		// Use DataTables' search API to filter the "ROLE" column (index 10)
		table.column(1).search(selectedRole).draw();
	});

</script>
