<?php
$old = $this->session->flashdata('old'); // Retrieve the flashdata
?>
<div class="main-content">
	<section class="divider">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-push-2" style="margin: 0 auto;">
					<div class="border-1px p-30 mb-0">
						<h3 class="text-theme-colored mt-0 pt-5">Official Email Request Application</h3>
						<hr>
						<p>Choose your role before submitting the form</p>
						<?php
						if(isset($_SESSION['response'])){
						?>
							<div class="alert alert-<?= $_SESSION['response']['type'] ?>">
								<?= $_SESSION['response']['message'] ?>
							</div>
						<?php
						}
						?>

						<form id="application-form" name="application_form" action="<?= site_url('email_request_save') ?>" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="form-group col-sm-12">
									<label for="user_role">Select Role</label>
									<select name="user_role" class="form-control my-2" id="user_role">
										<option value="1" <?= isset($old) && $old['user_role'] == 1 ? 'selected': '' ?>>Student</option>
										<option value="2" <?= isset($old) && $old['user_role'] == 2 ? 'selected': '' ?>>Faculty</option>
										<option value="3" <?= isset($old) && $old['user_role'] == 3 ? 'selected': '' ?>>Staff</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="first_name">First Name <small class="text-danger">*</small></label>
										<input name="first_name" id="first_name" type="text" placeholder="Enter First Name" required="" class="form-control" value="<?= isset($old['first_name']) ? $old['first_name'] : '' ?>">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="last_name">Last Name </label>
										<input name="last_name" id="last_name" type="text" placeholder="Enter Last Name" class="form-control" value="<?= isset($old['last_name']) ? $old['last_name'] : '' ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="cnic_no">CNIC No. <small class="text-danger">*</small></label>
										<small class="text-danger">(13 digits without dashes)</small>
										<input name="cnic_no" id="cnic_no" type="text" placeholder="Enter CNIC NO." required="" class="form-control" value="<?= isset($old['cnic_no']) ? $old['cnic_no'] : '' ?>">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="email">Current Email Address <small class="text-danger">*</small></label>
										<input name="email" id="email" type="email" placeholder="Enter Current Email Address" required="" class="form-control" value="<?= isset($old['email']) ? $old['email'] : '' ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="date_of_birth">Date of Birth<span class="text-danger">*</span></label>
										<input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Enter your Date of Birth" value="<?= isset($old['date_of_birth']) ? $old['date_of_birth'] : '' ?>">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="city">City<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="city" name="city" placeholder="Enter your City Name" value="<?= isset($old['city']) ? $old['city'] : '' ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="mobile_phone">Mobile Phone <span class="text-danger">*</span></label>
										<small class="text-danger">(11 digits only)</small>
										<input type="text" class="form-control" id="mobile_phone" name="mobile_phone" placeholder="Enter your Mobile Phone Number" value="<?= isset($old['mobile_phone']) ? $old['mobile_phone'] : '' ?>">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group my-2">
										<label for="whatsapp_no">WhatsApp No. <span class="text-danger">*</span></label>
										<small class="text-danger">(11 digits only)</small>
										<input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="Enter your Whatsapp Number" value="<?= isset($old['whatsapp_no']) ? $old['whatsapp_no'] : '' ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group std">
										<label for="roll_no">Roll No.<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="roll_no" name="roll_no" placeholder="Enter your Roll No" value="<?= isset($old['roll_no']) ? $old['roll_no'] : '' ?>">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group my-2 std">
										<label for="batch">Batch<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="batch" name="batch" placeholder="Enter your Batch" value="<?= isset($old['batch']) ? $old['batch'] : '' ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group other">
										<label for="employee_id">Employee ID<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Enter your Employee ID" value="<?= isset($old['employee_id']) ? $old['employee_id'] : '' ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group my-2 std">
										<label for="degree_program">Degree Program<span class="text-danger">*</span></label>
										<select class="form-control" id="degree_program" name="degree_program">
											<option value="" <?= isset($old) && $old['degree_program'] == '' ? 'selected': '' ?>>Select Degree Program</option>
											<option value="bachelor" <?= isset($old) && $old['degree_program'] == 'bachelor' ? 'selected': '' ?>>Bachelor</option>
											<option value="master" <?= isset($old) && $old['degree_program'] == 'master'  ? 'selected' : ''?>>Master</option>
											<option value="mphil" <?= isset($old) && $old['degree_program'] == 'mphil'  ? 'selected': ''?>>MPhil</option>
											<option value="phd" <?= isset($old) && $old['degree_program'] == 'phd'  ? 'selected': ''?>>PhD</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="department">Department<span class="text-danger">*</span></label>
										<select class="form-control" id="department" name="department">
											<option value="">Select Department</option>
											<?php
											foreach ($departments as $dept){
												?>
												<option value="<?= $dept->DEPT_ID ?>" <?= isset($old) && $old['department'] == $dept->DEPT_ID ? 'selected': '' ?>><?= $dept->DEPT_NAME ?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="education_level">Education Level/Degree<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="education_level" name="education_level" placeholder="Enter your Education Level" value="<?= isset($old['education_level']) ? $old['education_level'] : '' ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group other">
										<label for="department">Designation<span class="text-danger">*</span></label>
										<input class="form-control" placeholder="Enter your Designation" name="designation" id="designation" value="<?= isset($old['designation']) ? $old['designation'] : '' ?>" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group other">
										<label for="date_of_appointment">Date of Appointment<small class="text-danger">*</small></label>
										<input type="date" class="form-control" id="date_of_appointment" name="date_of_appointment" placeholder="Enter your Date of Appointment" value="<?= isset($old['date_of_appointment']) ? $old['date_of_appointment'] : '' ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="applicant_picture">Applicant Picture
									<span class="text-danger">*</span>
								</label>
									<small class="text-danger">(Max Upload File Size: 500KB, Background: White, Dimensions: 2x2)</small>
								<input type="file" class="" id="applicant_picture" name="applicant_picture" accept="image/*">
								<img id="applicant_picture_preview" src="" alt="Preview" style="display: none; margin-top: 10px; max-width: 100px; border: 1px solid #ccc;">
							</div>
							<div class="form-group">
								<input name="form_botcheck" class="form-control" type="hidden" value="" />
								<button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">Apply Now</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
	$(document).ready(function(){
		$(".other").hide()

	// 	Handle Application Form Validations
		// Initialize form validation on the form
		$("#application-form").validate({
			rules: {
				// General rules for fields that are always required
				cnic_no: { required: true, number: true, minlength: 13, maxlength: 13 },
				email: { required: true, email: true },
				department: { required: true },
				first_name: { required: true, minlength: 3 },
				education_level: { required: true },
				mobile_phone: { required: true, minlength: 11 },
				whatsapp_no: { required: true, minlength: 11 },
				date_of_birth: { required: true },
				city: { required: true },
				applicant_picture: { required: true },
			},
			messages: {
				email: {
					required: "Please enter your Current Email address",
					email: "Please enter a valid Email address"
				},
				cnic_no: {
					required: "Please enter your CNIC number",
					minlength: "CNIC must contain 13 digits",
					maxlength: "CNIC must contain 13 digits"
				},
				department: { required: "Please select your Department" },
				first_name: {
					required: "Please enter your First Name",
				},
				education_level: "Please enter your Education Level",
				mobile_phone: {
					required: "Please enter your Mobile Phone",
					minlength: "Invalid Mobile Phone No."
				},
				whatsapp_no: {
					required: "Please enter your Whatsapp No",
					minlength: "Invalid WhatsApp No."
				},
				date_of_birth: { required: "Please enter your Date of Birth" },
				city: { required: "Please enter your City Name" },
				applicant_picture: { required: "Please chose a photo" },
			}
		});

		// Function to toggle fields based on role and update validation rules
		function toggleRoleFields() {
			const role = $("#user_role").val();

			// Clear previous role-specific validation rules
			$('#roll_no, #degree_program').rules("remove");

			if (role !== '1') { // If 'Other' role is selected
				$(".other").show();
				$(".std").hide();

				// Set required rules for "Other" role-specific fields
				$("#employee_id").rules("add", {
					required: true,
					messages: { required: "Please enter your Employee ID" }
				});
				$("#date_of_appointment").rules("add", {
					required: true,
					messages: { required: "Please enter a Date of Appointment" }
				});
				$("#designation").rules("add", {
					required: true,
					messages: { required: "Please enter your Designation" }
				});
			} else { // If 'Student' role is selected
				$(".std").show();
				$(".other").hide();

				// Set required rules for "Student" role-specific fields
				$("#roll_no").rules("add", {
					required: true,
					messages: { required: "Please enter your Student ID" }
				});
				$("#batch").rules("add", {
					required: true,
					messages: { required: "Please enter your Batch" }
				});
				$("#degree_program").rules("add", {
					required: true,
					messages: { required: "Please select your Degree Program" }
				});
			}
		}

		// Initial field display based on default selected role
		toggleRoleFields();

		// Event listener for role selection change
		$("#user_role").on("change", function () {
			toggleRoleFields();
		});

		const numberFields = ['cnic_no', 'mobile_phone', 'whatsapp_no', 'office_phone'];

		numberFields.forEach(function (item){
			$(`#${item}`).on("input", function(){
				$(this).val($(this).val().replace(/[^0-9]/g, ''))
				let maxLength = 11
				if(item === 'cnic_no'){
					maxLength = 13
				}
				if(maxLength > 0){
					$(this).val($(this).val().substr(0, maxLength));
				}
			})
		});

		flatpickr("#date_of_birth, #cnic_expiry, #date_of_appointment");

		$('#applicant_picture').on('change', function () {
			const file = this.files[0]; // Get the selected file

			if (file) {
				// Check file type
				if (!file.type.startsWith('image/')) {
					alert('Please select a valid image file.');
					return;
				}

				// Preview the image
				const reader = new FileReader();
				reader.onload = function (e) {
					$('#applicant_picture_preview')
						.attr('src', e.target.result) // Set the image source to the file data
						.css('display', 'block');   // Show the image
				};
				reader.readAsDataURL(file); // Read the file as a data URL
			} else {
				// Reset the preview if no file is selected
				$('#applicant_picture_preview')
					.attr('src', '')
					.css('display', 'none');
			}
		});

	})
</script>
