<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class GameModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getAllStudents(){
    $this->db->select("*");
    $this->db->from('students');
    $query = $this->db->get();
    return $query->result();
  }

	public function getTopStudents(){
    $this->db->select("*");
    $this->db->from('students');
		$this->db->order_by("Total", "desc");
    $query = $this->db->get();
    return $query->result();
  }

	function resetTable(){
		$this->db->empty_table('students');
	}

	function addChild($aChild){
		$insertChild['Name'] = $aChild['childName'];
		$insertChild['C1'] = NUll;
		$insertChild['C2'] = NUll;
		$insertChild['C3'] = NUll;
		$insertChild['C4'] = NUll;
		$insertChild['C5'] = NUll;
		$insertChild['Total'] = NUll;

		$this->db->insert('students',$insertChild);

		if ($this->db->affected_rows() == 1) {
			return true;
		}else {
			return false;
		}
	}

	//--------------------------------------------------
	//Function is requesting child ID and $score array
	//Score should contain the Question ID and the Score
	// EG:
	// $score['C1'] = 50;
	//--------------------------------------------------
	function updateScore($childId, $score){
		$this->db->where('ID', $childId); // here is the id
		$this->db->update('students', $score);
		if ($this->db->affected_rows() == 1) {
			return true;
		}
		else {
			return false;
		}
	}
}
