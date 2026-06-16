<?php

include 'koneksi.php';

$heroCards = mysqli_query($conn,"
    SELECT * FROM hero_cards
");

$profile = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT * FROM profile LIMIT 1
    ")
);

$skills = mysqli_query($conn,"
    SELECT * FROM skills
");

$projects = mysqli_query($conn,"
    SELECT * FROM projects
    ORDER BY id DESC
");

$experience = mysqli_query($conn,"
    SELECT * FROM experience
    ORDER BY id DESC
");


$socials = mysqli_query($conn,"
    SELECT * FROM social_links
    ORDER BY id ASC
");

if(isset($_POST['send'])){

    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $message    = $_POST['message'];

    mysqli_query($conn,"
        INSERT INTO contacts
        (name,email,message)
        VALUES
        (
            '$name',
            '$email',
            '$message'
        )
    ");

    echo "
    <script>
        alert('Message Sent Successfully');
        window.location='index.php#contact';
    </script>
    ";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
<?= $profile['name']; ?> | Premium Portfolio
</title>

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link
href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

:root{

    --bg:#f7f2eb;
    --card:#ffffff;
    --text:#1f2937;
    --muted:#6b7280;

    --gradient:
    linear-gradient(
        135deg,
        #ff8a00,
        #ff3d81,
        #7c4dff
    );
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    scroll-behavior:smooth;
}

body{

    font-family:'Outfit',sans-serif;

    background:
    linear-gradient(
        180deg,
        #f7f4ef,
        #eee5da
    );

    color:var(--text);

    overflow-x:hidden;
}

/* CURSOR */

.cursor{

    position:fixed;

    width:320px;
    height:320px;

    border-radius:50%;

    background:
    radial-gradient(
        circle,
        rgba(255,61,129,.12),
        transparent 70%
    );

    pointer-events:none;

    z-index:-1;

    transform:translate(-50%,-50%);
}

/* BACKGROUND */

.bg-blur{

    position:fixed;

    inset:0;

    z-index:-5;
}

.circle{

    position:absolute;

    border-radius:50%;

    filter:blur(120px);

    animation:float 10s infinite ease-in-out;
}

.circle1{

    width:450px;
    height:450px;

    background:rgba(255,138,0,.18);

    top:-100px;
    left:-100px;
}

.circle2{

    width:500px;
    height:500px;

    background:rgba(124,77,255,.15);

    bottom:-150px;
    right:-100px;
}

.circle3{

    width:300px;
    height:300px;

    background:rgba(255,61,129,.16);

    top:40%;
    left:40%;
}

@keyframes float{

    0%{
        transform:translateY(0px);
    }

    50%{
        transform:translateY(-25px);
    }

    100%{
        transform:translateY(0px);
    }
}

/* PARTICLES */

.particle{

    position:absolute;

    width:5px;
    height:5px;

    border-radius:50%;

    background:rgba(255,255,255,.7);

    animation:particle 14s linear infinite;
}

@keyframes particle{

    0%{
        transform:translateY(0);
        opacity:0;
    }

    50%{
        opacity:1;
    }

    100%{
        transform:translateY(-1000px);
        opacity:0;
    }
}

/* SOCIAL */

.social{

    position:fixed;

    left:25px;
    top:50%;

    transform:translateY(-50%);

    display:flex;
    flex-direction:column;

    gap:18px;

    z-index:999;
}

.social-item{

    position:relative;
}

.social a{

    width:58px;
    height:58px;

    border-radius:20px;

    display:flex;

    justify-content:center;
    align-items:center;

    text-decoration:none;

    color:#fff;

    font-size:21px;

    background:
    linear-gradient(
        135deg,
        rgba(255,255,255,.8),
        rgba(255,255,255,.45)
    );

    backdrop-filter:blur(20px);

    border:1px solid rgba(255,255,255,.6);

    box-shadow:
    0 10px 30px rgba(0,0,0,.12);

    transition:.35s;
}

.social a i{

    background:var(--gradient);

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.social a:hover{

    transform:
    translateY(-6px)
    scale(1.08);

    box-shadow:
    0 15px 35px rgba(255,61,129,.25);
}

.social-popup{

    position:absolute;

    left:78px;
    top:50%;

    transform:
    translateY(-50%)
    translateX(-10px);

    background:rgba(255,255,255,.92);

    backdrop-filter:blur(20px);

    padding:16px 18px;

    border-radius:18px;

    width:260px;

    opacity:0;
    visibility:hidden;

    transition:.35s;

    box-shadow:
    0 15px 35px rgba(0,0,0,.12);
}

.social-item:hover .social-popup{

    opacity:1;
    visibility:visible;

    transform:
    translateY(-50%)
    translateX(0);
}

.social-popup h4{

    font-size:15px;

    margin-bottom:5px;
}

.social-popup p{

    font-size:13px;

    color:#6b7280;

    margin-bottom:10px;
}

.social-popup span{

    display:inline-block;

    padding:10px 14px;

    border-radius:12px;

    background:var(--gradient);

    color:white;

    font-size:12px;

    font-weight:600;
}

/* NAVBAR */

.navbar{

    position:fixed;

    top:25px;
    left:50%;

    transform:translateX(-50%);

    width:92%;
    max-width:1350px;

    padding:18px 35px;

    background:rgba(255,255,255,.5);

    backdrop-filter:blur(20px);

    border-radius:30px;

    display:flex;

    justify-content:space-between;
    align-items:center;

    z-index:999;

    border:1px solid rgba(255,255,255,.5);

    box-shadow:
    0 10px 40px rgba(0,0,0,.06);
}

.logo{

    font-size:30px;

    font-weight:900;

    background:var(--gradient);

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.menu{

    display:flex;

    gap:35px;
}

.menu a{

    text-decoration:none;

    color:#111827;

    font-weight:600;

    transition:.3s;
}

.menu a:hover{

    color:#ff3d81;
}

.admin-btn{

    padding:14px 28px;

    border-radius:18px;

    text-decoration:none;

    color:white;

    background:var(--gradient);

    font-weight:700;

    transition:.4s;
}

.admin-btn:hover{

    transform:
    translateY(-5px)
    scale(1.05);
}

/* HERO */

.hero{

    min-height:100vh;

    display:grid;

    grid-template-columns:1.1fr .9fr;

    align-items:center;

    gap:70px;

    padding:150px 8% 80px;
}

.badge{

    display:inline-flex;

    align-items:center;

    gap:10px;

    padding:12px 24px;

    border-radius:999px;

    background:white;

    margin-bottom:30px;

    box-shadow:
    0 10px 25px rgba(0,0,0,.06);
}

.dot{

    width:10px;
    height:10px;

    border-radius:50%;

    background:#22c55e;
}

.hero h1{

    font-size:84px;

    line-height:1;

    margin-bottom:28px;

    font-weight:900;

    letter-spacing:-4px;
}

.gradient{

    background:var(--gradient);

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.hero p{

    color:var(--muted);

    line-height:2;

    font-size:18px;

    max-width:650px;
}

.hero-buttons{

    display:flex;

    gap:18px;

    margin-top:45px;

    flex-wrap:wrap;
}

.btn{

    padding:18px 34px;

    border-radius:22px;

    text-decoration:none;

    color:white;

    background:var(--gradient);

    font-weight:700;

    transition:.4s;
}

.btn:hover{

    transform:
    translateY(-7px)
    scale(1.03);
}

.btn-outline{

    padding:18px 34px;

    border-radius:22px;

    text-decoration:none;

    background:white;

    color:#111827;

    font-weight:700;

    transition:.4s;
}

.btn-outline:hover{

    background:#111827;

    color:white;

    transform:translateY(-7px);
}

/* PHOTO */

.hero-right{

    position:relative;

    display:flex;

    justify-content:center;
}

.hanger{

    position:relative;

    width:430px;
    height:580px;

    animation:swing 5s infinite ease-in-out;
}

@keyframes swing{

    0%{
        transform:rotate(1deg);
    }

    50%{
        transform:rotate(-1deg);
    }

    100%{
        transform:rotate(1deg);
    }
}

.rope{

    width:6px;
    height:120px;

    background:#9ca3af;

    position:absolute;

    top:-120px;
    left:50%;

    transform:translateX(-50%);
}

.pin{

    width:28px;
    height:28px;

    border-radius:50%;

    background:#111827;

    position:absolute;

    top:-135px;
    left:50%;

    transform:translateX(-50%);
}

.photo-frame{

    width:100%;
    height:100%;

    background:white;

    border-radius:40px;

    padding:18px;

    transition:.5s;

    box-shadow:
    0 40px 100px rgba(0,0,0,.18);
}

.photo-frame:hover{

    transform:
    rotateY(10deg)
    rotateX(4deg);
}

.photo-frame img{

    width:100%;
    height:100%;

    object-fit:cover;

    border-radius:28px;
}

/* FLOAT CARD */

.float-card{

    position:absolute;

    width:220px;

    padding:18px 22px;

    background:rgba(255,255,255,.72);

    backdrop-filter:blur(20px);

    border-radius:24px;

    border:1px solid rgba(255,255,255,.7);

    box-shadow:
    0 15px 40px rgba(0,0,0,.08);

    animation:floating 4s infinite ease-in-out;
}

.float-card h4{

    margin-bottom:8px;

    font-size:15px;
}

.float-card p{

    font-size:13px;

    color:#6b7280;

    line-height:1.8;
}

@keyframes floating{

    0%{
        transform:translateY(0);
    }

    50%{
        transform:translateY(-10px);
    }

    100%{
        transform:translateY(0);
    }
}

/* SECTION */

.section{

    padding:70px 8%;
}

.section-title{

    text-align:center;

    font-size:58px;

    margin-bottom:15px;

    font-weight:900;
}

.section-sub{

    text-align:center;

    color:#6b7280;

    max-width:700px;

    margin:auto auto 35px;

    line-height:1.9;
}

/* SKILLS */
.skills-wrapper{
    position:relative;
    width:100%;

    /* bikin section lebih “centered feel” */
    display:flex;
    justify-content:center;
}

/* SLIDER */
.skills-slider{
    display:grid;
    grid-auto-flow:column;
    grid-template-rows:repeat(2, 1fr);

    gap:16px;

    overflow-x:auto;
    scroll-behavior:smooth;

    scrollbar-width:none;

    padding:22px 40px;

    scroll-snap-type:x mandatory;
    -webkit-overflow-scrolling:touch;

    /* penting: bikin konten terasa di tengah */
    max-width:1100px;
    width:100%;
}

/* CARD */
.skill-card{
    width:175px;

    background:rgba(255,255,255,.72);
    backdrop-filter:blur(22px);

    border:1px solid rgba(255,255,255,.65);

    border-radius:22px;
    padding:16px;

    flex-shrink:0;

    box-shadow:
        0 10px 25px rgba(0,0,0,.06),
        inset 0 1px 0 rgba(255,255,255,.5);

    transition:all .28s ease;

    position:relative;
    overflow:hidden;

    scroll-snap-align:center;
}

/* hover lebih smooth (tidak terlalu “loncat”) */
.skill-card:hover{
    transform:translateY(-5px);
    box-shadow:
        0 18px 45px rgba(0,0,0,.12);
}

/* ICON */
.skill-icon{
    width:42px;
    height:42px;
    border-radius:14px;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:17px;

    background:linear-gradient(
        135deg,
        rgba(255,61,129,.20),
        rgba(124,77,255,.20)
    );

    color:#ff3d81;

    margin-bottom:12px;

    transition:.3s ease;
}

.skill-card:hover .skill-icon{
    transform:rotate(6deg) scale(1.08);
}

/* TEXT */
.skill-card h3{
    font-size:14.5px;
    margin-bottom:6px;
    font-weight:600;
    color:#1f1f1f;
}

.skill-card p{
    font-size:11.3px;
    line-height:1.5;
    color:rgba(0,0,0,.6);

    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

/* NAV BUTTON (lebih soft & center balance) */
.skill-nav{
    position:absolute;
    top:50%;
    transform:translateY(-50%);

    width:44px;
    height:44px;

    border:none;
    border-radius:50%;

    background:rgba(255,255,255,.88);
    backdrop-filter:blur(14px);

    cursor:pointer;
    z-index:10;

    box-shadow:0 8px 20px rgba(0,0,0,.10);

    display:flex;
    align-items:center;
    justify-content:center;

    transition:all .2s ease;
}

/* posisi lebih seimbang (tidak terlalu keluar) */
.skill-nav.left{ left:10px; }
.skill-nav.right{ right:10px; }

.skill-nav:hover{
    transform:translateY(-50%) scale(1.08);
    background:#fff;
}

/* edge fade diperhalus biar tidak “keras” */
.skills-wrapper::before,
.skills-wrapper::after{
    content:"";
    position:absolute;
    top:0;
    width:90px;
    height:100%;
    z-index:5;
    pointer-events:none;
}

.skills-wrapper::before{
    left:0;
    background:linear-gradient(to right, #f8f9fb, transparent);
}

.skills-wrapper::after{
    right:0;
    background:linear-gradient(to left, #f8f9fb, transparent);
}

/* PROJECT */

/* WRAPPER */
.projects-wrapper{
    position:relative;
    width:100%;
}

/* CAROUSEL */
.projects{
    display:grid;
    grid-auto-flow:column;
    grid-template-rows:1fr;

    gap:28px;

    overflow-x:auto;
    scroll-behavior:smooth;

    padding:30px 70px;

    scrollbar-width:none;

    scroll-snap-type:x mandatory;
}

.projects::-webkit-scrollbar{
    display:none;
}

/* CARD */
.project{
    width:380px;
    background:rgba(255,255,255,.85);
    backdrop-filter:blur(18px);

    border-radius:26px;
    overflow:hidden;

    border:1px solid rgba(255,255,255,.6);

    box-shadow:0 12px 30px rgba(0,0,0,.06);

    transition:.35s ease;

    scroll-snap-align:center;

    position:relative;
}

/* hover focus */
.project:hover{
    transform:translateY(-10px);
    box-shadow:0 25px 60px rgba(0,0,0,.12);
}

/* IMAGE */
.project-img-wrap{
    width:100%;
    height:250px;
    overflow:hidden;
}

.project img{
    width:100%;
    height:100%;
    object-fit:cover;

    transition:.6s ease;
}

.project:hover img{
    transform:scale(1.08);
}

/* CONTENT */
.project-content{
    padding:22px;
}

.project-content h3{
    font-size:21px;
    font-weight:600;
    margin-bottom:10px;
    color:#111827;
}

.project-content p{
    font-size:13.5px;
    color:rgba(107,114,128,.9);
    line-height:1.6;

    margin-bottom:16px;

    display:-webkit-box;
    -webkit-line-clamp:3;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

/* LINK CTA */
.project-content a{
    text-decoration:none;
    font-size:13px;
    font-weight:600;

    color:#ff3d81;

    display:inline-flex;
    align-items:center;
    gap:6px;

    transition:.25s ease;
}

.project-content a::after{
    content:"→";
    transition:.25s ease;
}

.project-content a:hover{
    transform:translateX(5px);
}

.project-content a:hover::after{
    transform:translateX(3px);
}

/* NAV BUTTON */
.project-nav{
    position:absolute;
    top:50%;
    transform:translateY(-50%);

    width:48px;
    height:48px;

    border:none;
    border-radius:50%;

    background:rgba(255,255,255,.9);
    backdrop-filter:blur(14px);

    cursor:pointer;

    z-index:10;

    box-shadow:0 10px 25px rgba(0,0,0,.12);

    display:flex;
    align-items:center;
    justify-content:center;

    transition:.2s ease;
}

.project-nav.left{ left:12px; }
.project-nav.right{ right:12px; }

.project-nav:hover{
    transform:translateY(-50%) scale(1.08);
}

/* soft glow accent (premium touch) */
.project::before{
    content:"";
    position:absolute;
    top:0;
    left:0;

    width:100%;
    height:3px;

    background:linear-gradient(90deg,#ff3d81,#7c4dff);
}

/* EXPERIENCE */

.timeline{

    max-width:950px;

    margin:auto;
}

.timeline-item{

    background:white;

    border-radius:35px;

    padding:35px;

    margin-bottom:25px;

    display:flex;

    gap:25px;

    transition:.4s;

    box-shadow:
    0 20px 40px rgba(0,0,0,.06);
}

.timeline-item:hover{

    transform:translateX(10px);
}

.timeline-item img{

    width:90px;
    height:90px;

    object-fit:cover;

    border-radius:25px;
}

.timeline-item h2{

    margin-bottom:8px;
}

.timeline-item h4{

    color:#ff3d81;

    margin-bottom:8px;
}

.timeline-item small{

    color:#6b7280;
}

.timeline-item p{

    margin-top:14px;

    color:#6b7280;

    line-height:1.8;
}

/* =========================
   EXPERIENCE FIX SLIDER
========================= */

.exp-wrapper{
    position:relative;
    width:100%;
}

/* 2 CARD PER VIEW (FIX PROPORSI) */
.exp-slider{
    display:grid;
    grid-auto-flow:column;

    /* 🔥 FIX: lebih stabil dari calc() */
    grid-auto-columns:50%;

    gap:24px;

    overflow-x:auto;
    scroll-behavior:smooth;
    scroll-snap-type:x mandatory;

    padding:20px 70px;

    scrollbar-width:none;
}

.exp-slider::-webkit-scrollbar{
    display:none;
}

/* CARD FIX (INI YANG BIKIN TIDAK MEMANJANG) */
.exp-card{
    background:rgba(255,255,255,.9);
    backdrop-filter:blur(18px);

    border-radius:26px;
    padding:26px;

    border:1px solid rgba(255,255,255,.6);

    box-shadow:0 12px 30px rgba(0,0,0,.06);

    scroll-snap-align:start;

    display:flex;
    flex-direction:column;

    /* 🔥 penting: jangan biarkan melebar aneh */
    min-height:240px;
}

/* HEADER */
.exp-top{
    display:flex;
    gap:14px;
    align-items:center;
    margin-bottom:12px;
}

.exp-top img{
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:16px;
}

/* POSITION */
.exp-card h4{
    font-size:15px;
    color:#ff3d81;
    margin:10px 0;
}

/* DESCRIPTION FIX */
.exp-card p{
    font-size:13.5px;
    color:rgba(107,114,128,.9);
    line-height:1.7;

    display:-webkit-box;
    -webkit-line-clamp:4;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

/* NAV */
.exp-nav{
    position:absolute;
    top:50%;
    transform:translateY(-50%);

    width:48px;
    height:48px;

    border:none;
    border-radius:50%;

    background:rgba(255,255,255,.95);
    cursor:pointer;

    z-index:10;
}

.exp-nav.left{left:10px;}
.exp-nav.right{right:10px;}

/* MOBILE */
@media(max-width:900px){
    .exp-slider{
        grid-auto-columns:85%;
        padding:20px 40px;
    }
}

/* CONTACT */

.contact-box{

    max-width:850px;

    margin:auto;

    background:white;

    padding:55px;

    border-radius:40px;

    box-shadow:
    0 20px 50px rgba(0,0,0,.08);
}

.form-grid{

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:20px;
}

input,
textarea{

    width:100%;

    padding:18px;

    border:none;

    border-radius:20px;

    background:#f3f4f6;

    margin-bottom:20px;

    font-family:'Outfit',sans-serif;
}

textarea{

    height:180px;

    resize:none;
}

input:focus,
textarea:focus{

    outline:none;

    background:white;

    box-shadow:
    0 0 0 3px rgba(255,61,129,.15);
}

/* FOOTER */

.footer{

    padding:70px;

    text-align:center;

    color:#6b7280;
}

/* REVEAL */

.reveal{

    opacity:1;

    transform:translateY(0);
}

/* MOBILE */

@media(max-width:1000px){

    .hero{

        grid-template-columns:1fr;

        text-align:center;

        padding-top:140px;
    }

    .hero h1{

        font-size:58px;
    }

    .menu{

        display:none;
    }

    .hero-buttons{

        justify-content:center;
    }

    .hanger{

        width:320px;
        height:430px;
    }

    .float-card{

        display:none;
    }

    .timeline-item{

        flex-direction:column;
    }

    .form-grid{

        grid-template-columns:1fr;
    }

    .social{

        display:none;
    }

    .section-title{

        font-size:42px;
    }
}

/* ABOUT ME CSS */

/* =========================
   CINEMATIC ABOUT MODAL
========================= */

.about-modal{
    position:fixed;
    inset:0;
    z-index:9999;
    display:none;
    align-items:center;
    justify-content:center;
}

.about-backdrop{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.65);
    backdrop-filter:blur(10px);
}

.about-card{
    position:relative;
    width:90%;
    max-width:850px;
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.2);
    backdrop-filter:blur(25px);
    border-radius:30px;
    padding:50px;
    color:white;
    box-shadow:0 30px 120px rgba(0,0,0,.6);
    animation:pop .6s ease;
    overflow:hidden;
}

.about-glow{
    position:absolute;
    width:400px;
    height:400px;
    background:radial-gradient(circle, rgba(255,61,129,.4), transparent 70%);
    top:-120px;
    left:-120px;
    filter:blur(40px);
}

.about-content{
    position:relative;
    z-index:2;
}

.about-content h1{
    font-size:34px;
    margin-bottom:20px;
}

.about-content p{
    color:#e5e7eb;
    line-height:1.9;
    margin-bottom:30px;
}

/* GRID BIODATA */
.about-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.about-item{
    background:rgba(255,255,255,.08);
    padding:18px;
    border-radius:18px;
    border:1px solid rgba(255,255,255,.15);
}

.about-item h3{
    margin-bottom:8px;
}

/* ANIMASI */
@keyframes pop{
    from{
        transform:scale(.8);
        opacity:0;
    }
    to{
        transform:scale(1);
        opacity:1;
    }
}

/* typing effect */
.typing{
    overflow:hidden;
    white-space:nowrap;
    border-right:2px solid white;
    width:0;
    animation:typing 2.5s steps(40,end) forwards;
}

@keyframes typing{
    from{width:0}
    to{width:100%}
}

</style>

</head>

<body>

<div class="cursor"></div>

<div class="bg-blur">

    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="circle circle3"></div>

</div>

<?php for($i=0;$i<20;$i++): ?>

<div
class="particle"
style="
left:<?= rand(0,100); ?>%;
top:<?= rand(0,100); ?>%;
animation-duration:<?= rand(10,18); ?>s;
"></div>

<?php endfor; ?>

<!-- SOCIAL -->

<div class="social">

    <?php while($s = mysqli_fetch_assoc($socials)): ?>

    <div class="social-item">

        <a href="<?= $s['url']; ?>" target="_blank">

            <i class="<?= $s['icon']; ?>"></i>

        </a>

        <div class="social-popup">

            <h4><?= $s['label']; ?></h4>

            <p><?= $s['username']; ?></p>

            <span><?= $s['subtitle']; ?></span>

        </div>

    </div>

    <?php endwhile; ?>

</div>

<header class="navbar">

    <div class="logo">
        <?= $profile['name']; ?>
    </div>

    <nav class="menu">

        <a href="#skills">Skills</a>
        <a href="#projects">Projects</a>
        <a href="#experience">Experience</a>
        <a href="#contact">Contact</a>

    </nav>

    <a href="login.php"
    class="admin-btn">

        Admin

    </a>

</header>

<section class="hero reveal">

    <div>

        <div class="badge">

            <div class="dot"></div>

            Open To Work & Freelance

        </div>
       
        <h1>

        Admitting I know nothing,
            <span class="gradient">
            driven to learn
            </span>

            everything.

        </h1>

        <p>

            <?= $profile['description']; ?>

        </p>

        <div class="hero-buttons">

            <a href="#projects"
            class="btn">

                Explore Projects

            </a>

            <a
            href="assets/upload/cv/<?= $profile['cv']; ?>"
            class="btn-outline"
            download>

                Download CV

            </a>

            <a href="javascript:void(0)" class="btn" onclick="openAbout()">
    About Me
</a>

        </div>

    </div>

    <div class="hero-right">

        <div class="hanger">

            <div class="rope"></div>

            <div class="pin"></div>

            <div class="photo-frame">

                <img
                src="assets/upload/profile/<?= $profile['photo']; ?>">

            </div>

        </div>

        <?php

        $positions = [

            "top:20px; left:-120px;",
            "top:120px; right:-120px;",
            "bottom:20px; left:-100px;",
            "bottom:120px; right:-100px;"
        ];

        $i = 0;

        while($c=mysqli_fetch_assoc($heroCards)):

        ?>

        <div
        class="float-card"
        style="<?= $positions[$i % count($positions)]; ?>">

            <h4>
                <?= $c['title']; ?>
            </h4>

            <p>
                <?= $c['description']; ?>
            </p>

        </div>

        <?php

        $i++;

        endwhile;

        ?>

    </div>

</section>

<section class="section reveal"
id="skills">

    <h2 class="section-title">
        Skills & Technologies
    </h2>

    <p class="section-sub">

        Technologies and tools that I use to build modern digital experiences.

    </p>

    <div class="skills-wrapper">

<button class="skill-nav left"
onclick="scrollSkills(-300)">
    <i class="fa-solid fa-chevron-left"></i>
</button>

<div class="skills-slider" id="skillsSlider">

    <?php while($s=mysqli_fetch_assoc($skills)): ?>

    <div class="skill-card">

        <div class="skill-icon">
            <i class="<?= $s['icon']; ?>"></i>
        </div>

        <h3><?= $s['name']; ?></h3>

        <p><?= $s['description']; ?></p>

    </div>

    <?php endwhile; ?>

</div>

<button class="skill-nav right"
onclick="scrollSkills(300)">
    <i class="fa-solid fa-chevron-right"></i>
</button>

</div>


</section>

<section class="section reveal" id="projects">

    <h2 class="section-title">Featured Projects</h2>

    <p class="section-sub">
        Selected works and digital solutions I have built.
    </p>

    <div class="projects-wrapper">

        <button class="project-nav left" onclick="scrollProjects(-1)">‹</button>

        <div class="projects">

            <?php while($p = mysqli_fetch_assoc($projects)): ?>

            <div class="project">

                <div class="project-img-wrap">
                    <img src="assets/upload/project/<?= $p['image']; ?>">
                </div>

                <div class="project-content">

                    <h3><?= htmlspecialchars($p['title']); ?></h3>

                    <p>
                        <?= htmlspecialchars(substr($p['description'], 0, 120)); ?>...
                    </p>

                    <a href="project/detail.php?id=<?= $p['id']; ?>">
                        View Detail →
                    </a>

                </div>

            </div>

            <?php endwhile; ?>

        </div>

        <button class="project-nav right" onclick="scrollProjects(1)">›</button>

    </div>

</section>

<section class="section" id="experience">

    <h2 class="section-title">Experience</h2>
    <p class="section-sub">Journey and professional experience.</p>

    <div class="exp-wrapper">

        <button class="exp-nav left" onclick="scrollExperience(-1)">‹</button>

        <div class="exp-slider" id="expSlider">

            <?php while($e = mysqli_fetch_assoc($experience)): ?>

            <div class="exp-card">

                <div class="exp-top">
                    <img src="assets/upload/company/<?= $e['logo']; ?>">
                    <div>
                        <h3><?= $e['company']; ?></h3>
                        <small><?= $e['period']; ?></small>
                    </div>
                </div>

                <h4><?= $e['position']; ?></h4>

                <p><?= $e['description']; ?></p>

            </div>

            <?php endwhile; ?>

        </div>

        <button class="exp-nav right" onclick="scrollExperience(1)">›</button>

    </div>

</section>

<section class="section reveal"
id="contact">

    <h2 class="section-title">
        Let's Connect
    </h2>

    <p class="section-sub">

        Interested in collaboration, projects, or opportunities?
        Feel free to contact me.

    </p>

    <div class="contact-box">

        <form method="POST" action="sendmail.php">

            <div class="form-grid">

                <input
                type="text"
                name="name"
                placeholder="Your Name"
                required>

                <input
                type="email"
                name="email"
                placeholder="Your Email"
                required>

            </div>

            <textarea
            name="message"
            placeholder="Write your message..."
            required></textarea>

            <button
            class="btn"
            name="send">

                Send Message

            </button>

        </form>

    </div>

</section>

<footer class="footer">

    © 2026 <?= $profile['name']; ?> — Premium Portfolio

</footer>


<script>
/* JSS */
/* CURSOR */

const cursor =
document.querySelector('.cursor');

document.addEventListener('mousemove',(e)=>{

    cursor.style.left =
    e.clientX + 'px';

    cursor.style.top =
    e.clientY + 'px';
});

/* ABOUT ME*/

function openAbout(){
    document.getElementById('aboutModal').style.display = 'flex';
}

function closeAbout(){
    document.getElementById('aboutModal').style.display = 'none';
}

/* close kalau klik ESC */
document.addEventListener('keydown', function(e){
    if(e.key === "Escape"){
        closeAbout();
    }
});

/* JSS SKILSS */
function scrollSkills(value){

document
.getElementById('skillsSlider')
.scrollBy({
    left:value,
    behavior:'smooth'
});
}


/* JSS PROJECT */

function scrollProjects(direction){
    const container = document.querySelector('.projects');

    const scrollAmount = 420;

    container.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}

/* JSS EXPERIENCE */

function scrollExperience(direction){

const container = document.getElementById('expSlider');

const cardWidth = container.offsetWidth / 2; 
// karena 2 card per view

container.scrollBy({
    left: direction * cardWidth,
    behavior: 'smooth'
});
}

</script>


<!-- CINEMATIC ABOUT MODAL -->
<div id="aboutModal" class="about-modal">

    <div class="about-backdrop" onclick="closeAbout()"></div>

    <div class="about-card">

        <div class="about-glow"></div>

        <div class="about-content">

            <h1 class="typing">Halo, kenalkan saya <?= $profile['name']; ?></h1>

            <p>
Halo, saya <?= $profile['name']; ?>, lulusan Politeknik Caltex Riau jurusan Sistem Informasi.  
Saya adalah seseorang yang tertarik pada dunia teknologi, khususnya dalam membangun website dan sistem digital yang sederhana namun efektif.

Saya menikmati proses belajar, mencoba hal baru, dan mengubah ide menjadi tampilan yang bisa digunakan orang lain.  
Saat ini saya sedang mencari peluang untuk berkembang, baik melalui pekerjaan, project, maupun kolaborasi di bidang teknologi.
</p>

            <div class="about-grid">

                <div class="about-item">
                    <h3>🎯 Fokus</h3>
                    <p>Web Design & Development</p>
                </div>

                <div class="about-item">
                    <h3>⚡ Passion</h3>
                    <p>Membuat UI modern & interaktif</p>
                </div>

                <div class="about-item">
                    <h3>🚀 Tujuan</h3>
                    <p>Menjadi developer yang terus berkembang</p>
                </div>

            </div>

            <button class="btn" onclick="closeAbout()">Tutup</button>

        </div>

    </div>

</div>
</body>
</html>