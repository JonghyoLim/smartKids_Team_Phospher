<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {

	//Answer Arrays:

	//Format = {Question Number, Question Text, Correct Answer, Wrong Answer, Wrong Answer, Wrong Answer}

	//========================= Questions and Answers Arrays =================================================================
	public $Science =  array(
		array(0,"What type of energy does the sun provide?", "Solar energy", "Atomic energy", "Geothermal energy", "Nuclear energy"),
		array(1,"When you push something, you apply ____.", "Force", "Compression", "Acceleration", "Mass"),
		array(2,"How many colors in a rainbow?", "7", "1", "9", "4")

	);
	public $Technology =  array(
		array(0,"What is the brain of a computer", "CPU (Central Processing unit)", "RAM(Random Access Memory)", "GPU(Graphics Processing unit)", "Hard Drive")
	);

	public $Enginering =  array(
		array(0,"What simple machine was used to make a cart during the ancient times", "Wheel and axle", "Pulley", "Screw", "Inclined Plane"),
		array(1,"How many sides does a Triangle have", "3", "2", "4", "8"),
	);
	public $Maths =  array(
		array(0,"4+5*2", "14", "11", "15", "18"),
		array(1,"3*4", "12", "11", "7", "16"),
		array(2,"2*2-1", "3", "5", "1", "2")
	);
	public $Fun =  array(
		array(0,"What is the name of the toy cowboy in Toy Story?", "Woody", "Sid", "Rex", "Buzz Lightyear"),
		array(1,"Which Italian city is famous for its leaning tower?", "Pisa", "Rome", "Milan", "Venice"),
		array(2,"Which country is home to the kangaroo?", "Australia", "Ireland", "America", "China")

	);
//========================= END: Questions and Answers Arrays =================================================================

	public function __construct(){
		parent::__construct();
		$this->load->model('GameModel');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('form_validation');

		//Load session through controller
		$this->load->library('session');
	}


	//By default setup page
	public function index(){

		$data['message'] = "Welcome to setup page";
		$data['studentList'] = $this->GameModel->getAllStudents();
		$this->load->view('setup_view', $data);
	}

	//Count down page
	function start(){
		$data['message'] = "Welcome to count down page";
		$data['challenge'] = " Challenge ";
		$data['cNumber'] = $this->input->post('cNumber');
		$data['id'] = $this->input->post('id');
		$data['name'] = $this->input->post('name');


		$activites = array (
			"Standing on one leg",
			"Jumping jacks (star jumps)",
			"Running on the spot (running in the jungle*)",
			"Burpees",
			"Running around a cone",
			"Push ups",
			"Sit ups" ,
			"Hula hooping",
			"Dribbling a basketball",
			"Dodging ball pit balls" );

			$i = rand(0, count($activites));
			$data['activity'] = $activites[$i];

			$this->load->view('count_down_view', $data);

		}

		function sendToQuestion_Page(){

			$info['id'] = $this->input->post('id');
			$info['cNunmber'] = $this->input->post('cNumber');



		}


		//addng a child from the setup page
		function addChild(){
			if ($this->input->post('submit')) {
				$this->form_validation->set_rules('childName', 'child Name', 'required');

				$aChild['childName'] = $this->input->post('childName');

				if(!$this->form_validation->run()){
					$this->load->view('setup_view', $aChild);
					return;
				}
				$this->GameModel->addChild($aChild);
				$this->index();
				return;
			}
			$aChild['childName'] = "";
			$this->load->view('setup_view', $aChild);
		}

		function resetTable(){
			$this->GameModel->resetTable();
			redirect('Game/index');
		}

		function finishGame(){
			$data['studentList'] = $this->GameModel->getTopStudents();
			$this->load->view('leaderboard', $data);

		}

		//This will generate  a random question based off what topic is passed in
		public function getQuestion($questionID){
			switch ($questionID) {
				case 'C1':
				//Science
				$num = rand(0,count($this->Science)-1);
				//print_r($this->Science[$num][0]);
				//print_r($this->Science[$num][1]);
				return array($this->Science[$num][0], $this->Science[$num][1]);
				break;
				case 'C2':
				// Technology
				$num = rand(0,count($this->Technology)-1);
				return array($this->Technology[$num][0], $this->Technology[$num][1]);
				break;
				case 'C3':
				// Engineering
				$num = rand(0,count($this->Enginering)-1);
				return array($this->Enginering[$num][0], $this->Enginering[$num][1]);
				break;
				case 'C4':
				// Maths
				$num = rand(0,count($this->Maths)-1);
				return array($this->Maths[$num][0], $this->Maths[$num][1]);
				break;
				case 'C5':
				// Fun
				$num = rand(0,count($this->Fun)-1);
				return array($this->Fun[$num][0], $this->Fun[$num][1]);
				break;
				default:
				$num = 0;
				return $num;
				break;
			}
			return 0;

		}
		/*
			This function will generate the random order of the answers by cutting the answer array and extracting only the answers,
			including the correct answer. Once the answers are extracted the answers are shuffled and sent off the be loaded on a webpage
		*/
		public function getAnswers($questionID, $num){
			switch ($questionID) {
				case 'C1':
				//Science
				$answers = $this->Science[$num];
				$answers = array_slice($answers, 2);
				shuffle($answers);
				return $answers;
				break;
				case 'C2':
				// Technology
				$answers = $this->Technology[$num];
				$answers = array_slice($answers, 2);
				shuffle($answers);
				return $answers;
				break;
				case 'C3':
				// Engineering
				$answers = $this->Enginering[$num];
				$answers = array_slice($answers, 2);
				shuffle($answers);
				return $answers;
				break;
				case 'C4':
				// Maths
				$answers = $this->Maths[$num];
				$answers = array_slice($answers, 2);
				shuffle($answers);
				return $answers;
				break;
				case 'C5':
				// Fun
				$answers = $this->Fun[$num];
				$answers = array_slice($answers, 2);
				shuffle($answers);
				return $answers;
				break;
				default:
				$num = 0;
				return $num;
				break;
			}
		}
		//Count down page
		function question(){
			if (isset($_POST['studentID'])) {

				$studentID = $this->input->post('studentID');
				$questionID = $this->input->post('questionID');
				//echo $questionID;
				$data['studentID'] = $studentID ;
				$data['questionID']= $questionID;
			}
			else {
				echo "Nothing recieved from POST";
			}


			$question = $this->getQuestion($questionID);

			$data['question'] = $question[1];

			$questionNumber = $question[0];
			//echo "questionNumber".$questionNumber;

			//Generate answers for question
			$data['answers'] = $this->getAnswers($questionID, $questionNumber);
			$data['questionNumber'] = $questionNumber;
			//print_r($data['answers']);
			//Send childID, question, answers, cNumber

			$data['message'] = "Welcome to question page";
			$this->load->view('question_view', $data);
		}

		//Returns the correct answer for checking after result is submitted
		function getQuestionData($questionID,$questionNumber)
		{
			switch ($questionID) {
				case 'C1':
				//Science
				$answers = $this->Science[$questionNumber];
				$answers = $answers[2];
				return $answers;
				break;
				case 'C2':
				// Technology
				$answers = $this->Technology[$questionNumber];
				$answers = $answers[2];
				return $answers;
				break;
				case 'C3':
				// Engineering
				$answers = $this->Enginering[$questionNumber];
				$answers = $answers[2];
				return $answers;
				break;
				case 'C4':
				// Maths
				$answers = $this->Maths[$questionNumber];
				$answers = $answers[2];
				return $answers;
				break;
				case 'C5':
				// Fun
				$answers = $this->Fun[$questionNumber];
				$answers = $answers[2];
				return $answers;
				break;
				default:
				$num = 0;
				return $num;
				break;
			}
		}
		//Check if submitted answer is correct
		function proccessanswer(){
			if (isset($_POST['studentID'])) {
				//print_r($_POST);
				$submittedanswer = $this->input->post('answer');
				$studentID = $this->input->post('studentID');
				$questionID = $this->input->post('questionID');
				$questionNumber = $this->input->post('questionNumber');


				//print_r($this->getQuestionData($questionID,$questionNumber));
				if ($submittedanswer == $this->getQuestionData($questionID,$questionNumber)) {
					//Question answered correctly
					//FOR NOW 50 points if correct answer
					$score[$questionID] = 50;
					$this->GameModel->updateScore($studentID,$score);
					$this->score(1,50);

				}
				else {
					//false
					//5 points for failed answer

					$score[$questionID]= 5;
					$this->GameModel->updateScore($studentID,$score);
					$this->score(0,5);
				}

			}
		}

		//Score page
		//--------------------------------------------------------------
		//Function is expecting a 1 or 0 for the correctness of the answer
		//and a numberic value for the score
		//http://localhost/JohnsonJohnson/CI/index.php/game/score/1/50
		//--------------------------------------------------------------
		function score($correct, $score){
			//$score = $this->input->get('score');
			//$correct = $this->input->get('correct');

			//Gathering data from countdown should have been processed here
			if ($correct == 1) {
				$correct = TRUE;
			}
			else {
				$correct = FALSE;
			}

			$data['message'] = "Welcome to score page";
			$data['score'] = $score;
			$data['correct'] = $correct;
			$this->load->view('score_view', $data);
		}
	}
