<?php
//$old = $this->session->flashdata('old'); // Retrieve the flashdata
?>
<div class="main-content">

	<section id="home" class="divider parallax" data-bg-img="<?= base_url() ?>images/usindh/slider_1.jpg" style="background: url(<?= base_url() ?>'images/usindh/slider_1.jpg'); background-size:cover; background-repeat: no-repeat; background-color: white;')">
		<div class="display-table">
			<div class="display-table-cell">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-push-3">
							<div class="bg-lightest border-1px p-30 mb-0">
								<h3 class="text-theme-colored mt-0 pt-5">Verify Email</h3>
								<hr>
								<?php
								if(isset($_SESSION['response'])){
									?>
									<div class="alert alert-<?= $_SESSION['response']['type'] ?>">
										<?= $_SESSION['response']['message'] ?>
									</div>
									<?php
								}
								?>
								<p>Enter the 4 digits OTP code sent to your email (check spam/junk folder)</p>
								<form id="otp-verify-form" name="otp-verify-form" action="<?= site_url('email_verify_otp') ?>" method="post">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
<!--												<label>Code <small>*</small></label>-->
												<input name="otp_input" id="otp_input" type="text" placeholder="Enter 4 Digit Code" required="" class="form-control" value="<?= $_SESSION['otp_code']??'' ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<input name="form_botcheck" class="form-control" type="hidden" value="" />
										<button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-10 pt-10 pb-10" data-loading-text="Please wait...">Verify</button>
										<button type="button" id="send-otp-btn" class="btn btn-theme-colored btn-dark btn-sm mt-10 mb-10">Resend</button>
										<div id="countdown" class="small"></div>

									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


</div>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
	$(document).ready(function(){

<?php
if (isset($_SESSION['otp_code']) && isset($_SESSION['otp_expiry'])) {
    // Calculate remaining time in seconds
    $timeLeft = $_SESSION['otp_expiry'] - time();
    if ($timeLeft > 0) {
?>
        function otpTimer() {
            let timeLeft = <?= $timeLeft ?>; // Remaining time in seconds
            $("#send-otp-btn").prop("disabled", true); // Disable the resend button initially
            const interval = setInterval(function () {
                if (timeLeft <= 0) {
                    clearInterval(interval);
                    $("#countdown").text(''); // Clear countdown display
                    $("#send-otp-btn").prop("disabled", false); // Enable the resend button
                    return;
                }

                // Update time left (in minutes and seconds)
                let minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;
                $("#countdown").text(`You can resend OTP in ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`);

                timeLeft--; // Decrement time left
            }, 1000);
        }

        otpTimer();
<?php
    } else {
        // OTP has already expired, enable the resend button immediately
        echo '$("#send-otp-btn").prop("disabled", false);';
    }
}
?>


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

		$("#send-otp-btn").click(function() {
			// Disable the resend button to prevent multiple clicks
			$("#send-otp-btn").prop("disabled", true);

			let formData = new FormData();
			formData.append('resend', '1')

			$.ajax({
				url: 'resend_otp',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					const data = JSON.parse(response);
					if (data.status === 'success') {
						// Redirect to the provided URL
						window.location.href = data.redirect;
					} else {
						// Show an error message
						// alert(data.message);
						$("#otp-heading").after(`<div class="alert alert-danger">${data.message}</div>`);
						$("#send-otp-btn").prop("disabled", false);
					}
				},
				error: function(xhr, status, error) {
					console.error("Error: " + error);
					$("#send-otp-btn").prop("disabled", false);
				}
			});
		});


	})
</script>
