<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $username = $this->session->userdata('username');
            $result = $this->user_model->get_userinfo($username);
            if (count($result) == 1) {
                $email = $result[0]['email'];
            } else {
                $this->session->set_flashdata('info not found', 'Info not found');
                redirect(base_url().'index.php?/login');
            }

            $data = array(
                'username' => $username,
                'email' => $email,
            );

            $wishlist = $this->file_model->getWishlist($username);
            $data['allWishlist'] = $wishlist;

        } else {
            $this->session->set_flashdata('profile_no_login', 'You are not logged in, please login.');
            redirect(base_url().'index.php?/login');
        }
        $this->load->view('template/header');
        $this->load->view('profile', $data);
        $this->load->view('template/footer');
    }

    public function edit_profile()
    {
        $old_username = $this->session->userdata('username');
        $data['info'] = $this->user_model->get_userinfo($old_username);
        $old_email = $data['info'][0]['email'];
        $this->load->view('template/header');
        $this->load->view('edit_profile', $data);
        $this->load->view('template/footer');
    }

    public function update_info()
    {
        $old_username = $this->session->userdata('username');
        $userinfo = $this->user_model->get_userinfo($old_username);
        $old_email = $userinfo[0]['email'];
        $new_username = $this->input->post('username');
        $new_email = $this->input->post('email');
        if ($new_username != $old_username && $new_email == $old_email) {
            $this->form_validation->set_rules(
                'username',
                'Username',
                'required|max_length[25]|is_unique[users.username]'
            );
            if ($this->form_validation->run() == FALSE) {
                // validation fail
                $this->index();
            } else {
                $new_userinfo['username'] = $new_username;
                $result = $this->user_model->update_userinfo($old_username, $new_userinfo);
                if ($result == TRUE) {
                    // update successfully
                    $user_data = array(
                        'username' => $new_username
                    );
                    $this->session->set_userdata($user_data);

                    redirect(base_url().'index.php?/profile');
                } else {
                    // update failed
                    $this->session->set_flashdata('profile-message', 'Something went wrong, please try again.');
                    redirect(base_url().'index.php?/profile');
                }
            }
        } else if ($new_email != $old_email && $new_username == $old_username) {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|valid_email|is_unique[users.email]'
            );
            if ($this->form_validation->run() == FALSE) {
                // validation fail
                $this->index();
            } else {
                $new_userinfo['email'] = $new_email;
                $new_userinfo['verified'] = 0;
                $result = $this->user_model->update_userinfo($old_username, $new_userinfo);
                if ($result == TRUE) {
                    // update successfully
                    $user_data = array(
                        'email' => $new_email
                    );
                    $this->session->set_userdata($user_data);

                    redirect(base_url().'index.php?/profile');
                } else {
                    // update failed
                    $this->session->set_flashdata('profile-message', 'Something went wrong, please try again.');
                    redirect(base_url().'index.php?/profile');
                }
            }
        } else if ($new_email != $old_email && $new_username != $old_username) {
            $this->form_validation->set_rules(
                'username',
                'Username',
                'required|max_length[25]|is_unique[users.username]'
            );
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|valid_email|is_unique[users.email]'
            );
            if ($this->form_validation->run() == FALSE) {
                // validation fail
                $this->index();
            } else {
                $new_userinfo['email'] = $new_email;
                $new_userinfo['username'] = $new_username;
                $new_userinfo['verified'] = 0;
                $result = $this->user_model->update_userinfo($old_username, $new_userinfo);
                if ($result == TRUE) {
                    // update successfully
                    $user_data = array(
                        'email' => $new_email,
                        'username' => $new_username
                    );
                    $this->session->set_userdata($user_data);

                    redirect(base_url().'index.php?/profile');
                } else {
                    // update failed
                    $this->session->set_flashdata('profile-message', 'Something went wrong, please try again.');
                    redirect(base_url().'index.php?/profile');
                }
            }
        } else {
            redirect(base_url().'index.php?/profile');
        }
    }

    public function addToWishlist()
    {
        $product_id = $this->input->post('product_id');
        $data['username'] = $this->input->post('username');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $result = $this->file_model->addWishlist($data);
        if ($result != false) {
            echo 'success';
        } else {
            echo 'error, try it again please';
        }
    }

    public function getWishlist()
    {
        $username = $this->input->post('username');
        $data = $this->file_model->getWishlist($username);
        if (!$data == null) {
            echo json_encode($data->result());
        } else {
            echo  "";
        }
    }

    public function deleteWishlist() {
        $title = $this->input->post('title');
        $username = $this->input->post('username');
        $result = $this->file_model->delete($username, $title);
        if ($result) {
            echo 'success';
        } else {
            echo 'try again';
        }
    }
}
