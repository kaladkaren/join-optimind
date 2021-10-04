<?php

class Application_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'applications'; # Replace these properties on children
    $this->upload_dir = 'uploads/applications/'; # Replace these properties on children
    $this->per_page = 15;

    $this->load->model('cms/applicants_model');
    $this->load->model('cms/email_model');
    $this->load->model('cms/positions_model');

  }

  public function all()
  {
    $this->squery(['fname']); # pass array for columns to check like
    $this->paginate();
    $this->filters();
    $res = $this->db->get('applications')->result();

    return $res;
  }

  public function addApplication($applicant_id, $position_id)
  {
    $data['applicant_id'] = $applicant_id;
    $data['position_id'] = $position_id;

    $this->db->insert('applications', $data);
    return $this->db->insert_id();

  }

  public function allUnprocessed()
  {
    $this->db->where('step1_status', 'pending');
    $res = $this->db->get('applications')->result();

    return $this->formatApplications($res); 
  }

  public function formatApplications($res)
  {
    $data = [];

    foreach ($res as $key => $value) {
      $value->position = $this->positions_model->get($value->position_id);
      $value->applicant = $this->applicants_model->get($value->applicant_id);

      $data[] = $value;
    }

    return $data;
  }

}