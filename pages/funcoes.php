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
            header("Location: categorias.php");
        } else {
            return "ERRO";
            header("Location: categorias.php");
        }   

        $stmt->close();
        header("Location: categorias.php");
    }
}

function exibir_categoria($tipo) {
    global $conn;
    
    // Definindo tipo = 0 para despesas por padrão
    $sql = "SELECT ID_Categoria, Nome, Tipo, ID_CategoriaPai FROM CATEGORIA WHERE Ativa = 1 AND Tipo = ? AND ID_CategoriaPai IS NULL ORDER BY Nome";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tipo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $html = "";
    if ($result->num_rows > 0) {
        
        // Exibir categorias principais
        while ($categoria = $result->fetch_assoc()) {
           echo '<div class="list-group-item category-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="category-name">' . $categoria["Nome"] . '</span>
                            <div class="subcategories">
                                <span class="badge badge-light mr-1">Aluguel</span>
                                <span class="badge badge-light mr-1">Contas</span>
                                <span class="badge badge-light">Manutenção</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <button class="btn btn-sm btn-link edit-category" data-id="6">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-link text-danger delete-category" data-id="6">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>';
            
            // Buscar e exibir subcategorias
            $html .= obter_subcategorias($categoria['ID_Categoria']);
            
            $html .= "</div>";
        }
        
        $html .= "</div>";
    } else {
        $html .= "<p>Nenhuma despesa cadastrada.</p>";
    }
    
    $stmt->close();
    
    echo $html;
}

// Função auxiliar para obter HTML das subcategorias
function obter_subcategorias($id_pai) {
    global $conn;
    
    $sql = "SELECT ID_categoria, Nome FROM CATEGORIA WHERE Ativa = 1 AND ID_CategoriaPai = ? ORDER BY Nome";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pai);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $html = '';
    
    if ($result->num_rows > 0) {
        $html .= "<div class='subcategorias-container ms-4 mt-2'>";
        
        while ($subcategoria = $result->fetch_assoc()) {
            $html .= "<div class='subcategoria-item d-flex justify-content-between align-items-center mb-1'>
                <div>
                    <i class='bi bi-dash'></i> " . htmlspecialchars($subcategoria['Nome']) . "
                </div>
                <div>
                    <button class='btn btn-sm btn-link edit-category' data-id='" . $subcategoria['ID'] . "'>
                        <i class='bi bi-pencil'></i>
                    </button>
                    <button class='btn btn-sm btn-link text-danger delete-category' data-id='" . $subcategoria['ID'] . "'>
                        <i class='bi bi-trash'></i>
                    </button>
                </div>
            </div>";
        }
        
        $html .= "</div>";
    }
    
    $stmt->close();
    
    return $html;
}

// Exemplo de uso:
// exibir_categoria(); // Vai exibir todas as despesas (tipo = 0)

?>