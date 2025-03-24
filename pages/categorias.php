<?php
/**
 * FN-CASH - Sistema de Controle Financeiro Pessoal
 * Página de Categorias
 */

// Incluir o cabeçalho
include_once '../header.php';

// CADASTRO DE CATEGORIA

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
                            <div class="list-group list-group-flush category-list" id="expense-categories">
                                <!-- Categorias carregadas via JavaScript -->
                                <div class="list-group-item category-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="category-name">Alimentação</span>
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
                                </div>
                                <div class="list-group-item category-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="category-name">Moradia</span>
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
                                </div>
                                <div class="list-group-item category-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="category-name">Transporte</span>
                                            <div class="subcategories">
                                                <span class="badge badge-light mr-1">Combustível</span>
                                                <span class="badge badge-light">Transporte Público</span>
                                            </div>
                                        </div>
                                        <div class="category-actions">
                                            <button class="btn btn-sm btn-link edit-category" data-id="7">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-link text-danger delete-category" data-id="7">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item category-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="category-name">Saúde</span>
                                            <div class="subcategories">
                                                <span class="badge badge-light mr-1">Médicos</span>
                                                <span class="badge badge-light">Medicamentos</span>
                                            </div>
                                        </div>
                                        <div class="category-actions">
                                            <button class="btn btn-sm btn-link edit-category" data-id="8">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-link text-danger delete-category" data-id="8">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            <div class="list-group list-group-flush category-list" id="income-categories">
                                <!-- Categorias carregadas via JavaScript -->
                                <div class="list-group-item category-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="category-name">Salário</span>
                                            <div class="subcategories">
                                                <span class="badge badge-light mr-1">CLT</span>
                                                <span class="badge badge-light">Bônus</span>
                                            </div>
                                        </div>
                                        <div class="category-actions">
                                            <button class="btn btn-sm btn-link edit-category" data-id="1">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-link text-danger delete-category" data-id="1">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item category-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="category-name">Investimentos</span>
                                            <div class="subcategories">
                                                <span class="badge badge-light mr-1">Dividendos</span>
                                                <span class="badge badge-light">Juros</span>
                                            </div>
                                        </div>
                                        <div class="category-actions">
                                            <button class="btn btn-sm btn-link edit-category" data-id="2">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-link text-danger delete-category" data-id="2">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item category-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="category-name">Freelance</span>
                                            <span class="badge badge-secondary ml-2">Sem subcategorias</span>
                                        </div>
                                        <div class="category-actions">
                                            <button class="btn btn-sm btn-link edit-category" data-id="3">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-link text-danger delete-category" data-id="3">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-caret-down-fill"></i>
                                        <strong>Alimentação</strong>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary add-subcategory" data-id="5">
                                            <i class="bi bi-plus-circle"></i> Subcategoria
                                        </button>
                                        <button class="btn btn-sm btn-link edit-category" data-id="5">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger delete-category" data-id="5">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <ul class="list-unstyled ml-4 mt-2">
                                    <li class="subcategory-item">
                                        <div class="d-flex justify-content-between align-items-center py-1">
                                            <span>Mercado</span>
                                            <div>
                                                <button class="btn btn-sm btn-link edit-category" data-id="51">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link text-danger delete-category" data-id="51">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="subcategory-item">
                                        <div class="d-flex justify-content-between align-items-center py-1">
                                            <span>Restaurantes</span>
                                            <div>
                                                <button class="btn btn-sm btn-link edit-category" data-id="52">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link text-danger delete-category" data-id="52">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="subcategory-item">
                                        <div class="d-flex justify-content-between align-items-center py-1">
                                            <span>Delivery</span>
                                            <div>
                                                <button class="btn btn-sm btn-link edit-category" data-id="53">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link text-danger delete-category" data-id="53">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- Moradia -->
                            <li class="category-tree-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-caret-down-fill"></i>
                                        <strong>Moradia</strong>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary add-subcategory" data-id="6">
                                            <i class="bi bi-plus-circle"></i> Subcategoria
                                        </button>
                                        <button class="btn btn-sm btn-link edit-category" data-id="6">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger delete-category" data-id="6">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <ul class="list-unstyled ml-4 mt-2">
                                    <li class="subcategory-item">
                                        <div class="d-flex justify-content-between align-items-center py-1">
                                            <span>Aluguel</span>
                                            <div>
                                                <button class="btn btn-sm btn-link edit-category" data-id="61">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link text-danger delete-category" data-id="61">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="subcategory-item">
                                        <div class="d-flex justify-content-between align-items-center py-1">
                                            <span>Contas</span>
                                            <div>
                                                <button class="btn btn-sm btn-link edit-category" data-id="62">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link text-danger delete-category" data-id="62">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="subcategory-item">
                                        <div class="d-flex justify-content-between align-items-center py-1">
                                            <span>Manutenção</span>
                                            <div>
                                                <button class="btn btn-sm btn-link edit-category" data-id="63">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link text-danger delete-category" data-id="63">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- Outras categorias de despesas -->
                            <li class="category-tree-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-caret-right-fill"></i>
                                        <strong>Transporte</strong>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary add-subcategory" data-id="7">
                                            <i class="bi bi-plus-circle"></i> Subcategoria
                                        </button>
                                        <button class="btn btn-sm btn-link edit-category" data-id="7">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger delete-category" data-id="7">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            
                            <li class="category-tree-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-caret-right-fill"></i>
                                        <strong>Saúde</strong>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary add-subcategory" data-id="8">
                                            <i class="bi bi-plus-circle"></i> Subcategoria
                                        </button>
                                        <button class="btn btn-sm btn-link edit-category" data-id="8">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger delete-category" data-id="8">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
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
                            <li class="category-tree-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-caret-down-fill"></i>
                                        <strong>Salário</strong>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary add-subcategory" data-id="1">
                                            <i class="bi bi-plus-circle"></i> Subcategoria
                                        </button>
                                        <button class="btn btn-sm btn-link edit-category" data-id="1">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger delete-category" data-id="1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <ul class="list-unstyled ml-4 mt-2">
                                    <li class="subcategory-item">
                                        <div class="d-flex justify-content-between align-items-center py-1">
                                            <span>CLT</span>
                                            <div>
                                                <button class="btn btn-sm btn-link edit-category" data-id="11">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link text-danger delete-category" data-id="11">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="subcategory-item">
                                        <div class="d-flex justify-content-between align-items-center py-1">
                                            <span>Bônus</span>
                                            <div>
                                                <button class="btn btn-sm btn-link edit-category" data-id="12">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link text-danger delete-category" data-id="12">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- Investimentos -->
                            <li class="category-tree-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-caret-down-fill"></i>
                                        <strong>Investimentos</strong>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary add-subcategory" data-id="2">
                                            <i class="bi bi-plus-circle"></i> Subcategoria
                                        </button>
                                        <button class="btn btn-sm btn-link edit-category" data-id="2">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger delete-category" data-id="2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <ul class="list-unstyled ml-4 mt-2">
                                    <li class="subcategory-item">
                                        <div class="d-flex justify-content-between align-items-center py-1">
                                            <span>Dividendos</span>
                                            <div>
                                                <button class="btn btn-sm btn-link edit-category" data-id="21">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link text-danger delete-category" data-id="21">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="subcategory-item">
                                        <div class="d-flex justify-content-between align-items-center py-1">
                                            <span>Juros</span>
                                            <div>
                                                <button class="btn btn-sm btn-link edit-category" data-id="22">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link text-danger delete-category" data-id="22">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- Freelance -->
                            <li class="category-tree-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-caret-right-fill"></i>
                                        <strong>Freelance</strong>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary add-subcategory" data-id="3">
                                            <i class="bi bi-plus-circle"></i> Subcategoria
                                        </button>
                                        <button class="btn btn-sm btn-link edit-category" data-id="3">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger delete-category" data-id="3">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Categoria -->
<div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-labelledby="category-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="category-modal-title">Nova Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="category-form" class="needs-validation" novalidate method="POST">
                    <input type="hidden" id="category-id">
                    <input type="hidden" id="category-parent-id">
                    
                    <div class="form-group">
                        <label for="category-name">Nome da Categoria</label>
                        <input type="text" class="form-control" id="category-name" name="nome" required>
                        <div class="invalid-feedback">
                            Por favor, informe um nome para a categoria.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="category-type">Tipo</label>
                        <select class="form-control" id="category-type" nome="tipo" required>
                            <option value="">Selecione um tipo</option>
                            <option value="Despesa">Despesa</option>
                            <option value="Receita">Receita</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecione um tipo.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="category-parent">Categoria Pai (opcional)</label>
                        <select class="form-control" id="category-parent" name="categoria-pai">
                            <option value="">Nenhuma (categoria principal)</option>
                            <!-- Categorias carregadas dinamicamente via JavaScript -->
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="category-description">Descrição (opcional)</label>
                        <textarea class="form-control" id="category-description" name="descricao" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="category-active" name="status" checked>
                            <label class="custom-control-label" for="category-active">Categoria Ativa</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="category-form" class="btn btn-primary">Salvar</button>
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