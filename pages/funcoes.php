<?php
// Incluir o cabeçalho
include_once 'header.php';
require_once "funcoes.php";


function cadastrar_categoia($nome, $tipo, $categoria_pai, $descricao, $status, $id_usuario){
    global $conn;

    $stmt = $conn->prepare("SELECT nome FROM CATEGORIA WHERE nome = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $stmt->store_result();

    if($resultado->num_rows > 0){
        return "categoria ja cadastrada";
    } else {
        $stmt = $conn->prepare("INSERT INTO CATEGORIA (Nome, Tipo, Descricao, Ativa, ID_CategoriaPai, ID_Usuario) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssi", $nome, $tipo, $descricao, $status, $categoria_pai, $id_usuario);
        

        if($stmt->execute()) {
            return "SUCESSO";
        } else {
            return "ERRO";
        }
    }
}

?>