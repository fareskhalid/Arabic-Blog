<!DOCTYPE html>
<html lang="ar">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= $page_title !== 'مدونتي' ? '../' : ''?>css/bootstrap.css">
        <link rel="stylesheet" href="<?= $page_title !== 'مدونتي' ? '../' : ''?>css/bootstrap-rtl.css">
        <?php if ($page_title === 'مدونتي') : ?>
        <link rel="stylesheet" href="css/main.css">
        <?php else: ?>
        <link rel="stylesheet" href="../css/dashboard.css">
        <?php endif; ?>
        <title><?php echo $page_title ?? 'مدونتي'; ?></title>
    </head>