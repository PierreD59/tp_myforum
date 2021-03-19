<div class="home">
<h1>Liste des membres</h1>
<hr>

        <!-- List of Users -->
        <div class="categoryBlock p-3">
            <table class="col-12 text-center table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Date d'inscription</th> 
                    <th scope="col">Dernière visite</th>
                    <th scope="col">Nombre de messages</th>                    
                    <th scope="col">Supprimer</th>                
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php $query = $database->query('SELECT * FROM `users`');
                    while (($data = $query->fetch())) { 
                        
                    $count = $database->prepare('SELECT * FROM `articles` WHERE user_id =' . $data['id']);
                    $count->execute();
                    $countArticle = $count->rowCount();

                    $count = $database->prepare('SELECT * FROM `comments` WHERE user_id =' . $data['id']);
                    $count->execute();
                    $countComment = $count->rowCount();

                    $countMessage = $countArticle + $countComment; ?>
                    <tr>
                        <td><a href="?page=profile&id=<?= $data['id']; ?>"><?= $data['pseudo']; ?></a></td>
                        <td><?= $data['registration_date']; ?></td>
                        <td><?= $data['last_connection']; ?></td>
                        <td><?= $countMessage; ?></td>
                        <td><a href="?page=delete&id=<?= $data['id']; ?>"><i class="fas fa-times p-1"></i></a></td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>


</div>