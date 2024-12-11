<?php
$old = $this->session->flashdata('old'); // Retrieve the flashdata
?>
<div class="main-content">
	<div class="container p-3">
		<div class="row">

			<div style="padding: 5rem" class="col-3 p-2">

				<h3>Email Request Application</h3>
				<?php
				if(isset($_SESSION['response'])){
					?>
					<div class="alert alert-<?= $_SESSION['response']['type'] ?>"><?= $_SESSION['response']['message'] ?></div>
				<?php
				}
				?>

				<form id="application-form" method="post" action="<?= site_url('email_request_save') ?>" enctype="multipart/form-data">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					<div class="form-group my-2">
						<label for="user_role">Select Role</label>
						<select name="user_role" class="form-control my-2" id="user_role">
							<option value="1">Student</option>
							<option value="2">Faculty</option>
							<option value="3">Staff</option>
						</select>
					</div>

					<div class="form-group my-2">
						<label for="first_name">First Name<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your First Name" value="<?= isset($old['first_name']) ? $old['first_name'] : '' ?>">
					</div>
					<div class="form-group my-2">
						<label for="last_name">Last Name</label>
						<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your Last Name" value="<?= isset($old['last_name']) ? $old['last_name'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="date_of_birth">Date of Birth<span class="text-danger">*</span></label>
						<input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Enter your Date of Birth" value="<?= isset($old['date_of_birth']) ? $old['date_of_birth'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="cnic_no">CNIC No. (without dashes)<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="cnic_no" name="cnic_no" maxlength="13" placeholder="Enter your CNIC" value="<?= isset($old['cnic_no']) ? $old['cnic_no'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="cnic_expiry">CNIC Expiry Date<span class="text-danger">*</span></label>
						<input type="date" class="form-control" id="cnic_expiry" name="cnic_expiry" placeholder="Enter your CNIC Expiry Date" value="<?= isset($old['cnic_expiry']) ? $old['cnic_expiry'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="email">Current Email Address<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email Address" value="<?= isset($old['email']) ? $old['email'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="mobile_phone">Mobile Phone <span class="text-danger">(11 digits only)*</span></label>
						<input type="text" class="form-control" id="mobile_phone" name="mobile_phone" placeholder="Enter your Mobile Phone Number" value="<?= isset($old['mobile_phone']) ? $old['mobile_phone'] : '' ?>">
					</div>
					<div class="form-group my-2">
						<label for="whatsapp_no">WhatsApp No. <span class="text-danger">(11 digits only)*</span></label>
						<input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="Enter your Whatsapp Number" value="<?= isset($old['whatsapp_no']) ? $old['whatsapp_no'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="address">Postal Address<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="address" name="address" placeholder="Enter your Home Address" value="<?= isset($old['address']) ? $old['address'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="province">State/Province<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="province" name="province" placeholder="Enter your Province Name" value="<?= isset($old['province']) ? $old['province'] : '' ?>">
					</div>
					<div class="form-group my-2">
						<label for="city">City<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="city" name="city" placeholder="Enter your City Name" value="<?= isset($old['city']) ? $old['city'] : '' ?>">
					</div>

					<div class="form-group my-2 std">
						<label for="roll_no">Roll No.<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="roll_no" name="roll_no" placeholder="Enter your Roll No" value="<?= isset($old['roll_no']) ? $old['roll_no'] : '' ?>">
					</div>

					<div class="form-group my-2 other">
						<label for="staff_or_faculty_id">Staff/Faculty ID<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="staff_or_faculty_id" name="staff_or_faculty_id" placeholder="Enter your Roll No" value="<?= isset($old['staff_or_faculty_id']) ? $old['staff_or_faculty_id'] : '' ?>">
					</div>

					<div class="form-group my-2">
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

					<div class="form-group my-2 other">
						<label for="department">Designation<span class="text-danger">*</span></label>
						<input class="form-control" placeholder="Enter your Designation" name="designation" id="designation" />
					</div>

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

					<div class="form-group my-2">
						<label for="education_level">Education Level/Degree<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="education_level" name="education_level" placeholder="Enter your Education Level" value="<?= isset($old['education_level']) ? $old['education_level'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="research_area">Research Focus Area</label>
						<input type="text" class="form-control" id="research_area" name="research_area" placeholder="Enter your Research Area" value="<?= isset($old['research_area']) ? $old['research_area'] : '' ?>">
					</div>

					<div class="form-group my-2 other">
						<label for="date_of_appointment">Date of Appointment</label>
						<input type="date" class="form-control" id="date_of_appointment" name="date_of_appointment" placeholder="Enter your Date of Appointment" value="<?= isset($old['date_of_appointment']) ? $old['date_of_appointment'] : '' ?>">
					</div>

					<div class="form-group my-2 std">
						<label for="additional_qualification">Additional Qualification</label>
						<input type="text" class="form-control" id="additional_qualification" name="additional_qualification" placeholder="Enter your Additional Qualification" value="<?= isset($old['additional_qualification']) ? $old['additional_qualification'] : '' ?>">
					</div>
					<div class="form-group my-2 other">
						<label for="additional_charge">Additional Charge</label>
						<input type="text" class="form-control" id="additional_charge" name="additional_charge" placeholder="Enter your Additional Charge" value="<?= isset($old['additional_charge']) ? $old['additional_charge'] : '' ?>">
					</div>
					<div class="form-group my-2 other">
						<label for="office_phone">Office Phone(if any)</label>
						<input type="text" class="form-control" id="office_phone" name="office_phone" placeholder="Enter your Office Phone Number" value="<?= isset($old['office_phone']) ? $old['office_phone'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="applicant_picture">Applicant Picture (white background, 2x2 dimensions, 500KB max)
							<span class="text-danger">*</span>
						</label>
						<input type="file" class="form-control" id="applicant_picture" name="applicant_picture" accept="image/*">
						<img id="applicant_picture_preview" src="" alt="Preview" style="display: none; margin-top: 10px; max-width: 100px; border: 1px solid #ccc;">
					</div>

					<div class="form-group my-2">
						<button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
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
				address: { required: true },
				city: { required: true },
				province: { required: true },
				applicant_picture: { required: true },
				cnic_expiry: { required: true },
				research_area: { required: true },
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
				address: { required: "Please enter your Postal Address" },
				city: { required: "Please enter your City Name" },
				province: { required: "Please enter your State or Province Name" },
				applicant_picture: { required: "Please chose a photo" },
				cnic_expiry: { required: "Please enter CNIC Expiry Date" },
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
				$("#staff_or_faculty_id").rules("add", {
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
				$("#degree_program").rules("add", {
					required: true,
					messages: { required: "Please select your Degree Program" }
				});
			}

			if(role == 3){
				$("#research_area").parent().hide()
			}
			else {
				$("#research_area").parent().show()
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
