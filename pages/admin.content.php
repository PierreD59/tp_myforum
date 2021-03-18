<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php'; ?>

<div class="home">
    <h1>Page Administrateur</h1>
    <hr>
    <div class="container my-5">

        <!-- List of Category -->
        <div class="categoryBlock p-3">
            <h2>Liste des Catégories</h2>
            <hr>
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
        </div>

        <div class="categoryBlock p-3">
            <h2>Liste des Sujets</h2>
            <hr>
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
        </div>
        <div class="categoryBlock p-3">
            <h2>Liste des Commentaires</h2>
            <hr>
            <table class="col-12 text-center table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Pseudo</th>
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
        </div>
    </div>
</div>