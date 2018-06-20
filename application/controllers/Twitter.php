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
		$this->connection = new TwitterOAuth('ZQJaxi2ylPg2Qe2pEmFrDCr8R', 'ELLRz996zV6BqccFDdJ8BFVHR4PGAwWgDf3GgZRDTcXwmvI7si', $this->access_token, $this->access_token_secret);

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
		$user = $this->user;
		$user->title = "Category Data";
		$this->load->view("header", $user);
		$this->load->view("category");
		$this->load->view("footer");
	}

	public function admin_timeline()
	{
		$timeline = $this->connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);
		var_dump($timeline);
	}

	public function user_analyze()
	{
		$username = $this->input->get('username', TRUE);
		$timeline = $this->connection->get("statuses/user_timeline", ["screen_name" => $username, "exclude_replies" => true]);

		var_dump($timeline);
	}

	public function user_search()
	{
		$user = array();
		$data = array();
		$query = $this->input->get('query', TRUE);
		$result = $this->connection->get("users/search", ["count" => 25, "q" => $query]);
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
		$user = $this->connection->get("users/show", ["count" => 25, "screen_name" => $username]);

		$this->load->view("user_info", $user);
	}
}
