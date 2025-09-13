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

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?=html_escape($students['last_name']);?>">

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?=html_escape($students['first_name']);?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?=html_escape($students['email']);?>">

            <label for="role">Role:</label>
            <input type="text" id="role" name="role" value="<?=html_escape($students['Role']);?>">

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
