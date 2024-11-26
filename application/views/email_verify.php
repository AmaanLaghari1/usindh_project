<?php
//$old = $this->session->flashdata('old'); // Retrieve the flashdata
?>
<div class="main-content">
	<div class="container p-3">
		<div class="row">

			<div style="padding: 5rem" class="col-3 p-2">

				<h3>Enter the otp code sent to your email <?= $_SESSION['otp_code']??'0' ?></h3>
				<?php
				if(isset($_SESSION['response'])){
					?>
					<div class="alert alert-<?= $_SESSION['response']['type'] ?>"><?= $_SESSION['response']['message'] ?></div>
					<?php
				}
				?>

				<form id="otp-verify-form" class="col-6" action="<?= site_url('email_verify_otp') ?>" method="post">
					<div class="form-group">
						<input type="text" class="form-control" name="otp_input" id="otp_input" placeholder="Enter OTP code" />
					</div>
					<div class="form-group float-start">
						<button type="submit" id="verify-otp-btn" class="btn btn-primary">Verify</button>
						<button type="button" id="send-otp-btn" class="btn btn-primary mx-1">Resend</button>
					</div>
				</form>

				<div id="countdown"></div>

			</div>
		</div>
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

			$.ajax({
				url: 'resend_otp',
				type: 'POST',
				success: function(response) {
					// Reload the page to reset the OTP timer
					location.reload();
				},
				error: function(xhr, status, error) {
					// console.log("Error: " + error);
					$("#send-otp-btn").prop("disabled", false);
				}
			});
		});


	})
</script>
