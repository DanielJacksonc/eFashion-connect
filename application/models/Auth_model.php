<?php

	class Auth_model extends CI_model{
		function __construct(){
			parent::__construct();
		}

		private $email;
		private $user_name;

		public function is_user_authenticate() {

			if ( isset( $_SESSION['user_id'] ) && isset( $_SESSION['user_name'] )  && isset( $_SESSION['user_type'] ) && isset( $_SESSION['priority'] ) && isset( $_SESSION['account_id'] ) ) {
				return 1;
			}
			else 
				return 0;
		}

		public function signup ( $user_data , $account_data , $profile_data ){

			$this->db->insert('profile', $profile_data);
			$profile_id = $this->db->insert_id();

			if ($profile_id) {
				$account_data['profile_id'] = $profile_id;

				$this->db->insert('account',$account_data);
				$account_id = $this->db->insert_id();

				if ( $account_id ) {

					$user_data['account_id'] = $account_id;
					$this->db->insert( 'user' , $user_data );

					$user_id = $this->db->insert_id();

					return [ $user_id , $account_id ];
				}
			}
		}

		public function checkEmail($email){
			$this->db->select('email');
			$this->db->where('email',$email);
			$this->email = $this->db->get('user');
			return $this->email->result_array();
		}

		public function checkUsername( $user_name ){
			$this->db->select( 'user_name');
			$this->db->where( 'user_name', $user_name );
			$this->user_name = $this->db->get('user');
			return $this->user_name->result_array();
		}

		function validateEmail($email) {
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return 1;
			}
			else {
				return 0;
			}
		}

		public function login($data){

			if ( $this->validateEmail( $data['email'] ) ) {

				$data = $this->db->get_where('user', $data );
				if($data->num_rows() > 0){
					return $data->result_array();
				}else{
					return 0;
				}
			}

			else {
				$data = $this->db->get_where('user', ['user_name'=> $data['email'] , 'user_pass' => $data['user_pass'] ] );
				if($data->num_rows() > 0){
					return $data->result_array();
				}else{
					return 0;
				}
			}

			

			
		}


		
        public function contact_designer( $data ) {

            $msg_array = [
                'time' => date('y-m-d h:i:s'),
                'sender_name' => $_SESSION['user_name'],
                'receiver_name' => $data['user_name'],
                'file' => $data['file'],
                'file_name' => $data['file_name'],
                'message' => $data['msg']
    
            ];
            return $this->db->insert( 'messages' , $msg_array );
        }

		public function create_an_order( $order ){
			//var_dump($order);
			// Check Personal Balance 
			$balance = $this->get_personal_balance();

			if ( $balance[0] >= $order['amount'] ) {


                $flag = $this->db->insert( 'order' , $order );

                if ( $flag ) {

                    // Deduct Personal balacne
                    $update_bal['personal_bal'] = $balance[0] - $order['amount'];
                    $update_bal['expense'] = $balance[1] + $order['amount'];

                    $this->db->where('account_id', $_SESSION['account_id'] );
                    $this->db->update('account', $update_bal );

                    // Update The Post As Hired
                    return [1 , 'Successfully Accepted the order'];
                }
				else {
					return [0 , ' Server Error '];
				}

            }
            else {
                return [0 , 'Insufficient Balance'];
            }

		}

		protected function get_personal_balance() {

			$this->db->select('personal_bal , expense');
			$this->db->where('account_id', $_SESSION['account_id'] );
			$this->result = $this->db->get('account');
			$balance = $this->result->result_array();
			return [ floatval( $balance[0]['personal_bal'] ) , floatval( $balance[0]['expense'] ) ];
		}

	}

?>