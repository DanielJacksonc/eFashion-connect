<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B extends CI_Controller{

	function __construct(){
		parent::__construct();
        $this->load->Model('Auth_model');
        $this->load->Model('Buyer_model');
        $this->load->Model('Message_model');
        $this->load->Model('Paypal_model');


		if ( $this->Auth_model->is_user_authenticate() == 0 || $_SESSION['user_type'] != '2' || $_SESSION['priority'] != 'buyer'  ) {
            echo " Please Login First !!! ";
            redirect('');
        }
	}

    public function index(){

		$posts = $this->Buyer_model->get_all_posts();

		$profile = $this->Buyer_model->get_profile_details();

		$this->load->view('buyer/Header');
		$this->load->view('buyer/Profile' , ["posts" => $posts , "profile"=> $profile[0] ] );
		$this->load->view('buyer/Footer');

    }

    public function balance() {

        $balance = $this->Paypal_model->get_personal_balance();
        $transactions = $this->Paypal_model->get_latest_transactions();

        $this->load->view('buyer/Header');
		$this->load->view('buyer/Balance' , [ 'balance'=>$balance , 'transactions' => $transactions ] );
		$this->load->view('buyer/Footer');
    }

    public function add_balance() {

        $param = $this->input->get();
        if ( count($param) == 1 && isset($param['amount']) && is_numeric($param['amount']) && (int)$param['amount'] > 0 ) {

            $this->load->view('buyer/Header');
            $this->load->view('buyer/Add_balance' , [ 'amount'=> $param['amount'] ] );
            $this->load->view('buyer/Footer');
        }
        else {
            echo "Payment Method is not Varified";
        }
    }


    public function paypal_transaction_complete() {

        $data = $this->input->post();

        if ( isset($data['orderID']) ) {
            $callback = $this->Paypal_model->save_payment_info( $data['orderID'] );
            echo json_encode( $callback );
        }
        else {
            echo json_encode( [0 , 'No valid Payment Id found'] );
        }
    }



    public function orders_request() {

        $orders = $this->Buyer_model->get_custom_order_request();

        $this->load->view('buyer/Header');
		$this->load->view('buyer/Orders_request' , ['orders' => $orders ] );
		$this->load->view('buyer/Footer');
    }


    public function cumtom_order_submit(){
        $data = $this->input->post();

        if ( isset($data) && isset($data['order_id']) && isset($data['state']) ) {
            $result = $this->Buyer_model->create_a_order( $data );
            echo json_encode($result);
        }
    }


    public function orders( $status = 'active' ) {

        $orders = [];
        if ( $status == 'active' ) {
            // Get Active Orders
            $orders = $this->Buyer_model->get_orders('a');
            $orders['active'] = 'a';
        }
        else if ( $status == 'completed' ) {
            // Get Active Orders
            $orders = $this->Buyer_model->get_orders('c');
            $orders['active'] = 'c';
        }

        else if ( $status == 'waiting' ) {
            // Get Active Orders
            $orders = $this->Buyer_model->get_orders('w');
            $orders['active'] = 'w';
        }

        $this->load->view('buyer/Header');
		$this->load->view('buyer/Orders' , $orders );
		$this->load->view('buyer/Footer');
    }


    public function manage_order( $order_id ) {

        $order = $this->Buyer_model->get_order_by_order_id( $order_id );

        $this->load->view('buyer/Header');
		$this->load->view('buyer/Manage_order' , $order );
		$this->load->view('buyer/Footer');
    }


    public function complete_an_order() {
        $data = $this->input->post();

        if ( isset ($data) ) {
            $complete = $this->Buyer_model->change_order($data['order_id'] , 'w' );
            echo 1;

        }
    }
    

    public function release_a_fund() {
        $data = $this->input->post();

        if ( isset ($data) && isset($data['order_id']) ) {
            $callback = $this->Buyer_model->change_order($data['order_id'] , 'c' );
            echo json_encode($callback);
        }
        else {
            echo json_encode([0 , 'Request Error']);
        }
    }




























	public function new_job(){
		$this->load->view('buyer/Header');
		$this->load->view('buyer/Post_job');
		$this->load->view('buyer/Footer');
	}

	public function post_submit() {

		$data = $this->input->post();
		$file = $_FILES;

        if(isset($file) && isset($data)){

            if ( $data['post_des'] == '' || strlen( $data['post_des'] ) > 4999 ) {
                echo json_encode( [ 0 , "Description must be not Empty And Within 50000 Character !"] );
                return;
            }

			//File
			$file_name = $file['file']['name'];
			$file_tmpname = $file['file']['tmp_name'];
			$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$file_new_name = substr(md5(microtime()), rand(0,25), 8);
			$file_upload_name = $file_new_name.".".$extension;

            $file_upload = move_uploaded_file ($file_tmpname, "./resource/post_files/".$file_upload_name);

            if ( ! $file_upload ) {
                $file_upload_name = '';
            }

            $post_array = [

                'job_id' => substr(md5(microtime()), rand(0,25), 8),
                'category' => $data['category'],
                'des' => $data['post_des'],
                'file' => $file_upload_name,
                'price' => $data['price'],
                'd_date' => $data['d_date'],
                'offered' => 0,
                'hired' => '0',
                'created_at' => date('y-m-d h:i:s'),
                'author_id' => $_SESSION['account_id']
            ];

            $post = $this->Buyer_model->upload_new_post( $post_array );

            if ( $post ) {
                echo json_encode( [ 1 , " Successfully Published the Post "] );
                return;
            }

		}

        echo json_encode( [ 0 , "There is no value you are posting !!"] );
        return;
    }

	public function setting() {
		$this->load->view('buyer/Header');
		$this->load->view('buyer/Settings');
		$this->load->view('buyer/Footer');
	}

	public function setting_update() {

        $data = $this->input->post();
		$file = $_FILES;

        if(isset($file) && isset($data)){

			//File
			$file_name = $file['profile_img']['name'];

            $file_upload_name = $file_upload =  '';

            if ( $file_name != '' ) {

                $file_tmpname = $file['profile_img']['tmp_name'];
                $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $file_new_name = substr(md5(microtime()), rand(0,25), 8);
                $file_upload_name = $file_new_name.".".$extension;
                $file_upload = move_uploaded_file ($file_tmpname, "./resource/avtar/".$file_upload_name);

            }
			
            if ( ! $file_upload ) {
                $file_new_name = '';
            }

            $profile_array = [

                'des' => $data['des'],
                'dob' => $data['dob'],
                'address' => $data['address'],
                'city' => $data['city'],
                'country' => $data['country'],
                'avtar' => $file_upload_name
            ];

            $profile = $this->Buyer_model->update_settings( $profile_array );

            if ( $profile ) {
                echo json_encode( [ 1 , " Successfully Uploaded Profile "] );
                return;
            }
            else {
                echo json_encode( [ 0 , "Cannot upload profile data"] );
                return;
            }
		}

        echo json_encode( [ 0 , "There is no value you are posting !!"] );
        return;
    }


    public function offers ( $id ) {

        $offers = $this->Buyer_model->get_offers_by_job_id( $id );

        $job_details = $this->Buyer_model->get_job_by_job_id( $id );

        if ( empty($job_details) ) {
            $this->load->view('buyer/Header');
            $this->load->view('buyer/profile');
            $this->load->view('buyer/Footer');
        }
        else {

            $this->load->view('buyer/Header');
            $this->load->view('buyer/Seller_offers' , ['offers' => $offers[0] , 'images' => $offers[1] , 'job' => $job_details[0] ] );
            $this->load->view('buyer/Footer');

        }

        

    }

    public function offer_send_msg() {
        $data = $this->input->post();
        $file = $_FILES;

        if ( isset($file) && isset($data) && $data['msg'] != '' ) {

            $file_name = $file['file']['name'];
            $file_tmpname = $file['file']['tmp_name'];
            $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $file_new_name = substr(md5(microtime()), rand(0,25), 8);
            $file_upload_name = $file_new_name.".".$extension;
            $file_upload = move_uploaded_file ($file_tmpname, "./resource/msg_file/".$file_upload_name);
            
            if ( ! $file_upload ) {
                $file_upload_name = '';
                $file_name = '';
            }

            $data['file'] = $file_upload_name;
            $data['file_name'] = $file_name;

            $msg = $this->Buyer_model->offer_send_msg( $data );

            if ( $msg ) {
                echo json_encode( [ 1 , " Successfully Sent "] );
                return;
            }
            echo json_encode( [ 1 , " Cannot Send Msg "] );
            return;
        }

        else {
            echo json_encode( [ 0 , " Message Cannot Be Empty "] );
            return;
        }
    }



    /**
     * For Msg
     */
    public function inbox() {

        // var_dump($new_user);
        $all_users = $this->all_msg_peoples();

        $this->load->view('buyer/Header');
		$this->load->view('buyer/Inbox' , ['people' => $all_users] );

    }

    public function event() {

        // Authenticate

        $user_name =  $this->input->post('id');
        $time =  $this->input->post('time');

        $new_msg = $this->Message_model->get_new_msgs( $user_name , $time );

        $new_msg_array = [];
        foreach ( $new_msg as $msg ) {

            if ( $msg['sender_name'] == $_SESSION['user_name'] ) {

                array_push( $new_msg_array , ['o' , $msg['message'] , $msg['file'] , $msg['file_name'] , $msg['time'] ] );
            }
            else {
                array_push( $new_msg_array , ['i' , $msg['message'] , $msg['file'] , $msg['file_name'], $msg['time'] ] );
            }
        }

        echo json_encode( [ 'msg' => $new_msg_array , 'peoples' => $this->all_msg_peoples() ] );

    }


    public function get_messages_of_the_user(){

        $user_name =  $this->input->post('id');
        $new_msg = $this->Message_model->get_messages_of_the_user( $user_name );

        $new_msg_array = [];
        foreach ( $new_msg as $msg ) {

            if ( $msg['sender_name'] == $_SESSION['user_name'] ) {

                array_push( $new_msg_array , ['o' , $msg['message'] , $msg['file'] , $msg['file_name'], $msg['time'] ] );
            }
            else {
                array_push( $new_msg_array , ['i' , $msg['message'] , $msg['file'] , $msg['file_name'], $msg['time'] ] );
            }
        }
        echo json_encode( ['msg' => array_reverse( $new_msg_array )] );


    }

    protected function all_msg_peoples( ) {

        $msg_users = $this->Message_model->get_msg_people();
        $users = $this->Message_model->get_all_user();

        $all_users = [];
        $temp_array = [];

        foreach ( $msg_users as $key => $msg_user ) {
            
            foreach ( $msg_user as $key2 => $value2 ) {

                $new = '';
                $msg = '';
                if ( $key2 == 'sender_name' ) {
                    $new = $value2;
                    $msg = $msg_user['message'];
                }

                else if ( $key2 == 'receiver_name' ) {
                    $new = $value2;
                    $msg = $msg_user['message'];
                    
                }

                if ( $new != $_SESSION['user_name'] ) {
                    
                    foreach ( $users as $user ) {
                        if ( $user['user_name'] == $new ) {

                            $temp = ['user_name'=> $new ];
                            
                            if ( in_array( $temp , $temp_array) != TRUE ) {

                                array_push($temp_array , $temp);

                                $temp = ['user_name'=> $new , 'avtar' => $user['avtar'] , 'msg' => $msg ];

                                array_push($all_users , $temp);
                                break;
                            }
                            else {
                                break;
                            }
                            
                        }
                    }
                }
            }
        }
        return $all_users;
    }


    public function send_msg_to_man() {

		$data = $this->input->post();
		$file = $_FILES;

        if(isset($file) && isset($data)){

            if ( $data['msg'] == ''  ) {
                $data['msg'] = 'Please Check It Out';
            }

			//File
			$file_name = $file['msg_file']['name'];
			$file_tmpname = $file['msg_file']['tmp_name'];
			$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$file_new_name = substr(md5(microtime()), rand(0,25), 8);
			$file_upload_name = $file_new_name.".".$extension;

            $file_upload = move_uploaded_file ($file_tmpname, "./resource/msg_file/".$file_upload_name);

            if ( ! $file_upload ) {
                $file_upload_name = '';
            }

            $msg_array = [

                'time' => date('y-m-d h:i:s'),
                'sender_name' => $_SESSION['user_name'],
                'receiver_name' => $data['receiver_id'],
                'file' => $file_upload_name,
                'file_name' => $file_name,
                'message' => $data['msg'],
                'seen' => '0'
            ];

            $msg = $this->Message_model->send_msg_to_man( $msg_array );

            if ( $msg ) {
                echo json_encode( [ 1 , " Successfully Sent The Message "] );
                return;
            }

		}

        echo json_encode( [ 0 , "There is no value you are posting !!"] );
        return;
    }

}

?>