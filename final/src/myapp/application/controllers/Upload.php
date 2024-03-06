<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Upload extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/header');
        if (!$this->session->userdata('logged_in')) //check if user already login
        {
            if (get_cookie('remember')) { // check if user activate the "remember me" feature  
                $username = get_cookie('username'); //get the username from cookie
                $password = get_cookie('password'); //get the username from cookie
                if ($this->user_model->login($username, $password)) //check username and password correct
                {
                    $user_data = array('username' => $username, 'logged_in' => true);
                    $this->session->set_userdata($user_data); //set user status to login in session
                    $this->load->view('file', array('error' => ' ')); //if user already logined show upload page
                }
            } else {
                redirect(base_url().'index.php?/login'); //if user already logined direct user to home page
            }
        } else {
            $this->load->view('file', array('error' => ' ')); //if user already logined show login page
        }
        $this->load->view('template/footer');
    }

    public function uploadFile()
    {
        $this->load->model('file_model');

        // username can be changed, so get user id as the user upload folder.
        $username = '';
        if ($this->session->userdata('username')) {
            $username = $this->session->userdata('username');
        } else if (get_cookie('username')) {
            $username = get_cookie('username');
        } else {
            $this->index();
        }
        $userinfo = $this->user_model->get_userinfo($username);
        $userid = $userinfo[0]['id'];
        

        $title = $this->input->post('title');
        $description = $this->input->post('description');

        // multiple files upload
        $file_count = count($_FILES['userfiles']['name']);
        $success = 0;
        $fail = 0;
        for($i = 0; $i < $file_count; $i++) {
            $_FILES['userfile']['name'] = $_FILES['userfiles']['name'][$i];
            $_FILES['userfile']['type'] = $_FILES['userfiles']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['userfiles']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $_FILES['userfiles']['error'][$i];
            $_FILES['userfile']['size'] = $_FILES['userfiles']['size'][$i];

            if ($this->upload_config($userid, $title) != false) {
                $this->file_model->upload($this->upload->data('file_name'), $this->upload->data('full_path'), $this->session->userdata('username'), $userid, $_FILES['userfile']['type'], $title, $description);
                $success++;
            } else {
                $fail++;
            }

        }
        $this->session->set_flashdata('upload_result', $success. ' files upload successfully, '.$fail.' files upload failed. '.$this->upload->display_errors());
        redirect(base_url().'index.php?/upload');
        
    }

    public function upload_config($userid, $title) {
        $config['upload_path'] = './uploads/' . $userid . '/' . $title;
        $config['allowed_types'] = 'jpg|mp4|mkv|pdf';
        $config['max_size'] = 8000000000; 
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // make directory if it did not exist.
        if (!is_dir('./uploads/' . $userid . '/' . $title)) {
            mkdir('./uploads/' . $userid . '/' . $title, 0777, true); // 0777 allow the folder to be written, true allows recursive.
        }

        if (!$this->upload->do_upload('userfile')) {
            return false;
        } else {
            return $this->upload->data('file_name');
        }
    }
 
}
