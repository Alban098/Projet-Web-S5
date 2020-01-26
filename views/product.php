<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $product->getName();?></title>
    <?php require_once "imports/links.html" ?>
</head>

<body>
<?php include_once("navbar.php"); ?>

<main class="page product-page">
    <section class="clean-block clean-product dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-sucess">
                    <a href="index.php?action=products&cat=<?php echo($product->getCategory()->getId()) ?>"><?php echo $product->getCategory()->getName()?></a>
                </h2>
            </div>
            <div class="block-content">
                <div class="product-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="gallery">
                                <div class="sp-wrap w-100"><a href="assets/img/products/<?php echo $product->getImg();?>">
                                    <img class="img-fluid d-block mx-auto" src="assets/img/products/<?php echo $product->getImg();?>"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <h3><?php echo $product->getName();?></h3>
                                <div class="rating">
                                    <?php for ($i = 0; $i < 10; $i+=2) {
                                        if ($product->getRating() - $i >= 2)
                                            echo("<img src=\"assets/img/star.svg\">");
                                        else if ($product->getRating() - $i == 1)
                                            echo("<img src=\"assets/img/star-half-empty.svg\">");
                                        else
                                            echo("<img src=\"assets/img/star-empty.svg\">");
                                    }?>
                                </div>
                                <div class="row">
                                    <div class="price col-6 text-center">
                                        <h3 class="my-auto"><?php echo number_format($product->getPrice(), 2, ",", " ");?> €</h3>
                                    </div>
                                    <div class="col-6 my-auto">
                                        <form action="index.php?action=addToCart" method="post">
                                            <div class="form-check form-check-inline">
                                                <input id="product-<?php echo($product->getId());?>" name="product" type="hidden" value="<?php echo($product->getId());?>">
                                                <input class="form-control-sm d-lg-flex justify-content-between product-quantity cart-qty" type="number" id="quantity-<?php echo($product->getId());?>" name="quantity" min="1" max="99" step="1" placeholder="1" value="1">
                                            </div>
                                            <button class="btn btn-success product-price my-auto" id="add-'.$p->getID().'" type="submit" title="Ajouter au Panier"><i class="icon-basket"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="summary">
                                    <p><?php echo $product->getDesc();?></p>
                                </div>
                            </div>
                        </div>
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