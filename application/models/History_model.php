<?php

class History_model extends CI_Model {
	private $date;

	public function __construct()
	{
		$this->date = date('Y-m-d H:i:s');
		$this->load->database();
	}

	public function index()
	{
		return $this->db->get('history')->result();
	}

	public function create($username, $result)
	{
		$data = array(
			'username' => $username,
			'result' => $result,
			'date' => $this->date
		);

		$this->db->insert('history', $data);
	}
}