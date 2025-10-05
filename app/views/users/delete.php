<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delete User</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root{
    --matcha-dark: #3f5c4b;
    --matcha-light: #a9c1a8;
    --off-white: #f9f9f6;
    --text-dark: #2e2e2e;
    --red: #e74c3c;
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

/* Optional overlay for pastel tint */
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background: rgba(223,240,210,0.25); /* soft pastel tint */
    z-index: -1;
   /* optional blur for background */
}


/* Container & Card */
.card {
    background: rgba(255, 255, 255, 0.85);
    border: 2px solid var(--matcha-dark);
    border-radius: 20px; /* ✅ curved corners */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    padding: 2rem;
    width: 90%;
    max-width: 900px;
    margin: auto;
    backdrop-filter: blur(6px); /* ✅ soft transparency */
    transition: all 0.3s ease;
}

/* Header */
.card-header {
    background: rgba(63, 92, 75, 0.95);
    padding: 1.5rem 2rem;
    border-bottom: 2px solid var(--matcha-light);
    border-top-left-radius: 18px;
    border-top-right-radius: 18px;
    text-align: center;
}
.card-header h1 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--danger); /* ✅ uses your red tone */
}

/* Body */
.card-body {
    padding: 2rem;
    text-align: center;
}
.card-body p {
    font-size: 1.1rem;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
}

/* Buttons */
.actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1.5rem;
}
.btn {
    padding: 0.7rem 1.6rem;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 10px;
    transition: all 0.3s ease;
    letter-spacing: 0.3px;
}

/* ✅ Confirm (red button) */
.btn-confirm {
    background: var(--danger);
    color: var(--off-white);
    border-color: var(--danger);
}
.btn-confirm:hover {
    background: #a8322f;
    box-shadow: 0 0 10px rgba(176, 65, 62, 0.8); /* ✅ red glow */
    transform: translateY(-2px);
}

/* ✅ Cancel (matcha button) */
.btn-cancel {
    background: var(--off-white);
    color: var(--matcha-dark);
    border: 2px solid var(--matcha-dark);
}
.btn-cancel:hover {
    background: var(--matcha-light);
    box-shadow: 0 0 8px rgba(169, 193, 168, 0.8); /* ✅ soft green glow */
    transform: translateY(-2px);
}

</style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Delete User</h1>
        </div>
        <div class="card-body">
            <p>Are you sure you want to delete <strong><?= $user['username'] ?></strong> (<?= $user['email'] ?>)?</p>
            <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="POST">
                <div class="actions">
    <button type="submit" class="btn btn-confirm">
        <i class="fas fa-check"></i> Yes, Delete
    </button>
    <a href="<?= site_url('users/view') ?>" class="btn btn-cancel">
        <i class="fas fa-times"></i> Cancel
    </a>
</div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
