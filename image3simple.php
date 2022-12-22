<?php
header('Content-type: image/svg+xml');
require_once 'access.php';
$requ=sprintf('SELECT image FROM pays WHERE id=%d', $_GET['id']??30);
$stmt=$cnx->query($requ);
$res=$stmt->fetch();
echo $res[0];

// VALIDER !