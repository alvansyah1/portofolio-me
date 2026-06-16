<?php

include '../koneksi.php';

$project_id = $_GET['id'];

if(isset($_POST['add'])){

    $title = $_POST['title'];

    $description = $_POST['description'];

    $image =
    time().$_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../assets/upload/project/".$image
    );

    mysqli_query($conn,"
        INSERT INTO project_gallery
        (
            project_id,
            title,
            description,
            image
        )
        VALUES
        (
            '$project_id',
            '$title',
            '$description',
            '$image'
        )
    ");
}

$data = mysqli_query($conn,"
    SELECT *
    FROM project_gallery
    WHERE project_id='$project_id'
");

?>

<form method="POST" enctype="multipart/form-data">

    <input
    type="text"
    name="title"
    placeholder="Title">

    <textarea
    name="description"
    placeholder="Description"></textarea>

    <input
    type="file"
    name="image">

    <button name="add">

        Upload

    </button>

</form>

<hr>

<?php while($d=mysqli_fetch_assoc($data)): ?>

    <img
    src="../assets/upload/project/<?= $d['image']; ?>"
    width="300">

    <h3>
        <?= $d['title']; ?>
    </h3>

    <p>
        <?= $d['description']; ?>
    </p>

<?php endwhile; ?>