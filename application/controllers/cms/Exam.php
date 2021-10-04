<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/exam_model');
  }

  public function essay()
  {
    $res = $this->exam_model->get_essay();

    $data['res'] = $res;
    $this->wrapper('cms/essay', $data);
  }

  public function logical()
  {
    $res = $this->exam_model->get_logical_question();
    $data['total_pages'] = $this->exam_model->getTotalPages();
    
    $data['res'] = $res;
    $this->wrapper('cms/logical', $data);
  }

  public function add()
  {
    if($this->exam_model->add($this->input->post(null, true))){
      $this->session->set_flashdata('flash_msg', ['message' => 'User added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding user. Email already exists.', 'color' => 'red']);
    }
    $this->admin_redirect('cms');
  }

  public function update($id)
  {
    if($this->exam_model->update($id, $this->input->post(null, true))){
      $this->session->set_flashdata('flash_msg', ['message' => 'User updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating user.', 'color' => 'red']);
    }
    $this->admin_redirect('cms');
  }

  public function delete()
  {
    if($this->exam_model->delete($this->input->post('id', true))){
      $this->session->set_flashdata('flash_msg', ['message' => 'User disabled successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting user.', 'color' => 'red']);
    }
    $this->admin_redirect('cms');
  }

  public function update_essay($id)
  {
    if($this->exam_model->updateEssay($id, $this->input->post(null, true))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Essay topic updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating essay topic.', 'color' => 'red']);
    }
    $this->admin_redirect('cms/exam/essay');
  }

}
