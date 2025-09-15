<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Students</title>
    <link rel="stylesheet" href="/public/css/style4.css"> <!-- separate CSS file -->
</head>
<body>
    <div class="panel">
        <h1>Students</h1>

        <div class="actions">
            <a href="<?= site_url('user/create'); ?>" class="back-link">Add New Student</a>
        </div>

        <table class="student-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= html_escape($student['id']); ?></td>
                            <td><?= html_escape($student['last_name']); ?></td>
                            <td><?= html_escape($student['first_name']); ?></td>
                            <td><?= html_escape($student['email']); ?></td>
                            <td><?= html_escape($student['Role']); ?></td>
                            <td>
                                <a href="<?= site_url('user/update/' . $student['id']); ?>">Edit</a>
                                <span class="separator">|</span>
                                <a href="<?= site_url('user/delete/' . $student['id']); ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="no-data">No students found 😢</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (!empty($page)): ?>
            <div class="pagination">
                <?= $page; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
