<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

$data = mysqli_query($conn,"
    SELECT * FROM contacts
    ORDER BY id DESC
");

?>

<!DOCTYPE html>
<html>
<head>

<title>Contacts</title>

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
    max-width:1100px;
    margin:auto;
    padding:50px 0;
}

.box{

    background:rgba(255,255,255,.05);

    padding:40px;

    border-radius:30px;

    border:1px solid rgba(255,255,255,.08);
}

.table{

    width:100%;

    border-collapse:collapse;

    margin-top:30px;
}

.table th,
.table td{

    padding:18px;

    border-bottom:1px solid rgba(255,255,255,.08);

    text-align:left;
}

.table th{
    background:#111827;
}

.back{
    display:inline-block;
    margin-bottom:30px;
    color:white;
    text-decoration:none;
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
            Incoming Contacts
        </h1>

        <table class="table">

            <tr>

                <th>Name</th>

                <th>Email</th>

                <th>Message</th>

                <th>Date</th>

            </tr>

            <?php while($d=mysqli_fetch_assoc($data)): ?>

            <tr>

                <td>
                    <?= $d['name']; ?>
                </td>

                <td>
                    <?= $d['email']; ?>
                </td>

                <td>
                    <?= $d['message']; ?>
                </td>

                <td>
                    <?= $d['created_at']; ?>
                </td>

            </tr>

            <?php endwhile; ?>

        </table>

    </div>

</div>

</body>
</html>