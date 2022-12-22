<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>liste pays</title>
   <link rel="stylesheet" href="styles.css">
</head>

<body>
   <?php
   require_once 'access.php';
   require_once 'bdd.php';

   /*    //fonction formulaire
 */

   ?>
   <div class="parent">
      <div class="div1">
         <!--choi du pays-->
         <?php $res = $cnx->query("SELECT * FROM pays");
         if (!isset($_POST['nom'])) {
            echo "<form method='post'>";
            echo "<label>envoyer une valeur:";
            echo "<select name='nom'>";
            echo "<option selected value='nullnom'>selection pays</option>";
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
               foreach ($row as $k => $val) {
                  if ($k == "nom") {
                     $pays = $val;
                  }
                  if ($k == "iso") {
                     echo "<option name='$pays' value='$val'> $pays</option> <br/>\n";
                  } else {
                  }
               }
            }
            echo "</select></label><br/>\n";
         }
         /*          choi de l'iso*/
         $is = $cnx->query("SELECT iso FROM pays");
         if (!isset($_POST['code'])) {
            echo "<label>";
            echo "<select name='code'>";
            echo "<option selected value='nulliso'>selection iso</option>";
            while ($row = $is->fetch(PDO::FETCH_ASSOC)) {
               foreach ($row as $v => $val) {
                  echo "<option name=$val value='$val'> $val</option> <br/>\n";
               }
            }
            echo "</select></label><br/>\n";
         }
         /*          choi de l'id*/
         $is = $cnx->query("SELECT * FROM pays");
         if (!isset($_POST['id'])) {
            echo "<label>";
            echo "<select name='id'>";
            echo "<option selected value='null'>selection id</option>";
            while ($row = $is->fetch(PDO::FETCH_ASSOC)) {
               foreach ($row as $k => $val) {
                  if ($k == "id") {
                     $id = $val;
                  }
                  if ($k == "iso") {
                     echo "<option name='$val' value='$val'> $id</option> <br/>\n";
                  } else {
                  }
               }
            }
            echo "</select></label>\n";
         }

         /*             //verification des qu'elle imput et ajoue dans la variable idi
 */
         if (!isset($_POST['submit']))
            echo "<input type='submit' name='submit' value='envoyer'>";
         echo "</form>";
         if (@$_POST['nom'] != "nullnom") {
            $idi = @$_POST['nom'];
         } elseif ($_POST['code'] != "nulliso") {
            $idi = $_POST['code'];
         } else $idi = $_POST['id'];
         ?>
         <nav>
            <a href="#<?php echo $idi; ?>"><?php if ($idi) {
                                                echo "<button>afficher mon pays</button>";
                                             } ?></a><br />
            <a href="http://localhost/php/PROJET/index.php"><?php if ($idi) {
                                                                     echo "<button>reset</button>";
                                                                  } ?></a>
         </nav>
         <!--       creation du tableau-->
         <button><a href="iiindex.php"> retour a la pages d'accueil</a></button>
      </div>
<!--       <div class="div1">
         <h1>Contenu de la table produits:</h1>
      </div> -->
      <div class="div2">
         <?php
         $res = $cnx->query("SELECT * FROM pays");
         if ($res != false) {
            echo "<table>\n";
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
               next($row);
               next($row);
               $idi = current($row);
               echo "<tr id=$idi>\n";
               reset($row);
               foreach ($row as $k => $v) {
                  if ($k == "id") {
                     $ida = $v;
                  }else{}
                  if ($k == 'image' && $v !="") {
                     echo "<td><img src='image3simple.php?id=". $ida ."'></td>";
                  } 
                   elseif ($k == 'image'){
                     echo "<td><img src='image3simple.php?id=30'></td>";
                  }
                  if ($k!='image')
                   {
                     echo "<td>" . $v . "</td>";
                  }
               }
               echo "</tr>\n";
            }
            echo "</table>";
         }
         ?></div>
   </div>