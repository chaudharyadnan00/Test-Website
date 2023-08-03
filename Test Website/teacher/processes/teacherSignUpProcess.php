<?php
session_start();
include "../../others/include/conn.php";
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$randstring = "@";
$add = RandomString();
$id = strval($phone) . $add;
$number = "select * from teachers_details where phone='$phone'";
$tid = "select * from teachers_details where email='$email'";
$o1 = mysqli_query($con, $number);
$o2 = mysqli_query($con, $tid);
$r1 = mysqli_num_rows($o1);
$r2 = mysqli_num_rows($o2);
if($r1>0 and $r2>0){
    echo "this phone and email are already registered";
}
elseif ($r1 > 0) {
    echo "this phone is already registered";
}
elseif ($r2 > 0) {
    echo "this email is already registered";
} 
else {
    $sql = "INSERT INTO teachers_details (id, name, phone, email, password) VALUES ('$id','$name','$phone', '$email', '$password')";
    $result = mysqli_query($con, $sql);
}

function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    global $randstring;
    for ($i = 0; $i < 5; $i++) {
        $randstring = $randstring . $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}
?>