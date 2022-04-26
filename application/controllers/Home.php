<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

	function __construct(){
		parent::__construct();
        $this->load->Model('Auth_model');
		$this->load->Model('Buyer_model');
	}

    public function index(){
		$this->load->view('Home_View');
    }

	public function am_i_valid() {
		$auth = $this->Auth_model->is_user_authenticate();

		if ( $auth ) {
			echo json_encode( [ 'valid' => 1 , 'priority' => $_SESSION['priority'] , 'username' => $_SESSION['user_name'] ] );
		}
		else {
			echo json_encode([ 'valid' => 0 ]);
		}
	}


	// Content to the designer
	public function contact_designer() {

        $data = $this->input->post();
        $file = $_FILES;

        if ( isset($file) && isset($data) && $data['msg'] != '' ) {

			if ( isset($data['user_name']) &&  $data['user_name'] == $_SESSION['user_name']) {
				echo json_encode( [ 0 , " You cannot message yourself "] );
				return;
			}

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

            $msg = $this->Auth_model->contact_designer( $data );

            if ( $msg ) {
                echo json_encode( [ 1 , " Successfully Sent "] );
                return;
            }
            echo json_encode( [ 0 , " Cannot Send Msg "] );
            return;
        }

        else {
            echo json_encode( [ 0 , " Message Cannot Be Empty "] );
            return;
        }
    }


	public function order_designer() {
		$data = $this->input->post();
		if ( isset($data) ) {

			if ( isset($data['user_name']) &&  $data['user_name'] == $_SESSION['user_name']) {
				echo json_encode( [ 0 , " You cannot Order yourself "] );
				return;
			}

			
			$gig = $this->Buyer_model->get_gig_by_id( $data['gig_id'] );

			if ( empty($gig) ) {
				echo json_encode( [ 0 , " No Gig Found "] );
            	return;
			}
			else {
				$gig = $gig[0];
			}

			$order = [
				'order_id' => substr(md5(microtime()), rand(0,25), 10),
				'buyer_id' => $_SESSION['user_name'],
				'seller_id' => $data['user_name'],
				'gig_id' => $gig['gig_id'],
				'des' => $data['req'],
				'amount' => floatval( $gig['price'] ),
				'd_date' => $gig['d_date'],
				'status' => 'a',
				'created_at' => date('y-m-d h:i:s')
			];

            $msg = $this->Auth_model->create_an_order( $order );

			echo json_encode($msg);
        }
	}



	public function profile() {
		$auth = $this->Auth_model->is_user_authenticate();
		if ( $auth ) {
			if ( $_SESSION['priority'] == 'buyer'){  redirect('b'); }
			else if ( $_SESSION['priority'] == 'seller'){  redirect('s'); }
		}
		else {
			redirect('login');
		}
	}

	public function about() {
		$this->load->view('header_view');
		$this->load->view('About_view');
		$this->load->view('footer_view');
	}

	public function contact() {
		$this->load->view('header_view');
		$this->load->view('Contact_view');
		$this->load->view('footer_view');
	}

	public function gallery() {
		$this->load->view('header_view');
		$this->load->view('Gallery_view');
		$this->load->view('footer_view');
	}

	public function login(){
		$this->load->view('header_view');
		$this->load->view('auth/login');
		$this->load->view('footer_view');
		
    }

	public function logout(){

        try {
            unset(
				$_SESSION['user_id'],
				$_SESSION['user_name'],
				$_SESSION['user_type'],
				$_SESSION['priority'],
				$_SESSION['account_id']
			);
			redirect('');

        } catch (\Throwable $th) {
            redirect('');
        }
	}

    public function signup(){
		$this->load->view('header_view');
		$this->load->view('auth/signup');
		$this->load->view('footer_view');
	}


	public function signup_submit() {

		$data = $this->input->post();

		if( isset($data) ) {

			if ( !isset($data['txt_username'])  || strlen($data['txt_username']) < 5 ) { echo json_encode([ 0 , 'User Name must be 5 character'] ); return 0; }
			if ( !isset($data['txt_email']) || !filter_var($data['txt_email'], FILTER_VALIDATE_EMAIL) ) { echo json_encode([ 0 , 'Email cannot Be empty'] ); return 0; }
			if ( ! isset($data['txt_pass']) || ! isset($data['txt_cpass']) || $data['txt_pass'] != $data['txt_cpass'] ) { echo json_encode([ 0 , 'Password Doesn\'t match'] ); return 0; }
			if ( ! isset($data['terms']) || $data['terms'] != '1' ) { echo json_encode([ 0 , 'Please Accept Terms and Conditions'] ); return 0; }


			// Get Form Values
			$user_name = $data['txt_username'];
			$user_email = $data['txt_email'];
			$user_pass = md5( $data['txt_pass'] );
			$type = $data['type_select'];
			$user_fname = $data['txt_fname'];
			$user_lname = $data['txt_lname'];
			$created_at = $data['created_at'];
			$user_status = 'active';
			$user_type = '2';

			
			// Settings
			$buyer = $seller = '0';
			$priority = '';

			if ( $type == '2') {
				$buyer = '1';
				$priority = 'buyer';
			}
			else if ($type == '3') {
				$seller = '1';
				$priority = 'seller';
			}

			$user_arr = array(
				'user_name' => $user_name,
				'email' => $user_email,
				'user_pass' => $user_pass,
				'user_type' => $user_type,
				'priority' => $priority,
				'user_status' => '1',
				'account_id' => 0,
			);

			$account_arr = array(
				'buyer' => $buyer,
				'seller' => $seller,
				's_type' => '',
				'net_bal' => 0.0,
				'personal_bal' => 0.0,
				'earnings' => 0.0,
				'expense' => 0.0,
				'profile_id' => 0,
				'created_at' => date('y-m-d h:i:s')
			);

			$profile_arr = array(
				'f_name' => $user_fname,
				'l_name' => $user_lname,
				'dob' => $user_lname,
				'address' => '',
				'city' => '',
				'country' => '',
				'avtar' => '',
			);

			$check_email = $this->Auth_model->checkEmail($user_email);
			$check_user_name = $this->Auth_model->checkUsername($user_name);

			if ( isset( $check_user_name [0]['user_name']) ) {
				echo json_encode([ 0 , 'User Name Already Exist'] );
				return;
			}

			else if( isset($check_email[0]['email']) ){
				echo json_encode([ 0 , 'Email Already Exist'] );
				return;
			}

			else{

				$result = $this->Auth_model->signup( $user_arr , $account_arr , $profile_arr );

				$session_arr = array(

					'user_id' => $result[0],
					'user_name' => $user_name,
					'user_type' => $user_type,
					'priority' => $priority,
					'account_id' => $result[1]
				);
				
				$this->session->set_userdata($session_arr);

				echo json_encode([ 1 , $priority , 'Successfully registered'] );

				return;
			}	
		}
		echo json_encode([ 0 , 'Page Not Found !!'] );
		return;
	}


	public function login_submit(){

        if( isset($_POST['txt_email']) && isset($_POST['txt_pass']) ){

			$data = array(
			'email' => $_POST['txt_email'],
			'user_pass' => md5($_POST['txt_pass'] )
			);

			$res = $this->Auth_model->login($data);

			if($res != 0){

				$session_array = array(
					'user_id' => $res[0]['user_id'],
					'user_name' => $res[0]['user_name'],
					'user_type' => $res[0]['user_type'],
					'priority' => $res[0]['priority'],
					'account_id' => $res[0]['account_id']
				);
				
				$this->session->set_userdata($session_array);

                echo json_encode( [ 1 , $res[0]['priority'] , ' Successfully Loged In'] );
				return;

			}
			else{
				echo json_encode([ 0 , ' Invalid Email & Password'] );
				return;
			}
		}

		echo json_encode([ 0 , 'Page Not Found !!'] );
		return;
    }
    
}

?>