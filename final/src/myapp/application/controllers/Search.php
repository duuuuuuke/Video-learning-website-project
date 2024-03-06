<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{
  public function index()
  {
    $this->load->view('template/header');
    $this->load->view('search');
    $this->load->view('template/footer');
  }

  public function check()
  {
    $query = $this->input->post('search');
    $result = explode(":", $query);
    $productId = end($result);
    redirect(base_url().'index.php?/detail?productId=' . $productId);
  }
}
