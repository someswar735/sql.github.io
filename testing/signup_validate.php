<?php
require_once 'db_connection.php';
$id = $_POST['id'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$gender = $_POST['gender'];
$fav_language = $_POST['fav_language'];
if ($password==$confirm_password) {
    if (strlen($fullname)>0 && strlen($email)>0 && strlen($password)>0 && strlen($confirm_password)>0 && strlen($fav_language)>0) {
   $select = "SELECT * FROM users WHERE email='$email'";
   $getuser = mysqli_query($conn,$select);
   if(mysqli_num_rows($getuser)==1){
    echo "<script>alert('Alredy registerd with this email');$go_back</script>";
   }
   else {
    $insert = "INSERT INTO users (fullname,email,password,gender,fav_language)
                VALUES ('$fullname','$email','$password','$gender','$fav_language')";
                
    $insertUser = mysqli_query($conn,$insert);
    if ($insertUser) {
        echo "<script>alert('registered succesfully');window.location.href='login.php';</script>";
    }
    else {
        echo "<script>alert('something went wrong');</script>";

    }
   }
    }
    else {
        echo "<script>alert('please fill all the mandatory fields');</script>";
    }
}else {
    echo "<script>alert('passwords are not matching');</script>";
}

?>