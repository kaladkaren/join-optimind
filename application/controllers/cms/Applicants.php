<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicants extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->model('cms/applicants_model');
  }

  public function index()
  {
    $res = $this->applicants_model->all();
    $data['total_pages'] = $this->applicants_model->getTotalPages();
    $data['startingPK'] = $this->applicants_model->getStartingPK();

    $data['res'] = $res;
    return $this->wrapper('cms/users', $data);
  }

  public function delete()
  {
    if($this->applicants_model->delete($this->input->post('id', true))){
      $this->session->set_flashdata('flash_msg', ['message' => 'User deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting product.', 'color' => 'red']);
    }
    $this->admin_redirect('cms/users');
  }

  # user views
  public function register()
  {
    return $this->applicant_wrapper('applicant/register');
  }

  public function profile()
  {
    $res = $this->applicants_model->get($this->session->id);

    $data['res'] = $res;
    // var_dump($data); die();
    $this->applicant_wrapper('applicant/profile', $data);
  }

  public function about()
  {
    $this->applicant_wrapper('applicant/about-us');
  }

  public function contact()
  {
    $this->applicant_wrapper('applicant/contact-us');
  }

  public function store()
  { 
    $res = $this->products_model->all();

    $data['res'] = $res;
    $this->applicant_wrapper('applicant/store', $data);
  }

  public function cart()
  {
    $get_last_cart_id = $this->orders_model->getLastCart($this->session->id);

    $res = $this->orders_model->getCartItems($get_last_cart_id);
    $total = $this->orders_model->getCartItemsTotalPrice($get_last_cart_id);

    $data['res'] = $res;
    $data['total_price'] = $total;
    @$data['cart_id'] = $get_last_cart_id;
    // var_dump($data); die();
    $this->applicant_wrapper('applicant/cart', $data);
  }

  public function forgot_password()
  {
    $this->applicant_wrapper('applicant/forgot_password');
  }

  # end - user view

  public function login()
  {
    $this->applicant_wrapper('applicant/index');
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login');
    die();
  }

  public function add()
  {
    $check_email = $this->applicants_model->getEmail($this->input->post('email'));

    if($check_email) {
      $this->session->set_flashdata('flash_msg_err', ['message' => 'Your email already exist, try logging that email to proceed.', 'color' => 'red']);
    }else{

      $last_id = $this->applicants_model->add(array_merge($this->input->post(), $this->applicants_model->upload('resume')));

      if($last_id){
        $this->session->set_flashdata('flash_msg', ['message' => 'Successfully registered, login your account to see your application status.', 'color' => 'green']);

      } else {
        $this->session->set_flashdata('flash_msg_err', ['message' => 'Error adding applicant.', 'color' => 'red']);
      }
    }

    redirect('');
  }

  public function update($id)
  {
    if($this->applicants_model->update($id, array_merge($this->input->post(), $this->applicants_model->upload('resume')))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Profile updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating profile.', 'color' => 'red']);
    }
    redirect('/profile');
  }

  public function attempt_login() # attempt to login
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $res = $this->applicants_model->getByEmail($email);
    if($res && password_verify($password, $res->password)){
      $this->session->set_flashdata('login_msg', ['message' => 'Welcome Back '. $res->fname .' !', 'color' => 'green']);
      $this->session->set_userdata(['role' => 'user', 'id' => $res->id, 'fname' => $res->fname]);
      redirect('/profile');
    } else {
      $this->session->set_flashdata('login_msg', ['message' => 'Incorrect email or password', 'color' => 'red']);
      redirect('login');
    }

  }

  public function attempt_change_password()
  {
    $email = $this->input->post('email');
    $res = $this->applicants_model->forgotPassword($email);
    if($res){
      $this->session->set_flashdata('login_msg', ['message' => 'Password reset link was sent to ' . $email, 'color' => 'green']);
      redirect('/forgot_password');
    } else {
      $this->session->set_flashdata('login_msg', ['message' => 'No user found.', 'color' => 'red']);
      redirect('/forgot_password');
    }
  }

  public function reset_password($encrypted_email)
  {
    $data['email'] = base64_decode(urldecode($encrypted_email));
    if ($this->applicants_model->getByEmail($data['email'])) {
      # if contains @
      $this->load->view('applicant/reset_password', $data);
    } else {
      $this->load->view('applicant/reset_password_label', ['label' => 'Invalid change password token']);
    }
  }

  public function change_password()
  {
    $user = $this->applicants_model->getByEmail($this->input->post('email'));
    // var_dump($this->input->post()); die();
    $password = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
    $this->db->set('password', $password);
    $this->db->where('email', $this->input->post('email'));
    $this->db->update('user');

    if ($this->db->error()){
      $this->load->view('applicant/reset_password_label', ['label' => 'Password reset successfully']);
    } else {
      $this->load->view('applicant/reset_password_label', ['label' => 'Failed to reset password']);
    }
    return;
  }


}
