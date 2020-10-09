<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	//$this->load->view('empty_header');
	$this->load->helper('url');
	$cssbase = base_url()."assets/css/";
	$jsbase = base_url()."assets/javascript/";
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SmatKids</title>
	<link href="<?php echo $cssbase . "style.css"?>" rel="stylesheet" type="text/css" media="all" />
	<script src="<?php echo $jsbase."common.js"?>"></script>
</head>
<body>

<div id="container">
	<h1>Welcome to SmartKids</h1>

	<div id="body">
		<div class="input">
			<?php
				 	echo form_open('Game/addChild');

					echo "<label>Enter a Student Name: </label>";
					echo form_input('childName');

					echo form_submit("submit", "Submit");
					echo "<br><br>";
					echo form_close();
			 ?>
		</div>
		<div class="list">
			<table id="list">
				<tr>
					<th>Child Name</th>
					<th>Challange 1</th>
					<th>Challange 2</th>
					<th>Challange 3</th>
					<th>Challange 4</th>
					<th>Challange 5</th>
					<th>Total</th>
				</tr>
					<?php if ($studentList) {
						foreach ($studentList as $row)
						{?>
							<tr>
								<td><?php echo $row->Name; ?></td>
								<td>

									<?php if ($row->C1 == NULL) {
											$hidden = array('id' => $row->ID, 'cNumber' => "C1", 'name' => $row->Name);
											echo form_open('Game/start', '', $hidden);

											echo form_submit("start", "Start");

											echo form_close();

										}else {
											echo $row->C1;
										}
									?>
								</td>

								<td>
									<?php if ($row->C2 == NULL) {
										$hidden = array('id' => $row->ID, 'cNumber' => "C2", 'name' => $row->Name);
										echo form_open('Game/start', '', $hidden);

										echo form_submit("start", "Start");

										echo form_close();
										}else {
											echo $row->C2;
										}
									?>
								</td>
								<td>
									<?php if ($row->C3 == NULL) {
										$hidden = array('id' => $row->ID, 'cNumber' => "C3", 'name' => $row->Name);
										echo form_open('Game/start', '', $hidden);

										echo form_submit("start", "Start");

										echo form_close();
										}else {
											echo $row->C3;
										}
									?>
								</td>
								<td>
									<?php if ($row->C4 == NULL) {
										$hidden = array('id' => $row->ID, 'cNumber' => "C4", 'name' => $row->Name);
										echo form_open('Game/start', '', $hidden);

										echo form_submit("start", "Start");

										echo form_close();
										}else {
											echo $row->C4;
										}
									?>
								</td>
								<td>
									<?php if ($row->C5 == NULL) {
										$hidden = array('id' => $row->ID, 'cNumber' => "C5", 'name' => $row->Name);
										echo form_open('Game/start', '', $hidden);

										echo form_submit("start", "Start");

										echo form_close();
										}else {
											echo $row->C5;
										}
									?>
								</td>
								<td>
									<?php
										if($row->Total == null || $row->Total == 0){
											echo "0";
										}else{
											echo $row->Total;
										}
									?>
								</td>
							</tr>
						<?php } } ?>
			</table>
		</div>
		<div class="finishGame">
			<?php
				echo form_open('Game/finishGame');
				echo form_submit("finishGame", "Finish Game");
				echo form_close();
			 ?>
		</div>
		<div class="reset">
			<?php
				echo form_open('Game/resetTable');
				echo form_submit("resetTable", "Reset Game");
				echo form_close();
			 ?>
		</div>
	</div>

</body>
</html>
