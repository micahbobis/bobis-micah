<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: " . site_url('auth/login'));
    exit;
}


$role = $_SESSION['role'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ProfileVault Suite</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/favicon.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>
:root {
    --matcha-dark: #3f5c4b;
    --matcha-light: #a9c1a8;
    --off-white: #f9f9f6;
    --text-dark: #2e2e2e;
    --danger: #b0413e;
}

/* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body */
body{
    font-family: 'Montserrat', sans-serif;
    background: linear-gradient(rgba(223,240,210,0.25), rgba(223,240,210,0.25)),
                url('/public/images/bg.png') no-repeat center center fixed;
    background-size: cover;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    color:var(--text-dark);
}
body::before{
    content:'';
    position:fixed;
    inset:0;
    background:rgba(223,240,210,0.25);
    z-index:-1;
}

/* 🪟 Card container */
.card {
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(63, 92, 75, 0.4);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    padding: 2rem;
    width: 95%;
    max-width: 1200px;
    margin: auto;
    border-radius: 20px;
    transition: 0.3s ease;
}

.card:hover {
    border-color: var(--matcha-light);
    box-shadow: 0 0 20px rgba(169, 193, 168, 0.8);
}

/* Title */
h1.main-title {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--matcha-dark);
    margin-bottom: 2rem;
}

/* Table */
.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 0.75rem 1rem;
    text-align: left;
}

th {
    background: var(--matcha-dark);
    color: var(--off-white);
    font-weight: 700;
}

tr:nth-child(even) td { background: var(--off-white); }
tr:nth-child(odd) td { background: #f1f4f0; }
tr:hover td {
    background: var(--matcha-light);
    color: var(--off-white);
    transition: 0.3s;
}

/* Profile Image */
img.profile-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid var(--matcha-dark);
    box-shadow: 0 0 10px rgba(63, 92, 75, 0.5);
}

/* Action Buttons */
td:last-child {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
}

.btn-edit, .btn-delete {
    padding: 0.5rem 1rem;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-edit {
    background: var(--matcha-light);
    color: var(--text-dark);
    border: 1px solid var(--matcha-dark);
}

.btn-edit:hover {
    background: var(--matcha-dark);
    color: var(--off-white);
    box-shadow: 0 0 10px var(--matcha-light);
}

.btn-delete {
    background: var(--danger);
    color: var(--off-white);
    border: 1px solid #943737;
}

.btn-delete:hover {
    background: #943737;
    box-shadow: 0 0 10px rgba(176, 65, 62, 0.8);
}

/* Empty state */
.empty {
    padding: 2rem;
    text-align: center;
    font-style: italic;
    background: #f1f4f0;
    color: var(--text-dark);
}

/* Pagination */
.pagination {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin: 1rem 0;
    padding: 0;
}

.pagination li a, .pagination li span {
    display: inline-block;
    padding: 0.5rem 0.9rem;
    border: 1px solid var(--matcha-dark);
    background: var(--matcha-light);
    color: var(--text-dark);
    text-decoration: none;
    border-radius: 6px;
    transition: 0.3s;
}

.pagination li a:hover {
    background: var(--matcha-dark);
    color: var(--off-white);
    box-shadow: 0 0 10px var(--matcha-light);
}

.pagination li.active a {
    background: var(--matcha-dark);
    color: var(--off-white);
}

/* Header actions (Search + Add button) */
.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    margin-top: 0.5rem;
}

/* Search bar */
.search-form {
    display: flex;
    align-items: center;
    border: 2px solid var(--matcha-dark);
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.8);
    height: 45px;
    overflow: hidden;
    transition: 0.3s;
}

.search-form:hover {
    box-shadow: 0 0 10px var(--matcha-light);
}

.search-input {
    border: none;
    outline: none;
    padding: 0 0.75rem;
    height: 100%;
    background: transparent;
    color: var(--matcha-dark);
    flex: 1;
}

.search-btn {
    background: var(--matcha-dark);
    color: var(--off-white);
    border: none;
    padding: 0 1rem;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: 0.3s;
}

.search-btn:hover {
    background: var(--matcha-light);
    color: var(--matcha-dark);
    box-shadow: 0 0 10px var(--matcha-light);
}



/* Add button */
.btn-add {
    padding: 0.6rem 1.2rem;
    background: var(--matcha-dark);
    color: var(--off-white);
    text-decoration: none;
    font-weight: 600;
    border-radius: 30px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
    border: 1px solid var(--matcha-dark);
}

.btn-add:hover {
    background: var(--matcha-light);
    color: var(--text-dark);
    box-shadow: 0 0 15px var(--matcha-light);
}
.search-btn i {
  color: var(--off-white);
  font-size: 1rem;
  transition: 0.3s;
}

.search-btn:hover i {
  color: var(--matcha-dark);
}
.btn-add {
  padding: 0.5rem 1.2rem;
  background: var(--matcha-dark);
  color: var(--off-white);
  text-decoration: none;
  font-weight: 600;
  border-radius: 10px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.4rem;
  box-shadow: 0 0 5px rgba(63, 92, 75, 0.3);
  transition: all 0.3s ease;
}

.btn-add i {
  font-size: 1rem;
}

.btn-add:hover {
  background: var(--matcha-light);
  color: var(--text-dark);
  box-shadow: 0 0 10px rgba(63, 92, 75, 0.7);
  transform: scale(1.05);
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.6rem 1.2rem;
    border: 2px solid transparent;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-edit {
    background: var(--matcha-light);
    color: var(--text-dark);
    border-color: var(--matcha-dark);
}
.btn-edit:hover {
    background: var(--matcha-dark);
    color: var(--off-white);
    box-shadow: 0 0 8px var(--matcha-dark);
    transform: translateY(-2px);
}

.btn-delete {
    background: var(--red);
    color: var(--off-white);
    border-color: var(--red);
}
.btn-delete:hover {
    background: #c0392b;
    box-shadow: 0 0 8px #c0392b;
    transform: translateY(-2px);
}

.btn i {
    font-size: 0.95rem;
}

/* Icons */

i {
    margin-right: 6px;
    font-size: 1rem;
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
                <button type="submit" class="search-btn">
                <i class="fa-solid fa-search"></i>
                </button>


            </form>

        <a href="<?= site_url('users/create') ?>" class="btn-add">
  <i class="fa-solid fa-user-plus"></i> &nbsp; Add Account
</a>

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
                        <?php if($_SESSION['role'] === 'admin'): ?>
                        <td>
                           <a href="<?= site_url('users/update/' . $user['id']) ?>" class="btn btn-edit">
  <i class="fas fa-pen"></i> Edit
</a>

<a href="<?= site_url('users/delete/' . $user['id']) ?>" 
   class="btn btn-delete" 
   onclick="return confirm('Are you sure you want to delete this user?');">
  <i class="fas fa-trash"></i> Delete
</a>


                        
                        </td>
                        <?php endif; ?>
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
