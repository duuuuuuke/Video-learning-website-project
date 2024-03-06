<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//put your code here 
class File_model extends CI_Model
{

    // upload file
    public function upload($filename, $path, $username, $userid, $type, $title, $description)
    {

        $data = array(
            'filename' => $filename,
            'path' => $path,
            'username' => $username,
            'userid' => $userid,
            'type' => $type,
            'title' => $title,
            'description' => $description
        );
        $query = $this->db->insert('files', $data);
    }

    function fetch_data($query)
    {
        if ($query == '') {
            return null;
        } else {
            $this->db->select("*");
            $this->db->from("files");
            $this->db->like('title', $query);
            $this->db->order_by('title', 'DESC');
            return $this->db->get();
        }
    }

    public function fetch_id($id)
    {
        if ($id == '') {
            return false;
        } else {
            $this->db->select("*");
            $this->db->from("files");
            $this->db->like('id', $id);
            return $this->db->get();
        }
    }

    public function fetch_all($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('files');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query;
    }

    public function addNewComment($data)
    {
        $this->db->insert('all_comments', $data);
        return $this->db->insert_id();
    }

    public function getAllComments($product_id)
    {
        $this->db->where('product_id', $product_id);
        return $this->db->get('all_comments');
    }

    public function getCommentByID($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('all_comments')->result_array();
    }

    public function addWishlist($data)
    {
        return $this->db->insert('wishlist', $data);
    }

    public function getWishlist($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('wishlist');
    }

    public function isAdded($username, $title)
    {
        $result = $this->db->query("SELECT title, username
        FROM wishlist
        WHERE username = '$username'
        AND title = '$title'");
        if (count($result->result_array()) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function fetchProductId($title)
    {
        $result = $this->db->query("SELECT id
        FROM files
        WHERE title = '$title'
        LIMIT 1");
        return $result;
    }

    public function delete($username, $title)
    {
        $this->db->where('username', $username);
        $this->db->where('title', $title);
        return $this->db->delete('wishlist');
    }
}
