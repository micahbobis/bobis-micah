<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root{
    --matcha-dark: #3f5c4b;
    --matcha-light: #a9c1a8;
    --off-white: #f9f9f6;
    --text-dark: #2e2e2e;
    --text-light: #4a4a4a;
}

/* Reset */
*{margin:0;padding:0;box-sizing:border-box;}

/* Body & Background */
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
/* Card container */
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
    color: var(--off-white);
    padding: 1.5rem 2rem;
    border-bottom: 2px solid var(--matcha-light);
    border-top-left-radius: 18px;
    border-top-right-radius: 18px;
    text-align: center;
}
.title {
    font-size: 2rem;
    font-weight: 700;
    letter-spacing: 1px;
}

/* Body */
.card-body {
    padding: 2rem;
}

/* Profile Section */
.form-top {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
    width: 100%;
}

.profile-preview {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--matcha-dark);
    box-shadow: 0 0 8px rgba(63, 92, 75, 0.3); /* ✅ subtle glow */
    transition: all 0.3s ease;
}
.profile-preview:hover {
    transform: scale(1.03);
    box-shadow: 0 0 12px rgba(63, 92, 75, 0.6);
}

/* Form Fields */
.form-group {
    margin-bottom: 1.5rem;
}
label {
    font-weight: 500;
    font-size: 1rem;
    color: var(--text-dark);
    display: block;
    margin-bottom: 0.5rem;
}
input[type="text"],
input[type="email"],
input[type="file"] {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--matcha-dark);
    background: var(--off-white);
    color: var(--text-dark);
    font-size: 1rem;
    border-radius: 8px; /* ✅ rounded input fields */
    transition: all 0.25s ease;
}
input::placeholder {
    color: var(--text-light);
}
input:focus {
    outline: none;
    border-color: var(--matcha-light);
    box-shadow: 0 0 8px rgba(169, 193, 168, 0.5); /* ✅ soft green glow */
    background: #ffffffb5;
}

/* Buttons */
.actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 1rem;
}
.btn {
    padding: 0.7rem 1.5rem;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

/* ✅ Primary (Save/Update) */
.btn-primary {
    background: var(--matcha-dark);
    color: var(--off-white);
    border-color: var(--matcha-dark);
}
.btn-primary:hover {
    background: #2f4639;
    box-shadow: 0 0 10px rgba(63, 92, 75, 0.8);
    transform: translateY(-2px);
}

/* ✅ Secondary (Cancel/Back) */
.btn-secondary {
    background: var(--off-white);
    color: var(--matcha-dark);
    border: 2px solid var(--matcha-dark);
}
.btn-secondary:hover {
    background: var(--matcha-light);
    box-shadow: 0 0 8px rgba(169, 193, 168, 0.8);
    transform: translateY(-2px);
}

</style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="title">Create Profile</h1>
        </div>
        <div class="card-body">
            <form action="<?= site_url('users/create') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-top">
                    <img src="<?= base_url() ?>public/default-avatar.png" alt="Default profile" class="profile-preview" id="profilePreview">
                    <input type="file" name="profile" id="profile" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter email" required>
                </div>

                <div class="actions">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-plus"></i> Create
    </button>
    <a href="<?= site_url('users/view') ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
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
