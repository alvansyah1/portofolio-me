<?php

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

$to = "htsalvan2001@gmail.com";
$subject = "Pesan Baru Dari Portfolio";

$body = "
Nama : $name

Email : $email

Pesan :
$message
";

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

if(mail($to, $subject, $body, $headers)){
    echo "<script>alert('Pesan berhasil dikirim');history.back();</script>";
}else{
    echo "<script>alert('Gagal mengirim pesan');history.back();</script>";
}