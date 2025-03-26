<?php
// Incluir o cabeçalho
include_once 'header.php';
require_once "../conexao.php";

function cadastrar_categoria($nome, $tipo, $categoria_pai, $descricao, $status, $id_usuario){
    global $conn;  // Certifique-se de que $conn está definido e é uma conexão válida

    $stmt = $conn->prepare("SELECT nome FROM CATEGORIA WHERE nome = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){  // Use $result->num_rows em vez de $categoria->num_rows
        return "categoria ja cadastrada";
    } else {
        $stmt = $conn->prepare("INSERT INTO CATEGORIA (Nome, Tipo, Descricao, Ativa, ID_CategoriaPai, ID_Usuario) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissii", $nome, $tipo, $descricao, $status, $categoria_pai, $id_usuario);  // Corrigido para 6 parâmetros
        
        if($stmt->execute()) {
            return "SUCESSO";
        } else {
            return "ERRO";
        }   

        $stmt->close();
        header("Location: categorias.php");
    }
}

?>