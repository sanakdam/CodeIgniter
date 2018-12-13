<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
use Sastrawi\Stemmer\StemmerFactory;

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
		return redirect('/twitter/input');
		// $user = array();
		// $user = $this->user;
		// $user->title = "Overview";
		// $this->load->view("header", $user);
		// $this->load->view("admin_info", $user);
		// $this->load->view("footer");
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

	public function user_analyze_proccess($username)
	{
		$stemmerFactory = new StemmerFactory();
		$stemmer  = $stemmerFactory->createStemmer();
		$train = array();
		$stem = array();
		$data = array();
		$user = array();
		$train["n"] = 0;

		$this->load->helper('file');
		$this->load->model('category_model');
		$this->load->model('subcategory_model');
		$this->load->model('history_model');
		$category = $this->category_model->index();
		$n = $this->subcategory_model->index();
		$train["n"] = count($n);

		foreach ($category as $data) 
		{
			$data_train = array();
			$subcategory = $this->subcategory_model->findByCategory($data->id);
			$data_train["class_name"] = $data->name;
			$data_train["class_n"] = count($subcategory);
			$data_train["class_prob"] = count($subcategory) / $train["n"];
			$data_train["class_list"] = $subcategory;

			$train["data"][] = $data_train;
		}

		$lines = file("./data/" . $username . ".txt", FILE_IGNORE_NEW_LINES);
		$stopword = file("./data/stopword.txt", FILE_IGNORE_NEW_LINES);

		function tokenizing($words)
		{
			$result = array();
			$explode = explode(' ', $words);
			$delimiter = array( '\'', '"', ',' , ';', '<', '>', '.' );
			foreach ($explode as $word) {
				if (!filter_var($word, FILTER_VALIDATE_URL)) {
				    $result[] = str_replace($delimiter, '', $word);
				}
			}

			return $result;
		}

		function removal($tokenizing, $stopword)
		{
			$result = array();
			foreach ($tokenizing as $token) 
			{
				if(!in_array($token, $stopword))
				{
					$result[] = $token;
				}
			}

			return $result;
		}

		function stemming($stemmer, $removal)
		{
			$result = array();
			foreach ($removal as $rm) {
				$result[] = $stemmer->stem($rm);
			}

			return $result;
		}

		function naive_bayes($train, $stem)
		{
			$result = array();

			foreach ($train["data"] as $data) 
			{
				$res_data = array();
				$count = 0;
				$res_data["name"] = $data["class_name"];
				$res_data["prob"] = $data["class_prob"];
				$res_data["n"] = $data["class_n"];
				$counts = array_count_values($stem);

				foreach ($data["class_list"] as $list) 
				{
					if(isset($counts[$list->name])) {
						$count += $counts[$list->name];
					}
				}

				$res_data["Xi_Y"] = $count / $res_data["n"];
				$res_data["bayes"] = $res_data["Xi_Y"] * $res_data["prob"];

				$result["data"][] = $res_data;
			}

			$result["n"] = $train["n"];
			return $result;
		}
		
		foreach ($lines as $line) {
			$words = strtolower($line);
			$tokenizing = tokenizing($words);
			$removal = removal($tokenizing, $stopword);
			$stemming = stemming($stemmer, $removal);
			$stem = array_merge($stem, $stemming);
		}

		$data->result = naive_bayes($train, $stem);
		$data->username = $username;
		$user = $this->user;
		$user->title = "Naive Bayes Result";
		$this->history_model->create($username, json_encode($data->result, true));

		$this->load->view("header", $user);
		$this->load->view("bayes_result", $data);
		$this->load->view("footer");
	}

	public function user_analyze()
	{
		$user = array();
		$data = array();
		$result = array();
		$tweets = array();
		$this->load->helper('file');
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

		$result = get_tweets($this->connection, $since_id, $tweets, $username);

		if (file_exists("./data/" . $username . ".txt")) {
		    unlink("./data/" . $username . ".txt");
		}
		
		foreach ($result as $data) {
			$text = str_replace( "\n", " ", $data->text); 
			if ( !write_file("./data/" . $username . ".txt", (string)$text . "\n", "a+")){
		    	echo 'Unable to write the file';
			}
		}

		$data->result = $result;
		$data->username = $username;
		$user = $this->user;
		$user->title = "User Timeline";

		$this->load->view("header", $user);
		$this->load->view("analyze", $data);
		$this->load->view("footer");
	}

	public function user_history()
	{
		$user = array();
		$data = array();

		$this->load->model('history_model');
		$data['result'] = $this->history_model->index();

		$user = $this->user;
		$user->title = "History";

		$this->load->view("header", $user);
		$this->load->view("history", $data);
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
