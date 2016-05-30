<?php



/**
 *  TABLEAU DES UTILISATEURS
 *  DU MAGASIN
 *
 * Les �l�ments du tableau sont:
 *
 * $utlisateur[0] Pr�nom
 * $utlisateur[1] Nom
 * $utlisateur[2] Nom d'usager
 * $utlisateur[3] Mot de passe
 * $utlisateur[4] Couleur du menu
 * etc ...
 *
 * */



$utilisateurs = array("Jimmy",
                    "Hendrix",
                    "admin",
                    "nimda",
                    "homme",
                    "admin@info-shop.com",
                    "(418)652-2159 #9999",
                    "red",

                    "Stevie-Ray",
                    "Vaughan",
                    "usager",
                    "mdp",
                    "homme",
                    "user@info-shop.com",
                    "(418)652-2159 #8888",
                    "green",

                    "Stephane",
                    "Poirier",
                    "guit",
                    "123",
                    "homme",
                    "stef@info-shop.com",
                    "(418)652-2159 #7777",
                    "purple"
                    );



/**
 * $nomusager, $motdepasse
 * */
function verif_usager($nomusager,$motdepasse)
{
//Acc�der le tableau des utilisateurs
global $utilisateurs;

// Initialiser la r�ponse � faux
$reponse = false;

//Boucler pour compteur allant de 0 jusqu� nombre d'item dans le table par pas de 4
for($compteur=0;$compteur<=count($utilisateurs);$compteur+=8)
    {
    // V�rifie si le nom d'usager et le mot de sont valide
    if($nomusager==$utilisateurs[$compteur+2]  &&  $motdepasse==$utilisateurs[$compteur+3])
      {
       //Initialiser le pr�nom dans une variable de session
       $_SESSION['Prenom']=$utilisateurs[$compteur];
       //Initialiser le nom dans une variable de session
       $_SESSION['Nom']=$utilisateurs[$compteur+1];
       // Initialiser le nom d'usager sur la session
       $_SESSION['nomusager']=$utilisateurs[$compteur+2];
       //Initialiser la couleur dans une variable de session
       $_SESSION['cboCouleur']=$utilisateurs[$compteur+7];
       // Enregistrer le num�ro de l'usager pour retrouver le profil
        $_SESSION['id']=$compteur;
       // initialise variable de retour pour retourner vrai
       $reponse = true;

       // Terminer la fonction et retourner vrai
       return $reponse;
      }
    // Si non vider le pr�nom et le nom de la session
    $_SESSION['Prenom']=$_SESSION['Nom']="";
    }
// Retourner la valeur false
return $reponse;
}



/******************************************
 *  LIBRAIRIE PRINCIPALES DES FONCTIONS
 *
 ******************************************/

/**
 *
 *  ROUTINE POUR L'AFFICHAGE DE L'ACCUEIL
 *
 *
 **/

function affiche_accueil()
{
    // D�finir l'affichage de la zone principale pour le profil
    $main = "Bienvenu chez info-shop<p>
                <div style=\"display:run-in;float:left\">
                <img width=\"125\" src=\"images/cfpmr.jpg\">
                </div>
             Lorem ipsum dolor sit amet, consectetur adipisicing elit,
             sed do eiusmod tempor incididunt ut labore et dolore magna
             aliqua. Ut enim ad minim veniam, quis nostrud exercitation
             ullamco laboris nisi ut aliquip ex ea commodo consequat.
             Duis aute irure dolor in reprehenderit in voluptate velit esse
             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
             cupidatat non proident, sunt in culpa qui officia deserunt mollit
             anim id est laborum";

// Retourner la l'affichage
return $main;
}



/**
 *
 *
 *  A F F I C H A G E    D U
 *  M A G A S I N
 *
 *
 **/

function affiche_magasin()
{
// R�cup�rer le tableau des produits dans
// dans une fonction priv�e
global $produits, $lien;

    // D�finir l'affichage de l'ent�te du tableau et du formulaire
    $main = "Voici la liste des produits du magasin d'info-shop<p>
            \n<form>
            \n<table border=\"0\">";

    // Formuler la requ�te pour lire tous les produits du magasin
    $requete = "SELECT * FROM tblProduits";

    // Transmettre la requ�te au serveur MySQL
    $reponse = mysql_query($requete,$lien);

    // Lire le nombre de rang�e re�ue
    $nbrangee = mysql_num_rows($reponse);

    // faire une boucle pour afficher chaque rang�e de produit
    for($pointeur=0;$pointeur<$nbrangee;$pointeur++)
        {

        // R�cup�rer chaque champ dans un tableau cl�-valeur
        $produit = mysql_fetch_array($reponse);

        // Cr�er une ligne d'affichage du produit avec le nom descripion proto prix, quantit�
        $main .="\n<tr>
                   <td>
                        <font size=\"+2\"><br>".$produit["nom"]."</font><br>
                        <font size=\"-2\">ID-".$produit["ID"]."</font>
                        <p/>

                          <div style=\"display:run-in;float:left\">
                          <img src=\"photos/".$produit["photo"]."\">
                          <br><b>".sprintf("$%0.2f",$produit["prix"])."</b>
                          </div>

                        <div style=\"display:run-in\">".$produit["description"]."
                        <br>
                        <font size=\"-1\">
                            <i>Quantit� disponible </i>: ".$produit["quantite"]."
                        </font>

                    </td>
                    <td>
                        <a href=\"javascript:passeraupanier(ID)\">
                        <img src=\"images/cart.png\" border=\"0\">
                        </a><br>
                        <input type=\"checkbox\" name=\"chkCart[]\" value=\"ID\">
                    </td>
                    </tr>";
        }

        // Terminer le tableau et le formulaire
        $main.="\n</table><div align=\"center\">
                   <input type=\"submit\" value=\"Transmettre\"></div>
                   </form>&nbsp<p>";

// retourner l'affichage du magasin
return $main;
}



/**
 *
 *     P A N I E R
 *
 *
 **/

function affiche_panier()
{
     // D�finir l'affichage de la zone principale pour le profil
    $main = "Votre panier d'achat<p>
             Lorem ipsum dolor sit amet, consectetur adipisicing elit,
             sed do eiusmod tempor incididunt ut labore et dolore magna
             aliqua. Ut enim ad minim veniam, quis nostrud exercitation
             ullamco laboris nisi ut aliquip ex ea commodo consequat.
             Duis aute irure dolor in reprehenderit in voluptate velit esse
             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
             cupidatat non proident, sunt in culpa qui officia deserunt mollit
             anim id est laborum";
// Retourner le paner
return $main;
}



/**
 *
 *
 *    P R O F I L
 *
 *
 *
 **/

function affiche_profil($id)
{
// Recouvrir les donn�es du tableau des utilisateurs
global $utilisateurs;
    // V�rifier si une session a �t� d�but�e
    if(isset($_SESSION['Prenom']) && isset($_SESSION['Nom']))
    {

    /**
     *  Voir utilisation des op�rateurs ternaires ($var==?"valeur1":"valeur2")
     *  pour d�finir la pr�s�lection dans la liste couleur
     *  et le sexe
     **/

    // D�finir l'affichage de la zone principale pour le profil
    $main = "<form name=\"frmProfil\" enctype=\"multipart/form-data\" action=\"".$_SERVER['PHP_SELF']."?selItem=enregistrer_profil\" method=\"POST\">\n

                <fieldset>
                <legend>Informations</legend>
                <div id=\"photo-profil\">
                Pr�nom: <input type=\"text\" name=\"txtPrenom\" value=\"".$utilisateurs[$id]."\"> <br>
                Nom : <input type=\"text\" name=\"txtNom\" value=\"".$utilisateurs[$id+1]."\"> <br>
                Nom d'usager: <input type=\"text\" size=\"15\" name=\"txtNomUsager\" value=\"".$utilisateurs[$id+2]."\"> <br>
                Mot de passe: <input type=\"password\" size=\"15\" name=\"txtMotDePasse\"> <br>
                Confirmation: <input type=\"password\" size=\"15\" name=\"txtConfirmation\"> <br>

                    Homme <input type=\"radio\" name=\"optSexe\" value=\"homme\" ".($utilisateurs[$id+4]=="homme"?"checked":"").">
                    Femme <input type=\"radio\" name=\"optSexe\" value=\"femme\" ".($utilisateurs[$id+4]=="femme"?"checked":"")." ><br>

                Courriel : <input type=\"text\" name=\"txtCourriel\" value=\"".$utilisateurs[$id+5]."\"> <br>
                T�l�phone : <input type=\"text\" name=\"txtTelephone\" value=\"".$utilisateurs[$id+6]."\"> <br>



                Couleur de profil <select name=\"cboCouleur\">
                <option value=\"red\" ".($utilisateurs[$id+7]=="red"?"selected":"").">Rouge</option>
                <option value=\"green\" ".($utilisateurs[$id+7]=="green"?"selected":"").">Vert</option>
                <option value=\"blue\" ".($utilisateurs[$id+7]=="blue"?"selected":"").">Bleu</option>
                <option value=\"purple\" ".($utilisateurs[$id+7]=="purble"?"selected":"").">Violet</option>
                </select>
                <br>
               <input type=\"submit\" name=\"cmdProfil\" value=\"Transmettre\">

                </fieldset>
                </form>";
    }
    else
    $main = "<font color=\"#cc0000\">Erreur d'acc�s au profil<br> Vous devez vous connecter...</font>";

// Retourner l'affichage du profil
return $main;
}



// Fonction pour enregistrer les nouvelles donn�es du profil
function enregistrer_profil($id)
{
// Recouvrir le tableau des utilisateurs
global $utilisateurs;



// V�rifier si le courriel � l'aide d'une expression r�guli�ere
if(preg_match("/^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-_.]?[[:alnum:]])*\.([a-z]{2,4})$/",$_REQUEST['txtCourriel']))
    {
    // Enregistrer Courriel
    $utilisateurs[$id+5]=$_REQUEST['txtCourriel'];
    }
else
    {
    // Retourner un message d'erreur et quitter la routine
    return  "<font color=\"#cc0000\"><b>Erreur...<br>Adresse courriel invalide</b></font>";
    }



//Si tous les champs sont compl�t�s correctement alors
if($_REQUEST['txtPrenom']!="" && $_REQUEST['txtNom']!="" && $_REQUEST['txtNomUsager'] && $_REQUEST['txtMotDePasse']==$_REQUEST['txtConfirmation'] && ($_REQUEST['txtMotDePasse']!="" || $_REQUEST['txtConfirmation']!=""))
    {
    // Enregistrer le pr�nom
    $utilisateurs[$id]=$_REQUEST['txtPrenom'];
    // Enregistrer le nom
    $utilisateurs[$id+1]=$_REQUEST['txtNom'];
    // Enregistrer le nom d'usager
    $utilisateurs[$id+2]=$_REQUEST['txtNomUsager'];
    // Enregistrer nouveau mot de passe
    $utilisateurs[$id+3]=$_REQUEST['txtMotDePasse'];
    // Enregistrer sexe
    $utilisateurs[$id+4]=$_REQUEST['optSexe'];
    // Enregistrer T�l�phone
    $utilisateurs[$id+6]=$_REQUEST['txtTelephone'];
    // Enregistrer couleur de profil
    $utilisateurs[$id+7]=$_REQUEST['cboCouleur'];
    // Enregistrer les donn�es dans les variables de session
    $_SESSION['Prenom']=$utilisateurs[$id]; // prenom
    $_SESSION['Nom']=$utilisateurs[$id+1]; // nom
    $_SESSION['nomusager']=$utilisateurs[$id+2]; // nomusager
    $_SESSION['cboCouleur']=$utilisateurs[$id+7]; // couleur



    // Initialiser le message de validation de l'enregistremrent
    $message = "<font color=\"#00cc00\"><b>Enregistrement compl�t�...</b></font>";

    // Afficher de nouveau le profil
    $message.=affiche_profil($id);
    }
// Si non
else
    // Initialiser message le mot de passe invalid
    $message = "<font color=\"#cc0000\"><b>Erreur d'enregistrement<br>Veuillez compl�ter tous les champs correctement</b></font>";
// retourner message
return $message;

}



/**
 *
 *
 *   �   P R O P O S
 *
 *
 *
 **/

function affiche_a_propos()
{
      // D�finir l'affichage de la zone principale pour le profil
    $main = "� propor d'info-shop<p>
             Lorem ipsum dolor sit amet, consectetur adipisicing elit,
             sed do eiusmod tempor incididunt ut labore et dolore magna
             aliqua. Ut enim ad minim veniam, quis nostrud exercitation
             ullamco laboris nisi ut aliquip ex ea commodo consequat.
             Duis aute irure dolor in reprehenderit in voluptate velit esse
             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
             cupidatat non proident, sunt in culpa qui officia deserunt mollit
             anim id est laborum";
    // Retourner l'affichage section � propos
    return $main;
}



/**
 *
 *     N O U S
 *
 *    J O I N D R E
 *
 *
 **/

function affiche_nous_joindre()
{

    // D�finir l'affichage de la zone principale pour le profil
    $main = "� propor d'info-shop<p>
             Lorem ipsum dolor sit amet, consectetur adipisicing elit,
             sed do eiusmod tempor incididunt ut labore et dolore magna
             aliqua. Ut enim ad minim veniam, quis nostrud exercitation
             ullamco laboris nisi ut aliquip ex ea commodo consequat.
             Duis aute irure dolor in reprehenderit in voluptate velit esse
             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
             cupidatat non proident, sunt in culpa qui officia deserunt mollit
             anim id est laborum";
// Retourner la section joidre
return $main;
}



/**
 *
 *
 *  G E S T I O N   D U   M A G A S I N
 *
 *
 **/

function gestion_produits()
{
// R�cup�rer le tableau des produits dans
// dans une fonction priv�e
global $produits, $lien;

    // D�finir l'affichage de l'ent�te du tableau et du formulaire
    $main = "<h3>Gestion des produits du magasin</h3><p>";


    /**
     *
     *  TABLE DE BRANCHEMENTS
     *
     **/
    switch($_REQUEST['action']){

     case "ajouter":
                    $main.=ajouter_item();
                    break;
     case "ajouter_item":
                    $main.=ajouter_item_db();
                    break;
     case "modifier":
                    $main.=modifier_item($_REQUEST["ID"]);
                    break;
     case "modifier_item":
                    $main.=modifier_item_db($_REQUEST["ID"]);
                    break;
     case "supprimer":
                    $main.=supprimer_item($_REQUEST["ID"]);
                    break;
    }


    /**
     *
     *
     *
     *  SECTION POUR L'AFFICHAGE DE LA LISTE DES PRODUITS
     *  AVEC LES BOUTONS D'OP�RATION AJOUT, SUPPRESION
     *  ET MODIFICATION
     *
     *
     **/
    $main .= "\n\n<table border=\"1\">";

            // Afficher la ligne titre
    $main .="<tr style=\"font-weight:bold\">
              <td>Items</td>
              <td valign=center>{op�rations}</td>
             </tr>";

    // Formuler la requ�te pour lire tous les produits du magasin
    $requete = "SELECT * FROM tblProduits";

    // Transmettre la requ�te au serveur MySQL
    $reponse = mysql_query($requete,$lien);

    // Lire le nombre de rang�e re�ue
    $nbrangee = mysql_num_rows($reponse);

    // faire une boucle pour afficher chaque rang�e de produit
    for($pointeur=0;$pointeur<$nbrangee;$pointeur++)
        {
        // R�cup�rer chaque champ dans un tableau cl�-valeur
        $produit = mysql_fetch_array($reponse);

        // Cr�er une ligne d'affichage du produit avec le nom descripion proto prix, quantit�
        $main .="\n<tr>
                   <td>
                        <font size=\"+2\"><br>".$produit["nom"]."</font><br>
                        <font size=\"-2\">ID-".$produit["ID"]."</font>
                        <p/>

                          <div style=\"display:run-in;float:left\">
                          <img src=\"photos/".$produit["photo"]."\">
                          <br><b>".sprintf("$%0.2f",$produit["prix"])."</b>
                          </div>

                        <div style=\"display:run-in\">".$produit["description"]."
                        <br>
                        <font size=\"-1\">
                            <i>Quantit� disponible </i>: ".$produit["quantite"]."
                        </font>

                    </td>";
         // Cellule avec les boutons d'op�rations ajout, modification et supression
         $main.=   "<td valign=\"center\" align=\"center\">
                     <a href=\"?selItem=gestion&action=ajouter&ID=".$produit["ID"]."\">
                     <img src=\"images/ajouter.png\" border=\"0\">
                     </a>
                     <a href=\"?selItem=gestion&action=modifier&ID=".$produit["ID"]."\">
                     <img src=\"images/modifier.png\" border=\"0\">
                     </a>
                     <a href=\"?selItem=gestion&action=supprimer&ID=".$produit["ID"]."\">
                     <img src=\"images/supprimer.png\" border=\"0\">
                     </a>
                    </td>
                    </tr>";

        }

        // Terminer le tableau et le formulaire
        $main.="\n</table>
                   &nbsp<p>";

      // retourner l'affichage du magasin
      return $main;
      }



/**
 *
 *   Afficher le formulaire pour ajouter un item
 *
 *
 *
 **/
 function ajouter_item()
 {
  //Ajouter un formulaire
  $main = "<div id=\"frmGestion\">
            \n\n<form name=\"frmAjout\" method=\"post\" enctype=\"mutipart/form-data\" action=\"".$_SERVER["PHP_SELF"]."?selItem=gestion&action=ajouter_item\">";

  //Ajouter les champs du produit
  $main .= "<br>Nom du produit: <input name=\"nom\" type=\"text\"><br>
            Description :<br>
            <textarea name=\"description\" cols=\"55\" rows=\"5\"></textarea><br>
            Prix : <input type=\"text\" name=\"prix\"><br>
            Quantit� : <input type=\"text\" name=\"quantite\"><br>
            Image du produit : <input type=\"file\" name=\"photo\"><P>
            <div style=\"text-align:right\">
            <input type=\"button\" value=\"Annuler\" onClick=\"javascript:location='".$_SERVER["PHP_SELF"]."?selItem=gestion'\">
            <input type=\"submit\" value=\"Envoyer\"></div>
            </form>
            </div>";

  // Retourner l'affichage du bloc formulaire
  return $main;

 }



 /**
  *
  *  Ajouter un nouvel item dans la base de donn�es
  *
  *
  *
  **/
 function ajouter_item_db(){
  //R�cup�rer le num�ro de conexion � la db
  global $lien;

  //Formuler la requ�te pour ajouter un item dans table des produits
  $requete= "INSERT INTO tblProduits SET
              nom='$_REQUEST[nom]',
              description = '$_REQUEST[description]',
              prix = '$_REQUEST[prix]',
              quantite ='$_REQUEST[quantite]',
              photo='$_REQUEST[photo]'";
  // Transmettre la requete au serveur mysql
  $reponse = mysql_db_query("dbInfoShop",$requete,$lien);
  // v�rifier si une erreur est survenue
  if(($message=mysql_error($lien))!="")
      // Retourner un message d'erreur d'inscription
      $main = "<b><font color=#ff0000>$message</font>";
      //Sinon
      else
      // Retourner un message que l'op�ration est compl�t�s
        $main = "<b><font color=#00ff00>Enregistrement compl�t�</font>";

      // Retourner un message que l'op�ration est compl�t�s
return $main;


 }



 /**
 *
 *   Afficher le formulaire pour modifier item
 *
 *
 *
 **/
 function modifier_item()
 {
  // R�cup�rer la variable de connexion � la DB
  global $lien;

  //Formuler la requ�te pour r�cup�rer tous les informations de l'item s�lectionn�
  $requete = "SELECT * FROM tblProduits WHERE ID=".$_REQUEST['ID'];
  // Transmettre la requ�te au serveur mysql
  $reponse = mysql_db_query("dbInfoShop",$requete,$lien);

  //V�rifier si un message d'erreur est survenue
  if(($message=mysql_error($lien))!="")
      // Terminer la fonction et retourner message d'erreur
      return $message;

  //R�cup�rer le r�sultat
  $produit=mysql_fetch_array($reponse);

  //Ajouter un formulaire
  $main = "<div id=\"frmGestion\">
            \n\n<form name=\"frmModif\" method=\"post\" enctype=\"mutipart/form-data\" action=\"".$_SERVER["PHP_SELF"]."?selItem=gestion&action=modifier_item\">";

  //Ajouter les champs du produit
  $main .= "<br>Nom du produit: <input name=\"nom\" type=\"text\" value=\"".$produit['nom']."\"><br>
            <input name=\"ID\" type=\"hidden\" value=\"".$produit['ID']."\">
            Description :<br>
            <textarea name=\"description\" cols=\"55\" rows=\"5\">".$produit['description']."</textarea><br>
            Prix : <input type=\"text\" name=\"prix\" value=\"".$produit['prix']."\"><br>
            Quantit� : <input type=\"text\" name=\"quantite\" value=\"".$produit['quantite']."\"><br>
            Image du produit : <input type=\"file\" name=\"photo\" value=\"".$produit['photo']."\"><P>
            <div style=\"text-align:right\">
            <input type=\"button\" value=\"Annuler\" onClick=\"javascript:location='".$_SERVER["PHP_SELF"]."?selItem=gestion'\">
            <input type=\"submit\" value=\"Envoyer\"></div>
            </form>
            </div>";

  // Retourner l'affichage du bloc formulaire
  return $main;
 }

  /**
  *
  *  Ajouter un nouvel item dans la base de donn�es
  *
  *
  *
  **/
 function modifier_item_db(){
  //R�cup�rer le num�ro de conexion � la db
  global $lien;

  //Formuler la requ�te pour ajouter un item dans table des produits
  $requete= "UPDATE tblProduits SET
              nom='$_REQUEST[nom]',
              description = '$_REQUEST[description]',
              prix = '$_REQUEST[prix]',
              quantite ='$_REQUEST[quantite]',
              photo='$_REQUEST[photo]'
              WHERE ID=".$_REQUEST[ID];


  // Transmettre la requete au serveur mysql
  $reponse = mysql_db_query("dbInfoShop",$requete,$lien);
  // v�rifier si une erreur est survenue
  if(($message=mysql_error($lien))!="")
      // Retourner un message d'erreur d'inscription
      $main = "<b><font color=#ff0000>$message</font>";
      //Sinon
      else
      // Retourner un message que l'op�ration est compl�t�s
        $main = "<b><font color=#00ff00>Enregistrement compl�t�</font>";

      // Retourner un message que l'op�ration est compl�t�s
return $main;


 }



 /**
 *
 *  Supprimer un item de la base de donn�es
 *
 *
 *
 **/
 function supprimer_item()
 {

  //R�cup�rer le num�ro de conexion � la db
  global $lien;

  //Formuler la requ�te pour ajouter un item dans table des produits
  $requete= "DELETE FROM tblProduits WHERE ID=".$_REQUEST[ID];

  // Transmettre la requete au serveur mysql
  $reponse = mysql_db_query("dbInfoShop",$requete,$lien);
  // v�rifier si une erreur est survenue
  if(($message=mysql_error($lien))!="")
      // Retourner un message d'erreur d'inscription
      $main = "<b><font color=#ff0000>$message</font>";
      //Sinon
      else
      // Retourner un message que l'op�ration est compl�t�s
        $main = "<b><font color=#00ff00>�l�ment supprim�</font>";

      // Retourner un message que l'op�ration est compl�t�s
return $main;


 }



?>
