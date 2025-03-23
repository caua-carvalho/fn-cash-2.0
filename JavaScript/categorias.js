/**
 * FN-CASH - Sistema de Controle Financeiro Pessoal
 * JavaScript específico para a página de Categorias
 */

// Aguardar o carregamento do DOM
document.addEventListener('DOMContentLoaded', function() {
    initializeCategoriesPage();
});

/**
 * Inicializa a página de categorias
 */
function initializeCategoriesPage() {
    // Inicializar eventos dos botões
    initializeCategoryButtons();
    
    // Inicializar manipulação de árvore de categorias
    initializeCategoryTree();
    
    // Inicializar formulário de categoria
    initializeCategoryForm();
    
    // Carregar dados de categorias (simulação)
    loadCategoryData();
}

/**
 * Inicializa eventos dos botões na página
 */
function initializeCategoryButtons() {
    // Botão para adicionar nova categoria
    document.getElementById('new-category-btn').addEventListener('click', function() {
        showCategoryModal();
    });
    
    // Botões para adicionar categoria por tipo
    document.getElementById('add-expense-category').addEventListener('click', function() {
        showCategoryModal('Despesa');
    });
    
    document.getElementById('add-income-category').addEventListener('click', function() {
        showCategoryModal('Receita');
    });
    
    // Botões nas abas específicas
    if (document.getElementById('add-expense-category-tab')) {
        document.getElementById('add-expense-category-tab').addEventListener('click', function() {
            showCategoryModal('Despesa');
        });
    }
    
    if (document.getElementById('add-income-category-tab')) {
        document.getElementById('add-income-category-tab').addEventListener('click', function() {
            showCategoryModal('Receita');
        });
    }
    
    // Delegar eventos para botões dinâmicos
    document.addEventListener('click', function(e) {
        // Editar categoria
        if (e.target.closest('.edit-category')) {
            const button = e.target.closest('.edit-category');
            const categoryId = button.getAttribute('data-id');
            editCategory(categoryId);
        }
        
        // Excluir categoria
        if (e.target.closest('.delete-category')) {
            const button = e.target.closest('.delete-category');
            const categoryId = button.getAttribute('data-id');
            deleteCategory(categoryId);
        }
        
        // Adicionar subcategoria
        if (e.target.closest('.add-subcategory')) {
            const button = e.target.closest('.add-subcategory');
            const parentId = button.getAttribute('data-id');
            addSubcategory(parentId);
        }
    });
}

/**
 * Inicializa a funcionalidade de árvore de categorias
 */
function initializeCategoryTree() {
    // Expandir/colapsar categorias
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('bi-caret-down-fill') || 
            e.target.classList.contains('bi-caret-right-fill')) {
            
            const icon = e.target;
            const categoryItem = icon.closest('.category-tree-item');
            const subcategoriesList = categoryItem.querySelector('ul');
            
            if (subcategoriesList) {
                // Toggle da visibilidade
                if (icon.classList.contains('bi-caret-down-fill')) {
                    icon.classList.replace('bi-caret-down-fill', 'bi-caret-right-fill');
                    subcategoriesList.style.display = 'none';
                } else {
                    icon.classList.replace('bi-caret-right-fill', 'bi-caret-down-fill');
                    subcategoriesList.style.display = 'block';
                }
            }
        }
    });
}

/**
 * Inicializa o formulário de categoria
 */
function initializeCategoryForm() {
    const categoryForm = document.getElementById('category-form');
    
    if (categoryForm) {
        categoryForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validar formulário
            if (!this.checkValidity()) {
                this.classList.add('was-validated');
                return;
            }
            
            // Processar formulário
            saveCategory();
            
            // Fechar modal
            $('#category-modal').modal('hide');
        });
        
        // Quando o tipo de categoria mudar, atualizar as opções de categoria pai
        document.getElementById('category-type').addEventListener('change', function() {
            updateParentCategoryOptions(this.value);
        });
    }
}

/**
 * Mostra o modal de categoria
 * @param {string} type - Tipo predefinido de categoria (opcional)
 * @param {number} parentId - ID da categoria pai (opcional)
 */
function showCategoryModal(type = '', parentId = null) {
    // Resetar formulário
    document.getElementById('category-form').reset();
    document.getElementById('category-form').classList.remove('was-validated');
    
    // Limpar campos ocultos
    document.getElementById('category-id').value = '';
    document.getElementById('category-parent-id').value = parentId || '';
    
    // Definir tipo se fornecido
    if (type) {
        document.getElementById('category-type').value = type;
        updateParentCategoryOptions(type);
    }
    
    // Definir categoria pai se fornecido
    if (parentId) {
        document.getElementById('category-parent').value = parentId;
        
        // Buscar o tipo da categoria pai e definir o tipo da nova categoria
        // Na implementação real, isso viria do backend
        // Por ora, vamos simular
        const parentType = findCategoryType(parentId);
        if (parentType) {
            document.getElementById('category-type').value = parentType;
            document.getElementById('category-type').disabled = true;
        }
    } else {
        document.getElementById('category-type').disabled = false;
    }
    
    // Definir título do modal
    document.getElementById('category-modal-title').textContent = parentId ? 'Nova Subcategoria' : 'Nova Categoria';
    
    // Mostrar modal
    $('#category-modal').modal('show');
}

/**
 * Simula encontrar o tipo de uma categoria pelo ID
 * @param {number} categoryId - ID da categoria
 * @returns {string} Tipo da categoria
 */
function findCategoryType(categoryId) {
    // Simular categorias de despesa
    const expenseIds = [5, 6, 7, 8, 51, 52, 53, 61, 62, 63];
    // Simular categorias de receita
    const incomeIds = [1, 2, 3, 11, 12, 21, 22];
    
    if (expenseIds.includes(parseInt(categoryId))) {
        return 'Despesa';
    } else if (incomeIds.includes(parseInt(categoryId))) {
        return 'Receita';
    }
    
    return '';
}

/**
 * Atualiza as opções de categoria pai com base no tipo selecionado
 * @param {string} type - Tipo de categoria (Despesa ou Receita)
 */
function updateParentCategoryOptions(type) {
    const parentSelect = document.getElementById('category-parent');
    
    // Limpar opções
    parentSelect.innerHTML = '<option value="">Nenhuma (categoria principal)</option>';
    
    if (!type) return;
    
    // Obter categorias do tipo selecionado (simulação)
    const categories = getCategoriesByType(type);
    
    // Adicionar categorias como opções
    categories.forEach(category => {
        // Não incluir subcategorias como opções para categoria pai
        if (!category.parentId) {
            const option = document.createElement('option');
            option.value = category.id;
            option.textContent = category.name;
            parentSelect.appendChild(option);
        }
    });
}

/**
 * Simula obter categorias pelo tipo
 * @param {string} type - Tipo de categoria (Despesa ou Receita)
 * @returns {Array} Lista de categorias
 */
function getCategoriesByType(type) {
    // Simulação de dados - em produção, isso viria do backend
    if (type === 'Receita') {
        return [
            { id: 1, name: 'Salário', parentId: null },
            { id: 11, name: 'CLT', parentId: 1 },
            { id: 12, name: 'Bônus', parentId: 1 },
            { id: 2, name: 'Investimentos', parentId: null },
            { id: 21, name: 'Dividendos', parentId: 2 },
            { id: 22, name: 'Juros', parentId: 2 },
            { id: 3, name: 'Freelance', parentId: null }
        ];
    } else {
        return [
            { id: 5, name: 'Alimentação', parentId: null },
            { id: 51, name: 'Mercado', parentId: 5 },
            { id: 52, name: 'Restaurantes', parentId: 5 },
            { id: 53, name: 'Delivery', parentId: 5 },
            { id: 6, name: 'Moradia', parentId: null },
            { id: 61, name: 'Aluguel', parentId: 6 },
            { id: 62, name: 'Contas', parentId: 6 },
            { id: 63, name: 'Manutenção', parentId: 6 },
            { id: 7, name: 'Transporte', parentId: null },
            { id: 8, name: 'Saúde', parentId: null }
        ];
    }
}

/**
 * Edita uma categoria existente
 * @param {number} categoryId - ID da categoria
 */
function editCategory(categoryId) {
    // Em produção, isso buscaria os dados da categoria do backend
    // Simulação de dados para demonstração
    const category = {
        id: categoryId,
        name: 'Nome da Categoria ' + categoryId,
        type: findCategoryType(categoryId),
        parentId: getCategoryParentId(categoryId),
        description: 'Descrição da categoria ' + categoryId,
        active: true
    };
    
    // Preencher formulário
    document.getElementById('category-id').value = category.id;
    document.getElementById('category-name').value = category.name;
    document.getElementById('category-type').value = category.type;
    document.getElementById('category-type').disabled = true; // Não permitir mudar o tipo ao editar
    document.getElementById('category-description').value = category.description;
    document.getElementById('category-active').checked = category.active;
    
    // Atualizar e definir categoria pai
    updateParentCategoryOptions(category.type);
    document.getElementById('category-parent').value = category.parentId || '';
    
    // Se for subcategoria, desabilitar campo de categoria pai
    const isSubcategory = category.parentId !== null;
    document.getElementById('category-parent').disabled = isSubcategory;
    
    // Definir título do modal
    document.getElementById('category-modal-title').textContent = 'Editar Categoria';
    
    // Mostrar modal
    $('#category-modal').modal('show');
}

/**
 * Simula obter o ID da categoria pai de uma categoria
 * @param {number} categoryId - ID da categoria
 * @returns {number|null} ID da categoria pai ou null
 */
function getCategoryParentId(categoryId) {
    // Lista de subcategorias e seus pais (simulação)
    const subcategories = {
        11: 1, 12: 1, // Subcategorias de Salário
        21: 2, 22: 2, // Subcategorias de Investimentos
        51: 5, 52: 5, 53: 5, // Subcategorias de Alimentação
        61: 6, 62: 6, 63: 6  // Subcategorias de Moradia
    };
    
    return subcategories[categoryId] || null;
}

/**
 * Adiciona uma subcategoria
 * @param {number} parentId - ID da categoria pai
 */
function addSubcategory(parentId) {
    showCategoryModal(null, parentId);
}

/**
 * Exclui uma categoria
 * @param {number} categoryId - ID da categoria
 */
function deleteCategory(categoryId) {
    // Verificar se tem subcategorias (simulação)
    const hasSubcategories = checkForSubcategories(categoryId);
    
    if (hasSubcategories) {
        if (!confirm('Esta categoria possui subcategorias. Excluir também as subcategorias?')) {
            return;
        }
    } else {
        if (!confirm('Tem certeza que deseja excluir esta categoria?')) {
            return;
        }
    }
    
    // Em produção, isso enviaria uma requisição ao backend
    console.log('Categoria excluída:', categoryId);
    
    // Recarregar dados
    loadCategoryData();
    
    // Exibir notificação de sucesso
    showToast('Categoria excluída com sucesso!');
}

/**
 * Simula verificar se uma categoria tem subcategorias
 * @param {number} categoryId - ID da categoria
 * @returns {boolean} Verdadeiro se tiver subcategorias
 */
function checkForSubcategories(categoryId) {
    // Categorias que têm subcategorias (simulação)
    const categoriesWithChildren = [1, 2, 5, 6];
    
    return categoriesWithChildren.includes(parseInt(categoryId));
}

/**
 * Salva uma categoria
 */
function saveCategory() {
    const id = document.getElementById('category-id').value;
    const name = document.getElementById('category-name').value;
    const type = document.getElementById('category-type').value;
    const parentId = document.getElementById('category-parent').value;
    const description = document.getElementById('category-description').value;
    const active = document.getElementById('category-active').checked;
    
    // Em produção, isso enviaria os dados para o backend
    console.log('Categoria salva:', {
        id: id || 'Nova',
        name,
        type,
        parentId: parentId || null,
        description,
        active
    });
    
    // Recarregar dados
    loadCategoryData();
    
    // Exibir notificação de sucesso
    showToast(`Categoria ${id ? 'atualizada' : 'criada'} com sucesso!`);
}

/**
 * Carrega dados de categorias (simulação)
 */
function loadCategoryData() {
    // Simulação - em produção, isso seria uma chamada AJAX
    
    // Por enquanto, não faremos nada aqui, pois os dados já estão carregados estaticamente no HTML
    // Em uma implementação real, esta função atualizaria os elementos do DOM com os dados das categorias
}

/**
 * Exibe uma notificação toast
 * @param {string} message - Mensagem a ser exibida
 * @param {string} type - Tipo de notificação (success, warning, error)
 */
function showToast(message, type = 'success') {
    // Verificar se o contêiner de toasts existe
    let toastContainer = document.getElementById('toast-container');
    
    // Criar contêiner se não existir
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.className = 'toast-container position-fixed bottom-0 right-0 p-3';
        document.body.appendChild(toastContainer);
    }
    
    // Criar elemento toast
    const toastId = 'toast-' + Date.now();
    const toast = document.createElement('div');
    toast.className = `toast bg-${type === 'success' ? 'success' : type === 'warning' ? 'warning' : 'danger'} text-white`;
    toast.id = toastId;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    toast.setAttribute('data-delay', '3000');
    
    toast.innerHTML = `
        <div class="toast-header bg-${type === 'success' ? 'success' : type === 'warning' ? 'warning' : 'danger'} text-white">
            <strong class="mr-auto">FN-CASH</strong>
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            ${message}
        </div>
    `;
    
    // Adicionar toast ao contêiner
    toastContainer.appendChild(toast);
    
    // Inicializar e mostrar toast
    $('#' + toastId).toast('show');
    
    // Remover toast quando fechado
    $('#' + toastId).on('hidden.bs.toast', function() {
        this.remove();
    });
}