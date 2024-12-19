<?php
//$old = $this->session->flashdata('old'); // Retrieve the flashdata
?>
<div class="main-content">
	<div class="col-md-6 col-md-offset-3">
		<h3>Enter the otp code sent to your email</h3>
		<h5>(check spam/junk folder)</h5>
		<?php
		if(isset($_SESSION['response'])){
			?>
			<div class="alert alert-<?= $_SESSION['response']['type'] ?>">
				<?= $_SESSION['response']['message'] ?>
			</div>
			<?php
		}
		?>
		<!-- Mailchimp Subscription Form-->
		<form id="otp-verify-form" method="post" class="newsletter-form mt-20" action="<?= site_url('email_verify_otp') ?>">
			<div class="input-group">
				<input type="text" id="otp_input" data-height="45px" class="form-control input-lg col-12" placeholder="Enter 4 digit code" name="otp_input" value="<?= $_SESSION['otp_code']??'' ?>" style="height: 45px; width: 100%">
				<span class="input-group-btn">
                </span>
			</div>
			<button type="submit" class="btn btn-colored btn-dark btn-lg m-0">Verify</button>
			<button type="button" id="send-otp-btn" class="btn btn-colored btn-primary btn-lg mt-10 mb-10">Resend</button>
			<div id="countdown"></div>
		</form>

	</div>
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
