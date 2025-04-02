// Este script é responsável por gerenciar a exibição de um modal para adicionar novas categorias.
// Ele é utilizado para abrir o modal quando o botão "Nova Categoria" é clicado e resetar o formulário dentro do modal.
document.addEventListener('DOMContentLoaded', function() {
    // Capturar botão que abre o modal
    const newCategoryBtn = document.getElementById('new-category-btn');
    
    // Adicionar evento de clique no botão para abrir o modal
    if (newCategoryBtn) {
        newCategoryBtn.addEventListener('click', function() {
            // Resetar formulário (opcional)
            if (document.getElementById('category-form')) {
                document.getElementById('category-form').reset();
            }
            
            // Exibir o modal usando jQuery
            $('#category-modal').modal('show');
        });
    }
});

// Este script é responsável por gerenciar a exibição de opções em um select baseado na seleção de outro select.
// Ele é utilizado para filtrar as opções de categorias pai com base no tipo de categoria selecionado pelo usuário.
document.addEventListener('DOMContentLoaded', function () {
    const categoryTypeSelect = document.getElementById('category-type');
    const categoryParentSelect = document.getElementById('category-parent');

    categoryTypeSelect.addEventListener('change', function () {
        const selectedType = this.value;

        // Mostra ou oculta as opções com base no tipo selecionado
        Array.from(categoryParentSelect.options).forEach(option => {
            if (option.dataset.tipo) {
                option.style.display = option.dataset.tipo === selectedType ? 'block' : 'none';
            }
        });

        // Reseta o valor do select de categoria pai
        categoryParentSelect.value = '';
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const editCategoryModal = document.getElementById('edit-category-modal');
    const editCategoryForm = document.getElementById('edit-category-form');

    // Adiciona evento aos botões de edição
    document.querySelectorAll('.edit-category').forEach(button => {
        button.addEventListener('click', function () {
            const categoryId = this.dataset.id;
            const categoryName = this.dataset.name;
            const categoryType = this.dataset.type;
            const categoryParent = this.dataset.parent || '';
            const categoryDescription = this.dataset.description || '';
            const categoryActive = this.dataset.active === '1';

            // Preenche os campos do modal
            editCategoryForm.querySelector('#edit-category-id').value = categoryId;
            editCategoryForm.querySelector('#edit-category-name').value = categoryName;
            editCategoryForm.querySelector('#edit-category-type').value = categoryType;
            editCategoryForm.querySelector('#edit-category-parent').value = categoryParent;
            editCategoryForm.querySelector('#edit-category-description').value = categoryDescription;
            editCategoryForm.querySelector('#edit-category-active').checked = categoryActive;

            // Exibe o modal
            $(editCategoryModal).modal('show');
        });
    });
});