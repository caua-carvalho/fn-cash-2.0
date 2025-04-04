<?php
require ".../conexao.php";
require "./dialog.php";

function($id_usuario, $descricao, $titlo, $valor, $data, $data_registro, $tipo, $status, $id_conta, $id_categoria, $id_conta_destino){
    global $conn;
    
    #VERIFICAÇÃO SE JÁ EXISTE UM TRANSACAO IGUAL CADASTRADA
    $stmt = $conn->prepare("SELECT Titulo, ID_Categoria FROM TRANSACAO WHERE Titulo = ? AND ID_Categoria = ?");
    if(!$stmt) {
        Erro("Erro ao preparar consulta!");
    }

    $stmt->bind_param("ss", $titulo, $id_categoria);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt->close();
        Error("Transação já cadastrada!");
    }

    $stmt->close();

    #INSERT DA TRANSACAO
    $stmt = $conn->prepare("INSERT INTO TRANSACAO (Titulo, Descricao, Valor, Data, DataRegistro, Tipo, Status, ID_Conta, ID_Categoria, ID_ContaDestino) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
    $stmt->bind_param("ssdssssiii");

    if($stmt->execute()) {
        $stmt-close();
        Confirma("Transação cadastrada com sucesso!");
    } else {
        $stmt->close();
        Erro("Erro ao cadastrar transação!");
    }
    exit;
}   

?>