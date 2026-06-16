<?php
session_start();
include '../koneksi.php';

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

/* DELETE */
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    mysqli_query($conn,"DELETE FROM social_links WHERE id=$id");
    header("Location: social_links.php");
    exit;
}

/* GET DATA */
$data = mysqli_query($conn,"SELECT * FROM social_links ORDER BY id DESC");

/* EDIT DATA */
$edit = null;
if(isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    $edit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM social_links WHERE id=$id"));
}

/* ADD */
if(isset($_POST['add'])){
    mysqli_query($conn,"INSERT INTO social_links VALUES (
        NULL,
        '{$_POST['platform']}',
        '{$_POST['icon']}',
        '{$_POST['url']}',
        '{$_POST['username']}',
        '{$_POST['label']}',
        '{$_POST['subtitle']}'
    )");
    header("Location: social_links.php");
}

/* UPDATE */
if(isset($_POST['update'])){
    mysqli_query($conn,"UPDATE social_links SET
        platform='{$_POST['platform']}',
        icon='{$_POST['icon']}',
        url='{$_POST['url']}',
        username='{$_POST['username']}',
        label='{$_POST['label']}',
        subtitle='{$_POST['subtitle']}'
        WHERE id={$_POST['id']}
    ");
    header("Location: social_links.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Social Links</title>

<style>
body{
    margin:0;
    font-family:sans-serif;
    background:#0b1020;
    color:#fff;
    padding:30px;
}

h1{margin-bottom:20px}

/* FORM */
.box{
    background:#111827;
    padding:20px;
    border-radius:15px;
    margin-bottom:20px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:10px;
}

input{
    padding:10px;
    border:none;
    border-radius:10px;
    background:#0f172a;
    color:#fff;
}

/* BUTTON */
.btn{
    margin-top:10px;
    padding:10px 15px;
    border:none;
    border-radius:10px;
    background:linear-gradient(135deg,#7c3aed,#06b6d4,#ec4899);
    color:#fff;
    cursor:pointer;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:#111827;
    border-radius:15px;
    overflow:hidden;
}

th,td{
    padding:12px;
    border-bottom:1px solid #1f2937;
    font-size:14px;
}

th{
    background:#0f172a;
    text-align:left;
}

a{color:#fff;text-decoration:none}

.action a{
    padding:6px 10px;
    border-radius:8px;
    font-size:12px;
    margin-right:5px;
}

.edit{background:#7c3aed}
.del{background:#ef4444}
.open{background:#06b6d4}

/* MODAL EDIT */
.modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.75);
    display:flex;
    align-items:center;
    justify-content:center;
    backdrop-filter:blur(8px);
}

/* CARD EDIT (INI YANG UTAMA FIX) */
.modal-card{
    width:520px;
    background:linear-gradient(145deg,#111827,#0b1220);
    padding:25px;
    border-radius:18px;

    border:1px solid rgba(255,255,255,.12);

    box-shadow:
        0 25px 80px rgba(0,0,0,.6),
        inset 0 1px 0 rgba(255,255,255,.05);

    transform:scale(.95);
    animation:pop .25s ease forwards;
}

/* TITLE */
.modal-card h3{
    margin-top:0;
    margin-bottom:15px;
    font-size:18px;
    color:#a78bfa;
}

/* INPUT BIAR CLEAN */
.modal-card input{
    width:100%;
    margin-bottom:10px;
    padding:12px;
    border-radius:10px;

    border:1px solid rgba(255,255,255,.08);
    background:#0f172a;
    color:#fff;

    outline:none;
}

/* INPUT FOCUS BIAR HIDUP */
.modal-card input:focus{
    border-color:#7c3aed;
    box-shadow:0 0 0 3px rgba(124,58,237,.2);
}

/* ANIMASI MUNCUL */
@keyframes pop{
    from{
        transform:scale(.85);
        opacity:0;
    }
    to{
        transform:scale(1);
        opacity:1;
    }
}
</style>

</head>
<body>

<h1>Social Links Manager</h1>

<!-- ADD -->
<div class="box">
<form method="POST">
<div class="grid">

<input name="platform" placeholder="Platform">
<input name="icon" placeholder="Icon">
<input name="url" placeholder="URL">

<input name="username" placeholder="Username">
<input name="label" placeholder="Label">
<input name="subtitle" placeholder="Subtitle">

</div>
<button class="btn" name="add">+ Add</button>
</form>
</div>

<!-- TABLE -->
<table>
<tr>
<th>Platform</th>
<th>Username</th>
<th>Label</th>
<th>Action</th>
</tr>

<?php while($r=mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $r['platform'] ?></td>
<td><?= $r['username'] ?></td>
<td><?= $r['label'] ?></td>
<td class="action">

<a class="open" href="<?= $r['url'] ?>" target="_blank">Open</a>
<a class="edit" href="?edit=<?= $r['id'] ?>">Edit</a>
<a class="del" onclick="return confirm('Delete?')" href="?delete=<?= $r['id'] ?>">Del</a>

</td>
</tr>
<?php endwhile; ?>

</table>

<!-- EDIT MODAL -->
<?php if($edit): ?>
<div class="modal">
<div class="modal-card">

<h3>Edit Social</h3>

<form method="POST">
<input type="hidden" name="id" value="<?= $edit['id'] ?>">

<input name="platform" value="<?= $edit['platform'] ?>"><br><br>
<input name="icon" value="<?= $edit['icon'] ?>"><br><br>
<input name="url" value="<?= $edit['url'] ?>"><br><br>
<input name="username" value="<?= $edit['username'] ?>"><br><br>
<input name="label" value="<?= $edit['label'] ?>"><br><br>
<input name="subtitle" value="<?= $edit['subtitle'] ?>"><br><br>

<button class="btn" name="update">Update</button>
<a href="social_links.php" style="margin-left:10px">Close</a>

</form>

</div>
</div>
<?php endif; ?>

</body>
</html>