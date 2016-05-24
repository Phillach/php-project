<?php
/************************************************
 *  Initialisation des variables
 *
 */
// Demarrer la session
session_start();



// �tablir la connexion avec la base de donn�es au d�part
require_once("connexion.php");



// Ajouter le lien sur le fichier de fonctions
// lib.php
require_once("lib.php");
require_once("libdemande.php");



// D�rinir la banni�re de page par d�faut
$banniere="<img src=\"images/banniere.png\">";









/**
 *
 * V�rifier si la valeur de la couleur est d�finie
 *
 * */
if(isset($_REQUEST['cboCouleur']))
    // D�finir la valeur de la couleur du menu
    $_SESSION['cboCouleur']=$_REQUEST['cboCouleur'];
else
    // D�finir la couleur a bleu par d�faut
     $_SESSION['cboCouleur']="blue";



/**
 * INITIALISATION DU MENU
 * Afficher le menu utilisateur ou le menu administrateur
 *
 **/

// V�rifie l'�tat de la connexion
if($_SESSION['Prenom']!="" && $_SESSION['Nom']!="")
    {
    // initialise la bo�te logbox avec nom d'usager et d�connexion
    $logbox  = "<a href=\"".$_SERVER['PHP_SELF']."?selItem=deconnexion\">".$_SESSION['Prenom']." ".$_SESSION['Nom']."</a>";

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
      <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=Demande\">Demande</a></li>\n"; //ICI---------------


	    // Vérifier si l'usager est un administrateur
	    if($_SESSION['nomusager']=="admin")
		// Ajouter l'option gestion dans le menu
		$menu.="<li><a href=\"".$_SERVER['PHP_SELF']."?selItem=gestion\">{GESTION}</a></li>\n";

    //Terminer l'affichage du menu
    $menu.="</ul>\n";
    }
// Si non
else
    {
    // initialise la bo�te logbox avec un formulaire de connexion
    $logbox = "<form action=\"".$_SERVER['PHP_SELF']."?selItem=connexion\" method=\"post\">
		Nom d'usager <input name=\"txtUserName\" type=\"text\" size=\"15\"><br>
		Mot de passe <input name=\"txtPassWord\" type=\"password\" size=\"15\"><br>
		<input type=\"submit\" value=\"Connecter\">
		</form>";
    /**
     * Enl�ve le profil dans le menu
     * */
    $menu="<ul>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=accueil\">Accueil</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=magasin\">Magasin</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=propos\">À propos</a></li>\n
	    <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=joindre\">Nous joindre</a></li>\n
      <li><a href=\"".$_SERVER['PHP_SELF']."?selItem=demande\">Demande</a></li>\n";

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


// V�rifier l'option choisie par l'utilisateur
switch($_REQUEST['selItem'])
    {
        case "accueil":
        case "":
                    // D�finir le titre du la section
                    $titre = "Accueil";
                    // D�finir l'affichage de l'accueil
                    $main = affiche_accueil();
                    break;

        case "magasin":
                    // D�finir le titre du la section
                    $titre = "Magasin";
                    // D�finir l'affichage du magasin
                    $main = affiche_magasin();
                    break;

        case "panier":
                    // D�finir le titre du la section
                    $titre = "Votre panier d'achat";
                    // D�finir l'affichage du panier
                    $main = affiche_panier();
                    break;

        case "profil":
                    // D�finir le titre du la section
                    $titre = "Votre profil utilisateur";
                    // D�finir l'affichage du profil
                    $main = affiche_profil($_SESSION['id']);
                    break;

        case "enregistrer_profil":
                    // Mettre a jour le profil
                    $message=enregistrer_profil($_SESSION['id']);
                    // D�finir le titre du la section
                    $titre = "Votre profil utilisateur";
                    // Ajouter le message � l'affichage
                    $main = $message;
                    // Rafraichir l'affichage de l'accueil
                    //header("location:".$_SERVER['PHP_SELF']."?selItem=profil");
                    break;


        case "propos":
                    // D�finir le titre du la section
                    $titre = "� propos";
                    // D�finir l'affichage de la section � propos
                    $main = affiche_a_propos();
                    break;

        case "joindre":
                    // D�finir le titre du la section
                    $titre = "Pour joindre info-shop";
                    // D�finir l'affichage section joindre
                    $main = affiche_nous_joindre();
		    break;

        case "gestion":
                    // D�finir le titre du la section
                    $titre = "GESTION DES PRODUITS";
                    // D�finir l'affichage section joindre
                    $main = gestion_produits();
		    break;


        case "Demande":

                    // D�finir le titre du la section
                    $titre = "GESTION DES DEMANDES";
                    // D�finir l'affichage section joindre
                    $main = gestion_demandes();
		    break;


        case "connexion":
		    // V�rifie si l'usager existe et retourne les donn�es
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

// Refermer la connexion apr�s affichage
mysql_close($lien);

?>
