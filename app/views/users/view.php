<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">

<style>
:root {
    --raisin-black: #2D2728ff;
    --van-dyke: #3F3735ff;
    --silver: #C7C2BFff;
    --jet: #383232ff;
    --davys-gray: #5F5957ff;
    --black: #040202ff;
    --smoky-black: #0F0C0Cff;
    --licorice: #1F1A1Aff;
    --raisin-black-2: #282222ff;
    --platinum: #EAE8E5ff;
    --white: #FFFFFFff;
}

/* --- Reset & Base --- */
* { box-sizing: border-box; margin:0; padding:0; }
body {
    font-family: 'Poppins', sans-serif;
    background: url("<?= base_url() ?>public/background.jpg") no-repeat center center fixed;
    background-size: cover;
    color: var(--silver);
    min-height: 100vh;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}
body::before {
    content:'';
    position: fixed;
    inset: 0;
    background: rgba(45,39,40,0.75);
    z-index: -1;
}

h1.main-title {
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    font-weight: 700;
    text-align: center;
    color: var(--white);
    text-shadow: 1px 1px 15px rgba(0,0,0,0.6);
    margin-bottom: 2rem;
}

.container { width: 100%; max-width: 1200px; }

.card {
    background: rgba(63,55,53,0.85);
    border-radius: 2rem;
    backdrop-filter: blur(15px);
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.35);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.45);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    background: var(--jet);
    font-family: 'Playfair Display', serif;
    font-weight: 600;
    font-size: 1.6rem;
    color: var(--white);
    border-bottom: 1px solid rgba(199,194,191,0.3);
    border-top-left-radius: 2rem;
    border-top-right-radius: 2rem;
}
.header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.btn-add {
    background: var(--black) !important;
    color: var(--white) !important;
    padding: 0.5rem 1.4rem;
    font-size: 1.1rem;
    border-radius: 1.2rem;
    font-weight: 500;
    text-decoration: none;
    box-shadow: 0 3px 8px rgba(0,0,0,0.5);
    transition: all 0.25s ease;
}
.btn-add:hover {
    background: #010101 !important;
    transform: translateY(-2px);
    transition: all 0.2s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.6);
}

.btn-edit, .btn-delete {
    padding: 0.4rem 0.9rem;
    border-radius: 1rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.3rem;
    transition: all 0.2s ease;
    cursor: pointer;
    text-decoration: none;
    white-space: nowrap;
    height: 40px; /* same height as profile image */
}

.btn-edit { background: var(--davys-gray); color: var(--white); }
.btn-edit:hover { background: var(--jet); }
.btn-delete { background: #9B2C2C; color: var(--white); }
.btn-delete:hover { background: #7B2424; }

.search-form {
    display: flex;
    align-items: center;
    background: var(--raisin-black-2);
    border-radius: 1.2rem;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.4);
}
.search-input {
    border: none;
    outline: none;
    padding: 0.6rem 1rem;
    background: transparent;
    color: var(--white);
    font-size: 1rem;
}
.search-input::placeholder { color: var(--silver); }
.search-btn {
    border: none;
    background: var(--black);
    color: var(--white);
    padding: 0.6rem 1rem;
    cursor: pointer;
    transition: background 0.2s;
}
.search-btn:hover { background: var(--jet); }

.table-wrapper { overflow-x: auto; margin: 1.5rem; }
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 1.5rem;
    overflow: hidden;
}

th, td {
    padding: 1rem 1.5rem;
    text-align: center;
    transition: all 0.2s;
    vertical-align: middle; /* center content vertically */
}

th { background: var(--smoky-black); color: var(--white); font-weight: 600; }

tr:nth-child(even) td { background: rgba(56,50,50,0.55); }
tr:nth-child(odd) td { background: rgba(63,55,53,0.55); }
tr:hover td { background: var(--jet); transform: scale(1.01); }

/* Action buttons in the last column */
td:last-child {
    display: flex;
    justify-content: center; /* center horizontally */
    align-items: center;     /* center vertically */
    gap: 0.5rem;
    background: inherit;     /* inherit row color */
}

/* Remove underline from links in actions */
td:last-child a { text-decoration: none; }

.empty { 
    padding: 2rem; 
    text-align: center; 
    font-style: italic; 
    background: rgba(45,39,40,0.65); 
    border-radius: 0 0 2rem 2rem; 
    color: var(--silver); 
}

.pagination { 
    list-style: none; 
    display: flex; 
    justify-content: center; 
    gap: 0.5rem; 
    padding: 0; 
    margin: 1.5rem 0; 
}
.pagination li { display: inline-flex; }
.pagination li a, .pagination li span { 
    display: inline-block; 
    padding: 0.5rem 0.9rem; 
    border-radius: 0.8rem; 
    background: var(--davys-gray); 
    color: var(--white); 
    text-decoration: none; 
    transition: background 0.2s; 
}
.pagination li a:hover { background: var(--jet); }
.pagination li.active a, .pagination li span.current { 
    background: var(--black); 
    font-weight: 600; 
}

/* --- Profile image --- */
img.profile-img { 
    border-radius: 50%; 
    object-fit: cover; 
    width: 50px;  /* match button height */
    height: 50px; 
    flex-shrink: 0;
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

        <!-- Pagination -->
        <div class="pagination-wrapper">
            <?= $page; ?>
        </div>
    </div>
</div>

</body>
</html>