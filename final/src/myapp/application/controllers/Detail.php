<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/header');

        $productId = $this->input->get('productId');
        $query = $this->file_model->fetch_id($productId);
        $result = $query->result();
        $product_username = '';
        $title = '';
        $description = '';
        $type = '';
        $path = '';
        $userid = '';
        $filename = '';
        foreach ($result as $row) {
            $product_username = $row->username;
            $title = $row->title;
            $description = $row->description;
            $type = $row->type;
            $path = $row->path;
            $userid = $row->userid;
            $filename = $row->filename;
        }

        $data = array(
            'product_username' => $product_username,
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'path' => $path,
            'userid' => $userid,
            'filename' => $filename,
            'productId' => $productId
        );

        if (!$this->session->userdata('logged_in')) //check if user already login
        {
            if (get_cookie('remember')) { // check if user activate the "remember me" feature  
                $username = get_cookie('username'); //get the username from cookie
                $password = get_cookie('password'); //get the username from cookie
                if ($this->user_model->login($username, $password)) //check username and password correct
                {
                    $user_data = array('username' => $username, 'logged_in' => true);
                    $this->session->set_userdata($user_data); //set user status to login in session
                    $this->load->view('detail'); //if user already logined show detail page
                }
            } else {
                redirect(base_url().'index.php?/login'); //if user already logined direct user to login page
            }
        } else {
            $username = $this->session->userdata('username');

            if ($username != $product_username && $this->product_model->is_bought($username, $title) == false) {
                // if the product in wishlist
                $isAdded = $this->file_model->isAdded($username, $title);
                if ($isAdded) {
                    $data['added'] = true;
                } else {
                    $data['added'] = false;
                }
                $this->load->view('pay', $data);
            } else {
                $isLiked = $this->product_model->getLike($productId, $username);
                $data['isLiked'] = $isLiked;
                $data['likeCount'] = $this->product_model->getLikeCount($productId);

                $allComments = $this->file_model->getAllComments($productId);
                $data['allComments'] = $allComments;
                $this->load->view('detail', $data);
            }
        }
        $this->load->view('template/footer');
    }

    public function paid()
    {
        $username = $this->input->get('username');
        $title = $this->input->get('title');
        $productId = $this->input->get('productId');
        $result = $this->product_model->user_purchased($username, $title, $productId);
        if ($result != false) {
            if ($this->file_model->isAdded($username, $title)) {
                $this->file_model->delete($username, $title);
            }
            redirect(base_url() . 'index.php?/detail?productId=' . $productId);
        } else {
            $this->session->set_flashdata('paid_result', 'Sorry, there are some error, please try again later!');
        }
    }

    public function getProductId()
    {
        $title = $this->input->get('title');
        $id = $this->file_model->fetchProductId($title);
        foreach ($id->result() as $row) {
            redirect(base_url()."index.php?/detail?productId=" . $row->id);
        }
    }
}
