<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/style.css">
</head>
<body>
    <h1>👤 User Information</h1>
    <h2>Please enter the details below:</h2>

    <div class="form-container">
        <form action="<?= site_url('/user/create'); ?>" method="post">
            <label for="last_name">📝 Last Name</label><br>
            <input type="text" name="last_name" placeholder="Doe" required><br>

            <label for="first_name">📝 First Name</label><br>
            <input type="text" name="first_name" placeholder="Jane" required><br>

            <label for="email">📧 Email</label><br>
            <input type="email" name="email" placeholder="jane@example.com" required><br>

            <label for="role">🎭 Role</label><br>
            <input type="text" name="role" placeholder="Admin/User" required><br>

            <button type="submit">✅ Enter</button>

            <div class="nav">
                <a href="<?= site_url('/user/show/'); ?>" class="btn create">📃 Records</a>
                <a href="<?= site_url('/'); ?>" class="btn danger">🏠 Home</a>
            </div>
        </form>
    </div>
</body>
</html>
