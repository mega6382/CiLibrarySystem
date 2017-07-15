<?php

//session_start(); 

Class Admin extends CI_Controller
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

		if($this->session->userdata['logged_in']['role'] != "admin")
		{
			redirect('client', 'refresh');
		}
	}

	public function index()
	{
		$result = $this->racks_database->fetchAll();
		$data = ['racks' => $result];
		$this->load->view('admin_head');
		$this->load->view('admin_page', $data);
	}

	
	public function add_rack()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin_head');
			$this->load->view('add_rack');
		} else
		{
			$data = array(
			'name' => $this->input->post('name'),
			);
			$result = $this->racks_database->addRack($data);
			if ($result == TRUE)
			{
				$data['message_display'] = 'New Rack Added Successfully!';
				$this->load->view('admin_head', $data);
				$this->load->view('add_rack');
			} else
			{
				$data['message_display'] = 'A rack with this name already exists';
				$this->load->view('admin_head', $data);
				$this->load->view('add_rack');
			}
		}
	}
	
	public function edit_rack()
	{

		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$id = $this->input->get('id', TRUE);
			if(!is_numeric($id))
			{
				redirect('admin', 'refresh');
			}
			$result = $this->racks_database->getRack($id);
			$this->load->view('admin_head');
			$this->load->view('edit_rack', ['name' => $result[0]->name]);
		} else
		{
			$data = array(
			'name' => $this->input->post('name'),
			);
			$result = $this->racks_database->editRack($data, $this->input->post('id'));
			if ($result == TRUE)
			{
				$data['message_display'] = 'Rack updated successfully!';
				$this->load->view('admin_head', $data);
				$this->load->view('add_rack');
			} else
			{
				$data['message_display'] = 'Could Not Update Rack. Try Again!';
				$this->load->view('admin_head', $data);
				$this->load->view('add_rack');
			}
		}
	}
	
	public function manage_books()
	{
		$racks = $this->racks_database->fetchAll();
		$options = [];
		foreach($racks as $rack)
		{
			$options[$rack->id] = $rack->name;
		}
		$result = $this->books_database->fetchAll();
		$data = ['books' => $result, 'racks' => $options];
		$this->load->view('admin_head');
		$this->load->view('manage_books', $data);
	}
	
	public function add_book()
	{
		$racks = $this->racks_database->fetchAll();
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('author', 'Author', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pub_year', 'Published Year', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rack', 'Rack', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin_head');
			$this->load->view('add_book', ['racks' => $racks]);
		} else
		{
			$rack_id = $this->input->post('rack');
			$rack = $this->racks_database->getRack($rack_id);
			if(!$rack)
			{
				$data['message_display'] = 'Rack does not Exist.';
				$data['racks'] = $racks;
				$this->load->view('admin_head', $data);
				$this->load->view('add_book');
				return;
			}
			$books = $this->books_database->getWhere("rack_id = '$rack_id'");
			if(count($books) >= 10)
			{
				$data['message_display'] = 'Maximum 10 Books Allowed Per Rack.';
				$data['racks'] = $racks;
				$this->load->view('admin_head', $data);
				$this->load->view('add_book');
				return;
			}
			$data = array(
			'rack_id' => $rack_id,
			'name' => $this->input->post('name'),
			'author' => $this->input->post('author'),
			'pub_year' => $this->input->post('pub_year'),
			);
			$result = $this->books_database->addBook($data);
			if ($result == TRUE)
			{
				$data['message_display'] = 'New Book Added Successfully!';
				$data['racks'] = $racks;
				$this->load->view('admin_head', $data);
				$this->load->view('add_book');
			} else
			{
				$data['message_display'] = 'A Book with this name already exists';
				$data['racks'] = $racks;
				$this->load->view('admin_head', $data);
				$this->load->view('add_book');
			}
		}
	}
	
	public function edit_book()
	{
		$racks = $this->racks_database->fetchAll();
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('author', 'Author', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pub_year', 'Published Year', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rack', 'Rack', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$id = $this->input->get('id', TRUE);
			if(!is_numeric($id))
			{
				redirect('admin', 'refresh');
			}
			$result = $this->books_database->getBook($id);
			$this->load->view('admin_head');
			$this->load->view('edit_book', ['book' => $result[0], 'racks' => $racks]);
		} else
		{
			$rack_id = $this->input->post('rack');
			$rack = $this->racks_database->getRack($rack_id);
			if(!$rack)
			{
				$data['message_display'] = 'Rack does not Exist.';
				$data['racks'] = $racks;
				$this->load->view('admin_head', $data);
				$this->load->view('add_book');
			}
			$books = $this->books_database->getWhere("rack_id = '$rack_id'");
			if(count($books) >= 10)
			{
				$data['message_display'] = 'Maximum 10 Books Allowed Per Rack.';
				$data['racks'] = $racks;
				$this->load->view('admin_head', $data);
				$this->load->view('add_book');
			}
			$data = array(
			'rack_id' => $rack_id,
			'name' => $this->input->post('name'),
			'author' => $this->input->post('author'),
			'pub_year' => $this->input->post('pub_year'),
			);
			$result = $this->books_database->editBook($data, $this->input->post('id'));
			if ($result == TRUE)
			{
				$data['message_display'] = 'Book updated successfully!';
				$this->load->view('admin_head', $data);
				$this->load->view('add_book');
			} else
			{
				$data['message_display'] = 'Could Not Update Book. Try Again!';
				$this->load->view('admin_head', $data);
				$this->load->view('add_book');
			}
		}
	}

}

