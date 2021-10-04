<?php

class Exam_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'logical_exam'; # Replace these properties on children
    $this->upload_dir = 'uploads/exams/'; # Replace these properties on children
    $this->per_page = 15;
  }

  public function add($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function update($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }

  public function get_essay()
  {
    return $this->db->get('essay')->row();
  }

  public function updateEssay($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update('essay', $data);
  }

  public function get_logical_question()
  {
    return $this->db->get('logical_questions')->result();
  }
}
