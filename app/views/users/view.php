<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ProfileVault Suite</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --matcha-dark:#3f5c4b;
    --matcha-light:#a9c1a8;
    --off-white:#f9f9f6;
    --text-dark:#2e2e2e;
    --danger:#b0413e;
}

/* Reset & Base */
*{margin:0;padding:0;box-sizing:border-box;}
body {
    font-family: 'Montserrat', sans-serif;
    background: url('<?= base_url() . "public/images/bg.png" ?>') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: var(--text-dark);
}

/* Optional overlay */
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background: rgba(223, 240, 210, 0.25);
    z-index: -1;
}

/* Container & Card */
.container{
    width:100%;
    max-width:1200px;
}
.card {
    background: rgba(255,255,255,0.9);
    border:2px solid var(--matcha-dark);
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
    padding: 1.5rem;
}

/* Title */
h1.main-title{
    font-family:'Montserrat', serif;
    font-size:2.5rem;
    font-weight:700;
    color:var(--matcha-dark);
    margin-bottom:2rem;
    text-align:center;
}

/* Card Header */
.card-header{
    display:flex;
    justify-content: space-between;
    align-items:center;
    padding:1rem 1.5rem;
    background:var(--matcha-dark);
    color:var(--off-white);
    font-family:'Montserrat',serif;
    font-size:1.3rem;
    font-weight:600;
    border-bottom:2px solid var(--matcha-light);
}
.header-actions{
    display:flex;
    align-items:center;
    gap:1rem;
}

/* Buttons */
.btn-add{
    background:var(--matcha-light);
    color:var(--text-dark);
    padding:0.5rem 1rem;
    font-size:1rem;
    font-weight:600;
    text-decoration:none;
    border:1px solid var(--matcha-dark);
    transition:all .25s ease;
}
.btn-add:hover{
    background:#98b598;
}

/* Table */
.table-wrapper{overflow-x:auto;margin:1rem 0;}
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    padding:0.8rem 1rem;
    text-align:center;
    border-bottom:1px solid var(--matcha-dark);
}
th{
    background:var(--matcha-dark);
    color:var(--off-white);
    font-weight:700;
}
tr:nth-child(even) td{background:var(--off-white);}
tr:nth-child(odd) td{background:#f1f4f0;}
tr:hover td{background:var(--matcha-light);}

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
    transition:all 0.2s ease;
    cursor:pointer;
    border:1px solid var(--matcha-dark);
}
.btn-edit{
    background:var(--matcha-light);
    color:var(--text-dark);
}
.btn-edit:hover{background:#98b598;}
.btn-delete{
    background:var(--danger);
    color:var(--off-white);
    border:1px solid #943737;
}
.btn-delete:hover{background:#943737;}

/* Profile images */
img.profile-img{
    width:50px;
    height:50px;
    object-fit:cover;
    border:2px solid var(--matcha-dark);
}

/* Empty state */
.empty{
    padding:2rem;
    text-align:center;
    font-style:italic;
    background:#f1f4f0;
    color:var(--text-dark);
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
    background:var(--matcha-light);
    color:var(--text-dark);
    text-decoration:none;
}
.pagination li a:hover{background:#98b598;}
.pagination li.active a, .pagination li span.current{
    background:var(--matcha-dark);
    color:var(--off-white);
    font-weight:700;
}

/* Search input */
.search-form{
    display:flex;
    align-items:center;
    border:1px solid var(--matcha-dark);
}
.search-input{
    border:none;
    outline:none;
    padding:0.5rem 0.8rem;
    background:var(--off-white);
    color:var(--text-dark);
    font-size:0.95rem;
    width:150px;
}
.search-input::placeholder{color:#666;}
.search-btn{
    border:none;
    background:var(--matcha-light);
    color:var(--text-dark);
    padding:0.5rem 0.8rem;
    cursor:pointer;
}
.search-btn:hover{background:#98b598;}
</style>
</head>
<body>

<h1 class="main-title">User Management System</h1>
<div class="container">
    <div class="card">
        <div class="card-header">
            <span>User Directory</span>
            <div class="header-actions">
                <form action="<?=site_url('users/view');?>" method="get" class="search-form">
                    <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                    <input class="search-input" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
                    <button type="submit" class="search-btn">Search</button>
                </form>
                <a href="<?= site_url('users/create') ?>" class="btn-add">Add User</a>
            </div>
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
                            <img src="<?= !empty($user['image_path']) ? base_url() . $user['image_path'] : base_url() . 'public/default-avatar.png' ?>"
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
                        <td colspan="5" class="empty">No users found</td>
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
