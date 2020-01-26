<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Merci !</title>
    <?php require_once "imports/links.html" ?>
</head>

<body onload="window.location.href = 'index.php?action=download&id=<?php echo ($order->getId());?>'" >
<?php require_once("navbar.php"); ?>
<main class="page landing-page">
    <section class="clean-block clean-info">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-success">Merci pour votre commande</h2>
                <p>Votre commande sera validée après récéption du paiement par notre équipe !</p>
                <?php if ($order->getPayment() == CHEQUE) {
                    echo("<br><p>Vous avez choisi de payer par chèque, Merci de nous faire parvenir la règlement pas voie postale</p>");
                } ?>
                <div class="row p-5">
                    <div class="col-4">

                    </div>
                    <div class="col-4">
                        <p class="small">Votre facture se téléchargera automatiquement</p>
                        <a href="index.php?action=download&id=<?php echo($order->getId());?>" class="btn btn-outline-success btn-block" role="button">Télécharger ma Facture</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once "footer.html" ?>
<?php require_once "imports/scripts.html" ?>
</body>

</html>

