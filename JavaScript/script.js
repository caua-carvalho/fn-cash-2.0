/**
 * FN-CASH - Sistema de Controle Financeiro Pessoal
 * JavaScript principal para funcionalidades dinâmicas
 */

// Aguardar o carregamento do DOM
document.addEventListener('DOMContentLoaded', function() {
    initializeFunctions();
});

/**
 * Inicializa todas as funções necessárias
 */
function initializeFunctions() {
    // Inicializar tooltips e popovers do Bootstrap
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
    
    // Inicializar sidebar
    initializeSidebar();
    
    // Inicializar datepickers
    initializeDatepickers();
    
    // Inicializar máscaras de entrada
    initializeInputMasks();
    
    // Inicializar eventos de formulários
    initializeFormEvents();
    
    // Inicializar filtros
    initializeFilters();
    
    // Inicializar funcionalidades específicas da página
    if (document.getElementById('transacoes-page')) {
        initializeTransacoesPage();
    }
}

/**
 * Inicializa a funcionalidade da sidebar
 */
function initializeSidebar() {
    // Toggle para abrir/fechar sidebar em dispositivos móveis
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('collapsed');
        $('.sidebar-overlay').toggleClass('active');
    });
    
    // Botão de fechar dentro da sidebar
    $('#sidebarCollapseBtn').on('click', function() {
        $('#sidebar').addClass('collapsed');
        $('.sidebar-overlay').removeClass('active');
    });
    
    // Fechar sidebar ao clicar no overlay
    $('.sidebar-overlay').on('click', function() {
        $('#sidebar').addClass('collapsed');
        $('.sidebar-overlay').removeClass('active');
    });
    
    // Gerenciar estado da sidebar em redimensionamento
    $(window).resize(function() {
        if ($(window).width() <= 768) {
            $('#sidebar').addClass('collapsed');
        }
    });
    
    // Verificar tamanho da tela no carregamento
    if ($(window).width() <= 768) {
        $('#sidebar').addClass('collapsed');
    }
}

/**
 * Inicializa datepickers nos campos de data
 */
function initializeDatepickers() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR',
        autoclose: true,
        todayHighlight: true
    });
    
    // Datepicker para filtros de intervalo de datas
    if (document.getElementById('date-range-filter')) {
        const start = document.getElementById('date-start');
        const end = document.getElementById('date-end');
        
        $(start).datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function(selected) {
            const startDate = new Date(selected.date.valueOf());
            const endDateInput = $(end);
            
            // Configurar data mínima para o datepicker de fim
            endDateInput.datepicker('setStartDate', startDate);
        });
        
        $(end).datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function(selected) {
            const endDate = new Date(selected.date.valueOf());
            const startDateInput = $(start);
            
            // Configurar data máxima para o datepicker de início
            startDateInput.datepicker('setEndDate', endDate);
        });
    }
}

/**
 * Inicializa máscaras de entrada para campos específicos
 */
function initializeInputMasks() {
    // Máscara para valores monetários
    $('.money-input').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        value = (parseInt(value) / 100).toFixed(2);
        $(this).val(formatCurrency(value));
    });
}

/**
 * Formata um valor para exibição como moeda
 * @param {number} value - Valor a ser formatado
 * @returns {string} Valor formatado
 */
function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}

/**
 * Converte um valor formatado como moeda para número
 * @param {string} value - Valor formatado
 * @returns {number} Valor numérico
 */
function parseCurrencyToNumber(value) {
    return parseFloat(value.replace(/\D/g, '')) / 100;
}

/**
 * Inicializa eventos de formulários
 */
function initializeFormEvents() {
    // Validação de formulários
    const forms = document.querySelectorAll('.needs-validation');
    
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    });
    
    // Alteração de tipo de transação
    if (document.getElementById('transaction-type')) {
        document.getElementById('transaction-type').addEventListener('change', function() {
            const type = this.value;
            const categoryField = document.getElementById('category-field');
            const destinyAccountField = document.getElementById('destiny-account-field');
            
            // Ajustar campos visíveis com base no tipo de transação
            if (type === 'Transferência') {
                categoryField.classList.add('d-none');
                destinyAccountField.classList.remove('d-none');
            } else {
                categoryField.classList.remove('d-none');
                destinyAccountField.classList.add('d-none');
                
                // Ajustar as categorias disponíveis
                updateCategoriesForType(type);
            }
        });
    }
}

/**
 * Atualiza as categorias disponíveis com base no tipo de transação
 * @param {string} type - Tipo de transação (Receita, Despesa)
 */
function updateCategoriesForType(type) {
    const categorySelect = document.getElementById('transaction-category');
    
    if (!categorySelect) return;
    
    // Armazenar valor atual
    const currentValue = categorySelect.value;
    
    // Limpar opções
    categorySelect.innerHTML = '<option value="">Selecione uma categoria</option>';
    
    // Obter categorias do tipo selecionado (simulação)
    const categories = getCategoriesByType(type);
    
    // Adicionar categorias ao select
    categories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;
        categorySelect.appendChild(option);
    });
    
    // Tentar manter o valor selecionado, se compatível
    categorySelect.value = currentValue;
}

/**
 * Retorna categorias pelo tipo (simulação)
 * @param {string} type - Tipo de categoria (Receita, Despesa)
 * @returns {Array} Lista de categorias
 */
function getCategoriesByType(type) {
    // Simulação de dados - em produção, isso viria do backend
    if (type === 'Receita') {
        return [
            { id: 1, name: 'Salário' },
            { id: 2, name: 'Investimentos' },
            { id: 3, name: 'Freelance' },
            { id: 4, name: 'Outras Receitas' }
        ];
    } else {
        return [
            { id: 5, name: 'Alimentação' },
            { id: 6, name: 'Moradia' },
            { id: 7, name: 'Transporte' },
            { id: 8, name: 'Saúde' },
            { id: 9, name: 'Lazer' },
            { id: 10, name: 'Educação' },
            { id: 11, name: 'Outras Despesas' }
        ];
    }
}

/**
 * Inicializa a funcionalidade de filtros
 */
function initializeFilters() {
    // Expandir/contrair painel de filtros
    const filterToggle = document.getElementById('filter-toggle');
    
    if (filterToggle) {
        filterToggle.addEventListener('click', function() {
            const filterPanel = document.getElementById('filter-panel');
            filterPanel.classList.toggle('show');
            
            // Alterar ícone
            const icon = this.querySelector('i');
            if (icon.classList.contains('bi-chevron-down')) {
                icon.classList.replace('bi-chevron-down', 'bi-chevron-up');
            } else {
                icon.classList.replace('bi-chevron-up', 'bi-chevron-down');
            }
        });
    }
    
    // Remover filtros ativos
    const activeFilters = document.querySelectorAll('.filter-badge .close');
    
    activeFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            this.parentElement.remove();
            // Aqui você pode adicionar lógica para recarregar os dados com os filtros atualizados
        });
    });
    
    // Aplicar filtros
    const applyFiltersBtn = document.getElementById('apply-filters');
    
    if (applyFiltersBtn) {
        applyFiltersBtn.addEventListener('click', function() {
            // Recolher painel de filtros em dispositivos móveis
            if (window.innerWidth < 768) {
                const filterPanel = document.getElementById('filter-panel');
                filterPanel.classList.remove('show');
                
                const icon = document.querySelector('#filter-toggle i');
                icon.classList.replace('bi-chevron-up', 'bi-chevron-down');
            }
            
            // Aqui você adicionaria a lógica para aplicar os filtros e recarregar os dados
            applyFilters();
        });
    }
}

/**
 * Aplica os filtros e recarrega os dados (simulação)
 */
function applyFilters() {
    // Simulação - em produção, isso seria uma chamada AJAX para o backend
    console.log('Filtros aplicados');
    
    // Exibir mensagem de carregamento
    const tableBody = document.querySelector('#transactions-table tbody');
    
    if (tableBody) {
        tableBody.innerHTML = '<tr><td colspan="6" class="text-center py-4">Carregando transações...</td></tr>';
        
        // Simular tempo de carregamento
        setTimeout(() => {
            // Carregar dados simulados
            loadTransactionData();
        }, 500);
    }
}

/**
 * Carrega dados de transações (simulação)
 */
function loadTransactionData() {
    // Simulação de dados - em produção, isso viria do backend
    const transactions = [
        {
            id: 1,
            description: 'Salário',
            amount: 3500.00,
            date: '05/03/2025',
            account: 'Conta Corrente',
            category: 'Salário',
            type: 'Receita',
            status: 'Efetivada'
        },
        {
            id: 2,
            description: 'Aluguel',
            amount: 1200.00,
            date: '10/03/2025',
            account: 'Conta Corrente',
            category: 'Moradia',
            type: 'Despesa',
            status: 'Efetivada'
        },
        {
            id: 3,
            description: 'Supermercado',
            amount: 350.75,
            date: '12/03/2025',
            account: 'Cartão de Crédito',
            category: 'Alimentação',
            type: 'Despesa',
            status: 'Efetivada'
        },
        {
            id: 4,
            description: 'Transferência para Poupança',
            amount: 500.00,
            date: '15/03/2025',
            account: 'Conta Corrente',
            destinyAccount: 'Poupança',
            type: 'Transferência',
            status: 'Efetivada'
        },
        {
            id: 5,
            description: 'Pagamento Freelance',
            amount: 800.00,
            date: '18/03/2025',
            account: 'Conta Corrente',
            category: 'Freelance',
            type: 'Receita',
            status: 'Pendente'
        }
    ];
    
    // Renderizar transações na tabela
    renderTransactions(transactions);
}

/**
 * Renderiza transações na tabela
 * @param {Array} transactions - Lista de transações
 */
function renderTransactions(transactions) {
    const tableBody = document.querySelector('#transactions-table tbody');
    
    if (!tableBody) return;
    
    let html = '';
    
    transactions.forEach(transaction => {
        // Determinar classes CSS com base no tipo de transação
        let amountClass = '';
        let typeClass = '';
        let statusClass = '';
        
        if (transaction.type === 'Receita') {
            amountClass = 'text-income';
            typeClass = 'badge-income';
        } else if (transaction.type === 'Despesa') {
            amountClass = 'text-expense';
            typeClass = 'badge-expense';
        } else {
            amountClass = 'text-transfer';
            typeClass = 'badge-transfer';
        }
        
        // Classes para status
        if (transaction.status === 'Pendente') {
            statusClass = 'badge-pending';
        } else if (transaction.status === 'Efetivada') {
            statusClass = 'badge-completed';
        } else {
            statusClass = 'badge-canceled';
        }
        
        // Formatar valor
        const amount = formatCurrency(transaction.type === 'Despesa' ? -transaction.amount : transaction.amount);
        
        // Gerar HTML da linha
        html += `
            <tr data-id="${transaction.id}">
                <td>${transaction.date}</td>
                <td>
                    <div class="font-weight-medium">${transaction.description}</div>
                    <small class="text-muted">${transaction.account}</small>
                </td>
                <td>
                    <span class="badge ${typeClass}">${transaction.type}</span>
                </td>
                <td>
                    ${transaction.category || (transaction.type === 'Transferência' ? `Para: ${transaction.destinyAccount}` : '-')}
                </td>
                <td class="${amountClass}">${amount}</td>
                <td>
                    <span class="badge ${statusClass}">${transaction.status}</span>
                </td>
                <td>
                    <div class="dropdown actions-menu">
                        <button class="btn btn-sm btn-light" type="button" data-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item edit-transaction" data-id="${transaction.id}">
                                <i class="bi bi-pencil"></i> Editar
                            </button>
                            <button class="dropdown-item duplicate-transaction" data-id="${transaction.id}">
                                <i class="bi bi-files"></i> Duplicar
                            </button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item text-danger delete-transaction" data-id="${transaction.id}">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
        `;
    });
    
    // Se não houver transações, exibir mensagem
    if (transactions.length === 0) {
        html = '<tr><td colspan="6" class="text-center py-4">Nenhuma transação encontrada.</td></tr>';
    }
    
    // Atualizar tabela
    tableBody.innerHTML = html;
    
    // Inicializar eventos de ações
    initializeTransactionActions();
}

/**
 * Inicializa eventos de ações para transações
 */
function initializeTransactionActions() {
    // Editar transação
    document.querySelectorAll('.edit-transaction').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            editTransaction(id);
        });
    });
    
    // Duplicar transação
    document.querySelectorAll('.duplicate-transaction').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            duplicateTransaction(id);
        });
    });
    
    // Excluir transação
    document.querySelectorAll('.delete-transaction').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            deleteTransaction(id);
        });
    });
}

/**
 * Inicializa funcionalidades específicas da página de transações
 */
function initializeTransacoesPage() {
    // Carregar dados iniciais
    loadTransactionData();
    
    // Botão para adicionar nova transação
    const newTransactionBtn = document.getElementById('new-transaction-btn');
    
    if (newTransactionBtn) {
        newTransactionBtn.addEventListener('click', function() {
            // Limpar formulário
            document.getElementById('transaction-form').reset();
            
            // Configurar formulário para nova transação
            document.getElementById('transaction-modal-title').textContent = 'Adicionar Nova Transação';
            document.getElementById('transaction-id').value = '';
            
            // Mostrar modal
            $('#transaction-modal').modal('show');
        });
    }
    
    // Alternar entre visualização de lista e calendário
    const viewToggles = document.querySelectorAll('.view-toggle');
    
    viewToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remover classe ativa de todos os toggles
            viewToggles.forEach(t => t.classList.remove('active'));
            
            // Adicionar classe ativa ao toggle clicado
            this.classList.add('active');
            
            // Mostrar a visualização correspondente
            const viewType = this.getAttribute('data-view');
            document.querySelectorAll('.view-container').forEach(container => {
                container.classList.add('d-none');
            });
            
            document.getElementById(`${viewType}-view`).classList.remove('d-none');
            
            // Se for visualização de calendário, inicializar o calendário
            if (viewType === 'calendar') {
                initializeCalendarView();
            }
        });
    });
    
    // Manipulação do formulário de transação
    const transactionForm = document.getElementById('transaction-form');
    
    if (transactionForm) {
        transactionForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validar formulário
            if (!this.checkValidity()) {
                this.classList.add('was-validated');
                return;
            }
            
            // Processar formulário
            saveTransaction();
            
            // Fechar modal
            $('#transaction-modal').modal('hide');
        });
    }
}

/**
 * Salva uma transação (simulação)
 */
function saveTransaction() {
    // Obter dados do formulário
    const id = document.getElementById('transaction-id').value;
    const description = document.getElementById('transaction-description').value;
    const amount = parseCurrencyToNumber(document.getElementById('transaction-amount').value);
    const date = document.getElementById('transaction-date').value;
    const type = document.getElementById('transaction-type').value;
    const account = document.getElementById('transaction-account').value;
    const category = type !== 'Transferência' ? document.getElementById('transaction-category').value : null;
    const destinyAccount = type === 'Transferência' ? document.getElementById('transaction-destiny-account').value : null;
    const status = document.getElementById('transaction-status').value;
    
    // Aqui, você enviaria os dados para o backend
    console.log('Transação salva', {
        id,
        description,
        amount,
        date,
        type,
        account,
        category,
        destinyAccount,
        status
    });
    
    // Recarregar dados para refletir a alteração
    loadTransactionData();
}

/**
 * Edita uma transação existente
 * @param {string} id - ID da transação
 */
function editTransaction(id) {
    // Em produção, isso buscaria os dados da transação do backend
    // Simulação com dados fixos para demonstração
    const transaction = {
        id: id,
        description: 'Supermercado',
        amount: 350.75,
        date: '12/03/2025',
        account: '1', // ID da conta
        category: '5', // ID da categoria
        type: 'Despesa',
        status: 'Efetivada'
    };
    
    // Preencher formulário com dados da transação
    document.getElementById('transaction-modal-title').textContent = 'Editar Transação';
    document.getElementById('transaction-id').value = transaction.id;
    document.getElementById('transaction-description').value = transaction.description;
    document.getElementById('transaction-amount').value = formatCurrency(transaction.amount);
    document.getElementById('transaction-date').value = transaction.date;
    document.getElementById('transaction-type').value = transaction.type;
    document.getElementById('transaction-account').value = transaction.account;
    
    // Atualizar campos dependentes do tipo
    updateCategoriesForType(transaction.type);
    
    // Configurar visibilidade dos campos
    const categoryField = document.getElementById('category-field');
    const destinyAccountField = document.getElementById('destiny-account-field');
    
    if (transaction.type === 'Transferência') {
        categoryField.classList.add('d-none');
        destinyAccountField.classList.remove('d-none');
        document.getElementById('transaction-destiny-account').value = transaction.destinyAccount;
    } else {
        categoryField.classList.remove('d-none');
        destinyAccountField.classList.add('d-none');
        document.getElementById('transaction-category').value = transaction.category;
    }
    
    document.getElementById('transaction-status').value = transaction.status;
    
    // Mostrar modal
    $('#transaction-modal').modal('show');
}

/**
 * Duplica uma transação
 * @param {string} id - ID da transação
 */
function duplicateTransaction(id) {
    // Em produção, isso buscaria os dados da transação do backend
    // Simular com dados fixos para demonstração
    const transaction = {
        id: '',  // Nova transação, sem ID
        description: 'Cópia de Supermercado',
        amount: 350.75,
        date: '12/03/2025',
        account: '1', // ID da conta
        category: '5', // ID da categoria
        type: 'Despesa',
        status: 'Pendente'  // Por padrão, pendente
    };
    
    // Preencher formulário com dados da transação
    document.getElementById('transaction-modal-title').textContent = 'Duplicar Transação';
    document.getElementById('transaction-id').value = transaction.id;
    document.getElementById('transaction-description').value = transaction.description;
    document.getElementById('transaction-amount').value = formatCurrency(transaction.amount);
    document.getElementById('transaction-date').value = transaction.date;
    document.getElementById('transaction-type').value = transaction.type;
    document.getElementById('transaction-account').value = transaction.account;
    
    // Atualizar campos dependentes do tipo
    updateCategoriesForType(transaction.type);
    
    // Configurar visibilidade dos campos
    const categoryField = document.getElementById('category-field');
    const destinyAccountField = document.getElementById('destiny-account-field');
    
    if (transaction.type === 'Transferência') {
        categoryField.classList.add('d-none');
        destinyAccountField.classList.remove('d-none');
        document.getElementById('transaction-destiny-account').value = transaction.destinyAccount;
    } else {
        categoryField.classList.remove('d-none');
        destinyAccountField.classList.add('d-none');
        document.getElementById('transaction-category').value = transaction.category;
    }
    
    document.getElementById('transaction-status').value = transaction.status;
    
    // Mostrar modal
    $('#transaction-modal').modal('show');
}

/**
 * Exclui uma transação
 * @param {string} id - ID da transação
 */
function deleteTransaction(id) {
    if (confirm('Tem certeza que deseja excluir esta transação?')) {
        // Em produção, isso enviaria uma requisição para o backend para excluir a transação
        console.log('Transação excluída:', id);
        
        // Remover linha da tabela (simulação)
        const row = document.querySelector(`tr[data-id="${id}"]`);
        if (row) {
            row.remove();
        }
    }
}

/**
 * Inicializa visualização de calendário
 */
function initializeCalendarView() {
    // Verificar se o contêiner do calendário existe
    const calendarContainer = document.getElementById('calendar-container');
    
    if (!calendarContainer) return;
    
    // Se o FullCalendar estivesse disponível, você poderia inicializá-lo assim:
    // Esse é apenas um esboço, você precisaria incluir a biblioteca FullCalendar
    /* 
    const calendar = new FullCalendar.Calendar(calendarContainer, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        events: [
            // Eventos viriam do backend
            {
                title: 'Salário',
                start: '2025-03-05',
                classNames: ['income']
            },
            {
                title: 'Aluguel',
                start: '2025-03-10',
                classNames: ['expense']
            },
            // Mais eventos...
        ],
        eventClick: function(info) {
            // Mostrar detalhes da transação
            const id = info.event.id;
            editTransaction(id);
        }
    });
    
    calendar.render();
    */
    
    // Simulação simplificada
    calendarContainer.innerHTML = `
        <div class="text-center p-5">
            <i class="bi bi-calendar-week" style="font-size: 3rem; color: var(--fn-medium-green);"></i>
            <h4 class="mt-3">Visualização de Calendário</h4>
            <p class="text-muted">Esta é uma simulação. Em produção, aqui seria exibido um calendário interativo com as transações.</p>
        </div>
    `;
}