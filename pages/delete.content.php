<?php

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

// Delete the data from the comment table
$deleteUser = $database->prepare("DELETE FROM `users` WHERE id = :id ");
$deleteUser->execute([
    "id" => $id,
]);
header("Location: " . $_SERVER['HTTP_REFERER']);

