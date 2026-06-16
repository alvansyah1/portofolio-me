<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Settings</title>

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&display=swap"
rel="stylesheet">

<style>

body{
    margin:0;
    background:#050816;
    color:white;
    font-family:'Sora',sans-serif;
}

.container{
    width:90%;
    max-width:800px;
    margin:auto;
    padding:50px 0;
}

.box{

    background:rgba(255,255,255,.05);

    padding:40px;

    border-radius:30px;

    border:1px solid rgba(255,255,255,.08);
}

.back{
    display:inline-block;
    margin-bottom:30px;
    color:white;
    text-decoration:none;
}

.item{

    padding:20px;

    margin-top:20px;

    border-radius:20px;

    background:#111827;
}

</style>

</head>

<body>

<div class="container">

    <a href="../dashboard.php"
    class="back">
        ← Back Dashboard
    </a>

    <div class="box">

        <h1>
            Settings
        </h1>

        <div class="item">
            Dark Mode Ready
        </div>

        <div class="item">
            Responsive Portfolio
        </div>

        <div class="item">
            SEO Optimization Ready
        </div>

        <div class="item">
            CV Upload Enabled
        </div>

    </div>

</div>

</body>
</html>