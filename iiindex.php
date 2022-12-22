<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <!--      <style>
         table {
             border: medium solid #000000;
             width: 50%;
         }

         td,
         th {
             border: thin solid #6495ed;
             width: 50%;
         }
     </style> -->
</head>

<body>
    <form action="#" method="post">
        <label>Id du pays: <input type="text" name="id" /></label><br/>
        <label>Entrer le nom du pays: <input type="text" name="nom" /></label><br/>
        <label>Entrer le code pays: <input type="text" name="iso" /></label><br/>

        <input type="submit">
        <button><a href='index.php'>voir tout le tableau</a></button><br/>
    </form>

    <?php

    require_once('access.php');

    try {

        
        if (!empty($_REQUEST['nom'])) {
            $nompays = $_REQUEST['nom'];
            $dem = sprintf("SELECT * FROM pays WHERE nom = %s", $cnx->quote($nompays));
        } else if (!empty($_REQUEST['iso'])) {
            $isoPays = $_REQUEST['iso'];
            $dem = sprintf("SELECT * FROM pays WHERE iso = %s", $cnx->quote($isoPays));
        } else if (!empty($_REQUEST['id'])) {
            $idPays = $_REQUEST['id'];
            $dem = sprintf("SELECT * FROM pays WHERE id = %s", $cnx->quote($idPays));
        }

        if (isset($dem)) {
            $res = $cnx->query($dem);

            while ($row = $res->fetch(PDO::FETCH_ASSOC)) { ?>
                <table>
                    <?php
                    foreach ($row as $key => $val) {
                        if ($key == "id") {
                            $ida = $val;
                        } else {
                        }
                        if ($key == 'image' && $val != "") {
                            echo "<tr><td>$key</td>\n<td><img src='image3simple.php?id=$ida'</td>\n</tr>";
                        } elseif ($key == 'image') {
                            echo "<tr><td>$key</td><td><img src='image3simple.php?id=30'></td></tr>";
                        }
                        if ($key != 'image') {
                            echo "<tr><td>$key</td>\n<td>$val</td>\n</tr>";
                        }
                    }

                    ?>
                </table>
    <?php
            }
        }
    } catch (PDOException $exp) {
        echo $exp->getMessage();
    }
    ?>
</body>

</html>