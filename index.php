<?php
namespace index;

session_start();
use controllers\Controller;

include 'Controller.php';
include "model/DAO.php";
include "model/Connection.php";
include 'model/CategoryDAO.php';
include 'model/CustomerDAO.php';
include 'model/DeliveryInfoDAO.php';
include 'model/OrderDAO.php';
include 'model/ProductDAO.php';
include 'model/UserDAO.php';
include 'model/OrderItemDAO.php';
include 'model/entities/Cart.php';
include 'model/entities/Checkout.php';
include 'utils/pdf.php';
define("REGISTERED", "Enregistre");
define("PAYED", "Attente de Paiement");
define("VALIDATED", "Valide");
define('FPDF_FONTPATH','utils/font/');
define('PAYPAL','Paypal');
define('CHEQUE','Chèque');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'index') {
        Controller::indexAction();
    }
    elseif ($_GET['action'] == 'login') {
       Controller::loginAction();
    }
    elseif ($_GET['action'] == 'logout') {
       Controller::logoutAction();
    }
    elseif ($_GET['action'] == 'register') {
        Controller::registerAction();
    }
    elseif ($_GET['action'] == 'products') {
        if (isset($_GET['cat']))
            Controller::productListAction($_GET['cat']);
        else
            Controller::productListAction(null);
    }
    elseif ($_GET['action'] == 'product') {
        Controller::productAction($_GET['id']);
    }
    elseif ($_GET['action'] == 'cart') {
        Controller::shoppingCartAction();
    }
    elseif ($_GET['action'] == 'admin') {
        Controller::adminAction();
    }
    elseif ($_GET['action'] == 'addToCart') {
        if (isset($_POST['product']) && isset($_POST['quantity']))
            Controller::addToCart($_POST['product'], $_POST['quantity']);
        else
            Controller::errorAction();
    }
    elseif ($_GET['action'] == 'editCart') {
        if (isset($_POST['product']) && isset($_POST['quantity']))
            Controller::editCart($_POST['product'], $_POST['quantity']);
        else
            Controller::errorAction(1);
    }
    elseif ($_GET['action'] == 'removeCart') {
        if (isset($_GET['id']))
            Controller::removeFromCart($_GET['id']);
        else
            Controller::errorAction(1);
    }
    elseif ($_GET['action'] == 'delivery') {
        if (isset($_GET['id']))
            Controller::deliveryAction($_GET['id']);
        else
            Controller::deliveryAction(-1);
    }
    elseif ($_GET['action'] == 'payment') {
        if (isset($_GET['id']))
            Controller::paymentAction($_GET['id']);
        else
            Controller::errorAction(2);
    }
    elseif ($_GET['action'] == 'validate') {
        if (isset($_GET['id']))
            Controller::validateOrder($_GET['id']);
        else
            Controller::errorAction(2);
    }
    elseif ($_GET['action'] == 'download') {
        if (isset($_GET['id']))
            Controller::downloadAction($_GET['id']);
        else
            Controller::errorAction(2);
    }
    elseif ($_GET['action'] == 'revive') {
        if (isset($_GET['id']))
            Controller::reviveAction($_GET['id']);
        else
            Controller::errorAction(2);
    }
    elseif ($_GET['action'] == 'paypal' || $_GET['action'] == 'cheque' ) {
        if (isset($_GET['id']))
            Controller::authPaymentAction($_GET['id'], $_GET['action'] == 'paypal');
        else
            Controller::errorAction(2);
    }
    elseif ($_GET['action'] == 'error') {
        if (isset($_GET['error']))
            Controller::errorAction($_GET['error']);
        else
            Controller::errorAction(0);
    }
    else {
        Controller::errorAction(0);
    }
}
else {
    Controller::errorAction(0);
}