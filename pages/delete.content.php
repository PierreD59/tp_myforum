<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$id = $_GET['id'];

// Delete the data from the category table
$deleteComment = $database->prepare("DELETE FROM `comments` WHERE id = :id ");
$deleteComment->execute([
    "id" => $id,
]);

// Delete the data from the article table
$deleteArticle = $database->prepare("DELETE FROM `articles` WHERE id = :id ");
$deleteArticle->execute([
    "id" => $id,
]);

// Delete the data from the comment table
$deleteCategory = $database->prepare("DELETE FROM `categorys` WHERE id = :id ");
$deleteCategory->execute([
    "id" => $id,
]);
header('Location:?page=admin');

