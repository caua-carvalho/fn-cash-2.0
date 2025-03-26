<?php
// Incluir o cabeçalho
include_once 'header.php';
require_once "../conexao.php";

$arquivo = $_SERVER['PHP_SELF'];

function cadastrar_categoria($nome, $tipo, $categoria_pai, $descricao, $status, $id_usuario){
    global $conn;
    global $arquivo;

    $stmt = $conn->prepare("SELECT nome FROM CATEGORIA WHERE nome = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        return "categoria_ja_cadastrada";
    } else {
        $stmt = $conn->prepare("INSERT INTO CATEGORIA (Nome, Tipo, Descricao, Ativa, ID_CategoriaPai, ID_Usuario) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissii", $nome, $tipo, $descricao, $status, $categoria_pai, $id_usuario);  
        
        if($stmt->execute()) {
            return "SUCESSO";
        } else {
            return "ERRO";
        }   

        $stmt->close();
        header("Location: categorias.php");
    }
}

function exibir_categoria($tipo = null) {
    global $conn;
    
    $sql = "SELECT ID, Nome, Tipo, ID_CategoriaPai FROM CATEGORIA WHERE Ativa = 1";
    
    // Filtrar por tipo se especificado (0 = despesa, 1 = receita)
    if ($tipo !== null) {
        $sql .= " AND Tipo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $tipo);
    } else {
        $stmt = $conn->prepare($sql);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $categorias = [];
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
    
    return $categorias;
}
?>