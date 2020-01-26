<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Paiement</title>
    <?php require_once "imports/links.html" ?>
</head>

<body>
<?php require_once("navbar.php"); ?>
<main class="page payment-page">
    <section class="clean-block payment-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-success">Paiement</h2>
            </div>
            <form>
                <div class="products">
                    <h3 class="title text-center">Récapitualtif</h3>
                    <?php
                        foreach($order->getItems() as $item) {
                            echo('
                                <div class="item"><span class="price">' .number_format($item->getProduct()->getPrice()*$item->getQuantity(), 2, ",", " ").'€</span>
                                    <p class="item-name">'. $item->getProduct()->getName().' (x'.$item->getQuantity().')</p>
                                </div>
                            ');
                        }
                    ?>
                    <div class="total"><span>Total</span><span class="price"><?php echo(number_format($order->getTotal(), 2, ",", " ")); ?>€</span></div>
                </div>
                <hr class="separator">
                <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            <div class="form-group"><a href="index.php?action=paypal&id=<?php echo($order->getId());?>" class="btn btn-warning btn-block" role="button"><img src="assets/img/paypal.png" height="20px"/></a></div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group"><a href="index.php?action=cheque&id=<?php echo($order->getId());?>" class="btn btn-success btn-block" role="button">Payer par chèque</a></div>
                        </div>
                        <div class="col-sm-1"></div>
                </div>
            </form>
        </div>
    </section>
</main>
<?php require_once "footer.html" ?>
<?php require_once "imports/scripts.html" ?>
</body>

</html>