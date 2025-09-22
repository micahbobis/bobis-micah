<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --matcha-dark: #3f5c4b;
    --matcha-light: #a9c1a8;
    --off-white:   #f9f9f6;
    --text-dark:   #2e2e2e;
    --text-light:  #4a4a4a;
}

/* Reset */
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

/* Optional overlay for pastel macha tint */
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
    max-width:720px;
}
.card {
    background: rgba(255, 255, 255, 0.75);
    border-radius: 0;
    padding: 1.5rem;
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    backdrop-filter: blur(5px);
}

.card-header{
    background: var(--matcha-dark);
    padding:1.5rem 2rem;
    border-bottom:2px solid var(--matcha-light);
    text-align:center;
}
.card-header h1{
    font-family:'Montserrat',serif;
    font-size:2rem;
    font-weight:700;
    color: var(--off-white);
}

/* Card Body */
.card-body{
    padding:2rem;
    text-align:center;
}
.form-top{
    display:flex;
    flex-direction:column;
    gap:1.5rem;
    align-items:center;
    margin-bottom:1.5rem;
}
.profile-preview{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:2px solid var(--matcha-dark);
}

/* Form Fields */
.form-group{margin-bottom:1.5rem;}
label{
    font-weight:500;
    font-size:1rem;
    color:var(--text-dark);
    display:block;
    text-align:left;
    margin-bottom:0.5rem;
}
input[type="text"],
input[type="email"],
input[type="file"]{
    width:100%;
    padding:.75rem 1rem;
    border:1px solid var(--matcha-dark);
    background: var(--off-white);
    color: var(--text-dark);
    font-family:'Montserrat',sans-serif;
    font-size:1rem;
    transition: all .2s ease;
}
input::placeholder{color:var(--text-light);}
input:focus{
    outline:none;
    border-color: var(--matcha-light);
    box-shadow:0 0 0 3px rgba(169,193,168,0.3);
}

/* Buttons */
.actions{
    display:flex;
    gap:.75rem;
    justify-content:center;
    margin-top:1rem;
}
.btn{
    padding:.6rem 1.4rem;
    font-weight:600;
    font-size:1rem;
    cursor:pointer;
    border:none;
    transition:all .25s ease;
}
.btn-primary{
    background: var(--matcha-dark);
    color: var(--off-white);
}
.btn-primary:hover{
    background:#2f4639;
    transform:translateY(-2px);
}
.btn-secondary{
    background: var(--matcha-light);
    color: var(--text-dark);
    border:1px solid var(--matcha-dark);
}
.btn-secondary:hover{
    background:#98b598;
    transform:translateY(-2px);
}
</style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Update User</h1>
        </div>
        <div class="card-body">
            <form action="<?= site_url('users/update/' . $user['id']) ?>" method="POST" enctype="multipart/form-data">
                
                <!-- Image Section -->
                <div class="form-top">
                    <img src="<?= !empty($user['image_path']) && $user['image_path'] !== 'default-avatar.png' ? base_url().'public/'.html_escape($user['image_path']) : base_url().'public/default-avatar.png' ?>" 
                         alt="Profile" class="profile-preview" id="profilePreview">
                    <input type="file" name="profile" id="profile" accept="image/*">
                </div>

                <!-- Form Fields -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?= $user['username'] ?>" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= $user['email'] ?>" placeholder="Enter email" required>
                </div>

                <!-- Actions -->
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="<?= site_url('users/view') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

            <script>
            // Preview new image before upload
            const profileInput = document.getElementById('profile');
            const previewImg = document.getElementById('profilePreview');
            profileInput.addEventListener('change', function() {
                const file = this.files[0];
                if(file) {
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
