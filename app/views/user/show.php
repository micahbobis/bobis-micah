<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showdata</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <style>
        /* dagdag na style para sa pagination */
        .pagination-wrapper {
            text-align: center;     /* center horizontal */
            margin-top: 20px;       /* space sa taas */
        }

        /* optional: kung may <ul> generated ng pagination */
        .pagination-wrapper ul {
            display: inline-flex;   /* para inline ang mga link */
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination-wrapper ul li {
            margin: 0 5px;
        }

        .pagination-wrapper ul li a {
            text-decoration: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #333;
        }

        .pagination-wrapper ul li a:hover,
        .pagination-wrapper ul li.active a {
            background: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="center-panel">
        <h1>SHOWDATA VIEW</h1>

        <form action="<?= site_url('user/show'); ?>" method="get" class="col-sm-4 float-end d-flex">
            <?php
            $q = '';
            if (isset($_GET['q'])) {
                $q = $_GET['q'];
            }
            ?>
            <input class="form-control me-2" name="q" type="text" placeholder="Search" value="<?= html_escape($q); ?>">
            <button type="submit" class="btn btn-primary" type="button">Search</button>
        </form>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= html_escape($student['id']); ?></td>
                <td><?= html_escape($student['last_name']); ?></td>
                <td><?= html_escape($student['first_name']); ?></td>
                <td><?= html_escape($student['email']); ?></td>
                <td><?= html_escape($student['Role']); ?></td>
                <td>
                    <a href="/user/update/<?= $student['id']; ?>">Update</a>
                    <a href="/user/soft-delete/<?= $student['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <a href="/user/create">Create Record</a>

        <!-- ⬇️ dito naka-center ang pagination -->
        <div class="pagination-wrapper">
            <?= $page; ?>
        </div>
    </div>
</body>
</html>
