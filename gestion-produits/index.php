<?php
/************************************************
 *  Initialisation des variables
 *
 */
// Démarrer la session
session_start();


// Établir la connexion avec la base de données au départ
require_once("connexion.php");


// Ajouter le lien sur le fichier de fonctions
// lib.php
require_once("lib.php");
require_once("lib_demande.php");



// Dérinir la bannière de page par défaut
$banniere="<img src=\"images/banniere.png\">";









/**
 *
 * Vérifier si la valeur de la couleur est définie
 *
 * */
if(isset($_REQUEST['cboCouleur']))
    // Définir la valeur de la couleur du menu
    $_SESSION['cboCouleur']=$_REQUEST['cboCouleur'];
else
    // Définir la couleur a bleu par défaut
     $_SESSION['cboCouleur']="blue";











/**
 * INITIALISATION DU MENU
 * Afficher le menu utilisateur ou le menu administrateur
 *
 **/

// Vérifie l'état de la connexion
if($_SESSION['prenom']!="" && $_SESSION['nom']!="")
    {
    // initialise la boîte logbox avec nom d'usager et déconnexion
    $logbox  = "<a href=\"".$_SERVER['PHP_SELF']."?selItem=deconnexion\">".$_SESSION['prenom']." ".$_SESSION['nom']."</a>";

    // Initialiser le menu avec l'option profil
    /**
     * Ajouter l'option profil dans le menu
     * */
    $menu="<ul>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=accueil\">Accueil</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=magasin\">Magasin</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=panier\">Panier</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=profil\">Profil</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=propos\">À propos</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=joindre\">Nous joindre</a></li>\n";

	    // Vérifier si l'usager est un administrateur
	    if($_SESSION['nomusager']=="admin")
		// Ajouter l'option getion dans le menu
		$menu.="<li><a href=\"".$_SERVER['PHP_SELF']."?selItem=gestion\">{GESTION}</a></li>\n";

    //Terminer l'affichage du menu
    $menu.="</ul>\n";
    }
// Si non
else
    {
    // initialise la boîte logbox avec un formulaire de connexion
    $logbox = "<form action=\"".$_SERVER['PHP_SELF']."?selItem=connexion\" method=\"post\">
		Nom d'usager <input name=\"txtUserName\" type=\"text\" size=\"15\"><br>
		Mot de passe <input name=\"txtPassWord\" type=\"password\" size=\"15\"><br>
		<input type=\"submit\" value=\"Connecter\">
		</form>";
    /**
     * Enlève le profil dans le menu
     * */
    $menu="<ul>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=accueil\">Accueil</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=magasin\">Magasin</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=propos\">À propos</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=joindre\">Nous joindre</a></li>\n";

    // Terminer le menu
    $menu .= "</ul>\n";
    }




/**
 *
 *  TABLE DE BRANCHEMENT PRINCIPALE
 *  DE L'APPLICATION
 *
 *
 **/


// Vérifier l'option choisie par l'utilisateur
switch($_REQUEST['selItem'])
    {
        case "accueil":
        case "":
                    // Définir le titre du la section
                    $titre = "Accueil";
                    // Définir l'affichage de l'accueil
                    $main = affiche_accueil();
                    break;

        case "magasin":
                    // Définir le titre du la section
                    $titre = "Magasin";
                    // Définir l'affichage du magasin
                    $main = affiche_magasin();
                    break;

        case "panier":
                    // Définir le titre du la section
                    $titre = "Votre panier d'achat";
                    // Définir l'affichage du panier
                    $main = affiche_panier();
                    break;

        case "profil":
                    // Définir le titre du la section
                    $titre = "Votre profil utilisateur";
                    // Définir l'affichage du profil
                    $main = affiche_profil($_SESSION['id']);
                    break;

        case "enregistrer_profil":
                    // Mettre a jour le profil
                    $message=enregistrer_profil($_SESSION['id']);
                    // Définir le titre du la section
                    $titre = "Votre profil utilisateur";
                    // Ajouter le message à l'affichage
                    $main = $message;
                    // Rafraichir l'affichage de l'accueil
                    //header("location:".$_SERVER['PHP_SELF']."?selItem=profil");
                    break;


        case "propos":
                    // Définir le titre du la section
                    $titre = "À propos";
                    // Définir l'affichage de la section à propos
                    $main = affiche_a_propos();
                    break;

        case "joindre":
                    // Définir le titre du la section
                    $titre = "Pour joindre info-shop";
                    // Définir l'affichage section joindre
                    $main = affiche_nous_joindre();
		    break;

        case "gestion":
                    // Définir le titre du la section
                    $titre = "GESTION DES PRODUITS";
                    // Définir l'affichage section joindre
                    $main = gestion_produits();
		    break;


        case "connexion":
		    // Vérifie si l'usager existe et retourne les données
		    if(verif_usager($_REQUEST['txtUserName'],$_REQUEST['txtPassWord'])==true)
			    {
			    // Rafraichir l'affichage de l'accueil
			    header("location:".$_SERVER['PHP_SELF']."?selItem=accueil");
			    }
		    else
			    {

			    // Afficher un message d'erreur de connexion dans logbox
			    $logbox .= "<br><font color=\"#cc0000\">
					Erreur de connexion...
					</font>";
			    // Afficher l'accueil
			    $main = affiche_accueil();
			    }
		    break;

	case "deconnexion":
		    // supprimer toutes les variables de session
		    session_destroy();
		    // Rafraichir l'affichage de l'accueil
		    header("location:".$_SERVER['PHP_SELF']."?selItem=accueil");
		    break;

    }



/************************************************
 *  Template interface web
 *
 */

require_once("template.php");

// Refermer la connexion après affichage
mysql_close($lien);

?>
