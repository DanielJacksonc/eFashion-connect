<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gig_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function get_gig_details( $id ) {

        // Get Gig Details
        $this->db->select('*');
        $this->db->where('gig_id', $id );
        $this->result = $this->db->get('gig');
        $gig = $this->result->result_array();
        if ( empty ( $gig ) ) {
            return -1;
        }else {
            $gig = $gig[0];
        }

        // Get User Details
        $this->db->select('*');
        $this->db->where('account_id', $gig['owner_id'] );
        $this->result = $this->db->get('user');
        $user = $this->result->result_array();
        if ( empty($gig) ) {
            return -2;
        }
        else {
            $user = $user[0];
        }

        // Get Profile ID
        $this->db->select('profile_id');
        $this->db->where('account_id', $gig['owner_id'] );
        $this->result = $this->db->get('account');
        $profile = $this->result->result_array();

        if ( empty ( $profile ) ) {
            return -3;
        }else {
            $profile = $profile[0];
        }


        // Get Profile Details
        $profile_id = $profile['profile_id'];
        $this->db->select('*');
        $this->db->where('profile_id', $profile_id );
        $this->result = $this->db->get('profile');
        $profile =  $this->result->result_array();
        if ( empty($profile) ) {
            return -4;
        }
        else {
            $profile = $profile[0];
        }

        return [ $gig , $user, $profile ];

    }

}