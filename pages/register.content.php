<?php
$imgDefault = "../assets/img/default.png";

if (isset($_POST['submit'])) {
    if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['confirmEmail']) && !empty($_POST['confirmEmail']) && $_POST['email'] === $_POST['confirmEmail']) {
            $email = htmlspecialchars($_POST['email']);
            if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword']) && $_POST['password'] === $_POST['confirmPassword']) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $addUser = $database->prepare("INSERT INTO `users`(`pseudo`, `password`, `email_adress`, `illustration_image_url`, `registration_date`) VALUES (:pseudo, :password, :email_adress, :illustration_image_url, :registration_date)");

                $toto = $addUser->execute([
                            'pseudo' => ucfirst($pseudo),
                            'password' => $password,
                            'email_adress' => $email,
                            'illustration_image_url' => $imgDefault,
                            'registration_date' => date("Y-m-d"),
                        ]);
                header('Location :?page=login');
            } else {
                echo "<p>Mot de passe incorrect !</p>";
            }
        } else {
            echo "<p>Entrez une adresse mail valide !</p>";
        }
    } else {
        echo "<p>Entrez un pseudo !</p>";
    }
}
?>

<div class="home">

    <div class="registerBlock p-3 container">
        <h1>S'inscrire</h1>
        <hr>
        <form class="p-3" action="?page=register" method="post">

            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse mail</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="confirmEmail" class="form-label">Confirmer l'adresse mail</label>
                <input type="email" class="form-control" id="confirmEmail" name="confirmEmail">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="text" class="form-control" id="image" name="image" placeholder="../assets/img/default.png">
            </div>

            <input class="btn btn-primary" type="submit" name="submit" value="S'inscrire">

        </form>

    </div>

</div>