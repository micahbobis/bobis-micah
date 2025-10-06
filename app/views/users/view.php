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
body {
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
body::before {
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
    font-family: 'Montserrat', sans-serif;
}

.pagination li a, 
.pagination li span {
    display: inline-block;
    padding: 0.5rem 0.9rem;
    border: 1px solid var(--matcha-dark);
    background: var(--off-white);
    color: var(--matcha-dark);
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.25s ease;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}

.pagination li a:hover {
    background: var(--matcha-dark);
    color: var(--off-white);
    transform: translateY(-2px);
    box-shadow: 0 0 12px var(--matcha-dark);
}

.pagination li.active span {
    background: var(--matcha-dark);
    color: var(--off-white);
    box-shadow: 0 0 10px var(--matcha-dark);
    pointer-events: none;
}

.pagination li.disabled span {
    opacity: 0.5;
    pointer-events: none;
}

/* Header actions (Search + Add + Logout) */
.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    margin-top: 0.5rem;
    gap: 1rem;
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

.search-btn i {
  color: var(--off-white);
  font-size: 1rem;
  transition: 0.3s;
}

.search-btn:hover i {
  color: var(--matcha-dark);
}

/* Add button */
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
  border: 1px solid var(--matcha-dark);
}

.btn-add:hover {
  background: var(--matcha-light);
  color: var(--text-dark);
  box-shadow: 0 0 10px rgba(63, 92, 75, 0.7);
  transform: scale(1.05);
}

/* Logout button */
.btn-logout {
  padding: 0.5rem 1.2rem;
  background: var(--danger);
  color: var(--off-white);
  text-decoration: none;
  font-weight: 600;
  border-radius: 10px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.4rem;
  box-shadow: 0 0 5px rgba(176, 65, 62, 0.3);
  border: 1px solid var(--danger);
  transition: all 0.3s ease;
}

.btn-logout:hover {
  background: #943737;
  box-shadow: 0 0 10px rgba(176, 65, 62, 0.7);
  transform: scale(1.05);
}

</style>
</head>
<body>

<div class="container">
    <div class="card">
        <h1 class="main-title">ProfileVault Suite</h1>
        
        <div class="header-actions">
            <form action="<?=site_url('users/view');?>" method="get" class="search-form">
                <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                <input class="search-input" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
                <button type="submit" class="search-btn">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form>

            <div style="display: flex; gap: 0.8rem;">
                <a href="<?= site_url('users/create') ?>" class="btn-add">
                    <i class="fa-solid fa-user-plus"></i> Add Account
                </a>
                <a href="<?= site_url('auth/logout') ?>" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
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
                            <img src="<?= site_url($user['image_path']) ?>" 
                                 alt="Profile" width="60" height="60"
                                 style="border-radius:50%; object-fit:cover;">
                        </td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <?php if(isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin'): ?>
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
