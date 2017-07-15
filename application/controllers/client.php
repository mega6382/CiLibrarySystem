<?php

//session_start(); 

Class Client extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('login_database');
		$this->load->model('racks_database');
		$this->load->model('books_database');
		$this->load->helper('url');
		if (!isset($this->session->userdata['logged_in']))
		{
			header("location: auth/login");
		}
	}

	public function index()
	{
		$result = $this->racks_database->viewRacks();
		$data = ['racks' => $result];
		$this->load->view('client_head');
		$this->load->view('client_page', $data);
	}
	
	public function view_rack()
	{
		$id = $this->input->get('id', TRUE);
		if(!is_numeric($id))
		{
			redirect('client', 'refresh');
		}
		$rack = $this->racks_database->getRack($id);
		$books = $this->books_database->getWhere("rack_id = '$id'");
		$this->load->view('client_head');
		$this->load->view('view_rack', ['rack' => $rack[0]->name, 'books' => $books]);
	}
	
	public function search_books()
	{
		$this->load->view('client_head');
		$this->load->view('search_books');
	}
	
	public function search_result()
	{
		$this->form_validation->set_rules('query', 'Search value', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
				redirect('client/search_books', 'refresh');
		} else
		{
			$search = $this->input->post('query');
			$result = $this->books_database->searchBooks($search);
			$racks = $this->racks_database->fetchAll();
			$options = [];
			foreach($racks as $rack)
			{
				$options[$rack->id] = $rack->name;
			}
			$data = ['books' => $result, 'racks' => $options, 'query' => $search];
			$this->load->view('client_head');
			$this->load->view('search_result', $data);
		}

	}

}

