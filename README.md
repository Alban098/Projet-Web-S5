# TP Final Web

### Auteurs / Développeurs
[Alban LACAILLE](https://github.com/alban098/)  
Louis PEIZERAT  

# Installation

Importer le script 'projetweb.sql'
```
identifiant : root
password : null
database_name : projetweb
```

# Action possible

## Connexion
```
http://localhost/index.php?action=login
```
Affiche la page de connexion et traite le formulaire associé

## Deconnexion
```
http://localhost/index.php?action=logout
```
Déconnecte l'utilisateur courant et redirige vers la liste des produits

## Inscription
```
http://localhost/index.php?action=register
```
Affiche la page d'inscription et traite le formulaire associé

## Liste des Produits
```
http://localhost/index.php?action=products&cat=x
cat=ID de la catégorie (Toutes si non spécifié)
```
Affiche la liste des produits

## Produit
```
http://localhost/index.php?action=product&id=x
id=ID du produits
```
Affiche la page d'un produit

## Panier
```
http://localhost/index.php?action=cart
```
Affiche le panier

## Administration
```
http://localhost/index.php?action=admin
```
Affiche la liste des commandes triées par Date et par statut de paiement

## Ajouter au Panier
```
http://localhost/index.php?action=addToCart
```
Ajoute un produit au panier (Passer par requête POST)

## Editer le Panier
```
http://localhost/index.php?action=editCart
```
Modifie la quantité d'un produit dans le panier et le supprimer si nécessaire (Passer par requête POST)

## Supprimer du Panier
```
http://localhost/index.php?action=removeCart
```
Supprimer un produit du Panier (Passer par requête POST)

## Adresse de Livraison
```
http://localhost/index.php?action=delivery[&id=x]
id=ID de l'adresse de livraison si le client est connecté
```
Affiche le formulaire de saisie d'adresse et l'adresse du client si il est connecté et traite le formulaire associé

## Valider une Commande
```
http://localhost/index.php?action=validate&id=x
id=ID de la commande à valider
```
Permet à l'administrateur de validé une commande

## Paiement
```
http://localhost/index.php?action=payment&id=x
id=ID de la commande à payer
```
Affiche la page de paiement pour une commande

## Facture
```
http://localhost/index.php?action=download&id=x
id=ID de la commande
```
Édite et télécharge la facture associé à une commande 

## Relancer
```
http://localhost/index.php?action=revive&id=x
id=ID de la commande
```
Permet à l'administrateur d'envoyer un mail au client si la commande est enregistrée mais non payée

## Paypal
```
http://localhost/index.php?action=paypal&id=x
id=ID de la commande
```
Enregistre le paiement de la commande (Lien avec Paypal non implémenté)
et redirige vers la page de remerciement depuis laquelle il sera possible de télécharger la facture

## Cheque
```
http://localhost/index.php?action=cheque&id=x
```
Enregistre le paiement de la commande et redirige vers la page de remerciement depuis laquelle il sera possible de télécharger la facture

## Erreur
```
http://localhost/index.php?action=error&error=x
error=code d'erreur
```
Affiche une page d'erreur avec une description

# Frameworks
Bootstrap  
JQuery  
FontAwesome 5