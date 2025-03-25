// Aguardar o carregamento do DOM
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