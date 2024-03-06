<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session'); //enable session
	}

	public function index()
	{
		$data['error'] = "";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');

		if (!$this->session->userdata('logged_in')) {
			if (get_cookie('remember')) {
				$username = get_cookie('username'); //getting username from cookie
				$password = get_cookie('password'); //getting password from cookie
				if ($this->user_model->login($username, $password)) {
					$user_data = array(
						'username' => $username,
						'logged_in' => true
					);
					$this->session->set_userdata($user_data);
					$this->load->view('home');
				}
			} else {
				$this->load->view('login', $data);
			}
		} else {
			$this->load->view('home');
		}
		$this->load->view('template/footer');
	}


	public function check_login()
	{
		$this->load->model('user_model');

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$username = $this->input->post('username'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		$remember = $this->input->post('remember'); //getting remember status from login form

		if (!$this->session->userdata('logged_in')) {
			if ($this->user_model->login($username, $password)) {
				$user_data = array(
					'username' => $username,
					'logged_in' => true
				);

				if ($remember) {
					set_cookie('username', $username, '3000');
					set_cookie('password', $password, '3000');
					set_cookie('remember', $remember, '3000');
				}
				$this->session->set_userdata($user_data);
				redirect(base_url().'index.php?/login');
			} else {
				$this->session->set_flashdata('error', "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod!! </div>");
				redirect(base_url().'index.php?/login');
				// $this->load->view('login', $data);
				// $this->load->view('template/footer');
			}
		} else {
			redirect(base_url().'index.php?/login');
			// $this->load->view('template/footer');
		}
	}

	public function logout()
	{
		delete_cookie('username');
		delete_cookie('password');
		delete_cookie('remember');
		$this->session->unset_userdata('logged_in');
		redirect(base_url().'index.php?/login');
	}

}
