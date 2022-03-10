<?php


if ( isset($_POST['regas']) && $_POST['regas'] != ''  && isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['password']) && $_POST['password'] != '' ) {

    $user_type = $_POST['regas'];
    if ($user_type == 'buyer') {
        $user_type = '2';
    }
    else if ($user_type == 'designer') {
        $user_type = '3';
    }
    else{
        echo'<h1> Sorry ! There is an error <h1>';
    }

    $email = $_POST['email'];
    $password = md5( $_POST['password'] );

    $conn = new mysqli('localhost','root','','e-fashion');
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    else {


        $sql = "SELECT * FROM users WHERE user_type='" . $user_type . "' AND email='" . $email . "' AND password='" . $password . "'";

        $result =$conn->query($sql);
        $user = mysqli_fetch_array($result);

        if ($user != NULL ) {
            // $redirect_link = 'http://' . $_SERVER['SERVER_NAME'] . '/Abimbola/theme/mona/login_successfull.html';

            echo'<h1>Congratulations!  You have successfully Loged In <h1> ';

            // session_start();
            // $_SESSION['name'] = $user['name'];
            // $_SESSION['email'] = $user['email'];

            
        }
        else {
            echo'<h1> There is no email and password found, Please Signup <h1>';
        }

        // if ($conn->query($sql) === TRUE) {
        //     echo'<h1>Congratulations!  You are successfully registered <h1>';
        // } 
        // else {
        //     echo "<h1> There is problem <h1>" . $conn->error ;
        // }
    }

}
else {
    echo'<h1> Please Put The All Required Field <h1>';
}