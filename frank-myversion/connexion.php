<?php

$DB_SERVER="localhost";                         // Adresse du serveur DB
$DB_LOGIN="root";                               // Nom d'usager pour la connexion DB
$DB_PASSWORD="";                                // Mot de passe db
$DB="tbllacha";                               // Nom de la db
$HTTP_HOST="localhost";                         // Adresse du serveur Web
$DOCROOT="/opt/lampp/htdocs/test/infoshop";     // Dossier racine de l'application






// Si une erreur de connexion alors
if(!($lien=mysql_pconnect($DB_SERVER,$DB_LOGIN,$DB_PASSWORD))){
// Affiche l'erreur avec le num�ro
echo "Erreur interne :\n".mysql_errno()."<br>".mysql_error();
// Terminer le script
exit();
}
// Si non
else
{
// S�lectionner la base de donn�es
mysql_selectdb($DB,$lien);
}
// Initialiser un message de connexion r�ussie
$message="<font size=-2 color=#cc0000>Overture r�ussie...</font>";
?>
