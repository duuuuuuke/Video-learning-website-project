<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//put your code here 
class Product_model extends CI_Model
{
    public function is_bought($username, $title)
    {
        $this->db->where('username', $username);
        $this->db->where('title', $title);
        $result = $this->db->get('purchased');
        if ($result->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function user_purchased($username, $title, $productId)
    {
        $data = array(
            'username' => $username,
            'title' => $title
        );
        if ($this->db->insert('purchased', $data)) {
            $this->db->where('id', $productId);
            return $this->db->get('files')->result_array();
        } else {
            return false;
        }
    }

    public function getLike($productId, $username)
    {
        $this->db->where('product_id', $productId);
        $this->db->where('username', $username);
        $result = $this->db->get('product_like');
        if ($result->num_rows() === 1) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function getLikeCount($productId)
    {
        $query = $this->db->query("SELECT COUNT(*) AS like_count 
        FROM product_like
        WHERE product_id = '$productId'");
        return $query->row()->like_count;
    }

    public function deleteLike($productId, $username) {
        $this->db->where('product_id', $productId);
        $this->db->where('username', $username);
        $result = $this->db->delete('product_like');
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public function addLike($productId, $username) {
        $data = array(
            'product_id' => $productId,
            'username' => $username
        );
        $result = $this->db->insert('product_like', $data);
        return $result;
    }
}
