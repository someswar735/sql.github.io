<?php
require_once 'constants.php';
$conn = mysqli_connect('localhost','root','','testing');
if ($conn) {
    echo "DB Connected";
}
else {
    echo "DB Not Connected";
}
?>