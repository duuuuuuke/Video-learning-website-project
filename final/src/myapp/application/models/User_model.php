<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//put your code here
class User_model extends CI_Model
{

    // Log in
    public function login($username, $password)
    {
        // Validate

        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                $hashed = $row->password;
                $is_verified = $row->verified;
            }

            if (password_verify($password, $hashed)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function add_new_user($new_user)
    {
        return $this->db->insert('users', $new_user); // return true on success, false on failure
    }

    public function verify_email($hash)
    {
        $username = $this->session->userdata('username');
        $this->db->select('email');
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {

            $result = $query->result();

            foreach ($result as $row) {
                $email = $row->email;
            }

            if ($hash == md5($email)) {
                $set_verified = $this->verify_account($email);
            } else {
                return false;
            }

            if ($set_verified == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function verify_account($email)
    {
        $data = array(
            'verified' => 1
        );

        $this->db->where('email', $email);
        return $this->db->update('users', $data);
    }

    public function get_userinfo($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('users')->result_array();
    }

    public function update_userinfo($old_username, $new_userinfo)
    {
        $this->db->where('username', $old_username);
        return $this->db->update('users', $new_userinfo);
    }

    public function updateToken($username, $data)
    {
        $this->db->where('username', $username);
        return $this->db->update('users', $data);
    }

    public function getToken($reset_token)
    {
        $this->db->where('reset_token', $reset_token);
        return $this->db->get('users')->result_array();
    }

    public function updatePassword($reset_token, $data)
    {
        $this->db->where('reset_token', $reset_token);
        return $this->db->update('users', $data);
    }
}
