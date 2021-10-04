<?php

class Email_model extends Admin_core_model
{

  function __construct()
  {
    parent::__construct();

    $this->load->library('email');
    $config_mail['protocol']= getenv('MAIL_PROTOCOL');
    $config_mail['smtp_host']= getenv('SMTP_HOST');
    $config_mail['smtp_port']= getenv('SMTP_PORT');
    $config_mail['smtp_timeout']='30';
    $config_mail['smtp_user']= getenv('SMTP_EMAIL');
    $config_mail['smtp_pass']= getenv('SMTP_PASS');
    $config_mail['charset']='utf-8';
    $config_mail['newline']="\r\n";
    $config_mail['wordwrap'] = TRUE;
    $config_mail['mailtype'] = 'html';
    $this->email->initialize($config_mail);

  }

  public function sendMail($from, $subject, $message)
  {
    $this->email->from($from, 'Join Optimind - Contact Us');
    $this->email->to('kmorales@myoptimind.com');
    $this->email->subject($subject);
    $this->email->message($message);
    return $this->email->send();
  }

  public function sendMailForgotPassword($to, $subject, $message)
  {
    $this->email->from('noreply@getapp.betaprojex.com', 'Join Optimind Sports');
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($message);
    return $this->email->send();
  }

  public function sendContactUs($contact_id)
  {
    $data = $this->contacts_model->get($contact_id);
    return $this->sendMail($data->email, $data->subject, $this->buildContactUsBody($data) );
  }
  
  public function buildContactUsBody($data)
  {
    $message = "<p>Name: {$data->name}</p>";
    $message .= "<p>Email Address: {$data->email}</p>";
    $message .= "<p>Subject: {$data->subject}</p><br>";

    $message .= "<p>Message: {$data->message}</p><br>";

    return $message;
  }

}
