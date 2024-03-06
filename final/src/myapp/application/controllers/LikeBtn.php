<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LikeBtn extends CI_Controller
{
    public function handleLike()
    {
        $product_id = $this->input->post('product_id');
        $isLiked = $this->input->post('liked');
        $username = $this->input->post('username');
        if ($isLiked == 'true') {
            if ($this->product_model->deleteLike($product_id, $username)) {
                echo $this->product_model->getLikeCount($product_id);
            } else {
                echo 'error';
            }
        } else {
            if ($this->product_model->addLike($product_id, $username)) {
                echo $this->product_model->getLikeCount($product_id);
            } else {
                echo 'error';
            }
        }
    }
}
