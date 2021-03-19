<?php

// Calls the ID of the category table
$query = $database->prepare('SELECT * FROM `categorys` WHERE `id` = :id');
$query->execute([
     "id" => $_GET['id'],
     ]);
$category = $query->fetch();

// Calls the ID of the article table
$query = $database->prepare('SELECT * FROM `articles` WHERE `id` = :id');
$query->execute([
     "id" => $_GET['id'],
     ]);
$article = $query->fetch();

// Calls the ID of the comment table
$query = $database->prepare('SELECT * FROM `comments` WHERE `id` = :id');
$query->execute([
     "id" => $_GET['id'],
     ]);
$comment = $query->fetch();

// Checks the form data and edits the category
if (isset($_POST['editCategorySubmit'])) {
    if(isset($_POST['editNameCategory']) && !empty($_POST['editNameCategory'])) {
        $editName = htmlspecialchars($_POST['editNameCategory']);
        $editCategory = $database->prepare("UPDATE `categorys` SET `name`= :name WHERE `id` =" . $_GET['id']);
        $editCategory->execute([
            "name" => $editName,
        ]);
        header("Location: ?page=home");
    }
}

// Checks the data in the form and edits the article
if (isset($_POST['editArticle'])) {
    if(isset($_POST['editArticleName']) && !empty($_POST['editArticleName'])) {
        $editNameArticle = htmlspecialchars($_POST['editArticleName']);

        if(isset($_POST['editChapeau']) && !empty($_POST['editChapeau'])) {
            $editChapeau = htmlspecialchars($_POST['editChapeau']);

            if(isset($_POST['editContentArticle']) && !empty($_POST['editContentArticle'])) {
                $editContent = htmlspecialchars($_POST['editContentArticle']);

                $editArticle = $database->prepare("UPDATE `articles` SET `articleName`= :articleName, `chapeau` = :chapeau, `content` = :content WHERE `id` =" . $_GET['id']);
                $toto = $editArticle->execute([
                    "articleName" => $editNameArticle,
                    "chapeau" => $editChapeau,
                    "content" => $editContent,
                    ]);
                header("Location: ?page=category");
            } 
        }
    }
}

// Checks the form data and edits the comment
if (isset($_POST['editComment'])) {
    if(isset($_POST['editContent']) && !empty($_POST['editContent'])) {
        $editContent = htmlspecialchars($_POST['editContent']);

        $editArticle = $database->prepare("UPDATE `comments` SET `comment`= :comment WHERE `id` =" . $_GET['id']);
        $toto = $editArticle->execute([
            "comment" => $editContent,
            ]);
        header("Location: ?page=article");
        
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
                    <label for="editArticleName" class="form-label">Nom de l'article :</label>
                    <input type="text" class="form-control" name="editArticleName" id="editArticleName" value="<?= $article['articleName']; ?>">
                </div>

                <div class="form-group">
                    <label for="editChapeau" class="form-label">Introduction de l'article :</label>
                    <textarea class="form-control" id="editChapeau" name="editChapeau" rows="3"><?= $article['chapeau']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="editContentArticle" class="form-label">Contenu de l'article :</label>
                    <textarea class="form-control" id="editContentArticle" name="editContentArticle" rows="3"><?= $article['content']; ?></textarea>
                </div>

                <input type="submit" class="btn btn-primary my-3" name="editArticle">
            </form>
        </div>
<?php } else { ?>

        <div class="commentBlock p-5 col-md-4 border-end m-3">
            <h2>Envoyer un commentaire</h2>
            <hr>
            <form method="post" class="p-3" action="?page=edit&id=<?= $comment['id']; ?>">

                <div class="form-group mb-3">
                    <label for="editContent" class="form-label">Editez votre commentaire</label>
                    <textarea class="form-control" id="editContent" name="editContent" rows="3"><?= $comment['comment']; ?></textarea>                
                </div>
                <input type="submit" class="btn btn-primary my-3" name="editComment">

            </form>
        </div>
<?php } ?>
    </div>
</div>

