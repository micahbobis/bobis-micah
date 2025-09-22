<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ProfileVault Suite</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- aesthetic fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Quicksand:wght@400;500&display=swap" rel="stylesheet">

<style>
:root{
    --matcha-dark:#3f5c4b;
    --matcha-light:#a9c1a8;
    --off-white:#f9f9f6;
    --text-dark:#2e2e2e;
    --danger:#b0413e;
}

/* Reset & base */
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:'Quicksand',sans-serif;
    background:linear-gradient(to bottom right,var(--matcha-light),var(--off-white));
    min-height:100vh;
    padding:2rem;
    display:flex;
    flex-direction:column;
    align-items:center;
}

/* Title */
h1.main-title{
    font-family:'Playfair Display',serif;
    font-size:3rem;
    font-weight:700;
    color:var(--matcha-dark);
    margin-bottom:2rem;
}

/* Container & card */
.container{width:100%;max-width:1200px;}
.card{
    background:var(--off-white);
    border:2px solid var(--matcha-dark);
    /* no rounded corners */
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
}
.card-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:1.5rem 2rem;
    background:var(--matcha-dark);
    color:var(--off-white);
    font-family:'Playfair Display',serif;
    font-size:1.6rem;
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
    padding:0.5rem 1.4rem;
    font-size:1.1rem;
    font-weight:600;
    text-decoration:none;
    border:1px solid var(--matcha-dark);
    transition:all .25s ease;
}
.btn-add:hover{
    background:#98b598;
    transform:translateY(-2px);
}

.btn-edit, .btn-delete{
    padding:0.4rem 0.9rem;
    font-weight:600;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:0.3rem;
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

/* Search */
.search-form{
    display:flex;
    align-items:center;
    border:1px solid var(--matcha-dark);
}
.search-input{
    border:none;
    outline:none;
    padding:0.6rem 1rem;
    background:var(--off-white);
    color:var(--text-dark);
    font-size:1rem;
    width:180px;
}
.search-input::placeholder{color:#666;}
.search-btn{
    border:none;
    background:var(--matcha-light);
    color:var(--text-dark);
    padding:0.6rem 1rem;
    cursor:pointer;
    transition:background 0.2s;
}
.search-btn:hover{background:#98b598;}

/* Table */
.table-wrapper{overflow-x:auto;margin:1.5rem;}
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    padding:1rem 1.5rem;
    text-align:center;
    border-bottom:1px solid var(--matcha-dark);
    vertical-align:middle;
}
th{
    background:var(--matcha-dark);
    color:var(--off-white);
    font-weight:700;
}
tr:nth-child(even) td{background:var(--off-white);}
tr:nth-child(odd) td{background:#f1f4f0;}
tr:hover td{background:var(--matcha-light);}

/* Action column */
td:last-child{
    display:flex;
    justify-content:center;
    gap:0.5rem;
    background:inherit;
}

/* Profile image */
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
    margin:1.5rem 0;
    padding:0;
}
.pagination li a,.pagination li span{
    display:inline-block;
    padding:0.5rem 0.9rem;
    border:1px solid var(--matcha-dark);
    background:var(--matcha-light);
    color:var(--text-dark);
    text-decoration:none;
    transition:background 0.2s;
}
.pagination li a:hover{background:#98b598;}
.pagination li.active a,.pagination li span.current{
    background:var(--matcha-dark);
    color:var(--off-white);
    font-weight:700;
}
</style>
</head>
<body>

<h1 class="main-title"><i class="fa-solid fa-users-gear"></i> User Management System</h1>
<div class="container">
    <div class="card">
        <div class="card-header">
            <span><i class="fa-solid fa-users"></i> User Directory</span>
            <div class="header-actions">
                <form action="<?=site_url('users/view');?>" method="get" class="search-form">
                    <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                    <input class="search-input" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
                    <button type="submit" class="search-btn"><i class="fa-solid fa-search"></i></button>
                </form>
                <a href="<?= site_url('users/create') ?>" class="btn-add"><i class="fa-solid fa-user-plus"></i> Add User</a>
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
                            <?php if (!empty($user['image_path'])): ?>
                                <img src="<?= base_url() . $user['image_path'] ?>"
                                     alt="<?= htmlspecialchars($user['username']) ?>'s profile"
                                     class="profile-img" />
                            <?php else: ?>
                                <img src="<?= base_url() ?>public/default-avatar.png"
                                     alt="Default profile"
                                     class="profile-img" />
                            <?php endif; ?>
                        </td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <a href="<?= site_url('users/update/'.$user['id']) ?>" class="btn-edit" title="Edit User"><i class="fa-solid fa-pen"></i></a>
                            <a href="<?= site_url('users/delete/'.$user['id']) ?>" class="btn-delete" title="Delete User" onclick="return confirm('Are you sure?');"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="empty"><i class="fa-regular fa-circle-xmark"></i> No users found</td>
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
