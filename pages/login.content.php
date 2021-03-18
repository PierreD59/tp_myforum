<?php
$database = require_once dirname(__FILE__) . '/../utils/database.utils.php';

$query = $database->prepare('SELECT `password` FROM `users`');
$query->execute([
     "password" => ':password',
     ]);
$password = $query->fetch();

if (isset($_POST['submit'])) {
    if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
        if (isset($_POST['password']) && !empty($_POST['password']) && password_verify($_POST['password'], $password['password'])) {
            $_SESSION['pseudo'] = $_POST['pseudo'];
            $_SESSION['password'] = $_POST['password'];

            header('Location: ?page=home');
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