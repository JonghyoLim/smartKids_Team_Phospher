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


<script type="text/javascript">
		function timer(){

		    var fiveMinutes = 05,
		    display = document.querySelector('#live_timer');
		    startTimer(fiveMinutes, display);

		    window.setTimeout(function() { document.frmSendToQ.submit(); }, 6000);
		};

		function startTimer(duration, display) {
		    var timer = duration, minutes, seconds;
		    setInterval(function () {
		        minutes = parseInt(timer / 60, 10)
		        seconds = parseInt(timer % 60, 10);

		        minutes = minutes < 10 ? "0" + minutes : minutes;
		        seconds = seconds < 10 ? "0" + seconds : seconds;

		        var lastChar = seconds[seconds.length -1];

		        display.textContent =  lastChar;

		        if (--timer < 0) {
		            timer = duration;
		        }
		    }, 1000);
		}
	</script>
<body>

<div id="container">
	<h1>Welcome to SmartKids</h1>

	<div id="body">

		<?php //echo anchor('game/question', 'Question ->'); ?>

		<div class="activity">
			<p>
				<?php
					echo $activity;
				?>
			</p>
		</div>


		<div class ="challenge">
			<p><?php echo "Challenge: " .$cNumber; ?></p>
			<p><?php echo " Student: " .$name; ?></p>
			<div class="clearfix"></div>
		</div>

		<div class ="countdown"> <p id="live_timer">5</p> </div>



  		<div class="button">
     		<?php

     			$hidden = array('studentID' => $id , 'questionID' => $cNumber);
     			$data = array(
     				'id' => 'frmSendToQ',
     				'name' => 'frmSendToQ',
     				'class' => 'frmSendToQ'
     			);
     			echo form_open_multipart("Game/question", $data,$hidden);
     			echo form_close();



			?>


			<?php
     			//$hidden = array('id' => $id , 'cNumber' => $cNumber);

     			//echo form_open("Game/sendToQuestion_Page");

     			$data = array(
     				'id' => 'btn_submit',
     				'class' => 'btn_submit',
     				'onclick' => 'timer();',
     				'type' => 'button',
     				'value' => 'Begin Game'
     			);
     			echo form_input($data);
     			//echo form_close();

     			//print_r($id, $cNumber);

			?>
  		<!-- <button class="view btn btn-success btn-block"> <?php //echo anchor('Game//'. ''); ?></button> -->
  		</div>


  	</div>

</div>

</body>
</html>
