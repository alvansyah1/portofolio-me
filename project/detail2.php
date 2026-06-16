<?php

include '../koneksi.php';

if(!isset($_GET['id'])){
    header("Location: ../index.php");
    exit;
}

$id = intval($_GET['id']);

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM projects WHERE id='$id'")
);

if(!$data){
    header("Location: ../index.php");
    exit;
}

$gallery = mysqli_query($conn,"
    SELECT *
    FROM project_gallery
    WHERE project_id='$id'
    ORDER BY id ASC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $data['title']; ?> | Project Detail</title>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>

:root{
    --bg:#f7f4ef;
    --text:#111827;
    --muted:#6b7280;
    --line:#ece7df;
    --gradient: linear-gradient(135deg,#ff8a00,#ff3d81,#7c4dff);
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Outfit',sans-serif;
    background:var(--bg);
    color:var(--text);
    overflow-x:hidden;
}

/* BACKGROUND */
.bg-blur{
    position:fixed;
    inset:0;
    z-index:-2;
}

.blur{
    position:absolute;
    border-radius:50%;
    filter:blur(120px);
}

.blur1{
    width:380px;
    height:380px;
    background:rgba(255,138,0,.14);
    top:-120px;
    left:-120px;
}

.blur2{
    width:380px;
    height:380px;
    background:rgba(124,77,255,.14);
    bottom:-140px;
    right:-120px;
}

/* CONTAINER */
.container{
    width:92%;
    max-width:1140px;
    margin:auto;
    padding:40px 0 90px;
}

/* NAVBAR */
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 24px;
    margin-bottom:28px;

    background:rgba(255,255,255,.65);
    backdrop-filter:blur(16px);

    border:1px solid rgba(255,255,255,.8);
    border-radius:22px;
}

.logo{
    font-size:22px;
    font-weight:900;
    background:var(--gradient);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.back-btn{
    padding:12px 18px;
    border-radius:14px;
    text-decoration:none;
    color:#fff;
    font-weight:700;
    background:var(--gradient);
    transition:.3s;
}

.back-btn:hover{
    transform:translateY(-3px);
}

/* CARD */
.detail-card{
    background:rgba(255,255,255,.72);
    backdrop-filter:blur(18px);
    border-radius:34px;
    overflow:hidden;
    border:1px solid rgba(255,255,255,.8);
}

/* HERO */
.cover-wrap{
    padding:16px;
}

.cover-image{
    width:100%;
    height:460px;
    object-fit:cover;
    border-radius:26px;
}

/* CONTENT */
.content{
    padding:10px 40px 50px;
}

.title{
    font-size:44px;
    font-weight:900;
    margin:18px 0;
    line-height:1.1;
}

.description{
    color:var(--muted);
    line-height:1.9;
    font-size:16px;
}

/* INFO */
.info-grid{
    margin-top:30px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:14px;
}

.info-box{
    background:white;
    padding:20px;
    border-radius:18px;
    border:1px solid var(--line);
    transition:.3s;
}

.info-box:hover{
    transform:translateY(-5px);
}

/* ===== CINEMATIC GALLERY ===== */

.gallery-section{
    margin-top:55px;
}

.section-title{
    font-size:24px;
    font-weight:800;
    margin-bottom:18px;
}

.cinematic-wrap{
    position:relative;
    border-radius:24px;
    overflow:hidden;
    background:black;
    box-shadow:0 25px 70px rgba(0,0,0,.25);
}

.cinematic-frame{
    position:relative;
    height:420px;
}

.cinematic-slide{
    position:absolute;
    width:100%;
    height:100%;
    object-fit:cover;

    opacity:0;
    transform:scale(1.08);

    transition:opacity 1.2s ease, transform 1.5s ease;
    cursor:pointer;
}

.cinematic-slide.active{
    opacity:1;
    transform:scale(1);
}

.cinematic-wrap::after{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(to top,rgba(0,0,0,.4),transparent);
    pointer-events:none;
}

/* PROGRESS */
.cinematic-progress{
    position:absolute;
    bottom:0;
    left:0;
    width:100%;
    height:4px;
    background:rgba(255,255,255,.15);
}

.cinematic-bar{
    height:100%;
    width:0%;
    background:linear-gradient(90deg,#ff8a00,#ff3d81,#7c4dff);
}

/* CONTROLS */
.cinematic-controls{
    position:absolute;
    bottom:18px;
    right:18px;
    display:flex;
    gap:10px;
}

.cinematic-controls button{
    width:42px;
    height:42px;
    border:none;
    border-radius:50%;
    background:rgba(255,255,255,.15);
    color:white;
    backdrop-filter:blur(10px);
    cursor:pointer;
    font-size:18px;
    transition:.3s;
}

.cinematic-controls button:hover{
    background:rgba(255,255,255,.3);
    transform:scale(1.1);
}

/* BUTTONS */
.buttons{
    margin-top:50px;
    display:flex;
    gap:14px;
    flex-wrap:wrap;
}

.btn{
    padding:14px 22px;
    border-radius:14px;
    font-weight:700;
    text-decoration:none;
    transition:.3s;
}

.btn-primary{
    background:var(--gradient);
    color:white;
}

.btn-outline{
    background:white;
    border:1px solid var(--line);
}

/* LIGHTBOX */
.lightbox{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.92);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:9999;
    padding:20px;
}

.lightbox img{
    max-width:95%;
    max-height:90%;
    border-radius:18px;
}

/* MOBILE */
@media(max-width:768px){
    .cover-image{ height:260px; }
    .cinematic-frame{ height:260px; }
    .content{ padding:10px 20px; }
    .navbar{ flex-direction:column; gap:10px; }
}

</style>

</head>

<body>

<div class="bg-blur">
    <div class="blur blur1"></div>
    <div class="blur blur2"></div>
</div>

<div class="container">

    <div class="navbar">
        <div class="logo">Project Detail</div>
        <a href="../index.php#projects" class="back-btn">← Back</a>
    </div>

    <div class="detail-card">

        <div class="cover-wrap">
            <img src="../assets/upload/project/<?= $data['image']; ?>" class="cover-image">
        </div>

        <div class="content">

            <h1 class="title"><?= $data['title']; ?></h1>

            <div class="description">
                <?= nl2br($data['description']); ?>
            </div>

            <div class="info-grid">

                <div class="info-box">
                    <h4>Type</h4>
                    <p>Web App</p>
                </div>

                <div class="info-box">
                    <h4>Tech</h4>
                    <p>PHP • MySQL • JS</p>
                </div>

                <div class="info-box">
                    <h4>Status</h4>
                    <p>Completed</p>
                </div>

                <div class="info-box">
                    <h4>Category</h4>
                    <p>Software Dev</p>
                </div>

            </div>

            <?php if(mysqli_num_rows($gallery) > 0): ?>

            <div class="gallery-section">

                <h2 class="section-title">Project Gallery</h2>

                <div class="cinematic-wrap">

                    <div class="cinematic-frame" id="frame">

                        <?php 
                        $g2 = mysqli_query($conn,"
                            SELECT * FROM project_gallery
                            WHERE project_id='$id'
                            ORDER BY id ASC
                        ");

                        while($g=mysqli_fetch_assoc($g2)):
                        ?>

                        <img 
                            src="../assets/upload/project/<?= $g['image']; ?>"
                            class="cinematic-slide previewImage">

                        <?php endwhile; ?>

                    </div>

                    <div class="cinematic-progress">
                        <div class="cinematic-bar" id="bar"></div>
                    </div>

                    <div class="cinematic-controls">
                        <button id="prev">‹</button>
                        <button id="play">⏸</button>
                        <button id="next">›</button>
                    </div>

                </div>

            </div>

            <?php endif; ?>

            <div class="buttons">
                <a href="../index.php#projects" class="btn btn-primary">More Projects</a>
                <a href="https://wa.me/6280000000000" class="btn btn-outline">Contact</a>
            </div>

        </div>

    </div>

</div>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox">
    <img id="lightboxImg">
</div>

<script>

// SLIDESHOW
const slides = document.querySelectorAll('.cinematic-slide');
const bar = document.getElementById('bar');

let i = 0;
let playing = true;
let duration = 4000;
let progress = 0;

function show(n){
    slides.forEach((s,idx)=>{
        s.classList.remove('active');
        if(idx === n) s.classList.add('active');
    });
    i = n;
    progress = 0;
}

function next(){
    i = (i + 1) % slides.length;
    show(i);
}

let interval = setInterval(next, duration);

// progress bar
setInterval(()=>{
    if(playing){
        progress += 100 / (duration/100);
        if(progress > 100) progress = 0;
        bar.style.width = progress + '%';
    }
},100);

// controls
document.getElementById('next').onclick = ()=> next();

document.getElementById('prev').onclick = ()=>{
    i = (i - 1 + slides.length) % slides.length;
    show(i);
};

document.getElementById('play').onclick = (e)=>{
    if(playing){
        clearInterval(interval);
        playing = false;
        e.target.innerHTML = '▶';
    }else{
        interval = setInterval(next, duration);
        playing = true;
        e.target.innerHTML = '⏸';
    }
};

// hover pause
document.querySelector('.cinematic-wrap').onmouseenter = ()=>{
    clearInterval(interval);
    playing = false;
};

document.querySelector('.cinematic-wrap').onmouseleave = ()=>{
    interval = setInterval(next, duration);
    playing = true;
};

// lightbox
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightboxImg');

document.querySelectorAll('.previewImage').forEach(img=>{
    img.onclick = function(){
        lightbox.style.display = 'flex';
        lightboxImg.src = this.src;
    }
});

lightbox.onclick = ()=> lightbox.style.display='none';

</script>

</body>
</html>