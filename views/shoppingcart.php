<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Panier</title>
    <?php require_once "imports/links.html" ?>
</head>

<body>
<?php include_once("navbar.php"); ?>

<main class="page shopping-cart-page">
    <section class="clean-block clean-cart dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-success">Mon Panier</h2>
            </div>
            <div class="content">
                <div class="row no-gutters">
                    <div class="col-md-12 col-lg-8">
                        <div class="items">
                            <?php
                            foreach ($cart->getItems() as $item) {
                                echo ('<div class="product">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-md-3">
                                            <div class="product-image"><img class="img-fluid d-block mx-auto image" src="assets/img/products/'.$item[0]->getImg().'"></div>
                                        </div>
                                        <div class="col-md-4 product-info"><a class="product-name" href="index.php?action=product&id='.$item[0]->getId().'">'.$item[0]->getName().'</a>
                                          
                                        </div>
                                        <div class="col-6 col-md-2 quantity">
                                            <form id="update-product-'.$item[0]->getId().'"action="index.php?action=editCart" method="post">
                                                <div class="row">
                                                    <input id="product-'.$item[0]->getId().'" name="product" type="hidden" value="'.$item[0]->getId().'">
                                                    <input class="col-8" type="number" id="number" name="quantity" class="form-control quantity-input" value="'.$item[1].'">
                                                    <button class="btn btn-link col-4" id="refresh-'.$item[0]->getID().'" type="submit" data-toggle="tooltip" "title="Mettre à jour le produit"><i class="fas fa-sync-alt"></i></button>
                                                </div>
                                            </form>
                                        </div>                                           
                                        
                                        <div class="col-5 col-md-2 price"><span>'.number_format($item[0]->getPrice() * $item[1], 2, ",", " ").'€</span></div>
                                        <div class="col-1"><a href="index.php?action=removeCart&id='.$item[0]->getId().'" title="Supprimer le produit"><i class="far fa-trash-alt"></i></a></div>
                                    </div>
                                </div>');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="summary">
                            <h3>Récapitulatif</h3>
                            <h4><span class="text">Sous Total</span><span class="price"><?php echo(number_format($cart->getTotal(), 2, ",", " ")); ?>€</span></h4>
                            <h4><span class="text">Frais de Port</span><span class="price">0€</span></h4>
                            <h4><span class="text">Total</span><span class="price"><?php echo(number_format($cart->getTotal(), 2, ",", " ")); ?>€</span></h4>
                            <a href="index.php?action=delivery" class="btn btn-success btn-block btn-lg mt-2" type="button">Passer la Commande</a></div>
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