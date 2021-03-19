<?php

// Add Category
if (isset($_POST['categorySubmit'])) {
    if (isset($_POST['categoryName']) && !empty($_POST['categoryName'])) {
        $categoryName = htmlspecialchars($_POST['categoryName']);

        $addCategory = $database->prepare("INSERT INTO `categorys`(`name`) VALUES (:name)");
        $addCategory->execute([
                "name" => $categoryName,
        ]);
        header('location:?page=home');
    }
}

?>
<div class="home">

    <h1>Accueil</h1>
    <hr>

    <?php $query = $database->query('SELECT * FROM `categorys`');
        while (($dataCategory = $query->fetch())) { ?>
                <div class="categoryBlock p-3"><a href="?page=category&id=<?= $dataCategory['id']; ?>"><?= $dataCategory['name']; ?></a></div>
        <?php } ?>

        <hr>
        <div class="col-md-6 row m-auto p-0">

<?php if(isset($_SESSION['pseudo'])) { ?>
            <div class="categoryBlock">
                <div class="p-5">
                    <h2 class="text-center">Ajouter une Catégorie</h2>
                    <hr>
                    <form action="?page=home" method="POST">

                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nom de la Categorie</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName">
                        </div>
                        <input class="btn btn-primary" type="submit" name="categorySubmit" value="Ajouter une catégorie">       

                    </form>
                </div>
            </div>
        <?php } else { ?>
            <h2>Vous devez vous connecter pour créer une catégorie</h2>
        <?php } ?>
        </div>

</div>