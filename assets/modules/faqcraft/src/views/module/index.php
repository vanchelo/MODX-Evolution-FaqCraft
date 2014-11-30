<?php /** @var \FaqCraft\FaqCraft $app */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FaqCraft</title>
    <link rel="stylesheet" href="<?= $app->config['assetsUrl'] ?>css/jquery.dataTables.min.css"/>

    <style>
        body {
            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 12px;
        }
    </style>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="<?= $app->config['assetsUrl'] ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= $app->config['assetsUrl'] ?>js/module.js"></script>
</head>
<body>
<table id="faqs" class="display" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>ID</th>
        <th>Вопрос</th>
        <th>Публикация</th>
        <th>Категория</th>
        <th>Дата создания</th>
        <th>Дата обновления</th>
        <th></th>
    </tr>
    </thead>
</table>
</body>
</html>
