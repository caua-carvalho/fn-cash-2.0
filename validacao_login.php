<?php
session_start();

if(isset($_SESSION['id'])){
    header('Location: index.php');
    exit();
}else{
    header('Location: pages/transacoes.php');
    exit;
}
?>