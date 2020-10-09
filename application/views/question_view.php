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
	<title>SmartKids</title>
	<link href="<?php echo $cssbase . "style.css"?>" rel="stylesheet" type="text/css" media="all" />
	<script src="<?php echo $jsbase."common.js"?>"></script>

	<script type="text/javascript">
		window.onload=function(){

		    var fiveMinutes = 60,
		    display = document.querySelector('#live_timer');

		    startTimer(fiveMinutes, display);

				var mytime = 60,
				display = document.querySelector('#getTime');
				startTimer(mytime, display);

		    window.setTimeout(function() { document.frmProccessAnswer.submit(); }, 60000);
		};

		function startTimer(duration, display) {
		    var timer = duration, minutes, seconds;
		    setInterval(function () {
		        minutes = parseInt(timer / 60, 10)
		        seconds = parseInt(timer % 60, 10);

		        minutes = minutes < 10 ? "0" + minutes : minutes;
		        seconds = seconds < 10 ? "0" + seconds : seconds;

		        display.textContent = minutes + ":" + seconds;

		        if (--timer < 0) {
		            timer = duration;
		        }
		    }, 1000);
		}

		function answerSelected(){
			window.setTimeout(function() { document.frmProccessAnswer.submit(); }, 0);
		}
	</script>

</head>
<body>

<div id="container">
	<h1>Welcome to SmartKids</h1>

	<div id="body">
		<!-- Question -->
		<div class="question">
			<p>
				<?php
					echo $question;
				?>
			</p>
		</div>

		<!-- Answer option -->
		<div class="answer_options">
			<!-- Options -->
			<div class="options">
				<?php
				$hidden = array('studentID' => $studentID , 'questionID' => $questionID, 'questionNumber' => $questionNumber);
					$data = array(
						'id' => 'frmProccessAnswer',
						'name' => 'frmProccessAnswer',
						'class' => 'frmProccessAnswer'
					);
					echo form_open_multipart('game/proccessanswer', $data, $hidden);

					echo "<ul>";
					echo "<li>";
					//print_r($answers);
					$data = array(
						'type' => 'radio',
						'id' => 'optionA',
						'name' => 'answer',
						'value' =>  $answers[0],
						'onclick' => 'answerSelected()'
					);
					echo form_radio($data);
					//Retrived from array (list)
					$option = $answers[0];
					echo "<label for='optionA'>" .$option. "</label></li>";

					echo "<li>";
					$data = array(
						'type' => 'radio',
						'id' => 'optionB',
						'name' => 'answer',
						'value' => $answers[1],
						'onclick' => 'answerSelected()'
					);
					echo form_radio($data);
					//Retrived from array (list)
					$option = $answers[1];
					echo "<label for='optionB'>" .$option. "</label></li>";

					echo "<li>";
					$data = array(
						'type' => 'radio',
						'id' => 'optionC',
						'name' => 'answer',
						'value' =>  $answers[2],
						'onclick' => 'answerSelected()'
					);
					echo form_radio($data);
					//Retrived from array (list)
					$option = $answers[2];
					echo "<label for='optionC'>" .$option. "</label></li>";

					echo "<li>";
					$data = array(
						'type' => 'radio',
						'id' => 'optionD',
						'name' => 'answer',
						'value' =>  $answers[3],
						'onclick' => 'answerSelected()'
					);
					echo form_radio($data);
					//Retrived from array (list)
					$option = $answers[3];
					echo "<label for='optionD'>" .$option. "</label></li>";

					echo "</ul>";
				?>
			</div>
			<!-- Image -->
			<div class="image">
			</div>
			<div class="clearfix"></div>
		</div>

		<!-- Timer -->
		<div class="timer">
			<p clas="live_timer" id="live_timer">01:00</p>
		</div>

		<!-- Submit Answer -->
		<div class="answer_submit">
			<?php
				$data = array(
					'id' => 'submit_answer',
					'class' => 'submit_answer',
					'name' => 'submit_answer',
					'type' => 'submit',
					'value' => 'Submit'
				);
				//echo form_input($data);
				$data = array(
					'id' => 'getTime',
					'name' => 'getTime',
					'type' => 'hidden',
					'value' => ''
				);
				echo form_input($data);
				echo form_close();
			?>
		</div>
	</div>

</body>
</html>
