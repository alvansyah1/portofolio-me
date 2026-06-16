<?php

session_start();

include 'koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($conn,"
        SELECT * FROM admin
        WHERE username='$username'
        AND password='$password'
    ");

    if(mysqli_num_rows($cek) > 0){

        $_SESSION['admin'] = true;

        header("Location: dashboard.php");

    }else{

        echo "
        <script>
            alert('Login Gagal');
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&display=swap"
rel="stylesheet">

<style>

body{
    background:#050816;
    font-family:'Sora',sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

.box{

    width:350px;

    background:rgba(255,255,255,.05);

    padding:40px;

    border-radius:30px;

    border:1px solid rgba(255,255,255,.08);

    color:white;
}

h1{
    text-align:center;
    margin-bottom:30px;
}

input{

    width:100%;

    padding:15px;

    margin-bottom:20px;

    border:none;

    border-radius:14px;

    background:#111827;

    color:white;
}

button{

    width:100%;

    padding:15px;

    border:none;

    border-radius:14px;

    background:linear-gradient(
        135deg,
        #7c3aed,
        #06b6d4,
        #ec4899
    );

    color:white;

    font-weight:bold;

    cursor:pointer;
}

a{
    color:white;
    text-decoration:none;
}

</style>

</head>

<body>

<div class="box">

    <h1>
        Admin Login
    </h1>

    <form method="POST">

        <input
        type="text"
        name="username"
        placeholder="Username"
        required>

        <input
        type="password"
        name="password"
        placeholder="Password"
        required>

        <button name="login">
            LOGIN
        </button>

    </form>

    <br>

    <center>

        <a href="index.php">
            Back To Portfolio
        </a>

    </center>

</div>

</body>
</html>