
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Buyer_model extends CI_model {

    function __construct(){
        parent::__construct();
    }

    public $result;

    public function upload_new_post( $post_array ) {
        return $this->db->insert( 'job_post' , $post_array );
    }

    public function get_all_posts() {

        $this->db->select('*');
        $this->db->where('author_id', $_SESSION['account_id'] );
        $this->result = $this->db->get('job_post');

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


    public function get_offers_by_job_id( $id ) {

        $this->db->select('*');
        $this->db->where( ['job_id =' => $id , 'owner_id =' => $_SESSION['account_id'] ] );
        $this->result = $this->db->get('send_offers');
        $offers = $this->result->result_array();

        $buyer_images = [];
        foreach( $offers as $offer ) {

            $this->db->select('avtar');
            $this->db->where( 'user_name' , $offer['seller_uname'] );
            $this->result = $this->db->get('user');
            $avtar = $this->result->result_array();
            $buyer_images = array_merge( $buyer_images , [ $offer['offer_id'] => $avtar[0]['avtar'] ]  );

        }

        return [$offers , $buyer_images];


    }

    public function get_job_by_job_id( $id ) {
        $this->db->select('*');
        $this->db->where( ['job_id =' => $id , 'author_id =' => $_SESSION['account_id'] ] );
        $this->result = $this->db->get('job_post');
        return $this->result->result_array();
    }

    public function offer_send_msg( $data ) {


        $sender_name = $_SESSION['user_name'];

        $msg_array = [
            'time' => date('y-m-d h:i:s'),
            'sender_name' => $_SESSION['user_name'],
            'receiver_name' => $data['r_u_name'],
            'file' => $data['file'],
            'file_name' => $data['file_name'],
            'message' => $data['msg']

        ];

        return $this->db->insert( 'messages' , $msg_array );
    }


    public function get_custom_order_request() {
        $this->db->select('*');
        $this->db->where( ['status =' => 'running' , 'buyer_id =' => $_SESSION['user_name'] ]  );
        $this->result = $this->db->get('temp_order');
        return $this->result->result_array();
    }


    public function create_a_order( $data ) {


        if ( $data['state'] == 'accept' ) {
            // Check Personal Balance 
            $balance = $this->get_personal_balance();

            $price = $this->get_temp_order_price( $data['order_id'] );

            if ( $balance[0] >= $price ) {

                $this->db->select('*');
                $this->db->where( ['order_id =' => $data['order_id'] , 'buyer_id =' => $_SESSION['user_name'] ]  );
                $this->result = $this->db->get('temp_order');
                $temp_array = $this->result->result_array();

                if (empty($temp_array)){
                    return [ 0 , 'No Order Request Found'];
                }

                $temp_array = $temp_array[0];

                $order_array = [
                    'order_id' => substr(md5(microtime()), rand(0,25), 10),
                    'buyer_id' => $_SESSION['user_name'],
                    'seller_id' => $temp_array['seller_id'],
                    'gig_id' => $temp_array['gig_id'],
                    'des' => $temp_array['des'],
                    'amount' => $temp_array['amount'],
                    'd_date' => $temp_array['d_date'],
                    'status' => 'a',
                    'created_at' => date('y-m-d h:i:s')
                ];

                $flag = $this->db->insert( 'order' , $order_array );

                if ( $flag ) {
                    $this->db->where('order_id', $data['order_id']);
                    $this->db->update( 'temp_order' , ['status' => 'accepted']);

                    // Deduct Personal balacne
                    $update_bal['personal_bal'] = $balance[0] - $price;
                    $update_bal['expense'] = $balance[1] + $price;

                    $this->db->where('account_id', $_SESSION['account_id'] );
                    $this->db->update('account', $update_bal );

                    // Update The Post As Hired
                    

                    return [1 , 'accepted' , 'Successfully Accepted the order'];
                }

            }
            else {
                return [0 , 'Insufficient Balance'];
            }

        }

        else {
            $this->db->where('order_id', $data['order_id']);
            $this->db->update( 'temp_order' , ['status' => 'rejected']);
            return [1 , 'rejected' , 'Successfully Rejected the order'];
        }

        
    }


    protected function get_personal_balance() {

        $this->db->select('personal_bal , expense');
        $this->db->where('account_id', $_SESSION['account_id'] );
        $this->result = $this->db->get('account');
        $balance = $this->result->result_array();
        return [ floatval( $balance[0]['personal_bal'] ) , floatval( $balance[0]['expense'] ) ];
    }

    protected function get_temp_order_price( $order_id ) {

        $this->db->select('amount');
        $this->db->where( ['order_id =' => $order_id , 'buyer_id =' => $_SESSION['user_name'] ] );
        $this->result = $this->db->get('temp_order');
        $balance = $this->result->result_array();
        return floatval($balance[0]['amount']);
    }


    public function get_orders( $status ) {
        $this->db->select('*');
        $this->db->where( ['buyer_id =' => $_SESSION['user_name'] , 'status =' => $status ]  );
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


    public function get_order_by_order_id( $order_id ) {

        $this->db->select('*');
        $this->db->where( [ 'buyer_id =' => $_SESSION['user_name'] , 'order_id =' => $order_id ]  );
        $this->db->order_by('created_at', 'DESC');
        $this->result = $this->db->get('delivaries');
        $delivaries = $this->result->result_array();


        $this->db->select('*');
        $this->db->where( [ 'buyer_id =' => $_SESSION['user_name'] , 'order_id =' => $order_id ]  );
        $this->result = $this->db->get('order');
        $order = $this->result->result_array();

        if ( $order ) {

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



    public function change_order( $order_id , $s ) {

        $this->db->where( ['buyer_id =' => $_SESSION['user_name'] , 'order_id =' => $order_id ] );
        $update = $this->db->update('order', ['status' => $s ]);

        if ( $update && $s == 'c' ) {
            
            // Get Seller User Name
            $this->db->select('seller_id, amount');
            $this->db->where( [ 'order_id =' => $order_id , 'buyer_id =' => $_SESSION['user_name'] ] );
            $this->result = $this->db->get('order');
            $order = $this->result->result_array();
            $user_name = $order[0]['seller_id'];
            
            // Get Seller Account Id
            $this->db->select('account_id');
            $this->db->where( 'user_name' , $user_name );
            $this->result = $this->db->get('user');
            $account_id = $this->result->result_array();
            $account_id = $account_id[0]['account_id'];

            
            // Update Seller Personal Balance
            $this->db->select('net_bal , personal_bal, earnings');
            $this->db->where('account_id', $account_id );
            $this->result = $this->db->get('account');
            $balance = $this->result->result_array();
            $balance = $balance[0];
            $balance['net_bal'] = $balance['net_bal'] + floatval($order[0]['amount']);
            $balance['personal_bal'] = $balance['personal_bal'] + floatval($order[0]['amount']);
            $balance['earnings'] = $balance['earnings'] + floatval($order[0]['amount']);

            $this->db->where( ['account_id =' => $account_id] );
            $update = $this->db->update('account', $balance );


            return [ 1 , ' Successfully Release Funds !!'];

        }
        else if ( $update ){
            return [ 1 , ' Successfully Complete The order !!'];
        }
        else {
            return [ 0 , ' Something Error !!'];
        }

        

    }

    

    
}

?>