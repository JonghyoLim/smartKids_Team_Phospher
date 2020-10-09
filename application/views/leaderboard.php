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
		<div class="list">
			<table id="list">
				<tr>
					<th>Child Name</th>
					<th>Total</th>
				</tr>
					<?php if ($studentList) {
						foreach ($studentList as $row)
						{?>
							<tr>
								<td><?php echo $row->Name; ?></td>
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
