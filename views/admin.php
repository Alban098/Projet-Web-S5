<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Administration</title>
    <?php require_once "imports/links.html" ?>
</head>

<body>
<?php require_once "navbar.php"; ?>
<main class="page catalog-page">
    <section class="clean-block clean-cart dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-success">Liste des Commandes</h2>
            </div>
            <div class="content">
                <ul class="nav nav-tabs" id="orders" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="payed-tab" data-toggle="tab" href="#payed" role="tab" aria-controls="home" aria-selected="true">En attente de Validation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="unpayed-tab" data-toggle="tab" href="#unpayed" role="tab" aria-controls="profile" aria-selected="false">Non Payées</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="validated-tab" data-toggle="tab" href="#validated" role="tab" aria-controls="contact" aria-selected="false">Validées</a>
                    </li>
                </ul>
                <div class="tab-content" id="ordersContent">
                    <div class="tab-pane fade show active" id="payed" role="tabpanel" aria-labelledby="payed-tab">
                        <div id="accordion-payed">
                        <?php
                            foreach($payedOrders as $order) {
                                $datetime = new DateTime($order->getDate());
                                echo('
                                    <div class="card">
                                        <div class="card-header" id="header-order-'.$order->getId().'">
                                            <h5 class="mb-0">
                                                <button class="btn btn-outline-success w-100" data-toggle="collapse" data-target="#collapse-order-'.$order->getId().'" aria-expanded="true" aria-controls="collapse-order-'.$order->getId().'">
                                                    <div class="row">
                                                        <div class="col-4">Date : '.$datetime->format("d-m-Y").'</div>
                                                        <div class="col-4">Commande N°'.$order->getId().'</div>
                                                        <div class="col-4">Total ('.$order->getPayment().') : '.number_format($order->getTotal(), 2, ",", " ").'€</div>
                                                    </div>
                                                     
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse-order-'.$order->getId().'" class="collapse" aria-labelledby="header-order-'.$order->getId().'" data-parent="#accordion-payed">
                                            <div class="card-body">
                                                 <div class="content">
                                                     <div class="row no-gutters">
                                                        <div class="col-md-12 col-lg-4">
                                                            <div class="summary text-center">
                                                                <h3>Adresse</h3>
                                                                <h5><span class="text">'.$order->getAddress()->getForename().' '.$order->getAddress()->getSurname().'</span></h5>
                                                                <h5><span class="text">'.$order->getAddress()->getEmail().'</span></h5>
                                                                <h5><span class="text">'.sprintf("%010d", $order->getAddress()->getPhone()).'</span></h5>
                                                                <h5><span class="text">'.$order->getAddress()->getAddress().'</span></h5>
                                                                <h5><span class="text">'.sprintf("%05d", $order->getAddress()->getPostCode()).' '.$order->getAddress()->getCity().'</span></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-8">
                                                            <div class="items">'
                                );
                                foreach($order->getItems() as $item) {
                                    echo ('<div class="product">
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-md-3">
                                                    <div class="product-image"><img class="img-fluid d-block mx-auto image" src="assets/img/products/'.$item->getProduct()->getImg().'"></div>
                                                </div>
                                                <div class="col-md-3 product-info"><a class="product-name" href="#">'.$item->getProduct()->getName().'</a>
                                                  
                                                </div>
                                                <div class="col-4 col-md-2 price price-admin"><span>'.number_format($item->getProduct()->getPrice(), 2, ",", " ").'€</span></div>
                                                <div class="col-4 col-md-2 quantity">
                                                     <span>x'.$item->getQuantity().'</span>
                                                </div>                                           
                                                <div class="col-4 col-md-2 price price-admin"><span>'.number_format($item->getProduct()->getPrice() * $item->getQuantity(), 2, ",", " ").'€</span></div>
                                            </div>
                                        </div>');
                                }
                                echo ('                       </div>
                                                                <div class="text-center p-2 row">
                                                                    <div class="col-2"></div>
                                                                    <div class="col-3"><a href="index.php?action=validate&id='.$order->getId().'" class="btn btn-success" role="button" title="Valider la commande">Valider</a></div>
                                                                    <div class="col-2"></div>
                                                                    <div class="col-3"><a href="index.php?action=download&id='.$order->getId().'" class="btn btn-outline-primary" role="button" title="Télécharger la facture">Facture</a></div>
                                                                </div>
                                                         </div>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ');
                            }

                        ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="unpayed" role="tabpanel" aria-labelledby="unpayed-tab">
                        <div id="accordion-unpayed">
                            <?php
                            foreach($registeredOrders as $order) {
                                $datetime = new DateTime($order->getDate());
                                echo('
                                    <div class="card">
                                        <div class="card-header" id="header-order-'.$order->getId().'">
                                            <h5 class="mb-0">
                                                <button class="btn btn-outline-danger w-100" data-toggle="collapse" data-target="#collapse-order-'.$order->getId().'" aria-expanded="true" aria-controls="collapse-order-'.$order->getId().'">
                                                    <div class="row">
                                                        <div class="col-4">Date : '.$datetime->format("d-m-Y").'</div>
                                                        <div class="col-4">Commande N°'.$order->getId().'</div>
                                                        <div class="col-4">Total : '.number_format($order->getTotal(), 2, ",", " ").'€</div>
                                                    </div>
                                                     
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse-order-'.$order->getId().'" class="collapse" aria-labelledby="header-order-'.$order->getId().'" data-parent="#accordion-unpayed">
                                            <div class="card-body">
                                                 <div class="content">
                                                     <div class="row no-gutters">
                                                        <div class="col-md-12 col-lg-4">
                                                            <div class="summary text-center">
                                                                <h3>Adresse</h3>
                                                                <h5><span class="text">'.$order->getAddress()->getForename().' '.$order->getAddress()->getSurname().'</span></h5>
                                                                <h5><span class="text">'.$order->getAddress()->getEmail().'</span></h5>
                                                                <h5><span class="text">'.sprintf("%010d", $order->getAddress()->getPhone()).'</span></h5>
                                                                <h5><span class="text">'.$order->getAddress()->getAddress().'</span></h5>
                                                                <h5><span class="text">'.sprintf("%05d", $order->getAddress()->getPostCode()).' '.$order->getAddress()->getCity().'</span></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-8">
                                                            <div class="items">'
                                );
                                foreach($order->getItems() as $item) {
                                    echo ('<div class="product">
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-md-3">
                                                    <div class="product-image"><img class="img-fluid d-block mx-auto image" src="assets/img/products/'.$item->getProduct()->getImg().'"></div>
                                                </div>
                                                <div class="col-md-3 product-info"><a class="product-name" href="#">'.$item->getProduct()->getName().'</a>
                                                  
                                                </div>
                                                <div class="col-4 col-md-2 price price-admin"><span>'.number_format($item->getProduct()->getPrice(), 2, ",", " ").'€</span></div>
                                                <div class="col-4 col-md-2 quantity">
                                                     <span>x'.$item->getQuantity().'</span>
                                                </div>                                           
                                                <div class="col-4 col-md-2 price price-admin"><span>'.number_format($item->getProduct()->getPrice() * $item->getQuantity(), 2, ",", " ").'€</span></div>
                                            </div>
                                        </div>');
                                }
                                echo ('                       </div>
                                                              <div class="text-center p-2 row">
                                                                    <div class="col-2"></div>
                                                                    <div class="col-3"><a href="index.php?action=revive&id='.$order->getId().'" class="btn btn-danger" role="button" title="Envoyer un mail de relance au client">Relancer</a></div>
                                                                    <div class="col-2"></div>
                                                                    <div class="col-3"><a href="index.php?action=download&id='.$order->getId().'" class="btn btn-outline-primary" role="button" title="Télécharger la facture">Facture</a></div>
                                                               </div>
                                                         </div>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ');
                            }

                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="validated" role="tabpanel" aria-labelledby="validated-tab">
                        <div id="accordion-validated">
                            <?php
                            foreach($validatedOrders as $order) {
                                $datetime = new DateTime($order->getDate());
                                echo('
                                    <div class="card">
                                        <div class="card-header" id="header-order-'.$order->getId().'">
                                            <h5 class="mb-0">
                                                <button class="btn btn-outline-primary w-100" data-toggle="collapse" data-target="#collapse-order-'.$order->getId().'" aria-expanded="true" aria-controls="collapse-order-'.$order->getId().'">
                                                    <div class="row">
                                                        <div class="col-4">Date : '.$datetime->format("d-m-Y").'</div>
                                                        <div class="col-4">Commande N°'.$order->getId().'</div>
                                                        <div class="col-4">Total ('.$order->getPayment().') : '.number_format($order->getTotal(), 2, ",", 0).'€</div>
                                                    </div>
                                                     
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse-order-'.$order->getId().'" class="collapse" aria-labelledby="header-order-'.$order->getId().'" data-parent="#accordion-validated">
                                            <div class="card-body">
                                                 <div class="content">
                                                     <div class="row no-gutters">
                                                        <div class="col-md-12 col-lg-4">
                                                            <div class="summary text-center">
                                                                <h3>Adresse</h3>
                                                                <h5><span class="text">'.$order->getAddress()->getForename().' '.$order->getAddress()->getSurname().'</span></h5>
                                                                <h5><span class="text">'.$order->getAddress()->getEmail().'</span></h5>
                                                                <h5><span class="text">'.sprintf("%010d", $order->getAddress()->getPhone()).'</span></h5>
                                                                <h5><span class="text">'.$order->getAddress()->getAddress().'</span></h5>
                                                                <h5><span class="text">'.sprintf("%05d", $order->getAddress()->getPostCode()).' '.$order->getAddress()->getCity().'</span></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-8">
                                                            <div class="items">'
                                );
                                foreach($order->getItems() as $item) {
                                    echo ('<div class="product">
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-md-3">
                                                    <div class="product-image"><img class="img-fluid d-block mx-auto image" src="assets/img/products/'.$item->getProduct()->getImg().'"></div>
                                                </div>
                                                <div class="col-md-3 product-info"><a class="product-name" href="#">'.$item->getProduct()->getName().'</a>
                                                  
                                                </div>
                                                <div class="col-4 col-md-2 price price-admin"><span>'.number_format($item->getProduct()->getPrice(), 2, ",", " ").'€</span></div>
                                                <div class="col-4 col-md-2 quantity">
                                                     <span>x'.$item->getQuantity().'</span>
                                                </div>                                           
                                                <div class="col-4 col-md-2 price price-admin"><span>'.number_format($item->getProduct()->getPrice() * $item->getQuantity(), 2, ",", " ").'€</span></div>
                                            </div>
                                        </div>');
                                }
                                echo ('                        </div>
                                                                <div class="text-center p-2 ">
                                                                    <a href="index.php?action=download&id='.$order->getId().'" class="btn btn-outline-primary" role="button" title="Télécharger la facture">Facture</a>
                                                                </div>
                                                         </div>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ');
                            }

                            ?>
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