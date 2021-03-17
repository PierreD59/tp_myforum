<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';
$id = $_GET['id'];

$deleteComment = $database->prepare("DELETE FROM `comments` WHERE id = :id ");
$deleteComment->execute([
    "id" => $id,
]);

$deleteArticle = $database->prepare("DELETE FROM `articles` WHERE id = :id ");
$deleteArticle->execute([
    "id" => $id,
]);

$deleteCategory = $database->prepare("DELETE FROM `categorys` WHERE id = :id ");
$deleteCategory->execute([
    "id" => $id,
]);

header('Location:?page=home');
