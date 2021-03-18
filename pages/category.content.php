<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

// Call category's ID

$query = $database->prepare('SELECT `id` FROM `categorys` WHERE `id` = :id');
$query->execute([
     "id" => $_GET['id'],
     ]);
$dataID = $query->fetch();

$query = $database->prepare('SELECT `id` FROM `users`');
$query->execute([
     "id" => ":id",
     ]);
$userID = $query->fetch();


// Add Article
if (isset($_POST['articleSubmit'])) {
    if (isset($_POST['articleName']) && !empty($_POST['articleName'])) {
        $articleName = htmlspecialchars($_POST['articleName']);

        if (isset($_POST['chapeau']) && !empty($_POST['chapeau'])) {
            $chapeau = htmlspecialchars($_POST['chapeau']);
            if (isset($_POST['contentArticle']) && !empty($_POST['contentArticle'])) {
                $content = htmlspecialchars($_POST['contentArticle']);
                $addArticle = $database->prepare("INSERT INTO `articles`(`articleName`, `content`, `publiched_date`, `author` ,`chapeau`, `category_id`, `user_id`) VALUES (:articleName, :content, :publiched_date, :author, :chapeau, :category_id, :user_id)");
                $addArticle->execute([
                    "articleName" => $articleName,
                    "content" => $content,
                    "publiched_date" => date("Y-m-d H:i:s"),
                    "author" => $_SESSION['pseudo'],
                    "chapeau" => $chapeau,
                    "category_id" => $_GET['id'],
                    "user_id" => $userID['id'],
                ]);
            } else {
                echo "Entrez un contenu";
            }
        } else {
            echo "Entrez une Introduction";
        }
    } else {
        echo "Entrez un nom d'Article";
    }
}

?>
<div class="home">

    <div class="container">
        <div class="articleBlock p-3">

            <table class="col-12 table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Nom de l'article</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Introduction</th>
                    <th scope="col">Date de Publication</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $query = $database->query('SELECT `id`, `articleName`, `author`, `chapeau`, `publiched_date` FROM `articles` WHERE `category_id` =' . $dataID['id']);
                    while (($dataArticle = $query->fetch())) { ?>
                    <tr>
                        <th scope="row"><a href="?page=article&id=<?= $dataArticle['id']; ?>"> <?= $dataArticle['articleName']; ?></a></th>
                        <td><?= $dataArticle['author']; ?></td>
                        <td><?= substr($dataArticle['chapeau'], 0, 50); ?></td>
                        <td><?= $dataArticle['publiched_date']; ?></td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>

        </div>

        <hr>

        <?php if(isset($_SESSION['pseudo'])) { ?>
                    <div class="articleBlock p-5 col-md-6">
                    <h2>Ajouter un article</h2>
                    <hr>
                    <form action="?page=category&id=<?=$dataID['id']; ?>" method="POST">
                        <div class="form-group mb-3">
                            <label for="articleName" class="form-label">Nom de l'article :</label>
                            <input type="text" class="form-control" name="articleName" id="articleName" placeholder="Toto va à la plage">
                        </div>

                        <div class="form-group">
                            <label for="chapeau" class="form-label">Introduction de l'article :</label>
                            <textarea class="form-control" id="chapeau" name="chapeau" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="contentArticle" class="form-label">Contenu de l'article :</label>
                            <textarea class="form-control" id="contentArticle" name="contentArticle" rows="3"></textarea>
                        </div>

                        <input type="submit" class="btn btn-primary my-3" name="articleSubmit">
                    </form>
                </div>
        <?php } else { ?>
            <h2>Vous devez vous connecter pour créer un sujet</h2>
        <?php } ?>
    </div>

</div>