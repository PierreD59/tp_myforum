<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

// Calls up the content of the article in relation to its ID
$query = $database->query('SELECT * FROM `articles` WHERE `id` =' . $_GET['id']);
$data = $query->fetch();

// Checks the POSTS of the comment form and sends them to the DB

if (isset($_POST['commentSubmit'])) {
    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
        if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
            $addComment = $database->prepare("INSERT INTO `comments`(`pseudo`, `comment`, `publiched_date`, `article_id`) VALUES (:pseudo, :comment, :publiched_date , :article_id)");
            $addComment->execute([
                "pseudo" => $_POST['pseudo'],
                "comment" => $_POST['comment'],
                "publiched_date" => date("Y-m-d H:i:s"),
                "article_id" => $_GET['id'],
            ]);
        } else {
            $defaultPseudo = "Anne Onyme";
            $addComment = $database->prepare("INSERT INTO `comments`(`pseudo`, `comment`, `publiched_date`, `article_id`) VALUES (:pseudo, :comment, :publiched_date , :article_id)");
            $addComment->execute([
                "pseudo" => $defaultPseudo,
                "comment" => $_POST['comment'],
                "publiched_date" => date("Y-m-d H:i:s"),
                "article_id" => $_GET['id'],
            ]);
        }
    }
} ?>



<div class="home">
    <div class="container my-5">
        <div class="article">
            <h1><?= $data['articleName']; ?></h1>
            <hr>
            <p><?= $data['chapeau']; ?></p>
            <p><?= $data['content']; ?></p>

            <div class="row">
                <div class="col-md-6 d-flex justify-content-start">
                    <p>Posté le <?= $data['publiched_date']; ?> par <?= $data['author']; ?></p>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="?page=edit&id=<?= $data['id']; ?>"><i class="fas fa-cog p-1"></i></a>
                    <a href="?page=delete&id=<?= $data['id']; ?>"><i class="fas fa-times p-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center">Espace Commentaire</h2>
    <hr>

    <div class="container-fluid my-3">
        <div class="row m-0 p-0">
            <div class="col-md-4 border-end m-3">
                <form method="post" class="p-3" action="?page=article&id=<?= $data['id']; ?>">
                
                    <div class="form-group mb-3">
                        <label for="pseudo" class="form-label">Votre pseudo</label>
                        <input type="text" id="pseudo" class="form-control" name="pseudo" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="comment" class="form-label">Votre commentaire</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>                
                    </div>
                    <input type="submit" class="btn btn-primary my-3" name="commentSubmit">

                </form>
            </div>
            <div class="col-md-6">

            <?php $query = $database->query('SELECT * FROM `comments` WHERE `article_id` =' . $_GET['id']);
            while (($dataComment = $query->fetch())) { ?>

                <div class="bg-light border m-3 p-3">
                    <div class="d-flex justify-content-end">
                        <a href="?page=edit&id=<?= $dataComment['id']; ?>"><i class="fas fa-cog p-1"></i></a>
                        <a href="?page=delete&id=<?= $dataComment['id']; ?>"><i class="fas fa-times p-1"></i></a>
                    </div>
                    <p><?= $dataComment['pseudo'] ?></p>
                    <p><?= $dataComment['publiched_date']; ?></p>
                    <p><?= $dataComment['comment']; ?></p>
                </div>

            <?php } ?>
            </div>
        </div>
    </div>
</div>