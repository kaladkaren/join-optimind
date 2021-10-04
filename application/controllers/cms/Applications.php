<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applications extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/application_model');
  }

  public function unprocessed()
  {
    $res = $this->application_model->allUnprocessed();
    $data['total_pages'] = $this->application_model->getTotalPages();

    $data['res'] = $res;
    $this->wrapper('cms/unprocessed', $data);
  }

  public function for_screening()
  {
    $res = $this->application_model->allUnprocessed();
    $data['total_pages'] = $this->application_model->getTotalPages();

    $data['res'] = $res;
    $this->wrapper('cms/for_screening', $data);
  }

  public function exams()
  {
    $res = $this->application_model->allUnprocessed();
    $data['total_pages'] = $this->application_model->getTotalPages();

    $data['res'] = $res;
    $this->wrapper('cms/exams', $data);
  }

  public function add()
  {
    if($this->application_model->add($this->input->post(null, true))){
      $this->session->set_flashdata('flash_msg', ['message' => 'User added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding user. Email already exists.', 'color' => 'red']);
    }
    $this->admin_redirect('cms');
  }

  public function update($id)
  {
    if($this->application_model->update($id, $this->input->post(null, true))){
      $this->session->set_flashdata('flash_msg', ['message' => 'User updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating user.', 'color' => 'red']);
    }
    $this->admin_redirect('cms');
  }

  public function delete()
  {
    if($this->application_model->delete($this->input->post('id', true))){
      $this->session->set_flashdata('flash_msg', ['message' => 'User disabled successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting user.', 'color' => 'red']);
    }
    $this->admin_redirect('cms');
  }

}
