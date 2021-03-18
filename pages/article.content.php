<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

// Calls up the content of the article in relation to its ID
$query = $database->query('SELECT * FROM `articles` WHERE `id` =' . $_GET['id']);
$data = $query->fetch();

// Calls up the content of the article in relation to its ID
$query = $database->prepare('SELECT `id` FROM `users`');
$query->execute([
     "id" => ":id",
     ]);
$user = $query->fetch();



if(isset($_SESSION['pseudo'])) {
    $pseudo = $_SESSION['pseudo'];
} elseif(isset($_POST['pseudo']) && !empty($_POST['pseudo']) ){
    $pseudo = $_POST['pseudo'];
} else {
    $pseudo = "Anne Onyme";
}

// Checks the POSTS of the comment form and sends them to the DB
if (isset($_POST['commentSubmit'])) {
    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
            $addComment = $database->prepare("INSERT INTO `comments`(`pseudo`, `comment`, `publiched_date`, `article_id`, `user_id`) VALUES (:pseudo, :comment, :publiched_date, :article_id, :user_id)");
            $toto = $addComment->execute([
                "pseudo" => $pseudo,
                "comment" => $_POST['comment'],
                "publiched_date" => date("Y-m-d H:i:s"),
                "article_id" => $_GET['id'],
                "user_id" => $user['id'],
            ]);
    } 
}
?>



<div class="home">
    <div class="container my-5">
        <div class="articleBlock article p-5">
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

    <div class="container my-3">
        <div class="row d-flex justify-content-center m-0 p-0">
            <div class="commentBlock p-5 col-md-4 border-end m-3">
                <h2>Envoyer un commentaire</h2>
                <hr>
                <form method="post" class="p-3" action="?page=article&id=<?= $data['id']; ?>">
                

                <?php if(isset($_SESSION['pseudo'])) { ?>
                    <div class="form-group mb-3">
                        <label for="comment" class="form-label">Votre commentaire</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>                
                    </div>
                <?php } else { ?>
                    <div class="form-group mb-3">
                        <label for="pseudo" class="form-label">Votre pseudo</label>
                        <input type="text" id="pseudo" class="form-control" name="pseudo" value="<?= $pseudo ?>"/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="comment" class="form-label">Votre commentaire</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>                
                    </div>
                <?php } ?>

                    <input type="submit" class="btn btn-primary my-3" name="commentSubmit">

                </form>
            </div>
            <div class="col-md-6">

            <?php $query = $database->query('SELECT * FROM `comments` WHERE `article_id` =' . $_GET['id']);
            while (($dataComment = $query->fetch())) { ?>

                <div class="commentBlock border m-3 p-3">
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