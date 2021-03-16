<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';


if (isset($_POST['categorySubmit'])) {
    if (isset($_POST['categoryName']) && !empty($_POST['categoryName'])) {
        $categoryName = htmlspecialchars($_POST['categoryName']);

        $addCategory = $database->prepare("INSERT INTO `categorys`(`name`) VALUES (:name)");
        $addCategory->execute([
                "name" => $categoryName,
        ]);
        echo '<p>La nouvelle Catégorie a été créée, <a href="?page=home">cliquez ici</a> pour la voir</p>';
    }
}

?>
    <h1>Page Administrateur</h1>


    <hr class="my-5">


    <div class="row m-0 p-0">

        <div class="col-md-6">
            <h2>Ajouter une Catégorie</h2>
            <form action="?page=admin" method="POST">

                <div class="mb-3">
                    <label for="categoryName" class="form-label">Nom de la Categorie</label>
                    <input type="text" class="form-control" id="categoryName" name="categoryName">
                </div>
                <input class="btn btn-primary" type="submit" name="categorySubmit" value="Ajouter une catégorie">       

            </form>
        </div>

        <div class="col-md-6">
            <h2>Ajouter un article</h2>
            <form action="?page=admin" method="POST">
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

    </div>