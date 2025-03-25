<?php
// Incluir o cabeçalho
include_once 'header.php';
require_once "funcoes.php";


function cadastrar_categoia($nome, $tipo, $categoria_pai, $descricao, $status, $id_usuario){
    $stmt = $conn->prepare("SELECT nome FROM CATEGORIA WHERE nome = ?");
    $stmt->bind_param("ssisssi", $nome);
    $stmt->execute();
    $stmt->store_result();

    if($resultado->num_rows > 0){
        return "categoria ja cadastrada";
    } else {
        $stmt = $conn->prepare("INSERT INTO CATEGORIA (Nome, Tipo, Descricao, Ativa, ID_CategoriaPai, ID_Usuario) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sss", $nome, $tipo, $descricao, $status, $categoria_pai, $id_usuario);
        

        if($stmt->execute()) {
            return "SUCESSO";
        } else {
            return "ERRO";
        }
    }
}

// CADASTRO DE CATEGORIA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recuperar os dados do formulário
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $categoria_pai = !empty($_POST['categoria_pai']) ? $_POST['categoria_pai'] : null;
    $descricao = $_POST['descricao'];
    $status = isset($_POST['status']);
    $id_usuario = $_SESSION['id_usuario']; // Assumindo que o ID do usuário está na sessão
    
    // Chamar a função de cadastro
    $resultado = cadastro_categoria($nome, $tipo, $categoria_pai, $descricao, $status, $id_usuario);
    
    // Exibir mensagem de sucesso ou erro (você pode adicionar um sistema de notificação aqui)
    if (strpos($resultado, 'Sucesso') !== false) {
        $_SESSION['mensagem'] = $resultado;
        $_SESSION['tipo_mensagem'] = 'success';
    } else {
        $_SESSION['mensagem'] = $resultado;
        $_SESSION['tipo_mensagem'] = 'danger';
    }
    
    // Redirecionar para atualizar a página e evitar reenvio do formulário
    header("Location: categorias.php");
    exit;
}
?>