<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ProfileVault Suite</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/favicon.ico">


<style>
:root{
    --matcha-dark:#3f5c4b;
    --matcha-light:#a9c1a8;
    --off-white:#f9f9f6;
    --text-dark:#2e2e2e;
    --danger:#b0413e;
}

/* Reset */
*{margin:0;padding:0;box-sizing:border-box;}

/* Body & Background */
body {
    font-family: 'Montserrat', sans-serif;
   background: url('public/images/bg.png') no-repeat center center fixed;

    background-size: cover;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: var(--text-dark);
}

/* Optional overlay */
body::before {
    content:'';
    position: fixed;
    inset: 0;
    background: rgba(223,240,210,0.25);
    z-index: -1;
}

/* Card container */
.card {
    background: rgba(255,255,255,0.9);
    border: 2px solid var(--matcha-dark);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    padding: 2rem;
    width: 95%;          /* add this */
    max-width:1200px;    /* optional */
    margin: auto;        /* centers card if parent allows */
}


/* Title */
h1.main-title{
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--matcha-dark);
    margin-bottom: 2rem;
}

/* Table wrapper */
.table-wrapper{
    overflow-x:auto;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    table-layout: auto;  /* allows columns to adjust */
}

th, td {
    padding: 0.75rem 1rem;
    text-align: left;
}
th{
    background: var(--matcha-dark);
    color: var(--off-white);
    font-weight: 700;
}
tr:nth-child(even) td{background: var(--off-white);}
tr:nth-child(odd) td{background: #f1f4f0;}
tr:hover td{background: var(--matcha-light);}

/* Profile image */
img.profile-img{
       width: 80px;              /* adjust bigger if needed */
    height: 80px;
    object-fit: cover;
    border-radius: 50%;       /* circular */
    border: 2px solid #3f5c4b; /* matcha dark border */
}
/* Action buttons */
td:last-child{
    display:flex;
    justify-content:center;
    gap:0.5rem;
}
.btn-edit, .btn-delete{
    padding:0.4rem 0.8rem;
    font-weight:600;
    text-decoration:none;
    cursor:pointer;
    border:1px solid var(--matcha-dark);
    transition: all 0.2s ease;
}
.btn-edit{
    background: var(--matcha-light);
    color: var(--text-dark);
}
.btn-edit:hover{background:#98b598;}
.btn-delete{
    background: var(--danger);
    color: var(--off-white);
    border:1px solid #943737;
}
.btn-delete:hover{background:#943737;}

/* Empty state */
.empty{
    padding:2rem;
    text-align:center;
    font-style:italic;
    background:#f1f4f0;
    color: var(--text-dark);
}

/* Pagination */
.pagination{
    list-style:none;
    display:flex;
    justify-content:center;
    gap:0.5rem;
    margin:1rem 0;
    padding:0;
}
.pagination li a, .pagination li span{
    display:inline-block;
    padding:0.5rem 0.9rem;
    border:1px solid var(--matcha-dark);
    background: var(--matcha-light);
    color: var(--text-dark);
    text-decoration:none;
}
.pagination li a:hover{background:#98b598;}
.pagination li.active a, .pagination li span.current{
    background: var(--matcha-dark);
    color: var(--off-white);
    font-weight:700;
}

.header-actions{
  display:flex;
    justify-content: space-between; /* ✅ search sa kaliwa, button sa kanan */
  align-items: center;   
    margin-bottom: 1.5rem; 
  margin-top:0.5rem;
}

.search-form{
  display:flex;
  align-items:center;
  border:2px solid var(--matcha-dark);
  border-radius:4px;
  background:var(--off-white);
  height:40px;          /* ✅ match height */
}

.search-input{
  border:none;
  outline:none;
  padding:0 0.75rem;
  height:100%;          /* ✅ match height */
  background:transparent;
  color:var(--matcha-dark);
}

.search-btn{
  background:var(--matcha-dark);
  color:var(--off-white);
  border:none;
  padding:0 0.9rem;
  height:100%;          /* ✅ match height */
  display:flex;
  align-items:center;
  justify-content:center;
  cursor:pointer;
  border-top-right-radius:4px;
  border-bottom-right-radius:4px;
}

.btn-add{
  padding:0.5rem 1rem;
  background:var(--matcha-dark);
  color:var(--off-white);
  text-decoration:none;
  font-weight:600;
  border-radius:4px;
  height:40px;          /* ✅ same as search form */
  display:flex;
  align-items:center;   /* center text vertically */
  justify-content:center;
}

</style>
</head>
<body>

<div class="container">
    <div class="card">
        <h1 class="main-title">ProfileVault Suite</h1>
        <div class="card-header">
        
        <div class="header-actions">
            <form action="<?=site_url('users/view');?>" method="get" class="search-form">
                <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                <input class="search-input" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
                <button type="submit" class="search-btn"><i class="fa-solid fa-search"></i></button>
            </form>
         <a href="<?= site_url('users/create') ?>" class="btn-add">+ Add Account</a>
</div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profile</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($users)): ?>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td>
                            <img src="<?= base_url() . 'public/' . $user['image_path'] ?>" 
                             alt="Profile" class="profile-img">

                        </td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <a href="<?= site_url('users/update/'.$user['id']) ?>" class="btn-edit">Edit</a>
                            <a href="<?= site_url('users/delete/'.$user['id']) ?>" class="btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="empty">No account found!</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            <?= $page; ?>
        </div>
    </div>
</div>

</body>
</html>
