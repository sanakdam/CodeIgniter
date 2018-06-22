<?php

class Category_model extends CI_Model {
	private $date;

	public function __construct()
	{
		$this->date = date('Y-m-d H:i:s');
		$this->load->database();
	}

	public function index()
	{
		return $this->db->get('category')->result();
	}

	public function find($id)
	{
		$data = array(
			'id' => $id
		);

		return $this->db->get_where('category', $data)->row();
	}

	public function create($name)
	{
		$data = array(
			'name' => $name,
			'date' => $this->date
		);

		$this->db->insert('category', $data);
	}

	public function update($id, $name)
	{
		$data = array(
			'name' => $name,
			'date' => $this->date
		);

		$this->db->where('id', $id);
		$this->db->update('category', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('category');
	}
}