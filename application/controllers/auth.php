<?php

//session_start(); 

Class Auth extends CI_Controller
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
	}

	public function index()
	{
		$this->load->view('login_form');
	}

	public function register()
	{
		$this->load->view('registration_form');
	}

	public function registerdb()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('registration_form');
		} else
		{
			$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
			);
			$result = $this->login_database->signup($data);
			if ($result == TRUE)
			{
				$data['message_display'] = 'Registration Successfully !';
				$this->load->view('login_form', $data);
			} else
			{
				$data['message_display'] = 'Username already exist!';
				$this->load->view('registration_form', $data);
			}
		}
	}

	public function login()
	{

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
			{
				redirect('admin', 'refresh');
			}else
			{
				$this->load->view('login_form');
			}
		} else
		{
			$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
			$result = $this->login_database->login($data);
			if ($result == TRUE)
			{
				$username = $this->input->post('username');
				$result = $this->login_database->getUser($username);
				if ($result != false)
				{
					$session_data = array(
					'username' => $result[0]->username,
					'email' => $result[0]->email,
					'role' => $result[0]->role,
					);
					$this->session->set_userdata('logged_in', $session_data);
					
					redirect('admin', 'refresh');
				}
			} else
			{
				$data = array(
				'error_message' => 'Invalid Username or Password'
				);
				$this->load->view('login_form', $data);
			}
		}
	}

	public function logout()
	{
		$sess_array = array(
		'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('login_form', $data);
	}
	

}

