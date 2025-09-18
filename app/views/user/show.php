<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showdata</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="center-panel">
        <h1>SHOWDATA VIEW</h1>

        <!-- Search Bar -->
        <form action="<?= site_url('user/show'); ?>" method="get" class="search-form">
            <?php
            $q = '';
            if (isset($_GET['q'])) {
                $q = $_GET['q'];
            }
            ?>
            <input class="form-control me-2" name="q" type="text" placeholder="Search" value="<?= html_escape($q); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Table of Records -->
        <table border="1" class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
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
                            <a href="<?= site_url('user/update/'.$student['id']); ?>">Update</a>
                            <a href="<?= site_url('user/soft-delete/'.$student['id']); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No records found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination Links: nasa ibaba ng table -->
        <div class="pagination-links">
            <?= $page; ?>
        </div>

        <!-- Create Record Button -->
        <div class="create-link">
            <a href="<?= site_url('user/create'); ?>">Create Record</a>
        </div>
    </div>
</body>
</html>
