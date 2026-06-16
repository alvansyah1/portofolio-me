<?php

session_start();

include '../koneksi.php';

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
}

/* ADD SKILL */

if(isset($_POST['add'])){

    $name           = $_POST['name'];

    $iconPicker     = $_POST['icon_picker'] ?? '';
    $iconCustom     = $_POST['icon_custom'] ?? '';

    $description    = $_POST['description'];

    /* PRIORITAS CUSTOM ICON */

    if(!empty($iconCustom)){

        $icon = $iconCustom;

    }else{

        $icon = $iconPicker;
    }

    mysqli_query($conn,"
        INSERT INTO skills
        (name,icon,description)
        VALUES
        (
            '$name',
            '$icon',
            '$description'
        )
    ");

    header("Location: skills.php");
}

/* DELETE */

if(isset($_GET['delete'])){

    mysqli_query($conn,"
        DELETE FROM skills
        WHERE id='$_GET[delete]'
    ");

    header("Location: skills.php");
}

/* DATA */

$data = mysqli_query($conn,"
    SELECT * FROM skills
    ORDER BY id DESC
");

/* ICON LIST */

$icons = [

    "fa-solid fa-code",
    "fa-solid fa-database",
    "fa-solid fa-server",
    "fa-solid fa-globe",
    "fa-solid fa-mobile-screen",
    "fa-solid fa-laptop-code",
    "fa-solid fa-terminal",
    "fa-solid fa-cloud",
    "fa-solid fa-shield-halved",
    "fa-solid fa-chart-line",
    "fa-solid fa-palette",
    "fa-solid fa-gear",
    "fa-solid fa-microchip",
    "fa-solid fa-network-wired",
    "fa-solid fa-bug",
    "fa-solid fa-brain",
    "fa-brands fa-html5",
    "fa-brands fa-css3-alt",
    "fa-brands fa-js",
    "fa-brands fa-php",
    "fa-brands fa-laravel",
    "fa-brands fa-react",
    "fa-brands fa-vuejs",
    "fa-brands fa-node-js",
    "fa-brands fa-python",
    "fa-brands fa-java",
    "fa-brands fa-github",
    "fa-brands fa-figma",
    "fa-brands fa-wordpress"

];

?>

<!DOCTYPE html>
<html>
<head>

<title>
Manage Skills
</title>

<link
href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&display=swap"
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

    font-family:'Sora',sans-serif;
}

.container{

    width:90%;

    max-width:1200px;

    margin:auto;

    padding:50px 0;
}

.back{

    display:inline-block;

    margin-bottom:30px;

    color:white;

    text-decoration:none;
}

.box{

    background:rgba(255,255,255,.05);

    padding:40px;

    border-radius:30px;

    border:1px solid rgba(255,255,255,.08);
}

h1{

    margin-bottom:30px;
}

.form-group{

    margin-bottom:25px;
}

input,
textarea{

    width:100%;

    padding:16px;

    border:none;

    border-radius:18px;

    background:#111827;

    color:white;

    font-family:'Sora',sans-serif;
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

    cursor:pointer;

    font-weight:600;
}

/* ICON PICKER */

.icon-picker{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(70px,1fr));

    gap:15px;

    margin-top:20px;
}

.icon-option{

    position:relative;
}

.icon-option input{

    display:none;
}

.icon-label{

    height:70px;

    border-radius:20px;

    display:flex;

    justify-content:center;
    align-items:center;

    background:#111827;

    border:2px solid transparent;

    cursor:pointer;

    transition:.3s;

    font-size:26px;
}

.icon-label:hover{

    transform:translateY(-5px);

    border-color:#06b6d4;
}

.icon-option input:checked + .icon-label{

    border-color:#06b6d4;

    background:linear-gradient(
        135deg,
        rgba(124,58,237,.25),
        rgba(6,182,212,.25)
    );

    color:#06b6d4;
}

.preview{

    margin-top:10px;

    color:#94a3b8;

    font-size:14px;

    line-height:1.8;
}

/* GRID */

.skills-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(320px,1fr));

    gap:25px;

    margin-top:50px;
}

.skill-card{

    position:relative;

    padding:35px;

    border-radius:30px;

    background:#111827;

    border:1px solid rgba(255,255,255,.08);

    overflow:hidden;

    transition:.4s;
}

.skill-card:hover{

    transform:translateY(-8px);
}

.skill-card::before{

    content:'';

    position:absolute;

    width:180px;
    height:180px;

    background:rgba(124,58,237,.18);

    filter:blur(80px);

    top:-80px;
    right:-80px;
}

.skill-icon{

    width:75px;
    height:75px;

    border-radius:22px;

    display:flex;

    justify-content:center;
    align-items:center;

    margin-bottom:25px;

    font-size:30px;

    background:rgba(255,255,255,.05);

    border:1px solid rgba(255,255,255,.08);

    color:#06b6d4;
}

.skill-card h3{

    margin-bottom:15px;

    font-size:24px;
}

.skill-card p{

    color:#94a3b8;

    line-height:1.8;

    margin-bottom:25px;
}

.delete{

    display:inline-block;

    padding:10px 18px;

    border-radius:14px;

    background:#ef444420;

    color:#ef4444;

    text-decoration:none;

    font-size:14px;
}

.delete:hover{

    background:#ef444440;
}

/* MOBILE */

@media(max-width:768px){

    .box{

        padding:25px;
    }

    .icon-picker{

        grid-template-columns:
        repeat(auto-fit,minmax(60px,1fr));
    }

    .icon-label{

        height:60px;

        font-size:22px;
    }
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
            Manage Skills
        </h1>

        <!-- FORM -->

        <form method="POST">

            <div class="form-group">

                <input
                type="text"
                name="name"
                placeholder="Skill Title"
                required>

            </div>

            <!-- ICON PICKER -->

            <div class="form-group">

                <h3 style="margin-bottom:20px;">
                    Choose Icon
                </h3>

                <div class="icon-picker">

                    <?php foreach($icons as $icon): ?>

                    <div class="icon-option">

                        <input
                        type="radio"
                        name="icon_picker"
                        value="<?= $icon; ?>"
                        id="<?= md5($icon); ?>">

                        <label
                        class="icon-label"
                        for="<?= md5($icon); ?>">

                            <i class="<?= $icon; ?>"></i>

                        </label>

                    </div>

                    <?php endforeach; ?>

                </div>

            </div>

            <!-- CUSTOM ICON -->

            <div class="form-group">

                <input
                type="text"
                name="icon_custom"
                placeholder="Or custom icon... Example: fa-solid fa-code">

                <div class="preview">

                    Example:
                    fa-solid fa-code,
                    fa-brands fa-github,
                    fa-solid fa-server

                </div>

            </div>

            <!-- DESCRIPTION -->

            <div class="form-group">

                <textarea
                name="description"
                placeholder="Skill Description"
                required></textarea>

            </div>

            <button name="add">

                Add Skill

            </button>

        </form>

        <!-- LIST -->

        <div class="skills-grid">

            <?php while($d=mysqli_fetch_assoc($data)): ?>

            <div class="skill-card">

                <div class="skill-icon">

                    <i class="<?= $d['icon']; ?>"></i>

                </div>

                <h3>
                    <?= $d['name']; ?>
                </h3>

                <p>
                    <?= $d['description']; ?>
                </p>

                <a
                href="?delete=<?= $d['id']; ?>"
                class="delete"
                onclick="return confirm('Delete this skill?')">

                    Delete

                </a>

            </div>

            <?php endwhile; ?>

        </div>

    </div>

</div>

</body>
</html>