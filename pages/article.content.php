<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$query = $database->query('SELECT * FROM `articles` WHERE `id` =' . $_GET['id']);
                while (($data = $query->fetch())) { ?>

<div class="home">
    <div class="container">
        <div class="article">
            <h1><?= $data['articleName']; ?></h1>
            <hr>
            <p><?= $data['chapeau']; ?></p>
            <p><?= $data['content']; ?></p>
            <p>Posté le<?= $data['publiched_date']; ?> par <?= $data['author']; ?></p>
        </div>
    </div>
</div>
<?php } ?>