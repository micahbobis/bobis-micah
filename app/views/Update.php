<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/style.css">
</head>
<body>
    <h1>✏️ Update User Information</h1>
    <h2>Please update the details below:</h2>

    <form action="<?= site_url('/user/update/'.$students['id']); ?>" method="post">
        <label for="last_name">📝 Last Name</label><br>
        <input type="text" name="last_name" value="<?= html_escape($students['last_name']); ?>" required><br>

        <label for="first_name">📝 First Name</label><br>
        <input type="text" name="first_name" value="<?= html_escape($students['first_name']); ?>" required><br>

        <label for="email">📧 Email</label><br>
        <input type="email" name="email" value="<?= html_escape($students['email']); ?>" required><br>

        <label for="role">🎭 Role</label><br>
        <input type="text" name="role" value="<?= html_escape($students['Role']); ?>" required><br>

        <button type="submit">✅ Update</button>
        <a href="<?= site_url('/user/show'); ?>" class="btn danger">↩️ Back</a>
    </form>
</body>
</html>
