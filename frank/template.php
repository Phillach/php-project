<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="fr">
<head>
    
    <title>Interface web</title>
        
    <script language="javascript" src="script.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css">

</head>

<body>
   <div id="page">
	<!--Section pour l'affichage de la banniere-->
	<div id="banniere"><?php echo $banniere ?></div>

	<!--Section pour l'affichage du menu avec la couleur-->

	<div class="<?php echo $_SESSION['cboCouleur'] ?>">
	
			<div id="slatenav">
				
				<?php echo $menu ?>
	   
			</div>
			
			<div id="logbox">
				<?php echo $logbox ?>
			</div>
	</div>
   
   

        
        <!--Section pour l'affichage de la rubrique sélectionnée-->
        <div class="main">

            <!--Titre de la rubrique-->
            
            <h3><?php echo $titre ?></h3>
            <hr>

            <!--Zone principale d'affichage-->

            <?php echo $main ?>
 
        </div>
    </div>

        
</body>
</html>
