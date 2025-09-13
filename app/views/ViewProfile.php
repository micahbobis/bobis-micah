<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewProfile</title>
<link rel="stylesheet" href="<?=base_url();?>public/css/style4.css">
</head>
<body>
    <div class="panel">
        <h1>Username: <?=html_escape($username);?></h1>
        <h1>Name: <?=html_escape($name);?></h1>
        <a href="<?=site_url('user/show');?>" class="back-link">Back to Showdata</a>

    </div>
</body>
</html>
