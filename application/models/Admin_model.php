<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function get_panding_withdrawals() {
        $this->db->select('*');
        $this->db->where('status', 'Pending' );
        $this->db->order_by('created_at', 'ASC');
        $this->result = $this->db->get('withdrawals');
        return $this->result->result_array();
    }

    public function update_withdrawals($data) {

        $this->db->where('id', $data['id'] );
        return $this->db->update('withdrawals', $data );
    }

}