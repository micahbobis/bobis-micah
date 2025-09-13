<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="/public/css/style2.css">


</head>
<body>
    <div class="panel">
        <h1>UPDATE VIEW</h1>
            <form action="/user/update/<?=$students['id'];?>" method="post">
    <label>Last Name</label>
    <input type="text" name="last_name" value="<?=html_escape($students['last_name']);?>">
    <label>First Name</label>
    <input type="text" name="first_name" value="<?=html_escape($students['first_name']);?>">
    <label>Email</label>
    <input type="email" name="email" value="<?=html_escape($students['email']);?>">
    <label>Role</label>
    <input type="text" name="role" value="<?=html_escape($students['Role']);?>">
    <input type="submit" value="Update">
</form>

    </div>
</body>
</html>
