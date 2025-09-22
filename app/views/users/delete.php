<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delete User</title>
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
    --white: #FFFFFFff;
    --red: #EF4444ff;
}

/* --- Base --- */
* { box-sizing: border-box; margin:0; padding:0; }
body {
    font-family: 'Poppins', sans-serif;
    background: url('./background.jpg') no-repeat center center fixed;
    background-size: cover;
    color: var(--silver);
    min-height: 100vh;
    padding: 2rem;
    display: flex;
    justify-content: center;
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

/* --- Card --- */
.container { width: 100%; max-width: 720px; }
.card {
    background: rgba(63,55,53,0.85);
    border-radius: 2rem;
    backdrop-filter: blur(15px);
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.35);
}
.card-header {
    padding: 1.5rem 2rem;
    background: var(--jet);
    border-bottom: 1px solid rgba(199,194,191,0.3);
    border-top-left-radius: 2rem;
    border-top-right-radius: 2rem;
}
.card-header h1 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 1.8rem;
    color: var(--red);
}

/* --- Card Body --- */
.card-body {
    padding: 2rem;
    text-align: center;
}
.card-body p {
    font-size: 1rem;
    color: var(--silver);
    margin-bottom: 1.5rem;
}

/* --- Buttons --- */
.actions { display: flex; justify-content: center; gap: 0.75rem; }
.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1.4rem;
    border-radius: 1.2rem;
    font-weight: 500;
    font-size: 1rem;
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: all 0.25s ease;
    box-shadow: 0 3px 8px rgba(0,0,0,0.35);
}
.btn-confirm {
    background: var(--red);
    color: var(--white);
}
.btn-confirm:hover {
    background: #dc2626;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.35);
}
.btn-cancel {
    background: var(--davys-gray);
    color: var(--white);
}
.btn-cancel:hover {
    background: var(--jet);
    transform: translateY(-2px);
}
</style>
</head>
<body style="background-image: url('<?= base_url()?>public/background.jpg">

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1><i class="fa-solid fa-trash"></i> Delete User</h1>
        </div>
        <div class="card-body">
            <p>Are you sure you want to delete <strong><?= $user['username'] ?></strong> (<?= $user['email'] ?>)?</p>
            <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="POST">
                <div class="actions">
                    <button type="submit" class="btn btn-confirm">
                        <i class="fa-solid fa-check"></i> Yes, Delete
                    </button>
                    <a href="<?= site_url('users/view') ?>" class="btn btn-cancel">
                        <i class="fa-solid fa-arrow-left"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>