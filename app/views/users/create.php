<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Minimalist font for headers -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">


<style>
:root{
    --matcha-dark: #3f5c4b;
    --matcha-light: #a9c1a8;
    --off-white:   #f9f9f6;
    --text-dark:   #2e2e2e;
    --text-light:  #4a4a4a;
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
    color: var(--off-white);
    padding:1.5rem 2rem;
    border-bottom:2px solid var(--matcha-light);
}
.title{
    font-family:'Playfair Display',serif;
    font-size:2rem;
    font-weight:700;
    display:flex;
    align-items:center;
    gap:.75rem;
}

/* --- Body --- */
.card-body{padding:2rem;}
.form-group{margin-bottom:1.5rem;}
label{
    font-weight:500;
    font-size:1rem;
    color:var(--text-dark);
    display:flex;
    align-items:center;
    gap:.5rem;
}
input[type="text"],
input[type="email"],
input[type="file"]{
    width:100%;
    padding:.75rem 1rem;
    border:1px solid var(--matcha-dark);
    background: var(--off-white);
    color: var(--text-dark);
    font-family:'Quicksand',sans-serif;
    font-size:1rem;
    transition: all .2s ease;
}
input::placeholder{color:var(--text-light);}
input:focus{
    outline:none;
    border-color: var(--matcha-light);
    box-shadow:0 0 0 3px rgba(169,193,168,0.3);
}

/* --- Buttons --- */
.actions{
    display:flex;
    gap:.75rem;
    justify-content:flex-end;
    margin-top:1rem;
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
.btn-primary{
    background: var(--matcha-dark);
    color: var(--off-white);
}
.btn-primary:hover{
    background: #2f4639;
    transform:translateY(-2px);
}
.btn-secondary{
    background: var(--matcha-light);
    color: var(--text-dark);
    border:1px solid var(--matcha-dark);
}
.btn-secondary:hover{
    background: #98b598;
    transform:translateY(-2px);
}

/* Profile preview img still rounded (for avatar look) */
.profile-preview{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
}
</style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="title"><i class="fa-solid fa-user-plus"></i> Create User</h1>
        </div>
        <div class="card-body">
            <form action="<?= site_url('users/create') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-top" style="display:flex;gap:2rem;align-items:center;margin-bottom:1.5rem;">
                    <div class="profile-left" style="flex:1;text-align:center;">
                        <?php if (!empty($user['image_path'])): ?>
                            <img src="<?= base_url() ?>public/<?= html_escape($user['image_path']) ?>"
                                 alt="<?= htmlspecialchars($user['username']) ?>'s profile"
                                 class="profile-preview" id="profilePreview">
                        <?php else: ?>
                            <img src="<?= base_url() ?>public/default-avatar.png"
                                 alt="Default profile"
                                 class="profile-preview" id="profilePreview">
                        <?php endif; ?>
                    </div>

                    <div class="profile-right" style="flex:1;display:flex;flex-direction:column;justify-content:center;">
                        <label for="profile">
                            <i class="fa-solid fa-image"></i> Upload Profile Image
                        </label>
                        <input type="file" name="profile" id="profile" accept="image/*">
                    </div>
                </div>

                <div class="form-group">
                    <label for="username"><i class="fa-solid fa-user"></i> Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter email" required>
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-check"></i> Create
                    </button>
                    <a href="<?= site_url('users/view') ?>" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>

            <script>
            const profileInput = document.getElementById('profile');
            const previewImg   = document.getElementById('profilePreview');
            profileInput.addEventListener('change', function(){
                const file = this.files[0];
                if(file){
                    const reader = new FileReader();
                    reader.onload = e => previewImg.src = e.target.result;
                    reader.readAsDataURL(file);
                }
            });
            </script>
        </div>
    </div>
</div>

</body>
</html>
