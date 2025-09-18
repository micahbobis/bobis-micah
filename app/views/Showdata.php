<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showdata</title>

    <!-- kung may sariling css -->
    <link rel="stylesheet" href="/public/css/style.css">
    <!-- kung gumagamit ng bootstrap css, siguraduhing naka-include -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-3">SHOWDATA VIEW</h1>

    <!-- ✅ Search form: nasa ilalim ng title -->
    <?php
        $q = isset($_GET['q']) ? $_GET['q'] : '';
    ?>
    <form action="<?= site_url('user/show'); ?>" method="get" class="mb-3">
        <div class="row g-2">
            <div class="col-sm-6 col-md-4">
                <input class="form-control" name="q" type="text"
                       placeholder="Search" value="<?= html_escape($q); ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- ✅ Table of records -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
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
        <?php foreach($students as $student): ?>
            <tr>
                <td><?= html_escape($student['id']); ?></td>
                <td><?= html_escape($student['last_name']); ?></td>
                <td><?= html_escape($student['first_name']); ?></td>
                <td><?= html_escape($student['email']); ?></td>
                <td><?= html_escape($student['Role']); ?></td>
                <td>
                    <a class="btn btn-sm btn-warning"
                       href="<?= site_url('user/update/'.$student['id']); ?>">Update</a>
                    <a class="btn btn-sm btn-danger"
                       href="<?= site_url('user/soft-delete/'.$student['id']); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a class="btn btn-success mb-3"
       href="<?= site_url('user/create'); ?>">Create Record</a>

    <!-- ✅ Pagination links sa pinakababa -->
    <div class="mt-3">
        <?= $page ?>
    </div>
</div>
</body>
</html>
