<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Users</title>
    <link rel="stylesheet" href="<?= base_url(); ?>public/css/data.css">
</head>
<body>
    <div class="header-row">
        <h1>Restore Users</h1>
    </div>

    <table class="guild-table">
        <tr>
            <th>ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Deleted At</th>
            <th>Action</th>
        </tr>
        <?php if(!empty($students)): ?>
            <?php foreach($students as $student): ?>
            <tr>
                <td><?= $student['id']; ?></td>
                <td><?= html_escape($student['last_name']); ?></td>
                <td><?= html_escape($student['first_name']); ?></td>
                <td><?= html_escape($student['email']); ?></td>
                <td><?= html_escape($student['Role']); ?></td>
                <td><?= $student['deleted_at']; ?></td>
                <td>
                    <a href="<?= site_url('/user/restore/'.$student['id']); ?>" class="btn">Restore</a> | 
                    <a href="<?= site_url('/user/delete/'.$student['id']); ?>" class="btn danger">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No Records Found</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        <?= $page; ?>
    </div>

    <div class="actions">
        <a href="<?= site_url('/user/show'); ?>" class="btn create">↩️ Back</a>
    </div>
</body>
</html>
