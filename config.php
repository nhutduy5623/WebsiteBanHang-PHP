<?php
$conn = mysqli_connect("localhost", "root", "", "webbandienthoai");  
if($conn)
{
        // echo 'Connect Success!';
}
else
{
        // echo 'Kết nối sql thất bại';
}
mysqli_query($conn, "SET NAMES 'utf8'");
?>