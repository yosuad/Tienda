<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['page_tag']; ?></title>
</head>

<body>
    <h1><?php echo $data['page_title']; ?></h1>
    <p><?php echo $data['page_content']; ?></p>

    <?php echo SMONEY . formatMoney(52500); ?>
</body>

</html>