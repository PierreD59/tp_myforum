<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
        $query = $database->prepare('SELECT * FROM `users` WHERE `pseudo` = :pseudo');
            $query->execute([
                "pseudo" => $_POST['pseudo'],
            ]);
            $user = $query->fetch();
            if ($user && isset($_POST['password']) && !empty($_POST['password']) && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['pseudo'] = $_POST['pseudo'];
    
                // header('Location: ?page=home');
            } else {
                echo "<p>Identifiants incorrect !</p>";
            }
        } else {
            echo "<p>Identifiants incorrect !</p>";
    }
}

?>

<div class="loginBloc container">

    <form class="p-3" action="?page=login" method="post">

        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <input class="btn btn-primary" type="submit" name="submit" value="S'inscrire">

    </form>

</div>