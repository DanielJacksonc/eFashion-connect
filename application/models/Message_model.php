<?php

	class Message_model extends CI_model{
		function __construct(){
			parent::__construct();
		}

		public function get_msg_people() {

            $sql = "SELECT * FROM messages WHERE sender_name = '" . $_SESSION['user_name'] . "' OR receiver_name = '" . $_SESSION['user_name'] . "'";
            $sql = $sql . ' ORDER BY `messages`.`time` DESC';
            $data = $this->db->query($sql);
            return $data->result_array();

        }

        public function get_all_user() {
            $this->db->select('user_name ,  avtar');
            $this->result = $this->db->get('user');
            return $this->result->result_array();
        }

        public function get_new_msgs( $user_name , $time ) {

            if ($time == '') {
                return [];
            }

            // Check User_name Is Valid

            $sql = "SELECT * FROM messages WHERE ";
            $sql = $sql . "((sender_name = '" . $_SESSION['user_name'] . "' AND receiver_name = '" . $user_name . "') OR ";
            $sql = $sql . "(sender_name = '" . $user_name . "' AND receiver_name = '" . $_SESSION['user_name'] . "'))";
            $sql = $sql . " AND ( time > '". $time ."') ORDER BY `messages`.`time` DESC ";


            $data = $this->db->query($sql);
            $data = $data->result_array();

            // if ( ! empty( $data) ) {
            //     foreach ( $data as $value ) {
            //         $this->db->query(" UPDATE messages SET seen='1' WHERE msg_id=". $value['msg_id'] );
            //     }  
            // }

            return $data;

        }

        public function get_messages_of_the_user( $user_name ) {
            $sql = "SELECT * FROM messages WHERE ";
            $sql = $sql . "((sender_name = '" . $_SESSION['user_name'] . "' AND receiver_name = '" . $user_name . "') OR ";
            $sql = $sql . "(sender_name = '" . $user_name . "' AND receiver_name = '" . $_SESSION['user_name'] . "'))";
            $sql = $sql . " ORDER BY `messages`.`time` DESC";

            $data = $this->db->query($sql);
            return $data->result_array();

        }

        public function send_msg_to_man( $msg_array ){
            return $this->db->insert( 'messages' , $msg_array );
        }


	}

?>