<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S extends CI_Controller{

	function __construct(){
		parent::__construct();
        $this->load->Model('Auth_model');
        $this->load->Model('Seller_model');
        $this->load->Model('Message_model');
        $this->load->Model('Paypal_model');

		if ( $this->Auth_model->is_user_authenticate() == 0 || $_SESSION['user_type'] != '2' || $_SESSION['priority'] != 'seller'  ) {
            echo " Please Login First !!! ";
            redirect('');
        }
	}

    public function index(){

		$gigs = $this->Seller_model->get_all_gig();
		$profile = $this->Seller_model->get_profile_details();

		$this->load->view('seller/Header');
		$this->load->view('seller/Profile' , ["gigs" => $gigs , "profile"=> $profile[0] ] );
		$this->load->view('seller/Footer');

    }


    public function balance() {

        $balance = $this->Paypal_model->get_personal_balance();
        $withdrawals = $this->Paypal_model->get_latest_withdrawals();

        $this->load->view('seller/Header');
		$this->load->view('seller/Balance' , [ 'balance'=>$balance , 'withdrawals' => $withdrawals ] );
		$this->load->view('seller/Footer');
    }


    public function withdraw() {
        $data = $this->input->post();
        if ( isset($data['method']) ) {
            $callback = $this->Paypal_model->withdraw_request($data);
            echo json_encode($callback);
        }
    }




    public function orders( $status = 'active' ) {

        $orders = [];
        if ( $status == 'active' ) {
            // Get Active Orders
            $orders = $this->Seller_model->get_orders('a');
            $orders['active'] = 'a';
        }
        else if ( $status == 'completed' ) {
            // Get Active Orders
            $orders = $this->Seller_model->get_orders('w');
            if ( empty($orders['orders']) ){
                $orders = $this->Seller_model->get_orders('c');
            }
            $orders['active'] = 'w';

        }

        $this->load->view('seller/Header');
		$this->load->view('seller/Orders' , $orders );
		$this->load->view('seller/Footer');
    }

    public function manage_order( $order_id ) {

        $order = $this->Seller_model->get_order_by_order_id( $order_id );
        

        $this->load->view('seller/Header');
		$this->load->view('seller/Manage_order' , $order );
		$this->load->view('seller/Footer');

    }


    public function delivar_submit() {
        $data = $this->input->post();
        $file = $_FILES;

        if ( isset($data) && isset($file) ) {

            if ( $data['msg'] == '' ) {
                echo json_encode([0, ' Description Cannot Be Empty ']);
                return;
            }

            //File
			$file_name = $file['file']['name'];
			$file_tmpname = $file['file']['tmp_name'];
			$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$file_new_name = substr(md5(microtime()), rand(0,25), 8);
			$file_upload_name = $file_new_name.".".$extension;

            $file_upload = move_uploaded_file ($file_tmpname, "./resource/delivary_file/".$file_upload_name);

            if ( ! $file_upload ) {
                $file_upload_name = '';
                $file_name = '';
            }

            $d_array = [

                'delivary_id' => substr(md5(microtime()), rand(0,25), 10),
                'order_id' => $data['order_id'],
                'buyer_id' => '',
                'seller_id' => $_SESSION['user_name'],
                'des' => $data['msg'],
                'file' => $file_upload_name,
                'file_name' => $file_name,
                'created_at' => date('y-m-d h:i:s'),
            ];

            $result = $this->Seller_model->save_delivar_data( $d_array );

            echo json_encode( [ 1 , 'Delivered the project '] );
        }
    }





















	public function new_gig(){
		$this->load->view('seller/Header');
		$this->load->view('seller/Create_gig');
		$this->load->view('seller/Footer');
	}

	public function create_new_gig() {

		$data = $this->input->post();
		$file = $_FILES;

        if(isset($file) && isset($data)){


            if ( $data['gig_title'] == '' || strlen( $data['gig_title'] ) > 80 ) {
                echo json_encode( [ 0 , "Title Must be not Empty And Within 80 Character !"] );
                return;
            }
    
            if ( $data['gig_des'] == '' || strlen( $data['gig_des'] ) > 1000 ) {
                echo json_encode( [ 0 , "Description must be not Empty And Within 1000 Character !"] );
                return;
            }

			//File
			$file_name = $file['gig_img']['name'];
			$file_tmpname = $file['gig_img']['tmp_name'];
			$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$file_new_name = substr(md5(microtime()), rand(0,25), 8);
			$file_upload_name = $file_new_name.".".$extension;

            $file_upload = move_uploaded_file ($file_tmpname, "./resource/gig-images/".$file_upload_name);

            if ( $file_upload ) {

                $gig_array = [

                    'gig_id' => substr(md5(microtime()), rand(0,25), 8),
                    'title' => $data['gig_title'],
                    'catagory' => $data['category'],
                    'des' => $data['gig_des'],
                    'img' => $file_upload_name,
                    'price' => $data['price'],
                    'd_date' => $data['d_date'],
                    'order_count' => 0,
                    'created_at' => date('y-m-d h:i:s'),
                    'owner_id' => $_SESSION['account_id']
                ];

                $gig = $this->Seller_model->upload_new_gig( $gig_array );

                if ( $gig ) {
                    echo json_encode( [ 1 , " Successfully Created Gig , Share "] );
                    return;
                }

                echo json_encode( [ 0 , "Cannot Save This Gig"] );
                return;
            }

            echo json_encode( [ 0 , "Cannot Upload Gig Image"] );
            return;
		}

        echo json_encode( [ 0 , "There is no value you are posting !!"] );
        return;
    }

	public function setting() {
		$this->load->view('seller/Header');
		$this->load->view('seller/Settings');
		$this->load->view('seller/Footer');
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

            $profile = $this->Seller_model->update_settings( $profile_array );

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


	public function gig( $id ) {

		$gig = $this->Seller_model->get_gig_by_id( $id );
        if ( ! empty ($gig) ) {
            $gig = $gig[0];
        }
        else {
            redirect('');
        }

        $profile = $this->Seller_model->get_profile_details();
        $user = $this->Seller_model->get_user_data();

        $this->load->view('seller/header');
		$this->load->view('seller/Gig' , ['gig' => $gig , 'profile' => $profile[0] , 'user' => $user[0] ]);
       $this->load->view('seller/footer');
	}


    public function requests( $status = 'active' ) {

        if ( $status == 'offers' ) {

            $sended_offers = $this->Seller_model->get_full_sended_offers();

            $this->load->view('seller/Header');
            $this->load->view('seller/Sended_offers' , ["offers" => $sended_offers]);
            $this->load->view('seller/Footer');


        }
        else {

            $all_jobs = $this->Seller_model->get_buyer_requests( $status );

            $offers = $this->Seller_model->get_sended_offers();

            $new_jobs = [];

            foreach ($all_jobs[0] as $job ) {

                $id = $job['job_id'];
                $flag = 1;

                foreach ( $offers as $offer ){
                    if ( $offer['job_id'] == $id ) {
                        $flag = 0;
                        break;
                    }
                }
                if ( $flag == 1 ) {
                    array_push( $new_jobs, $job );
                }
            }

            $gigs = $this->Seller_model->get_all_gig();

            $this->load->view('seller/Header');
            $this->load->view('seller/Buyer_requests' , ["gigs" => $gigs, 'jobs' => $new_jobs , 'images' => $all_jobs[1] ]);
            $this->load->view('seller/Footer');

        }
    }

    public function send_offer() {

        $data = $this->input->post();

        if( isset($data) && isset($data['gig_id']) ){

            if ( $data['job_id'] == '' || $data['gig_id'] == '' ) {
                echo json_encode( [ 0 , " No Gig Selected, Please Create a gig first "] );
                return;
            }

            if ( $data['offer_des'] == '' ) {
                echo json_encode( [ 0 , " Offer Description will not be empty "] );
                return;
            }

            if ( $data['price'] == '' || $data['d_date'] == '' || $data['price'] == '0' || $data['d_date'] == '0' ) {
                echo json_encode( [ 0 , " Price And Delivary date Cannot be empty or Zero "] );
                return;
            }

            $offer_array = [

                'offer_id' => substr(md5(microtime()), rand(0,25), 10),
                'job_id' => $data['job_id'],
                'gig_id' => $data['gig_id'],
                'seller_uname' => $_SESSION['user_name'],
                'des' => $data['offer_des'],
                'price' => $data['price'],
                'd_date' => $data['d_date'],
                'created_at' => date('y-m-d h:i:s'),
                'owner_id' => ''
            ];

            $offer = $this->Seller_model->send_offer_request( $offer_array );

            if ( $offer ) {
                echo json_encode( [ 1 , $data['job_id'] , " Successfully Sended The Offer "] );
                return;
            }
            else {
                echo json_encode( [ 0 , " Cannot Send the offer "] );
                return;
            }
		}

        echo json_encode( [ 0 , " Please Create A GIG First!!"] );
        return;
    }




    
    /**
     * For Msg
     */

    public function inbox() {

        // var_dump($new_user);
        $all_users = $this->all_msg_peoples();
        $gigs = $this->Seller_model->get_all_gig();

        $this->load->view('seller/Header');
		$this->load->view('seller/Inbox' , ['gigs'=>$gigs ,'people' => $all_users] );

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
                echo json_encode( [ 1 , " Successfully Published the Post "] );
                return;
            }

		}

        echo json_encode( [ 0 , "There is no value you are posting !!"] );
        return;
    }


    /**
     * Sending Custom Order
     */
    public function send_custom_order() {
        $data = $this->input->post();
        
        if ( isset($data) ) {
            if ( $data['b_name'] == '' ) {
                echo json_encode([ 0 , ' Please Select A Buyer ' ]);
                return;
            }
            else if ( $data['gig'] == '' ) {
                echo json_encode([ 0 , ' Please Select A Gig ' ]);
                return;
            }
            else if ( $data['des'] == '' ) {
                echo json_encode([ 0 , ' Description can\'t be Empty ' ]);
                return;
            }
            else if ( $data['amount'] == '' ) {
                echo json_encode([ 0 , ' Amount can\'t be Empty ' ]);
                return;
            }
            else if ( $data['d_date'] == '' ) {
                echo json_encode([ 0 , ' Delivary Date can\'t be Empty ' ]);
                return;
            }

            $order_array = [
                'order_id' => substr(md5(microtime()), rand(0,25), 10),
                'buyer_id' => $data['b_name'],
                'seller_id' => $_SESSION['user_name'],
                'gig_id' => $data['gig'],
                'des' => $data['des'],
                'amount' =>  (int) $data['amount'],
                'd_date' => (int) $data['d_date'],
                'status' => 'running',
                'created_at' => date('y-m-d h:i:s')
            ];

            // var_dump($order_array);
            // exit;

            $update = $this->Seller_model->save_seller_custom_order_request($order_array);

            if (  $update ){
                echo json_encode([ 1 , ' Successfully Send the Order Request ' ]);
            }
        }
    }
	

}

?>