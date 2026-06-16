<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

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
    margin:auto;
    padding:50px 0;
}

h1{
    margin-bottom:40px;
}

.grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(250px,1fr));

    gap:25px;
}

.card{

    background:rgba(255,255,255,.05);

    padding:35px;

    border-radius:30px;

    border:1px solid rgba(255,255,255,.08);
}

.card h2{
    margin-bottom:15px;
}

.card p{
    color:#94a3b8;
    line-height:1.8;
}

.card a{

    display:inline-block;

    margin-top:20px;

    padding:14px 20px;

    border-radius:14px;

    text-decoration:none;

    color:white;

    background:linear-gradient(
        135deg,
        #7c3aed,
        #06b6d4,
        #ec4899
    );
}

.logout{

    position:fixed;

    top:20px;
    right:20px;

    background:red;

    padding:12px 20px;

    border-radius:14px;

    color:white;

    text-decoration:none;
}

</style>

</head>

<body>

<a href="logout.php"
class="logout">
    Logout
</a>

<div class="container">

    <h1>
        Dashboard Admin
    </h1>

    <div class="grid">

        <div class="card">

            <h2>
                Profile
            </h2>

            <p>
                Edit profile portfolio
            </p>

            <a href="admin/profile.php">
                Open
            </a>

        </div>

        <div class="card">

            <h2>
                Skills
            </h2>

            <p>
                Manage skill data
            </p>

            <a href="admin/skills.php">
                Open
            </a>

        </div>

        <div class="card">

            <h2>
                Projects
            </h2>

            <p>
                Manage projects
            </p>

            <a href="admin/projects.php">
                Open
            </a>

        </div>

        <div class="card">

            <h2>
                Experience
            </h2>

            <p>
                Manage experiences
            </p>

            <a href="admin/experience.php">
                Open
            </a>

        </div>


        <div class="card">

            <h2>
                Hero Card
            </h2>

            <p>
                Manage Hero Card
            </p>

            <a href="admin/hero_card.php">
                Open
            </a>

        </div>

        <div class="card">

            <h2>
                Contacts
            </h2>

            <p>
                View incoming messages
            </p>

            <a href="admin/contacts.php">
                Open
            </a>

        </div>


        <div class="card">

            <h2>
                Social Links
            </h2>

            <p>
                Manage Social Links
            </p>

            <a href="admin/social_links.php">
                Open
            </a>

        </div>

    </div>

</div>

</body>
</html>