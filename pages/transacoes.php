<?php
/**
 * FN-CASH - Sistema de Controle Financeiro Pessoal
 * Página de Transações
 */

// Incluir o cabeçalho
include_once '../header.php';
?>

<!-- Conteúdo da Página de Transações -->
<div id="transacoes-page">
    <!-- Cabeçalho da Página -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Transações</h2>
            <p class="text-muted">Gerencie suas receitas, despesas e transferências</p>
        </div>
        <div class="d-flex">
            <button id="new-transaction-btn" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> <span class="d-none d-md-inline">Nova Transação</span>
            </button>
            <div class="dropdown ml-2">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="actionDropdown" data-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actionDropdown">
                    <a class="dropdown-item" href="#" id="export-csv">
                        <i class="bi bi-file-earmark-arrow-down"></i> Exportar CSV
                    </a>
                    <a class="dropdown-item" href="#" id="export-pdf">
                        <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
                    </a>
                    <a class="dropdown-item" href="#" id="import-transactions">
                        <i class="bi bi-file-earmark-arrow-up"></i> Importar
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" id="print-transactions">
                        <i class="bi bi-printer"></i> Imprimir
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Painel de Filtros -->
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="color: #333;">Filtros</h5>
            <button id="filter-toggle" class="btn btn-sm btn-link text-muted">
                <i class="bi bi-chevron-down"></i>
            </button>
        </div>
        <div id="filter-panel" class="card-body collapse">
            <form id="filter-form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date-range">Período</label>
                            <div id="date-range-filter" class="input-group">
                                <input type="text" id="date-start" class="form-control datepicker" placeholder="Data inicial">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">até</span>
                                </div>
                                <input type="text" id="date-end" class="form-control datepicker" placeholder="Data final">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="filter-type">Tipo</label>
                            <select id="filter-type" class="form-control">
                                <option value="">Todos</option>
                                <option value="Despesa">Despesas</option>
                                <option value="Receita">Receitas</option>
                                <option value="Transferência">Transferências</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="filter-status">Status</label>
                            <select id="filter-status" class="form-control">
                                <option value="">Todos</option>
                                <option value="Pendente">Pendente</option>
                                <option value="Efetivada">Efetivada</option>
                                <option value="Cancelada">Cancelada</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="filter-account">Conta</label>
                            <select id="filter-account" class="form-control">
                                <option value="">Todas</option>
                                <option value="1">Conta Corrente</option>
                                <option value="2">Poupança</option>
                                <option value="3">Cartão de Crédito</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="filter-category">Categoria</label>
                            <select id="filter-category" class="form-control">
                                <option value="">Todas</option>
                                <optgroup label="Receitas">
                                    <option value="1">Salário</option>
                                    <option value="2">Investimentos</option>
                                    <option value="3">Freelance</option>
                                    <option value="4">Outras Receitas</option>
                                </optgroup>
                                <optgroup label="Despesas">
                                    <option value="5">Alimentação</option>
                                    <option value="6">Moradia</option>
                                    <option value="7">Transporte</option>
                                    <option value="8">Saúde</option>
                                    <option value="9">Lazer</option>
                                    <option value="10">Educação</option>
                                    <option value="11">Outras Despesas</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="filter-search">Descrição</label>
                            <input type="text" id="filter-search" class="form-control" placeholder="Busque por descrição...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="reset" class="btn btn-light">Limpar</button>
                        <button type="button" id="apply-filters" class="btn btn-primary">Aplicar Filtros</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Filtros Ativos -->
    <div id="active-filters" class="mb-3">
        <div class="filter-badge">
            Março/2025 <button type="button" class="close" aria-label="Close">&times;</button>
        </div>
        <div class="filter-badge">
            Despesas <button type="button" class="close" aria-label="Close">&times;</button>
        </div>
    </div>
    
    <!-- Abas de Visualização -->
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link view-toggle active" href="#" data-view="list">
                        <i class="bi bi-list-ul"></i> Lista
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link view-toggle" href="#" data-view="calendar">
                        <i class="bi bi-calendar-week"></i> Calendário
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Visualização em Lista -->
        <div id="list-view" class="view-container card-body p-0">
            <div class="table-responsive">
                <table id="transactions-table" class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="100">Data</th>
                            <th>Descrição</th>
                            <th width="110">Tipo</th>
                            <th>Categoria/Destino</th>
                            <th width="120">Valor</th>
                            <th width="110">Status</th>
                            <th width="60">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dados carregados dinamicamente via JavaScript -->
                        <tr>
                            <td colspan="7" class="text-center py-4">Carregando transações...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Paginação -->
            <div class="d-flex justify-content-between align-items-center p-3 border-top">
                <div class="text-muted small">
                    Exibindo <span id="displayed-count">0</span> de <span id="total-count">0</span> transações
                </div>
                <nav aria-label="Navegação de página">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Próxima</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <!-- Visualização de Calendário -->
        <div id="calendar-view" class="view-container card-body d-none">
            <div id="calendar-container" class="calendar-view">
                <!-- Calendário carregado dinamicamente via JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- Modal de Transação -->
<div class="modal fade" id="transaction-modal" tabindex="-1" role="dialog" aria-labelledby="transaction-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transaction-modal-title">Nova Transação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="transaction-form" class="needs-validation" novalidate>
                    <input type="hidden" id="transaction-id">
                    
                    <div class="form-group">
                        <label for="transaction-type">Tipo de Transação</label>
                        <select id="transaction-type" class="form-control" name="tipo" required>
                            <option value="">Selecione o tipo</option>
                            <option value="Despesa">Despesa</option>
                            <option value="Receita">Receita</option>
                            <option value="Transferência">Transferência</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecione um tipo de transação.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="transaction-description">Descrição</label>
                        <input type="text" id="transaction-description" class="form-control" name="descricao" required>
                        <div class="invalid-feedback">
                            Por favor, forneça uma descrição.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="transaction-amount">Valor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            <input type="text" id="transaction-amount" class="form-control money-input" name="valor" required>
                            <div class="invalid-feedback">
                                Por favor, forneça um valor válido.
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="transaction-date">Data</label>
                        <input type="text" id="transaction-date" class="form-control datepicker" name="data" required>
                        <div class="invalid-feedback">
                            Por favor, forneça uma data válida.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="transaction-account">Conta</label>
                        <select id="transaction-account" class="form-control" name="conta" required>
                            <option value="">Selecione uma conta</option>
                            <option value="1">Conta Corrente</option>
                            <option value="2">Poupança</option>
                            <option value="3">Cartão de Crédito</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecione uma conta.
                        </div>
                    </div>
                    
                    <div id="category-field" class="form-group">
                        <label for="transaction-category">Categoria</label>
                        <select id="transaction-category" class="form-control" name="categoria">
                            <option value="">Selecione uma categoria</option>
                            <!-- Categorias carregadas dinamicamente via JavaScript -->
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecione uma categoria.
                        </div>
                    </div>
                    
                    <div id="destiny-account-field" class="form-group d-none">
                        <label for="transaction-destiny-account">Conta de Destino</label>
                        <select id="transaction-destiny-account" class="form-control" name="conta_destino">
                            <option value="">Selecione a conta de destino</option>
                            <option value="1">Conta Corrente</option>
                            <option value="2">Poupança</option>
                            <option value="3">Cartão de Crédito</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecione a conta de destino.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="transaction-status">Status</label>
                        <select id="transaction-status" class="form-control" name="status" required>
                            <option value="Pendente">Pendente</option>
                            <option value="Efetivada" selected>Efetivada</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecione um status.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="transaction-form" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Importação -->
<div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Importar Transações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Selecione um arquivo para importar transações.</p>
                <form id="import-form">
                    <div class="form-group">
                        <label for="import-file">Arquivo CSV ou OFX</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="import-file" accept=".csv,.ofx,.qif">
                            <label class="custom-file-label" for="import-file">Escolher arquivo</label>
                        </div>
                        <small class="form-text text-muted">
                            Formatos suportados: CSV, OFX, QIF
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="import-account">Conta</label>
                        <select id="import-account" class="form-control" required>
                            <option value="">Selecione uma conta</option>
                            <option value="1">Conta Corrente</option>
                            <option value="2">Poupança</option>
                            <option value="3">Cartão de Crédito</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="button" id="start-import" class="btn btn-primary">Importar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script específico para a página -->
<script src="../JavaScript/script.js"></script>

<?php
// Incluir o rodapé
include_once '../footer.php';
?>