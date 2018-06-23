<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter extends CI_Controller {
	private $connection;
	private $user;
	private $access_token = '2804650369-D48HPdOJAVyRBCcU3HsNQ7XZQSwm3b1ln8H16nY';
	private $access_token_secret = '68SXVBBE9hvdK1Wr83NgRX3gradX1kH7z44tambQZfIWE';

	public function __construct()
	{
		parent::__construct();

   		// load base_url
   		$this->load->helper('url');
		$this->connection = new TwitterOAuth(
			'ZQJaxi2ylPg2Qe2pEmFrDCr8R', 
			'ELLRz996zV6BqccFDdJ8BFVHR4PGAwWgDf3GgZRDTcXwmvI7si', 
			$this->access_token, 
			$this->access_token_secret
		);

		$this->user = $this->connection->get("account/verify_credentials");
	}

	public function index()
	{
		$user = array();
		$user = $this->user;
		$user->title = "Overview";
		$this->load->view("header", $user);
		$this->load->view("admin_info", $user);
		$this->load->view("footer");
	}

	public function input()
	{
		$user = array();
		$data = array();
		$user = $this->user;
		$user->title = "Input Data";
		$this->load->view("header", $user);
		$this->load->view("input");
		$this->load->view("footer");
	}

	public function category()
	{
		$user = array();
		$data = array();

		$this->load->model('category_model');
		$data['result'] = $this->category_model->index();

		$user = $this->user;
		$user->title = "Category Data";
		$this->load->view("header", $user);
		$this->load->view("category", $data);
		$this->load->view("footer");
	}

	public function add_category($id)
	{
		$this->load->model('category_model');
		$category = $this->category_model->find($id);
		var_dump($category);
	}

	public function create_category()
	{
		$name = $this->input->get('name', TRUE);

		$this->load->model('category_model');
		$this->category_model->create($name);

		return redirect('/twitter/category');	
	}

	public function update_category($id)
	{
		$name = $this->input->get('name', TRUE);

		$this->load->model('category_model');
		$this->category_model->update($id, $name);

		return redirect('/twitter/category');		
	}

	public function delete_category($id)
	{
		$this->load->model('category_model');
		$this->category_model->delete($id);

		return redirect('/twitter/category');		
	}

	public function show_words($id)
	{
		$user = array();
		$data = array();

		$this->load->model('category_model');
		$this->load->model('subcategory_model');
		$data['category'] = $this->category_model->find($id);
		$data['subcategory'] = $this->subcategory_model->findByCategory($id);

		$user = $this->user;
		$user->title = "Show Words";

		$this->load->view("header", $user);
		$this->load->view("words", $data);
		$this->load->view("footer");		
	}

	public function add_word($id)
	{
		$user = array();
		$data = array();

		$this->load->model('category_model');
		$data['category'] = $this->category_model->find($id);

		$user = $this->user;
		$user->title = "Add Word";

		$this->load->view("header", $user);
		$this->load->view("add_word", $data);
		$this->load->view("footer");
	}

	public function create_word()
	{
		$categoryID = $this->input->get('categoryID', TRUE);
		$name = $this->input->get('name', TRUE);

		$this->load->model('subcategory_model');
		$this->subcategory_model->create($categoryID, $name);

		return redirect('/twitter/show_words/' . $categoryID);
	}

	public function edit_word($id, $categoryID)
	{
		$user = array();
		$data = array();

		$this->load->model('category_model');
		$this->load->model('subcategory_model');
		$data['category'] = $this->category_model->find($categoryID);
		$data['subcategory'] = $this->subcategory_model->find($id);

		$user = $this->user;
		$user->title = "Edit Word";

		$this->load->view("header", $user);
		$this->load->view("edit_word", $data);
		$this->load->view("footer");
	}

	public function update_word($id)
	{
		$categoryID = $this->input->get('categoryID', TRUE);
		$name = $this->input->get('name', TRUE);

		$this->load->model('subcategory_model');
		$this->subcategory_model->update($id, $name);

		return redirect('/twitter/show_words/' . $categoryID);
	}

	public function admin_timeline()
	{
		$timeline = $this->connection->get("statuses/home_timeline", [
			"count" => 25, 
			"exclude_replies" => true
		]);

		var_dump($timeline);
	}

	public function user_analyze()
	{
		$user = array();
		$data = array();
		$tweets = array();
		$username = $this->input->get('username', TRUE);
		$since_id = 1;

		function get_tweets($conn, $since_id, $tweets, $username)
		{
			$result = $conn->get("statuses/user_timeline", [
				"count" => 200,
				"since_id" => $since_id,
				"screen_name" => $username,
				"exclude_replies" => true
			]);

			if(count($result) == 200)
			{
				$tweets = array_merge($tweets, $result);
				$since_idx = $result[count($result) - 1]->id;
				return get_tweets($conn, $since_idx, $tweets, $username);
			} else {
				$tweets = array_merge($tweets, $result);
				return $tweets;
			}
		}

		$data['result'] = get_tweets($this->connection, $since_id, $tweets, $username);
		$user = $this->user;
		$user->title = "User Timeline";

		$this->load->view("header", $user);
		$this->load->view("analyze", $data);
		$this->load->view("footer");
	}

	public function user_search()
	{
		$user = array();
		$data = array();
		$query = $this->input->get('query', TRUE);
		$result = $this->connection->get("users/search", [
			"count" => 25, 
			"q" => $query
		]);

		$user = $this->user;
		$data['result'] = $result;
		$data['query'] = $query;
		$user->title = "Query Result";
		$this->load->view("header", $user);
		$this->load->view("input", $data);
		$this->load->view("footer");
	}

	public function user_info($username)
	{
		$user = $this->connection->get("users/show", [
			"count" => 25, 
			"screen_name" => $username
		]);

		$this->load->view("user_info", $user);
	}
}
