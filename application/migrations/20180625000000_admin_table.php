<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_admin_table extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
        'unique' => TRUE,
      ),
      'role' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'password' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
    ));
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`deleted_at` datetime NULL DEFAULT");

    if($this->dbforge->create_table('admin'))
    {
      $table = 'admin';

      $data = array(
        'name' => 'Administrator Karen',
        'role' => 'admin',
        'email' => 'kmorales@myoptimind.com',
        'password' => password_hash('password', PASSWORD_DEFAULT)
      );
      $this->db->insert($table, $data);
    }
  }

  public function down()
  {
    $this->dbforge->drop_table('admin', true);
  }
}
