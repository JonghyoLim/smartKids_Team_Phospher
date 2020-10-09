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
			<?php //echo anchor('game/index', 'Home ->'); ?>
		</div>

		<div class="answer_wrapper">
			<div id="answer">
			<?php
			// $correct is a boolean value
				if (isset($correct)) {
					if ($correct) {
						?>
							<h3 id="correct">Answer was correct!</h3>
						<?php

					}
					else {
						?>
						<h3 id="incorrect">Answer was wrong</h3>
						<?php
					}
				}
			 ?>
		</div>

		<div id="points">
			<?php
			//$score is a numeric (int) value
			if (isset($score)) {
				?>
					<h3>You scored <?php echo $score; ?> points</h3>
				<?php
			}
			 ?>
		</div>
		<div class="clearfix"></div>
		</div>

		<div class="goback">
			<?php echo anchor('game/index', 'Home'); ?>
		</div>


</div>

</body>
</html>
