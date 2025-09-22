<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Roles</title>
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/role.css">
</head>
<body>
    <!-- Hero / Dashboard -->
    <div class="hero">
        <h1>🎭 User Roles Dashboard</h1>
        <p>
            Welcome to the User Roles Dashboard. Here, you can see all the roles assigned to users in the system.
            Manage permissions and access easily! ✨
        </p>
    </div>

    <!-- Buttons -->
    <div class="buttons">
        <a href="<?= site_url('/user/create'); ?>" class="btn checkin">➕ Add User</a>
        <a href="<?= site_url('/user/show'); ?>" class="btn list">📃 View Users</a>
        <a href="<?= site_url('/'); ?>" class="btn home">🏰 Home</a>
    </div>
</body>
</html>
