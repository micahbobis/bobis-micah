<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="/public/css/style2.css"> <!-- separate CSS file -->
</head>
<body>
    <div class="panel">
        <h1>UPDATE VIEW</h1>
        <form action="<?= site_url('user/update/' . $students['id']); ?>" method="post">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?= html_escape($students['last_name']); ?>" required>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?= html_escape($students['first_name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= html_escape($students['email']); ?>" required>

            <label for="role">Role:</label>
            <input type="text" id="role" name="role" value="<?= html_escape($students['Role']); ?>" required>

            <input type="submit" value="Update">
        </form>
        <a href="<?= site_url('user/show'); ?>" class="back-link">⬅ Back to Showdata</a>
    </div>
</body>
</html>
