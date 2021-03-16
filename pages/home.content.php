<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';


?>
<div class="home">

    <h1>Accueil</h1>

    <?php

    $query = $database->query('SELECT * FROM `categorys`');
            while (($dataCategory = $query->fetch())) { ?>

    <div><?= $dataCategory['name']; ?></div>
    <?php } ?>


</div>