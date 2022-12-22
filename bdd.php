<?php
    require_once 'access.php';                              // Necessite du script de connexion à la bdd
    
    try {
        $cnx->exec('DROP TABLE IF EXISTS pays');            // Supprime systematiquement la table
                                                            // pour éviter la duplication de clé primaire
        $cnx->exec("CREATE TABLE IF NOT EXISTS pays (id BIGINT PRIMARY KEY, 
                                                    nom VARCHAR(100), 
                                                    iso VARCHAR(40), 
                                                    image LONGBLOB)");
        if ($file = fopen("pays.csv", "r")) {               // Si (fopen) ouverture du fichier en Lecture
            while ($line = fgets($file)) {                  // Tant qu'on récupère une ligne 
                $tab = explode(",", trim($line));           //(explode) scinde une chaine de caractère en segment
                $flag = 'drapeau/' . $tab[2] . '.svg';      // nom du fichier du drapeau avec son extension
                if (file_exists($flag)) {                   // si le fichier existe
                    $img = file_get_contents($flag);        // on insère dans la colonne image le fichier
                } else {                                    // sinon
                    $img = '';                              // on laisse une chaine vide
                }
                $int = sprintf(                                 // $int retourne une chaîne formaté
                    "INSERT INTO pays VALUES (%d,%s,%s,%s)",    // insère dans la table pays avec comme valeur
                    $tab[0],                                    // index qui est un entier décimal
                    $cnx->quote($tab[1]),                       // un nom en chaîne de caractères
                    $cnx->quote($tab[2]),                       // un code iso chaîne de caractères
                    $cnx->quote($img)                           // une image qui est un chaîne de caractères
                );
               // if (empty($img)) echo $int."<br/>\n";
                $cnx->exec($int);                               // connexion puis execution de la requête
                
            }
            fclose($file);                                      // Ferme le fichier
            //echo "<p>la base est correctement remplie </p>\n";
        }
    } catch (exception $myexep) {                               // En cas d'erreur, on l'intercepte
        echo "erreur:", $myexep->getMessage();                  // Affiche un message d'érreur
    }