<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Oups !</title>
    <?php require_once "imports/links.html" ?>
</head>

<body>
<?php require_once("navbar.php"); ?>
<main class="page landing-page">
    <section class="clean-block clean-info">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-danger">Oups !</h2>
                <p class="text-warning"> <?php echo $error?></p>
            </div>
        </div>
    </section>
</main>
<?php require_once "footer.html" ?>
<?php require_once "imports/scripts.html" ?>
</body>

</html>

