<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Security');
    $this->Security->getsecurity();
    if ($this->cl->acl("cpanel/home")==false) {
      redirect("errors/er403");
    }
  }

  function index()
  {
    $this->layouts->set_title('home');
    $data['aku'] = "mpampam";
    $this->layouts->view('content/home/index',array(),$data);
  }


}
