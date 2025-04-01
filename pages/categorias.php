<?php

// Incluir o cabeçalho
require_once "../conexao.php";
require_once "validacao_login.php";
require_once "funcoes.php";


// CADASTRO DE CATEGORIA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    cadastrar_categoria( $_POST['nome'],
                        $_POST['tipo'],
                        !empty($_POST['categoria_pai']) ? $_POST['categoria_pai'] : null,
                        $_POST['descricao'],
                        isset($_POST['status']),
                        $_SESSION['id']);
}

require_once 'head.php';
require_once "modal.php";
?>

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
        
        <!-- Somente Despesas -->
        <div class="tab-pane fade" id="expense" role="tabpanel" aria-labelledby="expense-tab">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-arrow-down-circle text-expense"></i> Categorias de Despesas
                    </h5>
                    <button class="btn btn-sm btn-outline-primary" id="add-expense-category-tab">
                        <i class="bi bi-plus"></i> Nova Categoria
                    </button>
                </div>
                <div class="card-body p-0">
                    <!-- Visualização Hierárquica -->
                    <div class="category-tree p-3">
                        <ul class="list-unstyled">
                            <!-- Alimentação -->
                            <li class="category-tree-item mb-3">
                                <?php exibir_categoria("Despesa"); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Somente Receitas -->
        <div class="tab-pane fade" id="income" role="tabpanel" aria-labelledby="income-tab">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-arrow-up-circle text-income"></i> Categorias de Receitas
                    </h5>
                    <button class="btn btn-sm btn-outline-primary" id="add-income-category-tab">
                        <i class="bi bi-plus"></i> Nova Categoria
                    </button>
                </div>
                <div class="card-body p-0">
                    <!-- Visualização Hierárquica -->
                    <div class="category-tree p-3">
                        <ul class="list-unstyled">
                            <!-- Salário -->
                            <?php exibir_categoria("Receita"); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Categoria -->
<?php Modal_categoria(); ?>

<!-- Script específico para a página -->
<script src="../JavaScript/categorias.js"></script>

<?php
// Incluir o rodapé
include_once '../footer.php';
?>