<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public function fatch()
    {
        $this->load->model('file_model'); // load file_model 
        $output = '';
        $query = '';
        if ($this->input->get('query')) {
            $query = $this->input->get('query'); // get search query send from ajax search form
        }
        $data = $this->file_model->fetch_data($query); //send query to file_model and put result to $data
        if (!$data == null) {
            echo json_encode($data->result()); //send result back
        } else {
            echo  ""; // no result found
        }
    }

    public function scroll_fetch()
    {
        $output = '';
        $data = $this->file_model->fetch_all($this->input->post('limit'), $this->input->post('start'));
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
                <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="card-title">' . $row->title . '</h5>
                        <p class="card-text">' . $row->description . '</p>
                        <p class="card-text">' . 'ID: ' . $row->id . '</p>
                        <a href="' . base_url() . 'index.php?/detail?productId=' . $row->id . '" class="btn btn-primary">Detail</a>
                    </div>
                </div>
                ';
            }
        }
        echo $output;
    }

    public function addComment()
    {
        $data['product_id'] = $this->input->post('product_id');
        $data['username'] = $this->input->post('username');
        $data['comments'] = $this->input->post('comments');
        $data['date'] = date('Y-m-d H:i:s');
        $result = $this->file_model->addNewComment($data);
        if (is_integer($result)) {
            $newComment = $this->file_model->getCommentByID($result);
            if (count($newComment) === 1) {
                echo json_encode($newComment);
            } else {
                echo 'error, please try again';
            }
        } else {
            echo 'error, please try again';
        }
    }

}
