<?php
// Incluir o cabeçalho
require_once "../conexao.php";

$arquivo = $_SERVER['PHP_SELF'];

function cadastrar_categoria($nome, $tipo, $categoria_pai, $descricao, $status, $id_usuario)
{
    global $conn;
    global $arquivo;

    $stmt = $conn->prepare("SELECT nome FROM CATEGORIA WHERE nome = ? AND Tipo = ?");
    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $nome, $tipo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt->close();
        header("Location: categorias.php?result=existente");
        exit;
    }

    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO CATEGORIA (Nome, Tipo, Descricao, Ativa, ID_CategoriaPai, ID_Usuario) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    $stmt->bind_param("ssssii", $nome, $tipo, $descricao, $status, $categoria_pai, $id_usuario);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: categorias.php?result=sucesso");
    } else {
        $stmt->close();
        header("Location: categorias.php?result=erro");
    }
    exit;
}

function exibir_categorias_form()
{
    global $conn;

    $categorias = [];
    $query = "SELECT ID_Categoria, Nome, Tipo FROM CATEGORIA ORDER BY Nome ASC";

    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $categorias[] = [
                'id' => $row['ID_Categoria'],
                'nome' => $row['Nome'],
                'tipo' => $row['Tipo']
            ];
        }
    }

    return $categorias; // Retorna o array de categorias\   
}

function exibir_categoria($tipo)
{
    global $conn;

    // Definindo tipo = 0 para despesas por padrão
    $sql = "SELECT ID_Categoria, Nome, Tipo, ID_CategoriaPai FROM CATEGORIA WHERE Ativa = 1 AND Tipo = ? AND ID_CategoriaPai IS NULL ORDER BY ID_Categoria DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tipo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        // Exibir categorias principais
        while ($categoria = $result->fetch_assoc()) {
            echo '<div class="list-group-item category-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="category-name">' . $categoria['Nome'] . '</span>
                            <div class="subcategories">
                                <span class="badge badge-light mr-1">Mercado</span>
                                <span class="badge badge-light mr-1">Restaurantes</span>
                                <span class="badge badge-light">Delivery</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <button class="btn btn-sm btn-link edit-category" data-id="5">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-link text-danger delete-category" data-id="5">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>';
        }

    } else {
        echo '<div class="list-group-item category-item">
                  <div class="d-flex justify-content-between align-items-center">
                      <div>
                            <span class="category-name">Nenhuma categoria cadastrada!</span>
                      </div>
                  </div>
              </div>';
    }

    $stmt->close();
}

// Função auxiliar para obter HTML das subcategorias
function obter_subcategorias($id_pai)
{
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