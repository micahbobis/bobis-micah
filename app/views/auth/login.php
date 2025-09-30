<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --matcha-dark: #3f5c4b;
    --matcha-light: #a9c1a8;
    --off-white: #f9f9f6;
    --text-dark: #2e2e2e;
    --text-light: #4a4a4a;
}
*{margin:0;padding:0;box-sizing:border-box;}
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
.card{
    background:rgba(255,255,255,0.9);
    border:2px solid var(--matcha-dark);
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
    padding:2rem;
    width:90%;
    max-width:400px;
}
.card-header{
    background:var(--matcha-dark);
    color:var(--off-white);
    padding:1.2rem;
    text-align:center;
    border-bottom:2px solid var(--matcha-light);
}
.title{
    font-size:1.8rem;
    font-weight:700;
}
.card-body{padding:2rem 1rem;}
.form-group{margin-bottom:1.2rem;}
label{
    font-weight:500;
    margin-bottom:.4rem;
    display:block;
}
input[type="text"],
input[type="password"]{
    width:100%;
    padding:.75rem 1rem;
    border:1px solid var(--matcha-dark);
    background:var(--off-white);
    font-size:1rem;
    color:var(--text-dark);
    transition:all .2s ease;
}
input:focus{
    outline:none;
    border-color:var(--matcha-light);
    box-shadow:0 0 0 3px rgba(169,193,168,0.3);
}
.actions{margin-top:1.5rem;}
.btn{
    width:100%;
    padding:.75rem;
    font-weight:600;
    font-size:1rem;
    border:none;
    cursor:pointer;
    transition:all .25s ease;
}
.btn-primary{
    background:var(--matcha-dark);
    color:var(--off-white);
}
.btn-primary:hover{
    background:#2f4639;
    transform:translateY(-2px);
}
.text-center{
    text-align:center;
    margin-top:1rem;
    color:var(--text-light);
}
.text-center a{
    color:var(--matcha-dark);
    font-weight:600;
    text-decoration:none;
}
.text-center a:hover{text-decoration:underline;}
</style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h1 class="title">Login</h1>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password" required>
            </div>
            <div class="actions">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <p class="text-center">
            Don’t have an account? 
            <a href="<?= site_url('auth/register') ?>">Register</a>
        </p>
    </div>
</div>

</body>
</html>
