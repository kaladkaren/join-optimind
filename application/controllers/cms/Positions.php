<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Positions extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/positions_model');
  }

  public function index()
  {
    $res = $this->positions_model->all();
    $data['total_pages'] = $this->positions_model->getTotalPages();

    $data['res'] = $res;
    $this->wrapper('cms/positions', $data);
  }

  public function add()
  {
    if($this->positions_model->add($this->input->post(null, true))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Position added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding position. Email already exists.', 'color' => 'red']);
    }
    $this->admin_redirect('cms/positions');
  }

  public function update($id)
  {
    if($this->positions_model->update($id, $this->input->post(null, true))){
      $this->session->set_flashdata('update_flash_msg', ['message' => 'Position updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('update_flash_msg', ['message' => 'Error updating position.', 'color' => 'red']);
    }
    $this->admin_redirect('cms/positions');
  }

  public function delete()
  {
    if($this->positions_model->delete($this->input->post('id', true))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Position disabled successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting position.', 'color' => 'red']);
    }
    $this->admin_redirect('cms/positions');
  }

}
