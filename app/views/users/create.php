<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create User</title>
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
}

* { box-sizing: border-box; margin:0; padding:0; }
body {
    font-family: 'Poppins', sans-serif;
    background: url("<?= base_url() ?>public/background.jpg") no-repeat center center fixed;
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
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem 2rem;
    background: var(--jet);
    border-bottom: 1px solid rgba(199,194,191,0.3);
    border-top-left-radius: 2rem;
    border-top-right-radius: 2rem;
}
.title {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 1.8rem;
    color: var(--white);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

/* --- Form --- */
.card-body { padding: 2rem; }
.form-group { margin-bottom: 1.5rem; }
label {
    font-weight: 500;
    font-size: 1rem;
    color: var(--silver);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
input[type="text"], input[type="email"], input[type="file"] {
    width: 100%;
    max-width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 1rem;
    border: 1px solid var(--davys-gray);
    background: rgba(31,26,26,0.5);
    color: var(--white);
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    transition: all 0.2s ease;
}
input::placeholder { color: var(--silver); }
input:focus {
    outline: none;
    border-color: var(--silver);
    box-shadow: 0 0 0 3px rgba(199,194,191,0.2);
}

/* --- Buttons --- */
.actions { display: flex; gap: 0.75rem; justify-content: flex-end; margin-top: 1rem; }
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
.btn i { pointer-events: none; }

/* Primary / Create */
.btn-primary {
    background: var(--black);
    color: var(--white);
}
.btn-primary:hover {
    background: #1a1a1a;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.35);
}

/* Secondary / Back */
.btn-secondary {
    background: var(--davys-gray);
    color: var(--white);
    border: 1px solid var(--silver);
}
.btn-secondary:hover {
    background: var(--jet);
    transform: translateY(-2px);
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
            <!-- IMPORTANT: may enctype na -->
            <form action="<?= site_url('users/create') ?>" method="POST" enctype="multipart/form-data">
            <!-- Top section: Image & Upload -->
            <div class="form-top" style="display:flex; gap:2rem; align-items:center; margin-bottom:1.5rem;">
                <!-- Left: Profile Image Preview (default muna) -->
                <div class="profile-left" style="flex:1; text-align:center;">
                    <?php if (!empty($user['image_path'])): ?>
                        <img src="<?= base_url() ?>public/<?= html_escape($user['image_path']) ?>">

                            alt="<?= htmlspecialchars($user['username']) ?>'s profile" 
                            class="profile-preview" id="profilePreview" 
                            style="width:120px; height:120px; border-radius:50%; object-fit:cover;">
                    <?php else: ?>
                            <img src="<?= base_url() ?>public/default-avatar.png" 
                            alt="Default profile" 
                            class="profile-preview" id="profilePreview" 
                            style="width:120px; height:120px; border-radius:50%; object-fit:cover;">
                    <?php endif; ?>
                </div>

                <!-- Right: Upload Button -->
                <div class="profile-right" style="flex:1; display:flex; flex-direction:column; justify-content:center;">
                    <label for="profile" style="font-weight:500; color:var(--silver); margin-bottom:0.5rem;">
                        <i class="fa-solid fa-image"></i> Upload Profile Image
                    </label>
                    <input type="file" name="profile" id="profile" accept="image/*">
                </div>
            </div>

                <!-- Bottom section: Username & Email -->
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
            // Image preview
            const profileInput = document.getElementById('profile');
            const previewImg = document.getElementById('profilePreview');

            profileInput.addEventListener('change', function() {
                const file = this.files[0];
                if(file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
            </script>
        </div>
    </div>
</div>

</body>
</html>