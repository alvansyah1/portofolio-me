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
    SELECT * FROM project_gallery
    WHERE project_id='$id'
    ORDER BY id ASC
");

$images = [];

/* COVER JADI SLIDE PERTAMA */
$images[] = $data['image'];

while($g = mysqli_fetch_assoc($gallery)){
    $images[] = $g['image'];
}

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

*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:'Outfit',sans-serif;
    background:var(--bg);
    color:var(--text);
}

/* CONTAINER */
.container{
    width:92%;
    max-width:1100px;
    margin:auto;
    padding:40px 0;
}

/* NAV */
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px;
    border-radius:20px;
    background:rgba(255,255,255,.7);
    backdrop-filter:blur(14px);
    margin-bottom:25px;
}

.logo{
    font-weight:900;
    background:var(--gradient);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.back-btn{
    padding:10px 16px;
    border-radius:12px;
    background:var(--gradient);
    color:white;
    text-decoration:none;
    font-weight:700;
}

/* CARD */
.card{
    background:rgba(255,255,255,.75);
    border-radius:30px;
    padding:18px;
    border:1px solid #eee;
}

/* TITLE */
.title{
    font-size:42px;
    font-weight:900;
    margin:18px 0 10px;
}

.desc{
    color:var(--muted);
    line-height:1.8;
}

/* INFO */
.info{
    margin-top:25px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:12px;
}

.box{
    background:#fff;
    padding:18px;
    border-radius:16px;
    border:1px solid var(--line);
}

/* =========================
   🔥 GALLERY UPGRADE
========================= */

.gallery{
    margin-top:50px;
}

.section-title{
    font-size:22px;
    font-weight:800;
    margin-bottom:15px;
}

/* MAIN SLIDER */
.slider{
    position:relative;
    border-radius:22px;
    overflow:hidden;
    background:#000;
}

.slide{
    width:100%;
    height:460px;
    object-fit:contain;
    background:#fff;

    display:none;
    animation:fade .5s ease;
}

.slide.active{
    display:block;
}

@keyframes fade{
    from{opacity:0; transform:scale(1.02);}
    to{opacity:1; transform:scale(1);}
}

/* ARROW */
.nav{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    width:55px;
    height:55px;
    border:none;
    border-radius:50%;
    background:rgba(0,0,0,.55);
    color:#fff;
    font-size:26px;
    cursor:pointer;
    transition:.3s;
}

.nav:hover{
    background:rgba(0,0,0,.85);
    transform:translateY(-50%) scale(1.1);
}

.nav.left{left:12px;}
.nav.right{right:12px;}

/* THUMBNAIL SCROLL (AUTO UX) */
.thumb{
    display:flex;
    gap:10px;
    overflow-x:auto;
    margin-top:12px;
    padding-bottom:8px;
    scroll-behavior:smooth;
}

.thumb img{
    width:120px;
    height:90px;
    object-fit:cover;
    border-radius:12px;
    cursor:pointer;
    opacity:.5;
    transition:.3s;
    border:2px solid transparent;
    flex:0 0 auto;
}

.thumb img.active{
    opacity:1;
    border:2px solid #ff3d81;
    transform:scale(1.05);
}

/* BUTTON */
.btns{
    margin-top:35px;
    display:flex;
    gap:12px;
}

.btn{
    padding:12px 18px;
    border-radius:12px;
    font-weight:700;
    text-decoration:none;
}

.primary{
    background:var(--gradient);
    color:#fff;
}

.outline{
    border:1px solid #ddd;
}

/* MOBILE */
@media(max-width:768px){
    .slide{height:300px;}
}

</style>

</head>

<body>

<div class="container">

    <div class="navbar">
        <div class="logo">PROJECT DETAIL</div>
        <a class="back-btn" href="../index.php#projects">Back</a>
    </div>

    <div class="card">

        <h1 class="title"><?= $data['title']; ?></h1>

        <div class="desc">
            <?= nl2br($data['description']); ?>
        </div>

        <div class="info">
            <div class="box"><b>Type</b><br>Web App</div>
            <div class="box"><b>Tech</b><br>PHP • MySQL</div>
            <div class="box"><b>Status</b><br>Completed</div>
            <div class="box"><b>Category</b><br>Software</div>
        </div>

        <!-- GALLERY -->
        <div class="gallery">

            <h2 class="section-title">Project Gallery</h2>

            <div class="slider">

                <?php foreach($images as $i => $img): ?>
                    <img class="slide <?= $i==0?'active':'' ?>"
                         src="../assets/upload/project/<?= $img; ?>">
                <?php endforeach; ?>

                <button class="nav left" onclick="prev()">‹</button>
                <button class="nav right" onclick="next()">›</button>

            </div>

            <div class="thumb" id="thumbs">
                <?php foreach($images as $i=>$img): ?>
                    <img src="../assets/upload/project/<?= $img; ?>" onclick="go(<?= $i ?>)">
                <?php endforeach; ?>
            </div>

        </div>

        <div class="btns">
            <a class="btn primary" href="../index.php#projects">More</a>
            <a class="btn outline" href="https://wa.me/6289526124390">Contact</a>
        </div>

    </div>

</div>

<script>

let slides = document.querySelectorAll('.slide');
let thumbs = document.querySelectorAll('.thumb img');

let i = 0;

/* AUTO SLIDE 4 DETIK */
let auto = setInterval(next, 4000);

function show(n){
    slides.forEach(s=>s.classList.remove('active'));
    thumbs.forEach(t=>t.classList.remove('active'));

    slides[n].classList.add('active');
    thumbs[n].classList.add('active');

    thumbs[n].scrollIntoView({
        behavior:'smooth',
        inline:'center'
    });

    i = n;
}

function next(){
    show((i+1) % slides.length);
}

function prev(){
    show((i-1+slides.length) % slides.length);
}

function go(n){
    show(n);
}

/* pause on hover */
document.querySelector('.slider').onmouseenter = ()=> clearInterval(auto);
document.querySelector('.slider').onmouseleave = ()=> auto = setInterval(next, 4000);

/* keyboard */
document.addEventListener('keydown', e=>{
    if(e.key==="ArrowRight") next();
    if(e.key==="ArrowLeft") prev();
});

show(0);

</script>

</body>
</html>