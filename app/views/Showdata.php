<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showdata</title>
    <link rel="stylesheet" href="<?=base_url();?>public/css/style.css">


</head>
<body>
    <div class="center-panel">
        <h1>SHOWDATA VIEW</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php foreach($students as $student): ?>
<tr>
    <td><?=html_escape($student['id']);?></td>
    <td><?=html_escape($student['last_name']);?></td>
    <td><?=html_escape($student['first_name']);?></td>
    <td><?=html_escape($student['email']);?></td>
    <td><?=html_escape($student['Role']);?></td>
    <td>
       <a href="/user/update/<?=$student['id'];?>">Update</a>
       <a href="/user/soft-delete/<?=$student['id'];?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
<a href="/user/create">Create Record</a>
        </table>
        <a href="/user/create">Create Record</a>

    </div>
</body>
</html>
