<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/?page=home">MyForum</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['pseudo'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/?page=member">Membres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/?page=profile&id=<?= $_SESSION['id']; ?>">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/?page=admin">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/?page=logout">Se deconnecter</a>
                        </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=login">Se connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=register">S'inscrire</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
