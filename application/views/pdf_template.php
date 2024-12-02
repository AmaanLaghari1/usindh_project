<?php
$imagePath = FCPATH . 'uploads/' . $data->APPLICANT_PICTURE; // Path to the uploaded image

$logoPath = FCPATH . 'images/us_logo.png';

// Convert the image to Base64
$imageData = base64_encode(file_get_contents($imagePath));
$logoData = base64_encode(file_get_contents($logoPath));


// Pass the Base64 image data to the view
$data->APPLICANT_PICTURE_BASE64 = 'data:image/jpeg;base64,' . $imageData;
$data->LOGO = 'data:image/jpeg;base64,' . $logoData;
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
	<img width="200" src="<?= $data->LOGO ?>" />
</div>
<h1 class="text-center">University of Sindh</h1>
<h3 class="text-center">Email Request Application Form</h3>

<table class="table table-bordered">
	<tr>
		<td>
			<img src="<?= $data->APPLICANT_PICTURE_BASE64 ?>" width="100" />
		</td>
	</tr>
	<tr>
		<th>Student ID</th>
		<td><?php echo $data->STUDENT_ID??''; echo $data->STAFF_OR_FACULTY_ID??''; ?></td>
	</tr>
	<tr>
		<th>First Name</th>
		<td><?php echo $data->FIRST_NAME; ?></td>
	</tr>
	<tr>
		<th>Last Name</th>
		<td><?php echo $data->LAST_NAME; ?></td>
	</tr>
	<tr>
		<th>Email</th>
		<td><?php echo $data->EMAIL; ?></td>
	</tr>
	<tr>
		<th>CNIC</th>
		<td><?php echo $data->CNIC_NO; ?></td>
	</tr>
	<tr>
		<th>Date of Birth</th>
		<td><?php echo $data->DATE_OF_BIRTH; ?></td>
	</tr>
	<tr>
		<th>Mobile Phone</th>
		<td><?php echo $data->MOBILE_PHONE; ?></td>
	</tr>
	<tr>
		<th>Whatsapp Phone</th>
		<td><?php echo $data->WHATSAPP_NO; ?></td>
	</tr>
	<tr>
		<th>City</th>
		<td><?php echo $data->CITY; ?></td>
	</tr>
	<tr>
		<th>Province</th>
		<td><?php echo $data->PROVINCE; ?></td>
	</tr>
	<tr>
		<th>PDF Link</th>
		<td><?= $pdf_url ?></td>
	</tr>

</table>
</body>
</html>
