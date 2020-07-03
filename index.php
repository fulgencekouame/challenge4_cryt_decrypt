<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>challenge4</title>
</head>
<body>
    <!-- <a href="truelove.php"><button>TRUELOVE</button></a>
    <a href="ivoiredating.php"><button>IVOIREDATING</button></a> -->

<!-- Formulaire des deux boutons qui actionnent le processus de décryptage des numéros des cartes -->
    <form action="" method="post">
       <div class = bouton>
        <input type="submit" value="DECRYPTAGE TRUELOVE" name="decryptage"><br><br>
        <input type="submit" value="CRYPTAGE TRUELOVE" name="cryptage"><br><br>
        <input type="submit" value="DECRYPTAGE IVOIREDATING" name="decryptageiv"><br><br>
        <input type="submit" value="CRYPTAGE IVOIREDATING" name="cryptageiv"><br><br>
       </div>
    </form>
    <style>
        body{
            text-align: center;
           }
        
    </style>

<?php 
//Script de décryptage des numéros de carte bancaire du site TRUELOVE
    include "config/connexion.php";

    if (isset($_POST['decryptage'])) //Si le bouton est cliqué
    {
        //Requete de selection des éléments de la table USERCC
        $query = mysqli_query($conn, "SELECT * FROM usercc ");

        //Boucle pour parcourir et récupérer les éléments de la table USERCC
       while($card = mysqli_fetch_array($query))
        
        { 
            //Déclaration de deux tableaux afin de stocker les elements qui serviront au décryptage
            $leter = array("X", "Y", "Z");
            $num = array("5", "3", "4");
            
            //Fonction de remplacement des lettres par les chiffre (le décryptage)
            $decript=str_replace($leter, $num, $card['cnumber']); 

            //Recuperation de l'identifiant de chaque enregistrement du tableau
            $id=$card['id'];

            //Requete de mise à jour de chaque numéro de carte de la colonne 'cnumber'
            mysqli_query($conn, "UPDATE usercc SET cnumber='$decript' WHERE id='$id'"); 

            //Affichage des numéros des cartes pour vérification
            echo ($decript);
            echo '<br>';
        }
            
    } 

?>


<?php 
//Script de cryptage des numéros de carte bancaire du site TRUELOVE
    

    if (isset($_POST['cryptage'])) //Si le bouton est cliqué
    {
        //Requete de selection des éléments de la table USERCC
        $query = mysqli_query($conn, "SELECT * FROM usercc ");

        //Boucle pour parcourir et récupérer les éléments de la table USERCC
       while($card = mysqli_fetch_array($query))
        
        { 
            //Déclaration de deux tableaux afin de stocker les elements qui serviront au cryptage
           
            $num = array("5", "3", "4");
            $leter = array("X", "Y", "Z");
            
            //Fonction de remplacement des lettres par les chiffre (le décryptage)
            $cript=str_replace($num, $leter, $card['cnumber']); 

            //Recuperation de l'identifiant de chaque enregistrement du tableau
            $id=$card['id'];

            //Requete de mise à jour de chaque numéro de carte de la colonne 'cnumber'
            mysqli_query($conn, "UPDATE usercc SET cnumber='$cript' WHERE id='$id'"); 

            //Affichage des numéros des cartes pour vérification
            echo ($cript);
            echo '<br>';
        }
            
    } 

?>

    <?php 
    //Script de décryptage des numéros de carte bancaire du site IVOIREDATING
    if (isset($_POST['decryptageiv'])) //Si le bouton est cliqué
    {
        //Requete de selection des éléments de la table 'userccbilling'
        $req = mysqli_query($conn, "SELECT * FROM userccbilling");

        //Boucle pour parcourir et récupérer les éléments de la table 'userccbilling'
        while($cardiv = mysqli_fetch_array($req))
        {
            //Conditions de décryptage (remplacement de la F par le chiffre selon le type de la carte bancaire)
            if ($cardiv['type']=='M') {
                $decrypt=str_replace('F', '5', $cardiv['cnumber']);
            }
            elseif ($cardiv['type']=='A') {
                $decrypt=str_replace('F', '3', $cardiv['cnumber']);
            }
            elseif ($cardiv['type']=='V') {
                $decrypt=str_replace('F', '4', $cardiv['cnumber']);
            }

            //Recuperation de l'identifiant de chaque enregistrement du tableau
            $code=$cardiv['id'];

            //Requete de mise à jour de chaque numéro de carte de la colonne 'cnumber'
            mysqli_query($conn, "UPDATE userccbilling SET cnumber='$decrypt' WHERE id='$code'");

            //Affichage des numéros des cartes pour vérification
            echo ($decrypt);
            echo '<br>';
        }
    }
    
    ?>

<?php 
    //Script de cryptage des numéros de carte bancaire du site IVOIREDATING
    if (isset($_POST['cryptageiv'])) //Si le bouton est cliqué
    {
        //Requete de selection des éléments de la table 'userccbilling'
        $req = mysqli_query($conn, "SELECT * FROM userccbilling");

        //Boucle pour parcourir et récupérer les éléments de la table 'userccbilling'
        while($cardiv = mysqli_fetch_array($req))
        {
            //Conditions de cryptage (remplacement de la F par le chiffre selon le type de la carte bancaire)
            if ($cardiv['type']=='M') {
                $crypt=str_replace('5','F',  $cardiv['cnumber']);
            }
            elseif ($cardiv['type']=='A') {
                $crypt=str_replace('3','F', $cardiv['cnumber']);
            }
            elseif ($cardiv['type']=='V') {
                $crypt=str_replace('4','F', $cardiv['cnumber']);
            }

            //Recuperation de l'identifiant de chaque enregistrement du tableau
            $code=$cardiv['id'];

            //Requete de mise à jour de chaque numéro de carte de la colonne 'cnumber'
            mysqli_query($conn, "UPDATE userccbilling SET cnumber='$crypt' WHERE id='$code'");

            //Affichage des numéros des cartes pour vérification
            echo ($crypt);
            echo '<br>';
        }
    }
    
    ?>
    
</body>
</html>