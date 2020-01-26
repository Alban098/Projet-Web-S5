<nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-success clean-navbar">
    <div class="container"><a class="navbar-brand logo" href="index.php?action=index">ISIWEB4SHOP</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
            id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link <?php if ($_GET['action'] == "products") echo ('active');?>" href="index.php?action=products">Nos produits</a></li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php if ($_GET['action'] == "cart") echo ('active');?>" href="index.php?action=cart" title="Mon Panier">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-pill badge-info"><?php
                            if (isset($_SESSION['cart'])) {
                                $cart = unserialize($_SESSION['cart']);
                                echo($cart->getNbProducts());
                            } else
                                echo("0");
                            ?></span>
                    </a>
                </li>
                <?php if (isset($_SESSION['username'])) {
                    if ($_SESSION['role'] == 'ADMIN') {
                        echo('<li class="nav-item" role="presentation"><a title="Administration" class="nav-link ');
                        if ($_GET['action'] == "admin") echo ('active');
                        echo('" href="index.php?action=admin"><i class="fa fa-user"></i></a></li>');
                    }
                    echo ('<li class="nav-item" role="presentation"><a title="Se deconnecter" class="nav-link" href="index.php?action=logout"><i class="fas fa-sign-out-alt"></i></a></li>');
                } else {
                    echo ('<li class="nav-item" role="presentation"><a title="Se connecter" class="nav-link ');
                    if ($_GET['action'] == "login") echo ('active');
                    echo('" href="index.php?action=login"><i class="fas fa-sign-in-alt"></i></a></li>');

                    echo ('<li class="nav-item" role="presentation"><a title="Crée un compte" class="nav-link ');
                    if ($_GET['action'] == "register") echo ('active');
                    echo('" href="index.php?action=register"><i class="fas fa-user-plus"></i></a></li>');
                }
                ?>
            </ul>
        </div>
    </div>
</nav>