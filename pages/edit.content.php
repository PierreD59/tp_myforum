<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

// Call category's ID
$query = $database->prepare('SELECT * FROM `categorys` WHERE `id` = :id');
$query->execute([
     "id" => $_GET['id'],
     ]);
$category = $query->fetch();

// Call article's ID
$query = $database->prepare('SELECT * FROM `articles` WHERE `id` = :id');
$query->execute([
     "id" => $_GET['id'],
     ]);
$article = $query->fetch();

// Call comment's ID
$query = $database->prepare('SELECT * FROM `comments` WHERE `id` = :id');
$query->execute([
     "id" => $_GET['id'],
     ]);
$comment = $query->fetch();

// Edit Category
if (isset($_POST['editCategorySubmit'])) {
    if(isset($_POST['editNameCategory']) && !empty($_POST['editNameCategory'])) {
        $editName = htmlspecialchars($_POST['editNameCategory']);
        $editCategory = $database->prepare("UPDATE `categorys` SET `name`= :name WHERE `id` =" . $_GET['id']);
        $editCategory->execute([
            "name" => $editName,
        ]);
    }
}
?>
<div class="home">
    <div class="container">

<?php if (isset($category['id'])) { ?>
        <div class="categoryBlock p-5 col-md-6">
            <h2>Editer une catégorie</h2>
            <hr>
            <form action="?page=edit&id=<?=$category['id']; ?>" method="POST">
                <div class="form-group mb-3">
                    <label for="editNameCategory" class="form-label">Editer le nom de la catégorie :</label>
                    <input type="text" class="form-control" name="editNameCategory" id="editNameCategory" value="<?= $category['name']; ?>">
                </div>

                <input type="submit" class="btn btn-primary my-3" name="editCategorySubmit">
            </form>
        </div>
<?php } elseif(isset($article['id'])) { ?>
        <div class="articleBlock p-5 col-md-6">
            <h2>Editer un article</h2>
            <hr>
            <form action="?page=edit&id=<?=$article['id']; ?>" method="POST">
                <div class="form-group mb-3">
                    <label for="articleName" class="form-label">Nom de l'article :</label>
                    <input type="text" class="form-control" name="articleName" id="articleName" value="<?= $article['articleName']; ?>">
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
<?php } ?>

    </div>
</div>

