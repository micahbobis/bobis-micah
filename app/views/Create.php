<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="/public/css/style3.css">

</head>
<body>
    <div class="panel">
        <h1>CREATE VIEW</h1>
        <form action="/user/create" method="post">

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>
            
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="role">Role</label>
            <input type="text" id="role" name="role" required>
            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
