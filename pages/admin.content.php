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
        header('location:?page=admin');
    }
}

?>
<div class="home">
    <h1 class="text-center">Page Administrateur</h1>
    <hr class="my-5">
    <div class="container my-5">
        <h2>Liste des Catégories</h2>
        <table class="col-12 text-center table">
            <thead class="thead-light">
                <tr>
                <th scope="col">Nom</th>
                <th scope="col">Editer</th>
                <th scope="col">Supprimer</th>                
                </tr>
            </thead>
            <tbody class="align-middle">
                <?php $query = $database->query('SELECT * FROM `categorys`');
                while (($data = $query->fetch())) { ?>
                <tr>
                    <td><a href="?page=category&id=<?= $data['id']; ?>"><?= $data['name']; ?></a></td>
                    <td><a href="?page=edit&id=<?= $data['id']; ?>"><i class="fas fa-cog p-1"></i></a></td>
                    <td><a href="?page=delete&id=<?= $data['id']; ?>"><i class="fas fa-times p-1"></i></a></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>

        <h2>Liste des Sujets</h2>
        <table class="col-12 text-center table">
            <thead class="thead-light">
                <tr>
                <th scope="col">Titre de l'article</th>
                <th scope="col">Auteur</th>
                <th scope="col">Introduction</th>
                <th scope="col">Contenu</th>
                <th scope="col">Date de Publication</th>
                <th scope="col">Editer</th>
                <th scope="col">Supprimer</th>                
                </tr>
            </thead>
            <tbody class="align-middle">
                <?php $query = $database->query('SELECT * FROM `articles`');
                while (($data = $query->fetch())) { ?>
                <tr>
                    <td><a href="?page=article&id=<?= $data['id']; ?>"><?= $data['articleName']; ?></a></td>
                    <td><?= $data['author']; ?></td>
                    <td><?= substr($data['chapeau'], 0, 50); ?></td>
                    <td><?= substr($data['content'], 0, 50); ?></td>
                    <td><?= $data['publiched_date']; ?></td>
                    <td><a href="?page=edit&id=<?= $data['id']; ?>"><i class="fas fa-cog p-1"></i></a></td>
                    <td><a href="?page=delete&id=<?= $data['id']; ?>"><i class="fas fa-times p-1"></i></a></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>

        <h2>Liste des Commentaires</h2>
        <table class="col-12 text-center table">
            <thead class="thead-light">
                <tr>
                <th scope="col">Nom</th>
                <th scope="col">Commentaire</th>
                <th scope="col">Date de Publication</th>                
                <th scope="col">Editer</th>
                <th scope="col">Supprimer</th>                
                </tr>
            </thead>
            <tbody class="align-middle">
                <?php $query = $database->query('SELECT * FROM `comments`');
                while (($data = $query->fetch())) { ?>
                <tr>
                    <td><a href="?page=article&id=<?= $data['id']; ?>"><?= $data['pseudo']; ?></a></td>
                    <td><?= $data['comment']; ?></td>
                    <td><?= $data['publiched_date']; ?></td>
                    <td><a href="?page=edit&id=<?= $data['id']; ?>"><i class="fas fa-cog p-1"></i></a></td>
                    <td><a href="?page=delete&id=<?= $data['id']; ?>"><i class="fas fa-times p-1"></i></a></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>


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