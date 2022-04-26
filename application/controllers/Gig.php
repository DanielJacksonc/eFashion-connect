<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gig extends CI_Controller{

	function __construct(){
		parent::__construct();
        $this->load->Model('Gig_model');
	}

    public function index( $id = FALSE ){

		$gigs = $this->Seller_model->get_all_gig();
		$profile = $this->Seller_model->get_profile_details();

		$this->load->view('seller/Header');
		$this->load->view('seller/Profile' , ["gigs" => $gigs , "profile"=> $profile[0] ] );
		$this->load->view('seller/Footer');

    }

    public function details( $id = FALSE ) {

        if ( $id == FALSE ){
            echo "No Gig Id Provided";
        }

		$gig_details = $this->Gig_model->get_gig_details( $id );

        if ( $gig_details == -1 ) {
            echo "No Gig Found!";
        }
        else if ( $gig_details == -2 || $gig_details == -3 || $gig_details == -4 ) {
            echo "Internal Problem";
        }
        else {
            $this->load->view('header_view');
            $this->load->view('gig/gig_view' , ['gig' => $gig_details[0] , 'user' => $gig_details[1] , 'profile' => $gig_details[2] ] );
            $this->load->view('footer_view');

        }

        
	}

    // public function gig( $id ) {
        
    //     $gig = $this->Seller_model->get_gig_by_id( $id );
    //     $profile = $this->Seller_model->get_profile_details_by_id($id);

    //     $user = $this->Public_model->get_user_data_by_id( $id );

    //     $this->load->view('customer/public/gig' , ['gig' => $gig[0] , 'profile' => $profile[0] , 'user' => $user[0] ]);

    // }

    public function profile( $user_name ) {
        $gigs = $this->Public_model->get_all_gig( $user_name );
        $profile = $this->Public_model->get_profile_details($user_name);

        $this->load->view('customer/public/profile' , ["gigs" => $gigs , "profile"=> $profile[0] ] );
    }

    
	

}

?>