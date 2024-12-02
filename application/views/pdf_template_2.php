<?php
$imagePath = FCPATH . 'uploads/' . $data->APPLICANT_PICTURE; // Path to the uploaded image
$logoPath = FCPATH . 'images/usindh/usindh-logo2.png';
$qrFramePath = FCPATH . 'images/usindh/qr_frame.png';

// Convert the image to Base64
$imageData = base64_encode(file_get_contents($imagePath));
$logoData = base64_encode(file_get_contents($logoPath));
$qrData = base64_encode(file_get_contents($qrFramePath));

// Pass the Base64 image data to the view
$data->APPLICANT_PICTURE_BASE64 = 'data:image/jpeg;base64,' . $imageData;
$data->LOGO = 'data:image/jpeg;base64,' . $logoData;
$data->QR = 'data:image/jpeg;base64,' . $qrData;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Email Request Application Form</title>
	<style>
		<?php
		// Read and embed the contents of the Bootstrap CSS file
		echo file_get_contents(FCPATH . 'css/bootstrap.min.css');
		?>
	</style>
</head>
<body>
<div class="container">
	<table class="table">
		<tr>
			<td width="20%" align="left">
				<img style="height: 6rem;" src="./images/usindh-logo2.png" alt="">
			</td>
			<td width="60%" align="center" style="position: relative;">
				<h3 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">University of Sindh</h3>
			</td>
			<td width="20%" align="right">
				<img style="height: 6rem;" src="./images/qr_frame.png" alt="">
			</td>
		</tr>
	</table>
</div>
</body>
</html>
