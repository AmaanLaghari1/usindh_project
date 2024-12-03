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

		* {
			color: #000;
		}

		td, th {
			font-size: small !important;
			padding: 5px !important;
		}
	</style>
</head>
<body>
<div class="container">
	<table width="100%" style="border: 0">
		<tr>
			<td width="20%" align="left">
				<img style="height: 6rem;" src="<?= $data->LOGO ?>" alt="">
			</td>
			<td width="60%" align="center" valign="middle">
				<h3>University of Sindh</h3>
			</td>
			<td width="20%" align="right">
				<img style="height: 6rem;" src="<?= $data->QR ?>" alt="">
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center" valign="middle">
				<h5>Official Email ID Request Application</h5>
			</td>
		</tr>
	</table>
	<small>
	<table class="table" width="100%">
		<tr>
			<td style="border: 0; margin-bottom: 0;" class="p-0 border-0" width="100%">
				<table class="table" width="100%">
					<tr>
						<th width="40%">FIRST NAME</th>
						<td><?= $data->FIRST_NAME??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">LAST NAME</th>
						<td><?= $data->LAST_NAME??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">EMAIL ADDRESS</th>
						<td><?= $data->EMAIL??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">DATE OF BIRTH</th>
						<td><?= $data->DATE_OF_BIRTH??'-' ?></td>
					</tr>

				</table>
			</td>
			<td style="border: 0" class="border-0">
				<img width="100" src="<?= $data->APPLICANT_PICTURE_BASE64 ?>" alt="">
			</td>
		</tr>
		<tr>
			<td style="border: 0; padding: 0;" colspan="2" width="100%">
				<table class="table" style="margin-top: 0;">
					<tr>
						<th width="40%">CNIC NO.</th>
						<td align="left"><?= $data->CNIC_NO ?></td>
					</tr>
					<tr>
						<th width="40%">CNIC EXPIRY DATE</th>
						<td><?= $data->CNIC_EXPIRY??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">MOBILE PHONE</th>
						<td><?= $data->MOBILE_PHONE??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">WHATSAPP NO.</th>
						<td><?= $data->WHATSAPP_NO??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">POSTAL ADDRESS</th>
						<td><?= $data->ADDRESS??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">STATE/PROVINCE</th>
						<td><?= $data->PROVINCE??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">CITY</th>
						<td><?= $data->CITY??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">STUDENT ID</th>
						<td><?= $data->STUDENT_ID??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">DEPARTMENT</th>
						<td>SOFTWARE ENGINEERING</td>
					</tr>
					<tr>
						<th width="40%">DEGREE PROGRAM</th>
						<td><?= $data->DEGREE_PROGRAM??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">EUCATION LEVEL/DEGREE</th>
						<td><?= $data->EDUCATION_LEVEL??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">ADDITIONAL QUALIFICATION</th>
						<td><?= $data->ADDITIONAL_QUALIFICATION??'-' ?></td>
					</tr>
					<tr>
						<th width="40%">APPLICATION TRACKING ID</th>
						<td>2123JKJKa%</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<table style="padding: 0" width="100%" cellpadding="50">
		<tr>
			<td>
				<div style="width: 50%; border-top: 1px solid black; margin-top: 30px" class="text-center">
					<small>Signature of Applicant</small>
				</div>
			</td>
			<td>
				<div style="width: 50%; border-top: 1px solid black; margin-left: auto; margin-top: 30px" class="text-center">
					<small>Signature of Head of Dept</small>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="width: 50%; border-top: 1px solid #000000; margin-top: 40px" class="text-center">
					<small>Signature of Director ITSC</small>
				</div>
			</td>
		</tr>
	</table>
	</small>

	<br />
	<br />
	<small>
		<b>Please Attach Required Documents</b>
		<ol>
			<li>Photocopy of CNIC</li>
			<li>Student ID Card</li>
			<li>Enrollment Card</li>
		</ol>
	</small>
</div>
</body>
</html>
