<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }


    public function withdraw_request($data) {

        if ( isset($data['amount']) ) {
            // Check Balance Of a customer
            $this->db->select('personal_bal');
            $this->db->where('account_id', $_SESSION['account_id'] );
            $this->result = $this->db->get('account');
            $balance = $this->result->result_array();

            if ( $balance[0]['personal_bal'] >= $data['amount'] ){
                // Insert database
                $data['user_name'] = $_SESSION['user_name'];
                $data['status'] = 'Pending';
                $data['created_at'] = date('y-m-d h:i:s');
                $flag = $this->db->insert( 'withdrawals' , $data );
                if ( $flag ) {
                    // Deduct money from personal Balance
                    $this->db->where('account_id', $_SESSION['account_id'] );
                    $this->db->update('account', ['personal_bal' => $balance[0]['personal_bal'] - $data['amount']  ]);
                    return [ 1 , " Successfully Withdrawal Request Send !! "];
                }
                else {
                    return [ 0 , " Server Problem !! "];
                }
            }
            return [ 0 , " Insufficient Balance !! "];
        }
        return [ 0 , " No Amount data Found !! "];
    }


    protected function get_payment_details ( $orderId ) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.sandbox.paypal.com/v2/checkout/orders/' . $orderId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic QWZXUnNlU19sR1YzZ3VaOXBjSXRWSHlnTDk3emFoeTdhSWVjbXFWZ0t5ZWJUOWRpTzlpOEU0Vm80VnltNk84Qm1fM3hVbUxBT3hoWVdibjI6RURUV2xqRHB1S2V3LVZOTWtNRTA1NzZLaFhBanhCa211UG9UZ2hubGJ0ZHY5LTBKUzJ0ZmF5YVhZSzh3dzJYQ2pDZGdjaGNRQzRDbU9XdTM='
            // 'Authorization: Basic QWYxSExfVzFsSEIwYWxGLTdPbkxCX1EwRGx6cTcwYmQ2WU5Pd1ZjV05IdXRXY25PaHlUemZWOC1UOUp2TW5rc09qZUlnZkJ1bmQ4M0o1Ui06RVBYeHRHc1J0UXRjbk04Wjk2YXFSanBoVC1iMXlEMnVmRWlReHRaZTk5dGtZSERqY3hPWkpwTFJmZGkybXJzYVM1Z082aURxejZicGpVdjY='
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }


    public function get_personal_balance() {
        $this->db->select('net_bal , personal_bal, earnings , expense');
        $this->db->where('account_id', $_SESSION['account_id'] );
        $this->result = $this->db->get('account');
        $balance = $this->result->result_array();
        return $balance[0];
    }

    public function get_latest_transactions() {
        
        $sql = "SELECT * FROM transactions WHERE sender = '" . $_SESSION['user_name'] . "' OR receiver = '" . $_SESSION['user_name'] . "'";
        $sql = $sql . ' ORDER BY `transactions`.`created_at` DESC';
        $data = $this->db->query($sql);
        return $data->result_array();
    }

    public function get_latest_withdrawals() {
        $sql = "SELECT * FROM withdrawals WHERE user_name = '" . $_SESSION['user_name'] . "'";
        $sql = $sql . ' ORDER BY `withdrawals`.`created_at` DESC';
        $data = $this->db->query($sql);
        return $data->result_array();
    }



    public function save_payment_info( $orderId ) {

        $pay_details = $this->get_payment_details( $orderId );
        
        $data = json_decode( $pay_details ,  true);

        if ( $data['status'] == 'COMPLETED' ) {
            $amount = floatval ( $data['purchase_units'][0]['amount']['value'] );

            // Check Order Id Already Exist Or not

            $this->db->select('*');
            $this->db->where('tran_id', $orderId );
            $this->result = $this->db->get('transactions');
            $id = $this->result->result_array();

            if ( empty($id) ) {

                $transaction = [
                    'tran_id' => $orderId,
                    'sender' => $_SESSION['user_name'],
                    'receiver' => 'e-fashion',
                    'amount' => $amount,
                    'status' => 'Completed',
                    'created_at' => date('y-m-d h:i:s'),
                ];
                $flag = $this->db->insert( 'transactions' , $transaction );
                if ( $flag ) {

                    // Update Net Price And Personal Balance
                    // Get Price First
                    $this->db->select('net_bal , personal_bal');
                    $this->db->where('account_id', $_SESSION['account_id'] );
                    $this->result = $this->db->get('account');
                    $balance = $this->result->result_array();
                    $balance = $balance[0];
                    // Update Balance
                    $balance['net_bal'] = $balance['net_bal'] + $amount;
                    $balance['personal_bal'] = $balance['personal_bal'] + $amount;

                    //Save Database Again
                    $this->db->where('account_id', $_SESSION['account_id'] );
                    $this->db->update('account', $balance);

                    return [1 , 'Successfully Updated The Transaction'];
                }
                else {
                    return [0 , 'There is tecnical Problem'];
                }
            }
            return [0 , 'This Transaction Already Exist'];

        }
        return [0 , 'Cannot Accept Failed Transactions'];
    }


}