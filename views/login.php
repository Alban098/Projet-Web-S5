<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Connexion</title>
    <?php require_once "imports/links.html" ?>
</head>

<body>
    <?php require_once("navbar.php"); ?>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-success">Se connecter</h2>
                </div>
                <form action="index.php?action=login" method="post">
                    <div class="form-group"><label for="username">Nom</label><input class="form-control item" type="text" id="username" name="username"></div>
                    <div class="form-group"><label for="password">Mot de passe</label><input class="form-control" type="password" id="password" name="password"></div>
                    <input class="btn btn-success btn-block" type="submit" value="Connexion">
                </form>
            </div>
        </section>
    </main>
    <?php require_once "footer.html" ?>
    <?php require_once "imports/scripts.html" ?>
</body>

</html>