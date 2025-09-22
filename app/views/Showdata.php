<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Records</title>
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/data.css">
</head>
<body>

<div class="topnav">
    <h1>👥 Welcome to User Records</h1>
    <form action="<?= site_url('user/show/'); ?>" method="get">
        <?php
        $q = '';
        if(isset($_GET['q'])) {
            $q = $_GET['q'];
        }
        ?>
        <input class="search" name="q" type="text" placeholder="Search" value="<?= html_escape($q); ?>">
        <button type="submit" class="btn">🔍 Search</button>
    </form>
</div>

<h2>List of Users</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>

    <?php if(!empty($students)): ?>
        <?php foreach (html_escape($students) as $student): ?>
        <tr>
            <td><?= $student['id']; ?></td>
            <td><?= $student['last_name']; ?></td>
            <td><?= $student['first_name']; ?></td>
            <td><?= $student['email']; ?></td>
            <td><?= $student['Role']; ?></td>
            <td>
                <a href="<?= site_url('/user/update/'.$student['id']); ?>">✏️ Update</a> |
                <a href="<?= site_url('/user/softdelete/'.$student['id']); ?>">🗑️ Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No Records Found</td>
        </tr>
    <?php endif; ?>
</table>

<!-- Pagination -->
<div class="pagination-wrapper">
    <?= $page; ?>
</div>

<div class="actions">
    <a href="<?= site_url('/user/create'); ?>" class="btn create">➕ Create</a>
    <a href="<?= site_url('/user/restore'); ?>" class="btn create">🔄 Restore</a>
    <a href="<?= site_url('/'); ?>" class="btn create">🏰 Home</a>
</div>

</body>
</html>
