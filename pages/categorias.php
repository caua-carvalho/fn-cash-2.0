<?php

// Incluir o cabeçalho
require_once "../conexao.php";
require_once "validacao_login.php";
require_once "funcoes.php";


// CADASTRO DE CATEGORIA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['form_id'])) {
        switch ($_POST['form_id']) {
            case 'edit':
                $id_categoria = $_POST['id_categoria'];
                $nome = $_POST['nome'];
                $tipo = $_POST['tipo'];
                $descricao = $_POST['descricao'];
                $status = isset($_POST['status']) ? 1 : 0;
                $categoria_pai = !empty($_POST['categoria_pai']) ? $_POST['categoria_pai'] : null;

                editar_categoria($id_categoria, $nome, $tipo, $descricao, $status, $categoria_pai);
                break;

            case 'criar':
                $nome = $_POST['nome'];
                $tipo = $_POST['tipo'];
                $categoria_pai = !empty($_POST['categoria_pai']) ? $_POST['categoria_pai'] : null;
                $descricao = $_POST['descricao'];
                $status = isset($_POST['status']) ? 1 : 0;
                $id_usuario = $_SESSION['id'];

                cadastrar_categoria($nome, $tipo, $categoria_pai, $descricao, $status, $id_usuario);
                break;
                
            // case 'delete':
            //     $id_categoria = $_POST['id_categoria'];

            //     excluir_categoria($id_categoria);
            //     break;
        }
            
    } else {
        echo "<script>alert('Erro: Formulário não encontrado.');</script>";
    }
}

require_once 'head.php';
require_once "modal.php";
?>
<h1 style="color: red;">ABA DE DESPESA/RECEITA NAO ESTA FUNCIONANDO!</h1>
<!-- Conteúdo da Página de Categorias -->
<div id="categorias-page">
    <!-- Cabeçalho da Página -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Categorias</h2>
            <p class="text-muted">Organize suas receitas e despesas em categorias</p>
        </div>
        <div class="d-flex">
            <button id="new-category-btn" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> <span class="d-none d-md-inline">Nova Categoria</span>
            </button>
        </div>
    </div>
    
    <!-- Abas para Tipos de Categorias -->
    <ul class="nav nav-tabs mb-4" id="categoriesTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">
                Todas
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="expense-tab" data-toggle="tab" href="#expense" role="tab" aria-controls="expense" aria-selected="false">
                <i class="bi bi-arrow-down-circle text-expense"></i> Despesas
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="income-tab" data-toggle="tab" href="#income" role="tab" aria-controls="income" aria-selected="false">
                <i class="bi bi-arrow-up-circle text-income"></i> Receitas
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="disabled-tab" data-toggle="tab" href="#disabled" role="tab" aria-controls="disabled" aria-selected="false">
                <i class="bi bi-slash-circle text-secondary"></i> Desativadas
            </a>
        </li>
    </ul>
    
    <!-- Conteúdo das Abas -->
    <div class="tab-content" id="categoriesTabContent">
        <!-- Todas as Categorias -->
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="row">
                <!-- Categorias de Despesas -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-arrow-down-circle text-expense"></i> Despesas
                            </h5>
                            <button class="btn btn-sm btn-outline-primary" id="add-expense-category">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <!-- Categorias carregadas via funcao -->
                            <?php exibir_categoria("Despesa"); ?>
                        </div>
                    </div>
                </div>
                
                <!-- Categorias de Receitas -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-arrow-up-circle text-income"></i> Receitas
                            </h5>
                            <button class="btn btn-sm btn-outline-primary" id="add-income-category">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <?php exibir_categoria("Receita"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Categorias Desativadas -->
        <div class="tab-pane fade" id="disabled" role="tabpanel" aria-labelledby="disabled-tab">
            <div class="row">
                <!-- Categorias de Despesas Desativadas -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-arrow-down-circle text-expense"></i> Despesas Desativadas
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <?php exibir_categoria_desativada("Despesa"); ?>
                        </div>
                    </div>
                </div>
                
                <!-- Categorias de Receitas Desativadas -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-arrow-up-circle text-income"></i> Receitas Desativadas
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <?php exibir_categoria_desativada("Receita"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script específico para a página -->
<script src="../JavaScript/categorias.js"></script>

<?php
// Incluir o rodapé
include_once '../footer.php';
?>