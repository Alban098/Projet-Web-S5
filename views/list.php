<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Nos <?php
        if ($category != null)
            echo $category->getName();
        else
            echo "Produits";
        ?></title>
    <?php require_once "imports/links.html" ?>
</head>

<body>
    <?php require_once "navbar.php"; ?>
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-success">Nos
                        <?php
                        if ($category != null)
                            echo $category->getName();
                        else
                            echo "Produits";
                        ?>
                    </h2>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-3 bg-light border-info">
                            <div class="d-md-block ">
                                <div class="filters ">
                                    <div class="filter-item">
                                        <h3>Catégories</h3>
                                        <div class="row">
                                            <?php
                                            foreach ($categories as $c) {
                                                echo '<div class="col-8"><a href="index.php?action=products&cat='.$c->getID().'">'.$c->getName().'</a></div>
                                                      <div class="col-2 p-0"><span class="badge badge-pill badge-info">'.$c->getNbProducts().'</span></div>';
                                            }
                                            ?>
                                            <div class="col-8"><a href='index.php?action=products'>Tous</a></div>
                                            <div class="col-2 p-0"><span class="badge badge-pill badge-info"><?php echo ($productCounts); ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="products">
                                <div class="row no-gutters">
                                    <?php
                                    foreach($products as $p) {
                                        echo '
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="clean-product-item">
                                                        <div class="image img-product-div">
                                                            <a href="index.php?action=product&id='.$p->getId().'">
                                                                <img class="img-fluid d-block mx-auto img-product" id="image-'.$p->getID().'" src="assets/img/products/'.$p->getImg().'">
                                                            </a>
                                                        </div>
                                                        <div class="product-name">
                                                            <p id="title-'.$p->getID().'">'.$p->getName().'</p>
                                                        </div>
                                                        <hr class="separator">
                                                        <div class="about">
                                                            <div class="justify-content-between price" style="max-width: 182px;">
                                                                <h3 id="price-'.$p->getID().'" class="product-description">'.number_format($p->getPrice(), 2, ",", " ").'€</h3>
                                                            </div>
                                
                                                            <form action="index.php?action=addToCart" method="post">
                                                                <div class="form-check form-check-inline m-0">
                                                                    <input id="product-'.$p->getId().'" name="product" type="hidden" value="'.$p->getId().'">
                                                                    <input class="form-control-sm d-lg-flex justify-content-between product-quantity cart-qty" type="number" id="quantity-'.$p->getId().'" name="quantity" min="1" max="99" step="1" placeholder="1" value="1">
                                                                </div>
                                                                <button class="btn btn-success product-price" id="add-'.$p->getID().'" type="submit" title="Ajouter au Panier"><i class="icon-basket"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>';
                                    }
                                    ?>
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