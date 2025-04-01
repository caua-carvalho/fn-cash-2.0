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