<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

/* ADD PROJECT */

if(isset($_POST['add'])){

    $title = $_POST['title'];
    $description = $_POST['description'];

    /* COVER */

    $cover = time().'_'.$_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../assets/upload/project/".$cover
    );

    /* INSERT PROJECT */

    mysqli_query($conn,"
        INSERT INTO projects
        (title,description,image)
        VALUES
        (
            '$title',
            '$description',
            '$cover'
        )
    ");

    $project_id = mysqli_insert_id($conn);

    /* MULTIPLE GALLERY */

    if(isset($_FILES['gallery'])){

        foreach($_FILES['gallery']['tmp_name'] as $key => $tmp){

            if(!empty($_FILES['gallery']['name'][$key])){

                $gallery_name =
                time().'_'.$key.'_'.$_FILES['gallery']['name'][$key];

                move_uploaded_file(
                    $tmp,
                    "../assets/upload/project/".$gallery_name
                );

                $caption =
                $_POST['caption'][$key];

                mysqli_query($conn,"
                    INSERT INTO project_gallery
                    (
                        project_id,
                        image,
                        caption
                    )
                    VALUES
                    (
                        '$project_id',
                        '$gallery_name',
                        '$caption'
                    )
                ");
            }
        }
    }

    header("Location: projects.php");
    exit;
}

/* DELETE */

if(isset($_GET['delete'])){

    $id = intval($_GET['delete']);

    mysqli_query($conn,"
        DELETE FROM projects
        WHERE id='$id'
    ");

    mysqli_query($conn,"
        DELETE FROM project_gallery
        WHERE project_id='$id'
    ");

    header("Location: projects.php");
    exit;
}

$data = mysqli_query($conn,"
    SELECT *
    FROM projects
    ORDER BY id DESC
");

?>

<!DOCTYPE html>
<html>
<head>

<title>Projects</title>

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&display=swap"
rel="stylesheet">

<style>

body{
    background:#050816;
    color:white;
    font-family:'Sora',sans-serif;
    margin:0;
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

    padding:14px 24px;

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

.project{

    background:#111827;

    padding:20px;

    border-radius:20px;

    margin-top:20px;
}

.project img{

    width:100%;

    height:250px;

    object-fit:cover;

    border-radius:20px;
}

.project h2{
    margin-top:20px;
}

.delete{
    color:red;
    text-decoration:none;
}

.back{
    display:inline-block;
    margin-bottom:30px;
    color:white;
    text-decoration:none;
}

.gallery-box{

    background:#0f172a;

    padding:20px;

    border-radius:20px;

    margin-bottom:20px;
}

.gallery-title{

    margin-bottom:15px;

    font-size:15px;

    color:#cbd5e1;
}

small{
    color:#94a3b8;
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
            Manage Projects
        </h1>

        <br>

        <form
        method="POST"
        enctype="multipart/form-data">

            <!-- TITLE -->

            <input
            type="text"
            name="title"
            placeholder="Project Title"
            required>

            <!-- DESCRIPTION -->

            <textarea
            name="description"
            placeholder="Project Description"
            required></textarea>

            <!-- COVER -->

            <small>
                Cover Image
            </small>

            <input
            type="file"
            name="image"
            required>

            <br><br>

            <!-- GALLERY -->

            <div class="gallery-box">

                <div class="gallery-title">

                    Gallery Image 1

                </div>

                <input
                type="file"
                name="gallery[]">

                <textarea
                name="caption[]"
                placeholder="Caption / Description"></textarea>

            </div>

            <div class="gallery-box">

                <div class="gallery-title">

                    Gallery Image 2

                </div>

                <input
                type="file"
                name="gallery[]">

                <textarea
                name="caption[]"
                placeholder="Caption / Description"></textarea>

            </div>

            <div class="gallery-box">

                <div class="gallery-title">

                    Gallery Image 3

                </div>

                <input
                type="file"
                name="gallery[]">

                <textarea
                name="caption[]"
                placeholder="Caption / Description"></textarea>

            </div>

            <button name="add">

                Add Project

            </button>

        </form>

        <br><br>

        <!-- LIST -->

        <?php while($d=mysqli_fetch_assoc($data)): ?>

        <div class="project">

            <img
            src="../assets/upload/project/<?= $d['image']; ?>">

            <h2>
                <?= $d['title']; ?>
            </h2>

            <p>
                <?= $d['description']; ?>
            </p>

            <br>

            <a
            href="../project/detail.php?id=<?= $d['id']; ?>"
            target="_blank">

                View Detail

            </a>

            |

            <a
            href="?delete=<?= $d['id']; ?>"
            class="delete"
            onclick="return confirm('Delete project?')">

                Delete

            </a>

        </div>

        <?php endwhile; ?>

    </div>

</div>

</body>
</html>