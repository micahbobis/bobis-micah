<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delete</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- aesthetic fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Quicksand:wght@400;500&display=swap" rel="stylesheet">

<style>
:root{
    --matcha-dark: #3f5c4b;
    --matcha-light: #a9c1a8;
    --off-white:   #f9f9f6;
    --text-dark:   #2e2e2e;
    --red:         #e74c3c;
}

/* --- Reset --- */
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:'Quicksand', sans-serif;
    background: linear-gradient(to bottom right, var(--matcha-light), var(--off-white));
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:2rem;
}

/* --- Card --- */
.container{width:100%;max-width:720px;}
.card{
    background: var(--off-white);
    border: 2px solid var(--matcha-dark);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    /* no rounded corners */
}
.card-header{
    background: var(--matcha-dark);
    padding:1.5rem 2rem;
    border-bottom:2px solid var(--matcha-light);
}
.card-header h1{
    font-family:'Playfair Display',serif;
    font-size:2rem;
    font-weight:700;
    color: var(--red);
    display:flex;
    align-items:center;
    gap:.75rem;
}

/* --- Body --- */
.card-body{
    padding:2rem;
    text-align:center;
}
.card-body p{
    font-size:1.1rem;
    color: var(--text-dark);
    margin-bottom:1.5rem;
}

/* --- Buttons --- */
.actions{
    display:flex;
    justify-content:center;
    gap:.75rem;
}
.btn{
    display:inline-flex;
    align-items:center;
    gap:.5rem;
    padding:.6rem 1.4rem;
    font-weight:600;
    font-size:1rem;
    text-decoration:none;
    cursor:pointer;
    border:none;
    transition:all .25s ease;
}
.btn i{pointer-events:none;}
.btn-confirm{
    background: var(--red);
    color: var(--off-white);
}
.btn-confirm:hover{
    background:#c0392b;
    transform:translateY(-2px);
}
.btn-cancel{
    background: var(--matcha-light);
    color: var(--text-dark);
    border:1px solid var(--matcha-dark);
}
.btn-cancel:hover{
    background:#98b598;
    transform:translateY(-2px);
}
</style>
</head>
<body>

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
