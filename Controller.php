<?php

namespace controllers;

use DAOs\CategoryDAO;
use DAOs\CustomerDAO;
use DAOs\DeliveryInfoDAO;
use DAOs\OrderDAO;
use DAOs\ProductDAO;
use DAOs\UserDAO;
use DateTime;
use entities\Cart;
use entities\Checkout;
use entities\Customer;
use entities\DeliveryInfo;
use entities\Order;
use entities\OrderItem;
use entities\User;

class Controller
{
    public static function reviveAction($id) {
        $order = OrderDAO::getInstance()->findById($id);
        if ($order != null) {
            if ($order->getStatus() == REGISTERED) {
                $datetime = new DateTime($order->getDate());
                $message =
                    "Bonjour,\r\n\r\n
                     Votre commande N°".$order->getId()." passée le ".$datetime->format("d-m-Y")." n'a, à ce jour, pas été réglée.\r\n
                     Afin de procéder au paiement merci de suivre le lien ci-dessous\r\n
                     http://$_SERVER[HTTP_HOST]/index.php?action=payment&id=".$order->getId()."\r\n\r\n
                     Cordialement\r\n
                     L'équipe ISIWEB4SHOP
                ";
                mail($order->getAddress()->getEmail(), "Commande N°".$order->getId()." impayée chez ISIWEB4SHOP", $message);
            }
        }
    }

    public static function downloadAction($id) {
        $order = OrderDAO::getInstance()->findById($id);
        if ($order != null) {
            $checkout = new Checkout($order);
            $pdf = $checkout->generate();
            $pdf->Output('d', 'facture-'.$order->getId().'.pdf');
        }
    }

    public static function indexAction() {
        header('Location: index.php?action=products');
        exit();
    }

    public static function loginAction() {
        if (isset($_SESSION['username'])) {
            header('Location: index.php?action=products');
            exit();
        } else {
            if (!empty($_POST['username'])) {
                $user = UserDAO::getInstance()->findByUsername($_POST['username']);
                if ($user != null) {
                    if (password_verify($_POST['password'], $user->getHash())) {
                        $_SESSION['username'] = $user->getUsername();
                        $_SESSION['userID'] = $user->getID();
                        $_SESSION['role'] = $user->getRole();
                        header('Location: index.php?action=products');
                        exit();
                    }
                    else {
                        header('Location: index.php?action=login&error=password');
                        exit();
                    }
                } else {
                    header('Location: index.php?action=login&error=username');
                    exit();
                }
            }
        }
        require_once('views/login.php');
    }

    public static function logoutAction() {
        if (isset($_SESSION['username'])) {
            session_unset();
        }
        header('Location: index.php?action=login');
        exit();
    }

    public static function registerAction() {
        if (isset($_SESSION['username'])) {
            header('Location: index.php?action=products');
            exit();
        } else {
            if (!empty($_POST['username'])) {
                $user = UserDAO::getInstance()->findByUsername($_POST['username']);
                if ($user == null) {
                    if (!empty($_POST['password'])) {
                        if (!empty($_POST['password_verify'])) {
                            if ($_POST['password_verify'] == $_POST['password']) {
                                if(!empty($_POST['forename'])) {
                                    if(!empty($_POST['surname'])) {
                                        if(!empty($_POST['phone'])) {
                                            if(!empty($_POST['email'])) {
                                                if(!empty($_POST['address'])) {
                                                    if(!empty($_POST['city'])) {
                                                        if (!empty($_POST['postcode'])) {
                                                            $address = new DeliveryInfo(0, $_POST['forename'], $_POST['surname'], $_POST['address'], $_POST['city'], $_POST['postcode'], $_POST['phone'], $_POST['email']);
                                                            DeliveryInfoDAO::getInstance()->insert($address);
                                                            $customer = new Customer(0, $_POST['forename'], $_POST['surname'], $_POST['phone'], $_POST['email'], true, $address->getId());
                                                            CustomerDAO::getInstance()->insert($customer);
                                                            $user = new User(0, $customer->getId(), $_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT), "USER");
                                                            UserDAO::getInstance()->insert($user);
                                                            header('Location: index.php?action=products');
                                                            exit();
                                                        } else {header('Location: index.php?action=register&error=postcode'); exit();}
                                                    } else{header('Location: index.php?action=register&error=city'); exit();}
                                                } else {header('Location: index.php?action=register&error=address'); exit();}
                                            } else {header('Location: index.php?action=register&error=email'); exit();}
                                        } else {header('Location: index.php?action=register&error=phone'); exit();}
                                    } else {header('Location: index.php?action=register&error=surname'); exit();}
                                } else {header('Location: index.php?action=register&error=forename'); exit();}
                            } else {header('Location: index.php?action=register&error=password_mismatch'); exit();}
                        } else {header('Location: index.php?action=register&error=password_verify'); exit();}
                    } else {header('Location: index.php?action=register&error=password'); exit();}
                } else {header('Location: index.php?action=register&error=username'); exit();}
            }
        }
        require_once("views/register.php");
    }

    public static function productListAction($catID) {
        $categories = CategoryDAO::getInstance()->findAll();
        $category = CategoryDAO::getInstance()->findById($catID);
        $productCounts = ProductDAO::getInstance()->getCount();
        $products = array();
        if ($category != null) {
            $products = ProductDAO::getInstance()->findByCat($category);
        } else {
            $products = ProductDAO::getInstance()->findAll();
        }
        require_once("views/list.php");
    }

    public static function productAction($id) {
        $product = ProductDAO::getInstance()->findById($id);;
        if ($product == null) {
            header('Location: index.php?action=error&error=1');
            exit();
        }
        require_once("views/product.php");
    }

    public static function shoppingCartAction() {
        if (!isset($_SESSION['cart'])) {
            $cart = new Cart();
            $_SESSION['cart'] = serialize($cart);
        }
        $cart = unserialize($_SESSION['cart']);
        require_once("views/shoppingcart.php");
    }

    public static function addToCart($id, $qty) {
        $product = ProductDAO::getInstance()->findById($id);
        if ($product != null) {
            if (!isset($_SESSION['cart'])) {
                $cart = new Cart();
                $_SESSION['cart'] = serialize($cart);
            }
            $cart = unserialize($_SESSION['cart']);
            $cart->add($product, $qty);
            $_SESSION['cart'] = serialize($cart);
        }
        header('Location: index.php?action=cart');
        exit();
    }

    public static function editCart($id, $qty) {
        $product = ProductDAO::getInstance()->findById($id);
        if ($product != null) {
            if (!isset($_SESSION['cart'])) {
                $cart = new Cart();
                $_SESSION['cart'] = serialize($cart);
            }
            $cart = unserialize($_SESSION['cart']);
            $cart->set($product, $qty);
            $_SESSION['cart'] = serialize($cart);
        }
        header('Location: index.php?action=cart');
        exit();
    }

    public static function removeFromCart($id) {
        $product = ProductDAO::getInstance()->findById($id);
        if ($product != null) {
            if (!isset($_SESSION['cart'])) {
                $cart = new Cart();
                $_SESSION['cart'] = serialize($cart);
            }
            $cart = unserialize($_SESSION['cart']);
            $cart->remove($product);
            $_SESSION['cart'] = serialize($cart);
        }
        header('Location: index.php?action=cart');
        exit();
    }

    public static function deliveryAction($addressID) {
        if ($addressID != -1) {
            $deliveryInfo = DeliveryInfoDAO::getInstance()->findById($addressID);
            if ($deliveryInfo != null) {
                if (isset($_SESSION['cart'])) {
                    $cart = unserialize($_SESSION['cart']);
                    $items = array();
                    foreach ($cart->getItems() as $c) {
                        array_push($items, new OrderItem(0, 0, $c[0]->getId(), $c[1]));
                    }
                    if (isset($_SESSION['username'])) {
                        $user = UserDAO::getInstance()->findByUsername($_SESSION['username']);
                        if ($user != null) {
                            $order = new Order(0, $user->getCustomer(), true, $deliveryInfo, 0, new \DateTime(), REGISTERED, session_id(), $cart->getTotal(), $items);
                            OrderDAO::getInstance()->insert($order);
                            unset($_SESSION['cart']);
                            header('Location: index.php?action=payment&id=' . $order->getId());
                            exit();
                        }
                    }
                    $order = new Order(0, null, false, $deliveryInfo, 0, new \DateTime(), REGISTERED, session_id(), $cart->getTotal(), $items);
                    OrderDAO::getInstance()->insert($order);
                    unset($_SESSION['cart']);
                    header('Location: index.php?action=payment&id=' . $order->getId());
                    exit();
                }
            }
        }
        if (!empty($_POST)) {
            if (!empty($_POST['forename'])) {
                if (!empty($_POST['surname'])) {
                    if (!empty($_POST['phone'])) {
                        if (!empty($_POST['email'])) {
                            if (!empty($_POST['address'])) {
                                if (!empty($_POST['city'])) {
                                    if (!empty($_POST['postcode'])) {
                                        if (isset($_SESSION['cart'])) {
                                            $cart = unserialize($_SESSION['cart']);
                                            if ($cart->isEmpty()) {
                                                header('Location: index.php?action=cart');
                                                exit();
                                            }
                                            $items = array();
                                            foreach ($cart->getItems() as $c) {
                                                array_push($items, new OrderItem(0, 0, $c[0]->getId(), $c[1]));
                                            }
                                            $deliveryInfo = new DeliveryInfo(0, $_POST['forename'], $_POST['surname'], $_POST['address'], $_POST['address'], $_POST['postcode'], $_POST['phone'], $_POST['email']);
                                            DeliveryInfoDAO::getInstance()->insert($deliveryInfo);
                                            if (isset($_SESSION['username'])) {
                                                $user = UserDAO::getInstance()->findByUsername($_SESSION['username']);
                                                if ($user != null) {
                                                    $order = new Order(0, $user->getCustomer(), false, $deliveryInfo, 0, new \DateTime(), REGISTERED, session_id(), $cart->getTotal(), $items);
                                                    OrderDAO::getInstance()->insert($order);
                                                    unset($_SESSION['cart']);
                                                    header('Location: index.php?action=payment&id=' . $order->getId());
                                                    exit();
                                                }
                                            }
                                            $order = new Order(0, null, false, $deliveryInfo, 0, new \DateTime(), REGISTERED, session_id(), $cart->getTotal(), $items);
                                            OrderDAO::getInstance()->insert($order);
                                            unset($_SESSION['cart']);
                                            header('Location: index.php?action=payment&id=' . $order->getId());
                                            exit();
                                        } else {header('Location: index.php?action=delivery&error=cart');exit();}
                                    } else {header('Location: index.php?action=delivery&error=postcode');exit();}
                                } else {header('Location: index.php?action=delivery&error=city');exit();}
                            } else {header('Location: index.php?action=delivery&error=address');exit();}
                        } else {header('Location: index.php?action=delivery&error=email');exit();}
                    } else {header('Location: index.php?action=delivery&error=phone');exit();}
                } else {header('Location: index.php?action=delivery&error=surname');exit();}
            } else {header('Location: index.php?action=delivery&error=forename');exit();}
        }
        $userDeliveryInfo = null;
        if (isset($_SESSION['username'])) {
            $user = UserDAO::getInstance()->findByUsername($_SESSION['username']);
            if ($user != null) {
                $customer = CustomerDAO::getInstance()->findById($user->getCustomer());
                if ($customer != null) {
                    $userDeliveryInfo = DeliveryInfoDAO::getInstance()->findById($customer->getAddress());
                }
            }
        }
        require_once("views/addressForm.php");
    }

    public static function paymentAction($id) {
        $order = OrderDAO::getInstance()->findById($id);
        if ($order == null) {
            header('Location: index.php?action=error&error=2');
            exit();
        }
        if ($order->getStatus() != REGISTERED) {
            header('Location: index.php?action=error&error=3');
            exit();
        }
        require_once("views/payment.php");
    }

    public static function authPaymentAction($id, $paypal) {
        $order = OrderDAO::getInstance()->findById($id);
        if ($order == null) {
            header('Location: index.php?action=error&error=2');
            exit();
        }
        if ($order->getStatus() != REGISTERED) {
            header('Location: index.php?action=error&error=3');
            exit();
        }
        if ($paypal) {
            $order->setPayment(PAYPAL);
        } else {
            $order->setPayment(CHEQUE);
        }
        $order->setStatus(PAYED);
        OrderDAO::getInstance()->update($order);
        require_once("views/orderDone.php");
    }

    public static function errorAction($id) {
        $error = "";
        switch ($id) {
            case 1:
                $error = "Ce produit n'existe pas !";
                break;
            case 2:
                $error = "Ce numéro de commande n'existe pas !";
                break;
            case 3:
                $error = "Cette commande a déjà été payée !";
                break;
            case 4:
                $error = "Vous n'avez pas les droits pour effectuer cette action !";
                break;
            case 5:
                $error = "Vous n'etes pas connecté !";
                break;
            default:
                $error = "La page demandé n'existe pas !";
        }
        require_once("views/error.php");
    }

    public static function adminAction() {
        if (isset($_SESSION['username'])) {
            $user = UserDAO::getInstance()->findByUsername($_SESSION['username']);
            if ($user != null) {
                if ($user->getRole() == "ADMIN") {
                    $registeredOrders = OrderDAO::getInstance()->findByStatus(REGISTERED);
                    $payedOrders = OrderDAO::getInstance()->findByStatus(PAYED);
                    $validatedOrders = OrderDAO::getInstance()->findByStatus(VALIDATED);
                    require_once("views/admin.php");
                } else {
                    header('Location: index.php?action=error&error=4');
                    exit();
                }
            } else {
                header('Location: index.php?action=error&error=5');
                exit();
            }
        } else {
            header('Location: index.php?action=error&error=5');
            exit();
        }
    }

    public static function validateOrder($id) {
        if (isset($_SESSION['username'])) {
            $user = UserDAO::getInstance()->findByUsername($_SESSION['username']);
            if ($user != null) {
                if ($user->getRole() == "ADMIN") {
                    $order = OrderDAO::getInstance()->findById($id);
                    if ($order != null) {
                        if ($order->getStatus() == PAYED) {
                            $order->setStatus(VALIDATED);
                            OrderDAO::getInstance()->update($order);
                        }
                    }
                    header('Location: index.php?action=admin');
                    exit();
                } else {
                    header('Location: index.php?action=error&error=4');
                    exit();
                }
            } else {
                header('Location: index.php?action=error&error=5');
                exit();
            }
        } else {
            header('Location: index.php?action=error&error=5');
            exit();
        }
    }
}
