<?php
// Philippe Lachance

/**
 *
 *
 *  G E S T I O N   D E S   D E M A N D E S
 *
 *
 **/

function gestion_demandes()
{
  global $lien;
// Récupérer le tableau des demandes dans
// dans une fonction privée

    // Définir l'affichage de l'entête du tableau et du formulaire
    $main = "<h3>Gestion des demandes du magasin</h3><p>";


    /**
     *
     *  TABLE DE BRANCHEMENTS
     *
     **/
    switch($_REQUEST['action']){

     case "ajouter":
                    $main.=ajouter_demande();
                    break;
     case "ajouter_demande":
                    $main.=ajouter_demande_db();
                    break;
     case "modifier":
                    $main.=modifier_demande($_REQUEST["ID"]);
                    break;
     case "modifier_demande":
                    $main.=modifier_demande_db($_REQUEST["ID"]);
                    break;
     case "supprimer":
                    $main.=supprimer_demande($_REQUEST["ID"]);
                    break;
    case "supprimer_demande_db":
                   $main.=supprimer_demande_db($_REQUEST["ID"]);
                   break;
    }


    /**
     *
     *
     *
     *  SECTION POUR L'AFFICHAGE DE LA LISTE DES demandeS
     *  AVEC LES BOUTONS D'OP�RATION AJOUT, SUPPRESION
     *  ET MODIFICATION
     *
     *
     **/

     $main.=   "<a href=\"?selItem=Demande&action=ajouter\">
                 <img src=\"images/ajouter.png\" border=\"0\">
                 </a>";

    $main .= "\n\n<table border=\"1\">";

            // Afficher la ligne titre
    $main .="<tr style=\"font-weight:bold\">
              <td>ID</td>
              <td>Prénom</td>
              <td valign=center>Nom</td>
              <td valign=center>Type de travail</td>
              <td valign=center>Objet</td>
              <td valign=center>Description</td>
              <td valign=center>Date demande</td>
              <td valign=center>Date requise</td>
              <td valign=center>Statut</td>
              <td valign=center>Opération</td>

             </tr>";



    // Formuler la requ�te pour lire tous les demandes du magasin
    $requete = "SELECT * FROM tbldemandes";

    // Transmettre la requ�te au serveur MySQL
    $reponse = mysql_query($requete,$lien);

    // Lire le nombre de rang�e re�ue
    $nbrangee = mysql_num_rows($reponse);

    // faire une boucle pour afficher chaque rang�e de demande
    for($pointeur=0;$pointeur<$nbrangee;$pointeur++)
        {
        // R�cup�rer chaque champ dans un tableau cl�-valeur
        $demande = mysql_fetch_array($reponse);

       $main .="\n<tr>
       <td> ".$demande["ID"]. "
       </td>";

       $main .="\n
       <td> ".$demande["Prenom"]. "
       </td>";

       $main .="\n
       <td> ".$demande["Nom"]. "
       </td>";

       $main .="\n
       <td> ".$demande["Type"]. "
       </td>";

       $main .="\n
       <td> ".$demande["Objet"]. "
       </td>";

       $main .="\n
       <td> ".$demande["Description"]. "
       </td>";

       $main .="\n
       <td> ".$demande["DateDemande"]. "
       </td>";

       $main .="\n
       <td> ".$demande["DateRequise"]. "
       </td>";

       $main .="\n
       <td> ".$demande["Statut"]. "
       </td>";


        //La partie admin des demandes
        if(($_SESSION['Prenom']=="Jimmy") && ($_SESSION['Nom']=="Hendrix"))
             {
       // Ajouter Modification et suppression
       $main.=   "<td valign=\"center\" align=\"center\">
       <a href=\"?selItem=Demande&action=ajouter\">
                   <img src=\"images/ajouter.png\" border=\"0\">
                   </a>
              <a href=\"?selItem=Demande&action=modifier&ID=".$demande["ID"]."\">
              <img src=\"images/modifier.png\" border=\"0\">
              </a>
              <a href=\"?selItem=Demande&action=supprimer&ID=".$demande["ID"]."\">
              <img src=\"images/supprimer.png\" border=\"0\">
              </a>
             </td>
             </tr>";
             }
             // sinon = compte connecter est = au compte de la demande permettre de modifier / supprimer

           elseif(($_SESSION['Prenom']== $demande['Prenom']) && ($_SESSION['Nom']== $demande['Nom']))
             {
       // Cellule avec les boutons d'op�rations ajout, modification et supression
       $main.=   "<td valign=\"center\" align=\"center\">
       <a href=\"?selItem=Demande&action=ajouter\">
                   <img src=\"images/ajouter.png\" border=\"0\">
                   </a>
              <a href=\"?selItem=Demande&action=modifier&ID=".$demande["ID"]."\">
              <img src=\"images/modifier.png\" border=\"0\">
              </a>
              <a href=\"?selItem=Demande&action=supprimer&ID=".$demande["ID"]."\">
              <img src=\"images/supprimer.png\" border=\"0\">
              </a>
             </td>
             </tr>";
             }




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
 function ajouter_demande()
 {
  //Ajouter un formulaire
  $main = "<div id=\"frmGestion\">
            \n\n<form name=\"frmAjout\" method=\"post\" enctype=\"mutipart/form-data\" action=\"".$_SERVER["PHP_SELF"]."?selItem=Demande&action=ajouter_demande\">";

  //Ajouter les champs du demande
  $main .= "<br>Prenom : <input type=\"text\" name=\"Prenom\" value=\"".$_SESSION["Prenom"]."\" readonly><br>
            <br>Nom : <input type=\"text\" name=\"Nom\" value=\"".$_SESSION["Nom"]."\" readonly><br>
            <br>Type:
                <select name=\"Type\">
                <option value=\"Conseil\">Conseil</option>
                <option value=\"Reparation-Logiciel/Materiel\">Reparation-Logiciel/Materiel</option>
                <option value=\"Depannage-Logiciel/Materiel\">Depannage-Logiciel/Materiel</option>
                <option value=\"Sauvegarde-Restauration\">Sauvegarde-Restauration/Tele intervention</option>
                <option value=\"Installation materielle/Logicielle\">Installation materielle/Logicielle</option>
                <option value=\"Nettoyage Antivirus\">Nettoyage Antivirus</option>
                <option value=\"Reconfiguration\">Reconfiguration</option><br>
                </select>
                <br>Objet :<br>
                <textarea name=\"Objet\" cols=\"55\" rows=\"5\"></textarea><br>
                Description :<br>
                <textarea name=\"Description\" cols=\"55\" rows=\"5\"></textarea><br>
                <br>Urgent: Oui <input name=\"Oui/Non\" type=\"Radio\" value=\"Oui\" /> Non <input name=\"Oui/Non\" type=\"Radio\" value=\"Non\" /> <br>
            <br>DateDemande: <input type=\"text\" name=\"DateDemande\" value=\"".date("Y-m-d")."\" readonly><br>
            <br>DateRequise: <input name=\"DateRequise\" type=\"text\"><br>
            <br>Statut: <input name=\"Statut\" type=\"text\" value=\""."Non-assigné"."\" readonly><br>
            <div style=\"text-align:right\">
            <input type=\"button\" value=\"Annuler\" onClick=\"javascript:location='".$_SERVER["PHP_SELF"]."?selItem=Demande'\">
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
 function ajouter_demande_db(){
  //R�cup�rer le num�ro de conexion � la db
  global $lien;

  //Formuler la requ�te pour ajouter un item dans table des demandes
  $requete= "INSERT INTO tbldemandes SET
              Prenom='$_REQUEST[Prenom]',
              Nom='$_REQUEST[Nom]',
              Type = '$_REQUEST[Type]',
              Objet = '$_REQUEST[Objet]',
              Description ='$_REQUEST[Description]',
              DateDemande='$_REQUEST[DateDemande]',
              DateRequise='$_REQUEST[DateRequise]',
              Statut='$_REQUEST[Statut]'
              ";

  // Transmettre la requete au serveur mysql
  $reponse = mysql_db_query("lacha815",$requete,$lien);
  // v�rifier si une erreur est survenue
  if(($message=mysql_error($lien))!="")
      // Retourner un message d'erreur d'inscription
      $main = "<b><font color=#ff0000>$message</font>";
      //Sinon
      else
      // Retourner un message que l'op�ration est compl�t�s
        $main = "<b><font color=#00ff00>Enregistrement complete</font>";



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
 function modifier_demande()
 {


  // R�cup�rer la variable de connexion � la DB
  global $lien;

  //Formuler la requ�te pour r�cup�rer tous les informations de l'item s�lectionn�
  $requete = "SELECT * FROM tbldemandes WHERE ID=".$_REQUEST['ID'];
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
            \n\n<form name=\"frmModif\" method=\"post\" enctype=\"mutipart/form-data\" action=\"".$_SERVER["PHP_SELF"]."?selItem=Demande&action=modifier_demande\">";

  //Ajouter les champs du demande
  $main = "<div id=\"frmDemande\">
            \n\n<form name=\"frmModif\" method=\"POST\" enctype=\"mutipart/form-data\" action=\"".$_SERVER["PHP_SELF"]."?selItem=Demande&action=modifier_demande\">";

  //Ajouter les champs du produit
  $main .= "
              ID : <input type=\"text\" name=\"ID\" value=\"".$demande["ID"]."\"readonly><br>
            Prenom : <input type=\"text\" name=\"Prenom\" value=\"".$demande["Prenom"]."\"readonly><br>
            Nom : <input type=\"text\" name=\"Nom\" value=\"".$demande["Nom"]."\"readonly> <br>
            Type :
            <name=\"type\">
                <select name=\"Type\">

                 <option ".($demande['Type']=="Conseil"?"selected":"")." value=\"Conseil\">Conseil</option> readonly<br>
                <option ".($demande['Type']=="Reparation-Logiciel/Materiel"?"selected":"")."  value=\"Reparation-Logiciel/Materiel\">Reparation-Logiciel/Materiel </option>
                <option ".($demande['Type']=="Depannage-Logiciel/Materiel"?"selected":"")." value=\"Depannage-Logiciel/Materiel\">Depannage-Logiciel/Materiel</option>
                <option  ".($demande['Type']=="Sauvegarde-Restauration"?"selected":"")." value=\"Sauvegarde-Restauration\">Sauvegarde-Restauration/Tele intervention</option> <br>
                <option ".($demande['Type']=="Installation materielle/Logicielle"?"selected":"")."  value=\"Installation materielle/Logicielle\">Installation materielle/Logicielle</option><br>
                <option ".($demande['Type']=="Nettoyage Antivirus"?"selected":"")." value=\"Nettoyage Antivirus\">Nettoyage Antivirus</option> <br>
                <option ".($demande['Type']=="Reconfiguration"?"selected":"")." value=\"Reconfiguration\">Reconfiguration</option><br>
               </select>
                <br>
            Objet : <input type=\"text\" name=\"Objet\" value=\"".$demande['Objet']."\"><br>
            Description : <input type=\"text\" name=\"Description\" value=\"".$demande['Description']."\"><br>
            DateDemande : <input type=\"date\" name=\"DateDemande\" value=\"".$demande['DateDemande']."\" readonly><br>
            DateRequise : <input type=\"date\" name=\"DateRequise\" value=\"".$demande['DateRequise']."\"><br>
          <br>Statut : <input type=\"text\" name=\"Statut\" value=\"".$demande["Statut"]."\"> <br>
                <br>
            <div style=\"text-align:right\">
            <input type=\"button\" value=\"Annuler\" onClick=\"javascript:location='".$_SERVER["PHP_SELF"]."?selItem=Demande'\">
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
 function modifier_demande_db(){
  //R�cup�rer le num�ro de conexion � la db
  global $lien;

  //Formuler la requ�te pour ajouter un item dans table des demandes
  $requete= "UPDATE tbldemandes SET
              Prenom='$_REQUEST[Prenom]',
              Nom = '$_REQUEST[Nom]',
              Type = '$_REQUEST[Type]',
              Objet ='$_REQUEST[Objet]',
              Description ='$_REQUEST[Description]',
              Datedemande ='$_REQUEST[DateDemande]',
              DateRequise ='$_REQUEST[DateRequise]',
              Statut='$_REQUEST[Statut]'
              WHERE ID=".$_REQUEST[ID];


  // Transmettre la requete au serveur mysql
  $reponse = mysql_db_query("lacha815",$requete,$lien);
  // v�rifier si une erreur est survenue
  if(($message=mysql_error($lien))!="")
      // Retourner un message d'erreur d'inscription
      $main = "<b><font color=#ff0000>$message</font>";
      //Sinon
      else
      // Retourner un message que l'op�ration est compl�t�s
        $main = "<b><font color=#00ff00>Enregistrement complete</font>";

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


 function supprimer_demande()
 {
    $main="\n<form method=\"post\" name=\"frmsupp\" enctype=\"mutipart/form-data\" action=\"".$_SERVER["PHP_SELF"]."?selItem=Demande&action=supprimer_demande_db\">
    \n<p style=\"width:33%;border:3px ridge darkgrey;margin:auto;text-align:center\">
        Êtes vous sur de vouloir supprimer la demande no: <b>".$_REQUEST['ID']."</b> ?<br />
         \n<input type=\"radio\" name=\"choix\" value=\"oui\" id=\"oui\" /> <label for=\"oui\">Oui</label><br />
         \n<input type=\"radio\" name=\"choix\" value=\"non\" id=\"non\" /> <label for=\"non\">Non</label><br />
         \n<input type=\"submit\" value=\"Envoyer\">
         <input readonly name=\"ID\" type=\"hidden\" value=\"".$_REQUEST['ID']."\"><br>
      </p>
      <br/><br/><br/><br/><br/>
      </form>";

  return $main;
 }


 function supprimer_demande_db()
 {

  //R�cup�rer le num�ro de conexion � la db
  global $lien;
  if($_REQUEST['choix']=="oui"){
  //Formuler la requ�te pour ajouter un item dans table des demandes
  $requete= "DELETE FROM tbldemandes WHERE ID=".$_REQUEST[ID];

  // Transmettre la requete au serveur mysql
  $reponse = mysql_db_query("lacha815",$requete,$lien);
  // v�rifier si une erreur est survenue
  if(($message=mysql_error($lien))!="")
      // Retourner un message d'erreur d'inscription
      $main = "<b><font color=#ff0000>$message</font>";
      //Sinon
      else
      // Retourner un message que l'op�ration est compl�t�s
        $main = "<b><font color=#00ff00>Element supprime</font>";
     }
          else{
            //Retourner un message que l'opération est annulée
            $main = "<b><font color=#ff0000>Opération annulée</font>";
        }
      // Retourner un message que l'op�ration est compl�t�s
return $main;


 }
?>
