<?php
//$old = $this->session->flashdata('old'); // Retrieve the flashdata
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

					<div class="form-group my-2 std">
						<label for="roll_no">Roll No</label>
						<input type="text" class="form-control" id="roll_no" name="roll_no" placeholder="Enter your Roll No" value="<?= isset($old['roll_no']) ? $old['roll_no'] : '' ?>">
					</div>

					<div class="form-group my-2 other">
						<label for="staff_or_faculty_id">Staff/Faculty ID</label>
						<input type="text" class="form-control" id="roll_no" name="staff_or_faculty_id" placeholder="Enter your Roll No" value="<?= isset($old['staff_or_faculty_id']) ? $old['staff_or_faculty_id'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="first_name">First Name<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your First Name" value="<?= isset($old['first_name']) ? $old['first_name'] : '' ?>">
					</div>
					<div class="form-group my-2">
						<label for="last_name">Last Name<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your Last Name" value="<?= isset($old['last_name']) ? $old['last_name'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="date_of_birth">Date of Birth<span class="text-danger">*</span></label>
						<input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= isset($old['date_of_birth']) ? $old['date_of_birth'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="cnic_no">CNIC No. (without dashes)<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="cnic_no" name="cnic_no" placeholder="Enter your CNIC" value="<?= isset($old['cnic_no']) ? $old['cnic_no'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="cnic_expiry">CNIC Expiry Date<span class="text-danger">*</span></label>
						<input type="date" class="form-control" id="cnic_expiry" name="cnic_expiry" placeholder="Enter your CNIC" value="<?= isset($old['cnic_expiry']) ? $old['cnic_expiry'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="email">Current Email Address<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email Address" value="<?= isset($old['email']) ? $old['email'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="mobile_phone">Mobile Phone<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="mobile_phone" name="mobile_phone" placeholder="Enter your Mobile Phone Number" value="<?= isset($old['mobile_phone']) ? $old['mobile_phone'] : '' ?>">
					</div>
					<div class="form-group my-2">
						<label for="whatsapp_no">Whatsapp No.<span class="text-danger">*</span></label>
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

					<div class="form-group my-2">
						<label for="department">Department<span class="text-danger">*</span></label>
						<select class="form-control" id="department" name="department">
							<option value="">Select Department</option>
							<?php
							foreach ($departments as $dept){
								?>
								<option value="<?= $dept->DEPT_ID ?>"><?= $dept->DEPT_NAME ?></option>
							<?php
							}
							?>
						</select>
					</div>

					<div class="form-group my-2 other">
						<label for="department">Designation<span class="text-danger">*</span></label>
						<select class="form-control" id="department" name="department">
							<option value="">Select Designation</option>
							<?php
							foreach ($departments as $dept){
								?>
								<option value="<?= $dept->DEPT_ID ?>"><?= $dept->DEPT_NAME ?></option>
								<?php
							}
							?>
						</select>
					</div>

<!--					<div class="form-group my-2 other">-->
<!--						<label for="faculty_type">Faculty Type</label>-->
<!--						<select class="form-control" id="faculty_type" name="faculty_type">-->
<!--							<option value="">Select Faculty Type</option>-->
<!--						</select>-->
<!--					</div>-->
					<div class="form-group my-2 std">
						<label for="degree_program">Bachelor/Master/MPhil/PHP<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="degree_program" name="degree_program" placeholder="Enter your Degree Program" value="<?= isset($old['degree_program']) ? $old['degree_program'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="education_level">Education Level/Degree<span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="education_level" name="education_level" placeholder="Enter your Education Level" value="<?= isset($old['education_level']) ? $old['education_level'] : '' ?>">
					</div>

					<div class="form-group my-2 other">
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
					<div class="form-group my-2">
						<label for="office_phone">Office Phone(if any)</label>
						<input type="text" class="form-control" id="office_phone" name="office_phone" placeholder="Enter your Office Phone Number" value="<?= isset($old['office_phone']) ? $old['office_phone'] : '' ?>">
					</div>

					<div class="form-group my-2">
						<label for="applicant_picture">Applicant Picture<span class="text-danger">*</span></label>
						<input type="file" class="form-control" id="applicant_picture" name="applicant_picture">
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
<script>
	$(document).ready(function(){
		$(".other").hide()


		$("#otp-form").validate({
			rules: {
				roll_no: {
					required: true,
				},
				email: {
					required: true,
				}
			},
			messages: {
				roll_no: {
					required: 'Roll No is required',
				},
				email: {
					required: 'Email is required',
				}
			},
			submitHandler: function(form) {

				$.ajax({
					url: 'email_request_send_otp',
					type: 'POST',
					data: {
						email: form.email.value,
						'<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'
					},
					dataType: 'json',
					success: function(response){
						console.log(response);
						let timeLeft = <?= $_SESSION['otp_expiry']??0 ?>;
						$("#send-otp-btn").prop("disabled", true);
						const interval = setInterval(function() {
							if (timeLeft <= 0) {
								clearInterval(interval);
								$("#countdown").text(''); // Clear countdown display
								$("#send-otp-btn").prop('disabled', false); // Enable the button
								return;
							}

							// Update time left (in minutes and seconds)
							let minutes = Math.floor(timeLeft / 60);
							let seconds = timeLeft % 60;
							$("#countdown").text(`You can resend OTP in ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`);

							timeLeft--; // Decrement time left
						}, 1000);
					}
				})
			}
		})

		$("#role_no").blur(function(){
			let rollNo = $(this).val()

			if (rollNo){
				$.ajax({
					url: 'email_request_fetch',
					type: 'POST',
					data: {
						roll_no: rollNo,
						'<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'
					},
					dataType: 'json',
					success: function(data){
						console.log("Data",data)
						if(data['exist']['email']) {
							$("#email").val(data.exist.email)
						}
						else {
							$("#email").val('')
						}
					}
				})
			}
		})


	// 	Handle Application Form Validations
		// Initialize form validation on the form
		$("#application-form").validate({
			rules: {
				// General rules for fields that are always required
				cnic_no: { required: true, number: true },
				email: { required: true, email: true },
				department: { required: true },
				first_name: { required: true },
				last_name: { required: true },
				education_level: { required: true },
				mobile_phone: { required: true },
				whatsapp_no: { required: true },
				date_of_birth: { required: true },
				address: { required: true },
				city: { required: true },
				postal_code: { required: true },
				province: { required: true },
				applicant_picture: { required: true },
				cnic_expiry: { required: true },
			},
			messages: {
				email: { required: "Please enter a your Email address" },
				cnic_no: { required: "Please enter your CNIC number" },
			}
		});

		// Function to toggle fields based on role and update validation rules
		function toggleRoleFields() {
			const role = $("#user_role").val();

			// Clear previous role-specific validation rules
			$('#roll_no, #faculty_type, #degree_program').rules("remove");

			if (role !== '1') { // If 'Other' role is selected
				$(".other").show();
				$(".std").hide();

				// Set required rules for "Other" role-specific fields
				$("#faculty_type").rules("add", {
					required: true,
					messages: { required: "Please select a faculty type" }
				});
				$("#date_of_appointment").rules("add", {
					required: true,
					messages: { required: "Please enter a date of appointment" }
				});
			} else { // If 'Student' role is selected
				$(".std").show();
				$(".other").hide();

				// Set required rules for "Student" role-specific fields
				$("#roll_no").rules("add", {
					required: true,
					messages: { required: "Please enter your roll number" }
				});
				$("#degree_program").rules("add", {
					required: true,
					messages: { required: "Please enter your degree program" }
				});
			}
		}

		// Initial field display based on default selected role
		toggleRoleFields();

		// Event listener for role selection change
		$("#user_role").on("change", function () {
			toggleRoleFields();
		});

	})
</script>
