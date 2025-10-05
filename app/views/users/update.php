<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update User</title>
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
/* Container & Card */
.card {
    background: rgba(255, 255, 255, 0.85);
    border: 2px solid var(--matcha-dark);
    border-radius: 20px; /* ✅ curved edges */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    padding: 2rem;
    width: 90%;
    max-width: 900px;
    margin: auto;
    backdrop-filter: blur(6px); /* ✅ subtle transparency effect */
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
    color: var(--off-white);
}

/* Body */
.card-body {
    padding: 2rem;
    text-align: center;
}
.form-top {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}
.profile-preview {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--matcha-dark);
}

/* Form fields */
.form-group {
    margin-bottom: 1.5rem;
    text-align: left;
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
    background: rgba(249, 249, 246, 0.9);
    color: var(--text-dark);
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem;
    border-radius: 10px; /* ✅ smoother inputs */
    transition: all 0.25s ease;
}
input::placeholder {
    color: var(--text-light);
}
input:focus {
    outline: none;
    border-color: var(--matcha-light);
    box-shadow: 0 0 6px rgba(169, 193, 168, 0.6);
}

/* Buttons */
.actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
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
.btn-primary {
    background: var(--matcha-dark);
    color: var(--off-white);
    border-color: var(--matcha-dark);
}
.btn-primary:hover {
    background: #2f4639;
    box-shadow: 0 0 10px rgba(63, 92, 75, 0.8); /* ✅ glow effect */
    transform: translateY(-2px);
}
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
            <h1>Update User</h1>
        </div>
        <div class="card-body">
            <form action="<?= site_url('users/update/' . $user['id']) ?>" method="POST" enctype="multipart/form-data">
                
                <!-- Profile Section -->
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
                   <button type="submit" class="btn btn-primary">
  <i class="fas fa-save"></i> Save Changes
</button>

<a href="<?= site_url('users/view') ?>" class="btn btn-secondary">
  <i class="fas fa-times"></i> Cancel
</a>


                </div>
            </form>

            <script>
            // Preview selected image before upload
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
