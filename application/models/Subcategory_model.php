<?php

class Subcategory_model extends CI_Model {
	private $date;

	public function __construct()
	{
		$this->date = date('Y-m-d H:i:s');
		$this->load->database();
	}

	public function index()
	{
		return $this->db->get('subcategory')->result();
	}

	public function find($id)
	{
		$data = array(
			'id' => $id
		);

		return $this->db->get_where('subcategory', $data)->row();
	}

	public function findByCategory($categoryID)
	{
		$data = array(
			'categoryID' => $categoryID
		);

		return $this->db->get_where('subcategory', $data)->result();
	}

	public function create($categoryID, $name)
	{
		$data = array(
			'categoryID' => $categoryID,
			'name' => $name,
			'date' => $this->date
		);

		$this->db->insert('subcategory', $data);
	}

	public function update($id, $name)
	{
		$data = array(
			'name' => $name,
			'date' => $this->date
		);

		$this->db->where('id', $id);
		$this->db->update('subcategory', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('subcategory');
	}
}