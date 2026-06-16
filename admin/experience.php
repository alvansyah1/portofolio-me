<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

if(isset($_POST['add'])){

    $company = $_POST['company'];
    $position = $_POST['position'];
    $period = $_POST['period'];
    $description = $_POST['description'];

    $logo = '';

    if($_FILES['logo']['name']){

        $logo = time().$_FILES['logo']['name'];

        move_uploaded_file(
            $_FILES['logo']['tmp_name'],
            "../assets/upload/company/".$logo
        );
    }

    mysqli_query($conn,"
        INSERT INTO experience
        (
            company,
            position,
            period,
            description,
            logo
        )
        VALUES
        (
            '$company',
            '$position',
            '$period',
            '$description',
            '$logo'
        )
    ");

    header("Location: experience.php");
}

if(isset($_GET['delete'])){

    mysqli_query($conn,"
        DELETE FROM experience
        WHERE id='$_GET[delete]'
    ");

    header("Location: experience.php");
}

$data = mysqli_query($conn,"
    SELECT * FROM experience
    ORDER BY id DESC
");

?>

<!DOCTYPE html>
<html>
<head>

<title>Experience</title>

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
    max-width:1000px;
    margin:auto;
    padding:50px 0;
}

.box{
    background:rgba(255,255,255,.05);
    padding:40px;
    border-radius:30px;
    border:1px solid rgba(255,255,255,.08);
}

input,
textarea{

    width:100%;
    padding:15px;
    margin-bottom:20px;

    border:none;
    border-radius:14px;

    background:#111827;
    color:white;
}

textarea{
    height:120px;
}

button{

    padding:15px 25px;

    border:none;

    border-radius:14px;

    background:linear-gradient(
        135deg,
        #7c3aed,
        #06b6d4,
        #ec4899
    );

    color:white;
    cursor:pointer;
}

.item{

    margin-top:25px;

    background:#111827;

    padding:25px;

    border-radius:20px;
}

.item img{

    width:80px;
    height:80px;

    object-fit:cover;

    border-radius:18px;

    margin-bottom:15px;
}

a{
    color:red;
    text-decoration:none;
}

.back{
    display:inline-block;
    margin-bottom:30px;
    color:white;
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
            Manage Experience
        </h1>

        <br>

        <form
        method="POST"
        enctype="multipart/form-data">

            <input
            type="text"
            name="company"
            placeholder="Company">

            <input
            type="text"
            name="position"
            placeholder="Position">

            <input
            type="text"
            name="period"
            placeholder="2023 - 2025">

            <textarea
            name="description"
            placeholder="Description"></textarea>

            Upload Logo
            <br><br>

            <input
            type="file"
            name="logo">

            <button name="add">
                Add Experience
            </button>

        </form>

        <?php while($d=mysqli_fetch_assoc($data)): ?>

        <div class="item">

            <img
            src="../assets/upload/company/<?= $d['logo']; ?>">

            <h2>
                <?= $d['company']; ?>
            </h2>

            <h3>
                <?= $d['position']; ?>
            </h3>

            <small>
                <?= $d['period']; ?>
            </small>

            <p>
                <?= $d['description']; ?>
            </p>

            <br>

            <a href="?delete=<?= $d['id']; ?>">
                Delete
            </a>

        </div>

        <?php endwhile; ?>

    </div>

</div>

</body>
</html>