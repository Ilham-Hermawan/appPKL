<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    show_404();
  }

  function backup_db(){
    $this->load->dbutil();
    $prefs = array(
      'format'      => 'zip',
      'filename'    => 'backup_db.sql'
    );

    $backup = $this->dbutil->backup($prefs);
    $this->load->helper('file');
    $filename = date('d-m-Y His').'-backup_db.zip';
    var_dump(write_file('backupdb/'.$filename, $backup));
  }

}
