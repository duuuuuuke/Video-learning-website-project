<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller
{

	public function index()
	{
		$data['error'] = "";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('signup', $data);
		$this->load->view('template/footer');
	}

	public function register()
	{
		// form validation
		$this->form_validation->set_rules(
			'username',
			'Username',
			'required|max_length[25]|is_unique[users.username]'
		);
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules(
			'confirmed_password',
			'Password Confirmation',
			'required|min_length[5]|matches[password]'
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|valid_email|is_unique[users.email]'
		);

		if ($this->form_validation->run() == FALSE) {
			// validation fail, back to signup and show error
			$this->index();
		} else {
			// validation succeed, insert new user
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$new_user = array(
				'username' => $username,
				'email' => $email,
				'password' => $hashed_password,
			);
			$result = $this->user_model->add_new_user($new_user);

			if ($result == TRUE) {
				// insert successfully, and set session, go to verification page
				$user_data = array(
					'username' => $username,
					'email' => $email,
					'logged_in' => false
				);
				$this->session->set_userdata($user_data);

				redirect(base_url().'index.php?/login');
			} else {
				// incase insertion failed
				$this->session->set_flashdata('message', 'Something went wrong, please try again.');
				redirect(base_url().'index.php?/signup');
			}
		}
	}
}
