<?php

class Positions_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'positions'; # Replace these properties on children
    $this->upload_dir = 'positions'; # Replace these properties on children
    $this->per_page = 15;
  }

  public function all()
  {
    $this->squery(['position_name']); # pass array for columns to check like
    $this->paginate();
    $this->filters();
    $this->db->order_by('position_name', 'asc');
    $res = $this->db->get('positions')->result();

    return $res;
  }

  public function add($data)
  {
    $data['is_technical'] = @$data['is_technical'] ? 1 : 0;
    $data['is_available'] = @$data['is_available'] ? 1 : 0;

    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function update($id, $data)
  {
    $data['is_technical'] = @$data['is_technical'] ? 1 : 0;
    $data['is_available'] = @$data['is_available'] ? 1 : 0;

    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }

  public function filters()
  {
    if (@$_GET['from']) {
      $this->db->where(''.$table.'.created_at >= "' . $_GET['from']. '"');
    }
    if (@$_GET['to']) {
      $this->db->where(''.$table.'.created_at <= "' . $_GET['to']. '"');
    }

    if (@$_GET['position_name']) {
      $this->db->where('positions.position_name LIKE "%' . $_GET['position_name']. '%" ');
    }
  }

}
