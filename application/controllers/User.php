<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}

    $this->load->model(array('user_model'));
  }

  public function index(){
    redirect('/');
  }

  public function list_data(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Users',
      'sub_header_title' => 'List of Users'
    );
    $this->backend_render(PATH_BACKEND.'user/list', $data);
  }

  public function add_data(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Users',
      'sub_header_title' => 'Tambah User'
    );
    $this->backend_render(PATH_BACKEND.'user/form', $data);
  }

  public function edit_data($id = NULL){
    $data = array(
      'header_title'      => '<i class="fa fa-users"></i> Users',
      'sub_header_title'  => 'Edit User',
      'set'               => $this->user_model->get_data_by_id($id)
    );
    $this->backend_render(PATH_BACKEND.'user/form', $data);
  }

  public function edit_profile(){
    $id = $this->session->userdata('userid');

    $data = array(
      'header_title'      => '<i class="fa fa-users"></i> Users',
      'sub_header_title'  => 'Edit User',
      'set'               => $this->user_model->get_data_by_id($id)
    );
    $this->backend_render(PATH_BACKEND.'user/form', $data);
  }
  public function get_list_data($level = "all", $status = "all"){
    $this->load->library('Datatables');
    $this->datatables->select('user_id, user_username, user_fullname, user_status, REPLACE(REPLACE(REPLACE(REPLACE(`user_level`,"0","<span class=\"text-danger\">'.strtoupper(LEVEL_0).'</span>"), "1", "<span class=\"text-success\">'.strtoupper(LEVEL_1).'</span>"), "2", "<span class=\"text-primary\">'.strtoupper(LEVEL_2).'</span>"), "3", "<span class=\"text-purple\">'.strtoupper(LEVEL_3).'</span>") AS user_level, user_avatar, user_created');
    if($level != "all"){
      $this->datatables->where('user_level', $level);
    }
    if($status != "all"){
      $this->datatables->where('user_status', $status);
    }
    if($this->session->userdata('userlevel') != "0"){
      $this->datatables->where('user_level !=', '0');
    }
    $this->datatables->from('tb_user');
    echo $this->datatables->generate();
  }

  public function save_data(){
    $id = $this->input->post('id', TRUE);

    if($id === "0"){
				$this->form_validation->set_rules('inputPassword', 'Password', 'trim|required|xss_clean|max_length[10]');
				$this->form_validation->set_rules('inputUsername', 'Username', 'trim|required|xss_clean|max_length[10]|is_unique[tb_user.user_username]');
		}
		else{
			$this->form_validation->set_rules('inputPassword', 'Password', 'trim|xss_clean|max_length[10]');
			$this->form_validation->set_rules('inputUsername', 'Username', 'trim|required|xss_clean|max_length[10]');
		}
		$this->form_validation->set_rules('inputFullName', 'Nama Lengkap', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('inputStatus', 'Status User', 'trim|xss_clean');
		$this->form_validation->set_rules('inputLevel', 'Level User', 'trim|xss_clean');

		if($this->form_validation->run() == FALSE){
				//gagal validasi
			$this->add_data();
		}
		else{
      $password = $this->input->post('inputPassword', TRUE);
      $data = array(
        'user_fullname'   => $this->input->post('inputFullName', TRUE),
        'user_username'   => $this->input->post('inputUsername', TRUE),
        'user_level'      => $this->input->post('inputLevel', TRUE),
        'user_status'      => $this->input->post('inputStatus', TRUE),
      );

      if($id == "0"){
				$data['user_password'] = $this->encryption_password($password);
        $data['user_created'] = date('Y-m-d H:i:s');
			}
			else{
				if(!empty($password)){
					$data['user_password'] = $this->encryption_password($password);
				}
			}

      //upload gambar
			if(empty($_FILES['input_gambar']['name'])){
				//tidak ada
				if($id == "0"){
						$data['user_avatar']    = "no-photo.jpg";
				}
			}
			else{
				//gambar ada
				if($id != "0"){
					$avatar = $this->input->post('gambar', TRUE);
					if($avatar != 'no-photo.jpg'){
							unlink(IMAGES_USER.$avatar);
					}
				}
        $name = time()."_".$data['user_username'];
				$result = $this->avatar_upload($name);

				if($result){
					//berhasil upload
					$data['user_avatar'] = $result['file_name'];
				}
				else{
					//gagal
					$this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_UPLOAD);
					redirect('dashboard/user/add');
				}
			}

      if($id == "0"){
					$this->user_model->save($data);
			}
			else{
				$this->user_model->update($data, $id);
			}

			$this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);

			if(!empty($this->input->post('profile', TRUE))){
					redirect('dashboard');
			}
			redirect('dashboard/user/list');
    }//end validation
  }//end save_data

  public function delete_data($id = NULL, $gambar = "no-photo.jpg"){

    if(file_exists(FCPATH.IMAGES_USER.$gambar)){
      if($gambar != 'no-photo.jpg'){
  				unlink(IMAGES_USER.$gambar);
  		}
    }
    $user = $this->user_model->get_data_by_id($id);
		$result = $this->user_model->delete($id);

		if($result){
			$this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
			redirect('dashboard/user/list');
		}
		else{
			$this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
			redirect('dashboard/user/list');
		}

	}

  //function avatar upload image
	public function avatar_upload($name = NULL){

			$config['upload_path']  = IMAGES_USER;
			$config['allowed_types']= 'jpg|jpeg|png|gif|bmp';
			$config['max_size']     = '1000'; //1mb
			$config['overwrite']    = TRUE;
			if($name != NULL ){
					$config['file_name']    = $name;
			}

			$this->load->library('upload', $config);

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('input_gambar')){ //jika upload gagal
					return FALSE;
			}
			else
			{ //jika upload berhasil
					//return TRUE;
					return $this->upload->data();
			}
	}

}
