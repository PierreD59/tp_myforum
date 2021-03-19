<?php 
// Calls up the content of the user in relation to its ID
$query = $database->prepare('SELECT * FROM `users` WHERE `id` = :id');
$query->execute([
     "id" => $_GET['id'],
     ]);
$user = $query->fetch();
?>

<div class="home">

<h1>Page de profil</h1>
<hr>
<div class="container toto">

    <div class="row p-3 m-0">
        <div class="profileBlock detailProfile p-3 col-md-6 border-end">
            <h2>Information de <?= $user['pseudo']; ?></h2>
            <ul>
                <li>Adresse mail : <?php $user['email_adress']; ?></li>
                <li>Date d'inscription : <?php $user['registration_date']; ?></li>
                <?php $count = $database->prepare('SELECT * FROM `articles` WHERE user_id =' . $user['id']);
                    $count->execute();
                    $countUser = $count->rowCount(); ?>
                <li>Messages : <?= $countUser; ?></li>              
            </ul>
        </div>
        <div class="profileBlock imgProfile col-md-4">
            <h2>Photo de Profil</h2>
            <img src="<?= $user['illustration_image_url']; ?>" alt="Photo profil">
        </div>

    </div>

</div>


</div>