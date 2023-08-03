<?php
session_start();
include "../../others/include/conn.php";
$phone = $_POST['phone'];
$target = $_POST['target'];
$password = $_POST['password'];
$add = RandomString();
$id = strval($phone) . $add;
$number = "select * from students_details where phone ='$phone'";
$out = mysqli_query($con, $number);
$rty =  mysqli_num_rows($out);
echo $rty;
if ($rty > 0) {
    echo "this phone already registered";
} else {
    $sql = "INSERT INTO students_details (id, phone, password, target) VALUES ('$id', '$phone', '$password', '$target')";
    $result = mysqli_query($con, $sql);
}


function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = "@";
    for ($i = 0; $i < 5; $i++) {
        $randstring = $randstring . $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}
?>
