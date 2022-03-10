<?php


if ( isset($_POST['regas']) && $_POST['regas'] != '' && isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['password']) && $_POST['password'] != '' && isset($_POST['phone']) && $_POST['phone'] != '' && isset($_POST['address']) && $_POST['address'] != '' && isset($_POST['city']) && $_POST['city'] != '' && isset($_POST['country']) && $_POST['country'] != '' ) {
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
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5( $_POST['password'] );
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    $conn = new mysqli('localhost','root','','e-fashion');
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    else {

        $sql = "INSERT INTO users(name,email,password,user_type,phone,address,city,country)
        VALUES ('" . $name . "', '" . $email . "', '" . $password . "', '" . $user_type . "',   '" . $phone . "','" . $address . "' ,'" . $city . "','" . $country . "')";

        if ($conn->query($sql) === TRUE) {
            echo'<h1>Congratulations!  You are successfully registered <h1>';
        } 
        else {
            echo "<h1> There is problem <h1>" . $conn->error ;
        }
    }

}
else {
    echo'<h1> Please Put The All Required Field <h1>';
}