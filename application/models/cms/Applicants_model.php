<?php

class Applicants_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->table = 'applicants'; # Replace these properties on children
    $this->upload_dir = 'uploads/applicants/'; # Replace these properties on children
    $this->per_page = 15;

    $this->load->model('cms/email_model');
    $this->load->model('cms/application_model');

  }

  public function all()
  {
    $this->squery(['fname']); # pass array for columns to check like
    $this->paginate();
    $this->filters();
    $res = $this->db->get('applicants')->result();

    return $res;
  }

  public function filters()
  {
    if (@$_GET['from']) {
      $this->db->where('applicants.created_at >= "' . $_GET['from']. '"');
    }
    if (@$_GET['to']) {
      $this->db->where('applicants.created_at <= "' . $_GET['to']. '"');
    }

    if (@$_GET['fname']) {
      $this->db->where('applicants.fname LIKE "%' . $_GET['fname']. '%" ');
    }

    if (@$_GET['lname']) {
      $this->db->where('applicants.lname LIKE "%' . $_GET['lname']. '%" ');
    }

  }

  public function get($id)
  {
    $this->db->where('id', $id);
    $res = $this->db->get('applicants')->row();
    unset($res->password);

    return $this->formatUser($res);
  }

  public function formatUser($data)
  {
    $data->fullname = $data->fname . ' ' . $data->lname;
    $data->profile_path = base_url('uploads/applicants/') . $data->resume;

    return $data;
  }

  public function getStartingPK()
  {
    $startingPK = 1;
    $page = $this->input->get('page') ?: 1;

    if ($page == 1) {
      $startingPK = 1;
    } else {
      $startingPK = ($page - 1) * $this->per_page + 1;
    }

    return $startingPK;
  }

  public function getTotalPages()
  {
    return ceil(count($this->db->get($this->table)->result()) / $this->per_page);
  }

  public function getEmail($email)
  {
    return $this->db->get_where($this->table, array('email' => $email))->row();
  }

  public function add($data)
  {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $this->db->insert('applicants', [
      'fname' => $data['fname'], 
      'lname' => $data['lname'],
      'email' => $data['email'],
      'mobile_num' => $data['mobile_num'],
      'year_graduated' => $data['year_graduated'],
      'years_experience' => $data['years_experience'],
      'resume' => $data['resume'],
      'password' => $data['password']
    ]);
    $last_id = $this->db->insert_id();

    $this->application_model->addApplication($last_id, $data['position_id']);

    return $last_id;
  }

  public function upload($file_key)
  {
    @$file = $_FILES[$file_key];
    $upload_path = $this->upload_dir;

    $config['upload_path'] = $upload_path; # NOTE: Change your directory as needed
    $config['allowed_types'] = '*'; # NOTE: Change file types as needed
    $config['file_name'] = time() . '_' . $file['name']; # Set the new filename
    $this->upload->initialize($config);

    if (!is_dir($upload_path) && !mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true)){
      mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true); # You can set DEFAULT_FOLDER_PERMISSIONS constant in application/config/constants.php
    }
    if($this->upload->do_upload($file_key)){
      return [$file_key => $this->upload->data('file_name')];
    }else{
      return [];
    }
  }

  public function delete($id)
  {
    $res = $this->get($id);
    $email_del = $res->email . '_deleted';
    // softdelete
    $this->db->where('id', $id);
    return $this->db->update($this->table, ['email' => $email_del, 'deleted_at' => date('Y-m-d H:i:s')]);
  }

  public function recoverDeleted($id)
  {
    $res = $this->get($id);
    $email_del = substr($res->email, 0, -8);
    // softdelete
    $this->db->where('id', $id);
    return $this->db->update($this->table, ['email' => $email_del, 'deleted_at' => NULL ]);
  }

  public function update($id, $data)
  {
    if (!$data['password']) {
      unset($data['password']);
    } else {
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    if ($_FILES['resume']['size']) {
        $this->session->set_userdata('resume', base_url().  $this->upload_dir . $data['resume']);
    }
    $this->session->set_userdata('name', $data['name']);

    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }

  public function getByEmail($email)
  {
    return $this->db->get_where($this->table, array('email' => $email))->row();
  }

  function forgotPassword($email)
  {
    $applicants = $this->getByEmail($email);
    if (!$applicants) {
      return false;
    }
    // var_dump($applicants);
    // die();
    $html = $this->generatePasswordResetMessage($email, $applicants->fname);
    // var_dump($html); die();
    return $this->email_model->sendMailForgotPassword($email, 'Forgot Password - Join Optimind', $html);
  }

  public function generatePasswordResetMessage($email, $name = 'User')
  {
    $link = base_url('cms/users/reset_password/') . urlencode(base64_encode($email));
    $html = '<table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
            <tbody>
            <tr bgcolor="E16B4B"><td height="15"></td></tr>
            <tr bgcolor="E16B4B">

                <td align="center">
                    <table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="560">
                        <tbody><tr>
                            <td>
                                <table class="top-header-left" align="left" border="0" cellpadding="0" cellspacing="0">
                                    <tbody><tr>
                                        <td align="center">
                                            <table class="date" border="0" cellpadding="0" cellspacing="0">
                                                <tbody><tr>
                                                    <td style="color: #fff; font-size: 10px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">

                                                    Forgot Password

                                                    </td>
                                                    <td>&nbsp;&nbsp;</td>
                                                    <td style="color: #fefefe; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                                                        <singleline>
                                                        </singleline>

                                                    </td>
                                                </tr>
                                                </tbody></table>
                                        </td>
                                    </tr>
                                    </tbody></table>


                                <table class="top-header-right" align="left" border="0" cellpadding="0" cellspacing="0">

                                    <tbody><tr><td height="20" width="30"></td></tr>

                                    </tbody></table>

                                <table class="top-header-right" align="right" border="0" cellpadding="0" cellspacing="0">
                                    <tbody><tr>
                                        <td align="center">
                                            <table class="tel" align="center" border="0" cellpadding="0" cellspacing="0">
                                                <tbody><tr>
                                                    <td style="color: #fff; font-size: 10px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                                                     Join Optimind Sports
                                                    </td>
                                                    <td>&nbsp;&nbsp;</td>
                                                    <td style="color: #fefefe; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                                                        <singleline>
                                                        </singleline>
                                                    </td>
                                                </tr>
                                                </tbody></table>
                                        </td>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>
                        </tbody></table>
                </td>
            </tr>
            <tr bgcolor="E16B4B"><td height="10"></td></tr>

            </tbody>
        </table>

        <!--  end top header  -->


        <!-- main content -->
        <table class="container" align="center"  border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="ffffff">


        <!--Header-->
        <tbody>

        <!--section 1 -->
        <tr>
            <td>
                <table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="560" bgcolor="F1F2F7">
                    <tr >
                        <td>
                            <table class="mainContent" align="center" border="0" cellpadding="0" cellspacing="0" width="528">
                                <tbody><tr><td height="20"></td></tr>
                                <tr>
                                    <td>

                                        <table class="section-item" align="left" border="0" cellpadding="0" cellspacing="0" width="360">
                                            <tbody><tr>
                                                <td style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                                                    Forgot Password
                                                </td>
                                            </tr>
                                            <tr><td height="15"></td></tr>
                                            <tr>
                                                <td style="color: #a4a4a4; line-height: 25px; font-size: 12px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                                                    Howdy '.$name.'! If you are trying to reset your passsword, please click on the button below. Otherwise, please ignore this email.

                                                </td>
                                            </tr>
                                            <tr><td height="15"></td></tr>
                                            <tr>
                                                <td>
                                                    <a href="'.$link.'" style="background-color: #E16B4B; font-size: 12px; padding: 10px 15px; color: #fff; text-decoration: none">Reset Password</a>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>

                                <tr><td height="20"></td></tr>
                                </tbody></table>
                        </td>
                    </tr>

                    </table>
            </td>
        </tr>
        <!-- end section 1-->

        <!-- footer -->
        <table class="container" border="0" cellpadding="0" cellspacing="0" width="600">
            <tbody>
            <tr bgcolor="E16B4B"><td height="15"></td></tr>
            <tr bgcolor="E16B4B">
                <td  style="color: #fff; font-size: 10px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;" align="center">
                     Join Optimind Sports © Copyright 2020 . All Rights Reserved
                </td>
            </tr>
            <tr>
                <td bgcolor="E16B4B" height="14"></td>
            </tr>
            </tbody></table>';
    return $html;
  }

}
