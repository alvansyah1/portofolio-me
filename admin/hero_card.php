<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

/* ADD */

if(isset($_POST['add'])){

    $title          = $_POST['title'];
    $description    = $_POST['description'];

    mysqli_query($conn,"
        INSERT INTO hero_cards
        (title,description)
        VALUES
        (
            '$title',
            '$description'
        )
    ");

    header("Location: hero_card.php");
}

/* DELETE */

if(isset($_GET['delete'])){

    mysqli_query($conn,"
        DELETE FROM hero_cards
        WHERE id='$_GET[delete]'
    ");

    header("Location: hero_card.php");
}

/* DATA */

$data = mysqli_query($conn,"
    SELECT * FROM hero_cards
    ORDER BY id DESC
");

?>

<!DOCTYPE html>
<html>
<head>

<title>
Manage Hero Cards
</title>

<link
href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    background:#050816;

    color:white;

    font-family:'Inter',sans-serif;

    overflow-x:hidden;
}

/* BACKGROUND */

body::before{

    content:'';

    position:fixed;

    width:500px;
    height:500px;

    background:rgba(124,58,237,.20);

    filter:blur(140px);

    top:-200px;
    left:-200px;

    z-index:-1;
}

body::after{

    content:'';

    position:fixed;

    width:500px;
    height:500px;

    background:rgba(6,182,212,.15);

    filter:blur(140px);

    bottom:-200px;
    right:-200px;

    z-index:-1;
}

.container{

    width:90%;

    max-width:1250px;

    margin:auto;

    padding:50px 0;
}

.back{

    display:inline-flex;

    align-items:center;

    gap:10px;

    margin-bottom:30px;

    color:white;

    text-decoration:none;

    font-size:15px;
}

.box{

    background:rgba(255,255,255,.05);

    padding:45px;

    border-radius:35px;

    border:1px solid rgba(255,255,255,.08);

    backdrop-filter:blur(25px);
}

.title-box{

    margin-bottom:40px;
}

.title-box h1{

    font-size:38px;

    margin-bottom:10px;
}

.title-box p{

    color:#94a3b8;

    line-height:1.8;
}

/* FORM */

.form-box{

    background:rgba(255,255,255,.03);

    padding:30px;

    border-radius:28px;

    border:1px solid rgba(255,255,255,.06);

    margin-bottom:50px;
}

.form-group{

    margin-bottom:22px;
}

label{

    display:block;

    margin-bottom:12px;

    font-size:14px;

    color:#cbd5e1;
}

input,
textarea{

    width:100%;

    padding:18px;

    border:none;

    border-radius:18px;

    background:#111827;

    color:white;

    font-size:15px;

    font-family:'Inter',sans-serif;

    border:1px solid transparent;

    transition:.3s;
}

input:focus,
textarea:focus{

    outline:none;

    border-color:#06b6d4;

    box-shadow:
    0 0 0 4px rgba(6,182,212,.10);
}

textarea{

    height:130px;

    resize:none;
}

button{

    padding:16px 30px;

    border:none;

    border-radius:18px;

    background:linear-gradient(
        135deg,
        #7c3aed,
        #06b6d4,
        #ec4899
    );

    color:white;

    font-weight:600;

    font-size:15px;

    cursor:pointer;

    transition:.3s;
}

button:hover{

    transform:translateY(-4px);

    box-shadow:
    0 15px 35px rgba(124,58,237,.35);
}

/* GRID */

.cards-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(320px,1fr));

    gap:25px;
}

.card{

    position:relative;

    padding:35px;

    border-radius:30px;

    background:rgba(255,255,255,.04);

    border:1px solid rgba(255,255,255,.08);

    overflow:hidden;

    transition:.4s;

    backdrop-filter:blur(20px);
}

.card::before{

    content:'';

    position:absolute;

    width:180px;
    height:180px;

    background:rgba(124,58,237,.20);

    filter:blur(80px);

    top:-80px;
    right:-80px;

    opacity:0;

    transition:.4s;
}

.card:hover{

    transform:translateY(-10px);

    border-color:rgba(6,182,212,.35);
}

.card:hover::before{

    opacity:1;
}

.card-icon{

    width:70px;
    height:70px;

    border-radius:22px;

    display:flex;

    justify-content:center;
    align-items:center;

    background:rgba(255,255,255,.05);

    border:1px solid rgba(255,255,255,.08);

    margin-bottom:22px;

    font-size:28px;

    color:#06b6d4;
}

.card h3{

    font-size:26px;

    margin-bottom:14px;
}

.card p{

    color:#94a3b8;

    line-height:1.9;

    margin-bottom:25px;

    font-size:14px;
}

.delete{

    display:inline-flex;

    align-items:center;

    gap:8px;

    padding:12px 18px;

    border-radius:14px;

    background:#ef444420;

    color:#ef4444;

    text-decoration:none;

    font-size:14px;

    transition:.3s;
}

.delete:hover{

    background:#ef444440;
}

/* EMPTY */

.empty{

    text-align:center;

    padding:60px 20px;

    color:#94a3b8;

    border:1px dashed rgba(255,255,255,.08);

    border-radius:30px;
}

/* MOBILE */

@media(max-width:768px){

    .box{

        padding:25px;
    }

    .title-box h1{

        font-size:30px;
    }

    .card{

        padding:28px;
    }
}

</style>

</head>

<body>

<div class="container">

    <a href="../dashboard.php"
    class="back">

        <i class="fa-solid fa-arrow-left"></i>

        Back Dashboard

    </a>

    <div class="box">

        <div class="title-box">

            <h1>
                Manage Hero Cards
            </h1>

            <p>
                Add floating hero cards that appear around your profile image on the portfolio homepage.
            </p>

        </div>

        <!-- FORM -->

        <div class="form-box">

            <form method="POST">

                <div class="form-group">

                    <label>
                        Card Title
                    </label>

                    <input
                    type="text"
                    name="title"
                    placeholder="Example: AI Interface"
                    required>

                </div>

                <div class="form-group">

                    <label>
                        Card Description
                    </label>

                    <textarea
                    name="description"
                    placeholder="Example: Modern premium UI/UX development."
                    required></textarea>

                </div>

                <button name="add">

                    <i class="fa-solid fa-plus"></i>

                    Add Hero Card

                </button>

            </form>

        </div>

        <!-- LIST -->

        <?php if(mysqli_num_rows($data) > 0): ?>

        <div class="cards-grid">

            <?php while($d=mysqli_fetch_assoc($data)): ?>

            <div class="card">

                <div class="card-icon">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

                <h3>
                    <?= $d['title']; ?>
                </h3>

                <p>
                    <?= $d['description']; ?>
                </p>

                <a
                href="?delete=<?= $d['id']; ?>"
                class="delete"
                onclick="return confirm('Delete this hero card?')">

                    <i class="fa-solid fa-trash"></i>

                    Delete

                </a>

            </div>

            <?php endwhile; ?>

        </div>

        <?php else: ?>

        <div class="empty">

            No hero cards yet.

        </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>