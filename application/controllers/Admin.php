<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

	function __construct(){
		parent::__construct();
        $this->load->Model('Auth_model');
        $this->load->Model('Admin_model');

		if ( $this->Auth_model->is_user_authenticate() == 0 || $_SESSION['user_type'] != '1' || $_SESSION['priority'] != 'none'  ) {
            echo " Please Login First !!! ";
            redirect('');
        }
	}
    

    public function index() {
        $withdrawals = $this->Admin_model->get_panding_withdrawals();
        $this->load->view('admin/Header');
		$this->load->view('admin/Withdrawals' , ['withdrawals' => $withdrawals]);
		$this->load->view('admin/Footer');
    }


    public function a_withraw() {
        $data = $this->input->post();

        if ( isset($data) && isset($data['id']) && isset($data['msg']) ) {
            $data['status'] = 'Completed';
            $update = $this->Admin_model->update_withdrawals($data);
            if ($update) {
                echo json_encode([1]);
            }
            else {
                echo json_encode([0]);
            }
        }
    }

    public function r_withraw() {
        $data = $this->input->post();
        
        if ( isset($data) && isset($data['id']) && isset($data['msg']) ) {
            $data['status'] = 'Rejected';
            $update = $this->Admin_model->update_withdrawals($data);
            if ($update) {
                echo json_encode([1]);
            }
            else {
                echo json_encode([0]);
            }
        }
    }
}
