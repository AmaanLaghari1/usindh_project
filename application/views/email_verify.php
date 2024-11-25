<?php
//$old = $this->session->flashdata('old'); // Retrieve the flashdata
?>
<div class="main-content">
	<div class="container p-3">
		<div class="row">

			<div style="padding: 5rem" class="col-3 p-2">

				<h3>Enter the otp code sent to your email <?= $_SESSION['otp_code'] ?></h3>

				<form id="otp-verify-form" class="col-6" action="<?= site_url('email_verify_otp') ?>" method="post">
					<div class="form-group">
						<input type="text" class="form-control" name="otp_input" id="otp_input" placeholder="Enter OTP code" />
					</div>
					<div class="form-group">
						<button type="submit" id="verify-otp-btn" class="btn btn-primary">Verify</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
	$(document).ready(function(){


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

		$("#otp-verify-form").validate({
			rules: {
				otp_input: {
					required: true,
					minlength: 4,
					maxlength: 4,
				},
			},
			messages: {
				otp_input: {
					required: 'Otp Code is required',
					minlength: 'Otp Code must contain 4 digits',
					maxlength: 'Otp Code must contain 4 digits',
				}
			}
		})


	})
</script>
