<?php

try {
    // Connexion à la BDD et stocker la connectivité dans $database
    $database = new PDO('mysql:host=localhost;dbname=myforum;charset=utf8', 'root', '');
} catch (Exception $exception) {
    var_dump($exception);
    exit;
}

return $database;
