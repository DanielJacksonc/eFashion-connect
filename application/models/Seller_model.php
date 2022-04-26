
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Seller_model extends CI_model {

    function __construct(){
        parent::__construct();
        // $this->db->where("your_id !=",$your_id);
    }

    public $result;


    public function upload_new_gig( $gig_array ) {
        return $this->db->insert( 'gig' , $gig_array );
    }

    public function get_all_gig() {

        $this->db->select('*');
        $this->db->where('owner_id', $_SESSION['account_id'] );
        $this->result = $this->db->get('gig');

        return $this->result->result_array();
    }

    public function get_profile_details(){

        $this->db->select('profile_id');
        $this->db->where('account_id', $_SESSION['account_id'] );
        $this->result = $this->db->get('account');
        $this->result = $this->result->result_array();

        if ( !empty( $this->result ) ){

            $profile_id = $this->result[0]['profile_id'];

            $this->db->select('*');
            $this->db->where('profile_id', $profile_id );
            $this->result = $this->db->get('profile');
            return $this->result->result_array();
        }
    }


    public function update_settings( $data ) {

        $this->db->select('profile_id');
        $this->db->where('account_id', $_SESSION['account_id'] );
        $this->result = $this->db->get('account');
        $this->result = $this->result->result_array();

        if ( !empty( $this->result ) ){

            $profile_id = $this->result[0]['profile_id'];

            $this->db->where('profile_id', $profile_id);
            $this->db->update('profile', $data);


            $this->db->where('account_id', $_SESSION['account_id']);
            $this->db->update('user', ['avtar'=> $data['avtar']]);

            return 1;

        }
        return 0;
    }

    public function get_gig_by_id( $gig_id ) {

        $this->db->select('*');
        $this->db->where('gig_id', $gig_id );
        $this->result = $this->db->get('gig');
        return $this->result->result_array();
    }

    public function get_user_data() {
        $this->db->select('*');
        $this->db->where('user_id', $_SESSION['user_id'] );
        $this->result = $this->db->get('user');
        return $this->result->result_array();
    }


    public function get_buyer_requests( $status ) {
        
        $this->db->select('*');
        $this->db->where('hired', '0' );
        $this->result = $this->db->get('job_post');
        $jobs =  $this->result->result_array();

        $buyer_images = [];
        foreach( $jobs as $job ) {

            $this->db->select('avtar');
            $this->db->where( 'account_id' , $job['author_id'] );
            $this->result = $this->db->get('user');
            $avtar = $this->result->result_array();
            $buyer_images = array_merge( $buyer_images , [ $job['job_id'] => $avtar[0]['avtar'] ]  );

        }
        return [ $jobs , $buyer_images ];
        

    }

    public function send_offer_request( $offer_array ) {

        // Get Offer Count
        $this->db->select('offered , author_id');
        $this->db->where('job_id', $offer_array['job_id'] );
        $this->result = $this->db->get('job_post');
        $job_data = $this->result->result_array();


        if ( !empty( $job_data ) ) {

            $count = (int) $job_data[0]['offered'];
            $count = $count + 1;
            $this->db->where('job_id', $offer_array['job_id'] );
            $this->db->update('job_post', ['offered' => $count] );

            $offer_array['owner_id'] = $job_data[0]['author_id'];

            return $this->db->insert( 'send_offers' , $offer_array );
            
        }
        else {
            return 0;
        }
        
    }

    public function get_sended_offers() {
        $this->db->select('job_id');
        $this->db->where('seller_uname', $_SESSION['user_name'] );
        $this->result = $this->db->get('send_offers');
        return $this->result->result_array();

    }

    public function get_full_sended_offers() {
        $this->db->select('*');
        $this->db->where('seller_uname', $_SESSION['user_name'] );
        $this->result = $this->db->get('send_offers');
        return $this->result->result_array();
    }

    public function save_seller_custom_order_request($order_array) {
        return $this->db->insert( 'temp_order' , $order_array );
    }







    public function get_orders( $status ) {
        $this->db->select('*');
        $this->db->where( ['seller_id =' => $_SESSION['user_name'] , 'status =' => $status ]  );
        $this->result = $this->db->get('order');
        $orders = $this->result->result_array();

        $seller_images = [];
        $gig_title = [];

        if ( ! empty($orders) ) {

             // Get Seller Images
             // Get Gig Title

             foreach ( $orders as $order ) {

                $this->db->select('avtar');
                $this->db->where( 'user_name' , $order['seller_id'] );
                $this->result = $this->db->get('user');
                $avtar = $this->result->result_array();
                $seller_images = array_merge( $seller_images , [ $order['seller_id'] => $avtar[0]['avtar'] ]  );


                // Gig Title
                $this->db->select('title');
                $this->db->where( 'gig_id' , $order['gig_id'] );
                $this->result = $this->db->get('gig');
                $title = $this->result->result_array();
                $gig_title = array_merge( $gig_title , [ $order['gig_id'] => $title[0]['title'] ]  );

             }

             $final = [ 'orders' => $orders , 'images' => $seller_images , 'title' => $gig_title  ];
            return $final;

        }
        else {
            return [ 'orders' => [] , 'images' => [] , 'title' => []  ];
        }
    }




    public function save_delivar_data( $d_array ) {

        // Get Buyer Id from order_id
        $this->db->select('buyer_id');
        $this->db->where( [ 'order_id' => $d_array['order_id'] ,  'seller_id' => $_SESSION['user_name'] ] );
        $this->result = $this->db->get('order');
        $buyer_id = $this->result->result_array();

        if ( ! empty($buyer_id) ) {
            $d_array['buyer_id'] = $buyer_id[0]['buyer_id'];
            $insert = $this->db->insert( 'delivaries' , $d_array );
            if ( $insert ) {
                return 1;
            }
        }
        else {
            return 0;
        }
        var_dump($d_array);
    }





    public function get_order_by_order_id( $order_id ) {

        $this->db->select('*');
        $this->db->where( [ 'seller_id =' => $_SESSION['user_name'] , 'order_id =' => $order_id ]  );
        $this->db->order_by('created_at', 'DESC');
        $this->result = $this->db->get('delivaries');
        $delivaries = $this->result->result_array();

        $this->db->select('*');
        $this->db->where( [ 'seller_id =' => $_SESSION['user_name'] , 'order_id =' => $order_id ]  );
        $this->result = $this->db->get('order');
        $order = $this->result->result_array();

        if ($order) {

            $seller_name = $order[0]['seller_id'];

            $this->db->select('avtar');
            $this->db->where( 'user_name' , $seller_name  );
            $this->result = $this->db->get('user');
            $user_name = $this->result->result_array();

            return ['img' => $user_name[0]['avtar'] , 'order' => $order[0] , 'delivaries' => $delivaries  ];

        }
        else {
            return ['img' => '' ,'order' => [] , 'delivaries' => []  ];
        }

    }



}

?>