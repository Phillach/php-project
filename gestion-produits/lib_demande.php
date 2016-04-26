<?php
/*Fait par Philippe Lachance
26 avril 2016
But: cr�er un onglet pour la gestion et cr�ation des demandes de support informatique

/**
 *
 *  G E S T I O N   DEMANDE
 *
 **/

function gestion_demandes()
{
// R�cup�rer le tableau des demandes dans
// dans une fonction priv�e
global $demande, $lien, $utilisateurs;

    // D�finir l'affichage de l'ent�te du tableau et du formulaire
    $main = "<h3>Gestion des demandes</h3><p>";


    /**
     *
     *  TABLE DE BRANCHEMENTS
     *
     **/

    //V�rifier l'action choisie par l'utilisateur
    switch($_REQUEST['action'])
    {
     case "ajouter":
                    $main.=ajouter_demande();
                    break;
     case "ajouter_demande":
                    $main.=ajouter_demande_db();
                    break;
     case "modifier":
                    $main.=modifier_demande($_REQUEST['id']);
                    break;
     case "modifier_demande":
                    $main.=modifier_demande_db($_REQUEST['id']);
                    break;
     case "supprimer":
                    $main.=supprimer_demande($_REQUEST['id']);
                    break;
    }


    /**
     *
     *  SECTION POUR L'AFFICHAGE DE LA LISTE DES DEMANDES
     *  AVEC LES BOUTONS D'OP�RATION AJOUT, SUPPRESION
     *  ET MODIFICATION
     *
     **/
    //Commencer le tableau
    $main .= "\n\n<table border=\"1\">";

            // Afficher la ligne titre
    $main .="<tr style=\"font-weight:bold\">
              <td>ID</td>
              <td>Pr�nom</td>
              <td>Nom</td>
              <td>Type de travail</td>
              <td>Objet</td>
              <td>Description</td>
              <td>Date de demande</td>
              <td>Date requise</td>
              <td>Statut</td>
              <td valign=center>Op�rations</td>
             </tr>";

    // Formuler la requ�te pour lire toutes les demandes de tbldemande
    $requete = "SELECT * FROM tbldemande";

    // Transmettre la requ�te au serveur MySQL
    $reponse = mysql_query($requete,$lien);

    // Lire le nombre de rang�e re�ue
    $nbrangee = mysql_num_rows($reponse);

    // faire une boucle pour afficher chaque rang�e de demandesi
    for($pointeur=0;$pointeur<$nbrangee;$pointeur++)
        {
        // R�cup�rer chaque champ dans un tableau cl�-valeur
        $demande = mysql_fetch_array($reponse);

        // Cr�er une ligne d'affichage du produit avec l'id, le prenom, le nom, le type de travail, l'objet, la description, la date de demande et la date requise
              $main .="\n<tr>
                   <td>
                        ".$demande["id"]."
                   </td>";
              $main .="\n
                   <td>
                        ".$demande["prenom"]."
                   </td>";
              $main .="\n
                   <td>
                        ".$demande["nom"]."
                   </td>";
              $main .="\n
                   <td>
                        ".$demande["type_travail"]."
                   </td>";
              $main .="\n
                   <td>
                        ".$demande["objet"]."
                   </td>";
              $main .="\n
                   <td>
                       ".$demande["description"]."
                   </td>";
              $main .="\n
                   <td>
                        ".$demande["date_demande"]."
                   </td>";
              $main .="\n
                   <td>
                        ".$demande["date_requise"]."
                   </td>";
              $main .="\n
                   <td>
                        ".$demande["statut"]."
                   </td>";


         // Cellule avec le bouton d'op�ration ajout
             $main.=   "<td valign=\"center\" align=\"center\">
                         <a href=\"?selItem=demande&action=ajouter&id=".$demande["id"]."\">
                         <img src=\"images/ajouter.png\" border=\"0\">
                         </a>";
                 //v�rifier si la demande a �t� faite par l'utilisateur de la session en cours
                 if($_SESSION["prenom"]==$demande["prenom"] && $_SESSION["nom"]==$demande["nom"])
                    {
                        //Cellule avec les boutons d'op�rations modifications et suppression
                        $main.= "<a href=\"?selItem=demande&action=modifier&id=".$demande["id"]."\">
                                 <img src=\"images/modifier.png\" border=\"0\">
                                 </a>
                                 <a onclick=\"confirmation(".$demande["id"].")\" href=\"#\">
                                 <img src=\"images/supprimer.png\" border=\"0\">
                                 </a>
                                 </td>
                                </tr>";
                     }
                  //verifier si l'utilisateur est admin
                  elseif($_SESSION['nomusager']=="admin")
                    {
                         //celulle avec les boutons modification et suppression
                         $main.= "<a href=\"?selItem=demande&action=modifier&id=".$demande["id"]."\">
                                  <img src=\"images/modifier.png\" border=\"0\">
                                  </a>
                                  <a onclick=\"confirmation(".$demande["id"].")\" href=\"#\">
                                  <img src=\"images/supprimer.png\" border=\"0\">
                                  </a>
                                  </td>
                                 </tr>";
                     }


        }

        // Terminer le tableau et le formulaire
        $main.="\n</table>
                   &nbsp<p>";

      // retourner l'affichage de demande
      return $main;
      }

/**
 *
 *   Afficher le formulaire pour ajouter une demande
 *
 **/
 function ajouter_demande()
 {
  //Ajouter un formulaire
  $main = "<div id=\"frmGestion\">
            \n\n<form name=\"frmAjout\" method=\"post\" enctype=\"mutipart/form-data\" action=\"".$_SERVER["PHP_SELF"]."?selItem=demande&action=ajouter_demande\">";

  //Ajouter les champs de la demande
  $main .= "<br>Pr�nom:<input name=\"txtprenom\" type=\"text\" readonly value=\"".$_SESSION["prenom"]."\"><br>
            Nom :<input name=\"txtnom\" type=\"text\" readonly value=\"".$_SESSION["nom"]."\"><br>
            Type de travail: <select name=\"txttype_travail\">
                               <option>Information</option>
                               <option>R�paration logiciel/mat�riel</option>
                               <option>D�pannagelogiciel/mat�riel</option>
                               <option>T�l� intervention</option>
                               <option>Sauvegarde/Recouvrement</option>
                               <option>Installation logiciel/mat�riel</option>
                               <option>Nettoyage antivirus</option>
                               <option>Reconfiguration</option>
                               <option>Autres</option>
                             </select><br>
            Objet de la demande : <input type=\"text\" name=\"txtobjet\"><br>
            Description :</br>
            <textarea name=\"txtdescription\" cols=\"55\" rows=\"5\"></textarea><br>
            Date de la demande :<input name=\"txtdate_demande\" type=\"text\" value=\"".date("Y-m-d H:i:s")."\"><br>
            Date requise :<input name=\"txtdate_requise\" type=\"datetime-local\"><br>
            Statut: <select name=\"txtstatut\">
                       <option>Non-assign�e</option>
                    </select><br>
            <input type=\"button\" value=\"Annuler\" onClick=\"javascript:location='".$_SERVER["PHP_SELF"]."?selItem=demande'\">
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
  **/
 function ajouter_demande_db(){
  //R�cup�rer le num�ro de conexion � la db
  global $lien;

  //Formuler la requ�te pour ajouter une demande dans table des demandes
    $requete= "INSERT INTO tbldemande "
              ."(prenom, nom, type_travail, objet, description, date_demande, date_requise, statut) VALUES "
              ."('".mysql_real_escape_string($_REQUEST['txtprenom'])."',"
              ."'".mysql_real_escape_string($_REQUEST['txtnom'])."',"
              ."'".mysql_real_escape_string($_REQUEST['txttype_travail'])."',"
              ."'".mysql_real_escape_string($_REQUEST['txtobjet'])."',"
              ."'".mysql_real_escape_string($_REQUEST['txtdescription'])."',"
              ."'".mysql_real_escape_string($_REQUEST['txtdate_demande'])."',"
              ."'".mysql_real_escape_string($_REQUEST['txtdate_requise'])."',"
              ."'".mysql_real_escape_string($_REQUEST['txtstatut'])."')";

  // Transmettre la requete au serveur mysql
  $reponse = mysql_db_query("lacha815",$requete,$lien);
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
 **/
 function modifier_demande()
 {
  // R�cup�rer la variable de connexion � la DB
  global $lien;

  //Formuler la requ�te pour r�cup�rer tous les informations de la demande s�lectionn�
  $requete = "SELECT * FROM tbldemande WHERE id=".$_REQUEST[id];
  // Transmettre la requ�te au serveur mysql
  $reponse = mysql_db_query("lacha815",$requete,$lien);

  //V�rifier si un message d'erreur est survenue
  if(($message=mysql_error($lien))!="")
      // Terminer la fonction et retourner message d'erreur
      return $message;

  //R�cup�rer le r�sultat
  $demande=mysql_fetch_array($reponse);

  //Ajouter un formulaire
  $main = "<div id=\"frmGestion\">
            \n\n<form name=\"frmModif\" method=\"post\" enctype=\"mutipart/form-data\" action=\"".$_SERVER["PHP_SELF"]."?selItem=demande&action=modifier_demande\">";

  //Ajouter les champs de la demande
 $main .= "<br>Pr�nom: <input name=\"txtprenom\" type=\"text\" value=\"".$demande['prenom']."\"><br>
            <input name=\"txtid\" type=\"hidden\" value=\"".$demande['id']."\">
            Nom: <input name=\"txtnom\" type=\"text\" value=\"".$demande['nom']."\"><br>
            Type de travail: <select name=\"txttype_travail\">
                               <option>Information</option>
                               <option>R�paration logiciel/mat�riel</option>
                               <option>D�pannage logiciel/mat�riel</option>
                               <option>T�l� intervention</option>
                               <option>Sauvegarde/Recouvrement</option>
                               <option>Installation logiciel/mat�riel</option>
                               <option>Nettoyage antivirus</option>
                               <option>Reconfiguration</option>
                               <option>Autres</option>
                             </select><br>
            Objet: <input name=\"txtobjet\" type=\"text\" value=\"".$demande['objet']."\"><br>
            Description :<br>
            <textarea name=\"txtdescription\" cols=\"55\" rows=\"5\">".$demande['description']."</textarea><br>
            Date de demande: <input name=\"txtdate_demande\" type=\"datetime\" value=\"".$demande['date_demande']."\"><br>
            Date requise: <input name=\"txtdate_requise\" type=\"datetime\" value=\"".$demande['date_requise']."\"><br>";
             //verifier si l'utilisateur est admin
             if($_SESSION['nomusager']=="admin")
               {
                //champ du statut de la demande
                 $main .="Statut: <select name=\"txtstatut\">
                                    <option>Non-assign�e</option>
                                    <option>En Cours</option>
                                    <option>En attente</option>
                                    <option>Termin�e</option>
                                    <option>Report�e</option>
                                  </select><br>";
            }

            $main.="<input type=\"button\" value=\"Annuler\" onClick=\"javascript:location='".$_SERVER["PHP_SELF"]."?selItem=demande'\">
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
  **/
 function modifier_demande_db(){
  //R�cup�rer le num�ro de conexion � la db
  global $lien;

  //Formuler la requ�te pour ajouter une demande dans table des demandes
  $requete= "UPDATE tbldemande SET"
              ." prenom='".$_REQUEST['txtprenom']."',"
              ." nom='".$_REQUEST['txtnom']."',"
              ." type_travail='".$_REQUEST['txttype_travail']."',"
              ." objet='".$_REQUEST['txtobjet']."',"
              ." description='".$_REQUEST['txtdescription']."',"
              ." date_demande='".$_REQUEST['txtdate_demande']."',"
              ." date_requise='".$_REQUEST['txtdate_requise']."',"
              ." statut='".$_REQUEST['txtstatut']."'"
              ." WHERE id=".$_REQUEST["txtid"];


  // Transmettre la requete au serveur mysql
  $reponse = mysql_db_query("lacha815",$requete,$lien);
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
 **/
 function supprimer_demande()
 {

  //R�cup�rer le num�ro de connexion � la db
  global $lien;

  //Formuler la requ�te pour ajouter un item dans table des produits
  $requete= "DELETE FROM tbldemande WHERE id=".$_REQUEST['id'];

  // Transmettre la requete au serveur mysql
  $reponse = mysql_db_query("lacha815",$requete,$lien);
  // v�rifier si une erreur est survenue
  if(($message=mysql_error($lien))!="")
      // Retourner un message d'erreur d'inscription
      $main = "<b><font color=#ff0000>$message</font>";
      //Sinon
      else
      // Retourner un message que l'op�ration est compl�t�
        $main = "<b><font color=#00ff00>�l�ment supprim�</font>";

      // Retourner un message que l'op�ration est compl�t�s
return $main;


 }

?>
