<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';


// Add Category
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
<div class="home">
    <div class="container my-5">
        <h1 class="text-center">Page Administrateur</h1>
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

        </div>
    </div>
</div>