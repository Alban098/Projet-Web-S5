<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Crée un compte</title>
    <?php require_once "imports/links.html" ?>
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-success">Créer un compte</h2>
                </div>
                <form action="index.php?action=register" method="post">
                    <div class="card">
                        <div class="card-header">Compte Utilisateur</div>
                        <div class="card-body">
                            <div class="form-group"><label for="username">Nom d'utilisateur</label><input class="form-control item" type="text" id="username" name="username" required></div>
                            <div class="form-group"><label for="password">Mot de passe</label><input class="form-control" type="password" id="password" name="password" required></div>
                            <div class="form-group"><label for="password_verify">Confirmation</label><input class="form-control" type="password" id="password_verify" name="password_verify" required></div>
                        </div>
                    </div>
                    <hr class="separator">
                    <div class="card">
                        <div class="card-header">Informations Client</div>
                        <div class="card-body">
                            <div class="form-group"><label for="forename">Nom</label><input class="form-control item" type="text" id="forename" name="forename" required></div>
                            <div class="form-group"><label for="surname">Prenom</label><input class="form-control item" type="text" id="surname" name="surname" required></div>
                            <div class="form-group"><label for="phone">Telephone</label><input class="form-control item" type="number" id="phone" name="phone" max="9999999999" min="0" required></div>
                            <div class="form-group"><label for="email">Email</label><input class="form-control item" type="email" id="email" name="email" required></div>
                        </div>
                    </div>
                    <hr class="separator">
                    <div class="card">
                        <div class="card-header">Adresse de livraison</div>
                        <div class="card-body">
                            <div class="form-group"><label for="address">Adresse</label><input class="form-control item" type="text" id="address" name="address" required></div>
                            <div class="form-group"><label for="city">Ville</label><input class="form-control item" type="text" id="city" name="city" required></div>
                            <div class="form-group"><label for="postcode">Code Postal</label><input class="form-control item" type="number" id="postcode" name="postcode" max="99999" min="0" required></div>
                        </div>
                    </div>
                    <hr class="separator">
                    <input class="btn btn-success btn-block" type="submit" value="Créer mon compte">
                </form>
            </div>
        </section>
    </main>
    <?php require_once "footer.html" ?>
    <?php require_once "imports/scripts.html" ?>
</body>

</html>