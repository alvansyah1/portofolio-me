<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

$data = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT * FROM profile LIMIT 1
    ")
);

if(isset($_POST['save'])){

    $name = $_POST['name'];
    $role = $_POST['role'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    $photo = $data['photo'];
    $cv = $data['cv'];

    if($_FILES['photo']['name']){

        $photo = time().$_FILES['photo']['name'];

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            "../assets/upload/profile/".$photo
        );
    }

    if($_FILES['cv']['name']){

        $cv = time().$_FILES['cv']['name'];

        move_uploaded_file(
            $_FILES['cv']['tmp_name'],
            "../assets/upload/cv/".$cv
        );
    }

    mysqli_query($conn,"
        UPDATE profile SET
        name='$name',
        role='$role',
        description='$description',
        email='$email',
        location='$location',
        photo='$photo',
        cv='$cv'
        WHERE id=1
    ");

    header("Location: profile.php");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Profile</title>

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
    height:140px;
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

img{

    width:120px;
    height:120px;

    object-fit:cover;

    border-radius:20px;

    margin-bottom:20px;
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
            Edit Profile
        </h1>

        <br>

        <img
        src="../assets/upload/profile/<?= $data['photo']; ?>">

        <form
        method="POST"
        enctype="multipart/form-data">

            <input
            type="text"
            name="name"
            value="<?= $data['name']; ?>"
            placeholder="Name">

            <input
            type="text"
            name="role"
            value="<?= $data['role']; ?>"
            placeholder="Role">

            <textarea
            name="description"
            placeholder="Description"><?= $data['description']; ?></textarea>

            <input
            type="email"
            name="email"
            value="<?= $data['email']; ?>"
            placeholder="Email">

            <input
            type="text"
            name="location"
            value="<?= $data['location']; ?>"
            placeholder="Location">

            Upload Photo
            <br><br>

            <input
            type="file"
            name="photo">

            Upload CV
            <br><br>

            <input
            type="file"
            name="cv">

            <br><br>

            <button name="save">
                Save Profile
            </button>

        </form>

    </div>

</div>

</body>
</html>