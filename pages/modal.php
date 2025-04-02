<?php
require_once 'funcoes.php'; // Inclua o arquivo com a função
$categorias = exibir_categorias_form(); // Obtenha o array de categorias
?>

<!-- MODAL PARA CADASTRO DE CATEOGIRA -->
<div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-labelledby="category-modal-label" aria-hidden="true">
    <input type="hidden" id="form_id" name="form_id" value="criar">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="category-modal-title">Nova Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="category-form" method="POST" action="categorias.php">
                    <input type="hidden" id="category-id" name="id">
                    <input type="hidden" id="category-parent-id" name="parent_id">
                    
                    <div class="form-group">
                        <label for="category-name">Nome da Categoria</label>
                        <input type="text" class="form-control" id="category-name" name="nome" required>
                        <div class="invalid-feedback">
                            Por favor, informe um nome para a categoria.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="category-type">Tipo</label>
                        <select class="form-control" id="category-type" name="tipo" required>
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
                        <select id="category-parent" name="categoria_pai" class="form-control">
                            <option value="">Selecione uma categoria pai</option>
                            <?php
                            $categorias = exibir_categorias_form();
                            foreach ($categorias as $categoria) {
                                echo '<option value="' . $categoria["id"] . '" data-tipo="' . $categoria["tipo"] . '">' . $categoria["nome"] . '</option>';
                            }
                            ?>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EDITAR CATEGORIA -->
<div class="modal fade" id="edit-category-modal editar" tabindex="-1" role="dialog" aria-labelledby="edit-category-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-category-modal-label">Editar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-category-form" method="POST" action="editar_categoria.php">
                    <input type="hidden" id="edit-category-id" name="id">
                    
                    <div class="form-group">
                        <label for="edit-category-name">Nome da Categoria</label>
                        <input type="text" class="form-control" id="edit-category-name" name="nome" required>
                        <div class="invalid-feedback">
                            Por favor, informe um nome para a categoria.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit-category-type">Tipo</label>
                        <select class="form-control" id="edit-category-type" name="tipo" required>
                            <option value="">Selecione um tipo</option>
                            <option value="Despesa">Despesa</option>
                            <option value="Receita">Receita</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecione um tipo.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit-category-parent">Categoria Pai (opcional)</label>
                        <select id="edit-category-parent" name="categoria_pai" class="form-control">
                            <option value="">Selecione uma categoria pai</option>
                            <?php
                            $categorias = exibir_categorias_form();
                            foreach ($categorias as $categoria) {
                                echo '<option value="' . $categoria["id"] . '" data-tipo="' . $categoria["tipo"] . '">' . $categoria["nome"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="edit-category-description">Descrição (opcional)</label>
                        <textarea class="form-control" id="edit-category-description" name="descricao" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="edit-category-active" name="status">
                            <label class="custom-control-label" for="edit-category-active">Categoria Ativa</label>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SUCESSO CADASTRO CATETGORIA -->
<div class="modal fade" id="sucessoCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="sucessoCategoriaModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="sucessoCategoriaModalLabel">
                    <i class="bi bi-check-circle-fill mr-2"></i>Sucesso!
                </h5>
                <a href="categorias.php" class="close text-white" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                </div>
                <h4 class="mb-3">Categoria cadastrada com sucesso!</h4>
                <p class="mb-0">A categoria foi adicionada ao sistema e já está disponível para uso.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="categorias.php" class="btn btn-success px-4">
                    <i class="bi bi-check-lg mr-2"></i>OK
                </a>
            </div>
        </div>
    </div>
</div>
<!-- ERRO AO CADASTRAR CATEGORIA -->
<div class="modal fade" id="erroCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="erroCategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="erroCategoriaModalLabel">
                    <i class="bi bi-x-circle-fill mr-2"></i>Erro!
                </h5>
                <a href="categorias.php" class="close text-white" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-4">
                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 4rem;"></i>
                </div>
                <h4 class="mb-3">Ocorreu um erro ao cadastrar a categoria.</h4>
                <p class="mb-0">Por favor, tente novamente.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="categorias.php" class="btn btn-danger px-4">
                    <i class="bi bi-x-lg mr-2"></i>Fechar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- CATEGORIA JA CADASTRADA -->
<div class="modal fade" id="categoriaExistenteModal" tabindex="-1" role="dialog" aria-labelledby="categoriaExistenteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="categoriaExistenteModalLabel">
                    <i class="bi bi-exclamation-circle-fill mr-2"></i>Atenção!
                </h5>
                <a href="categorias.php" class="close text-white" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-4">
                    <i class="bi bi-exclamation-circle-fill text-warning" style="font-size: 4rem;"></i>
                </div>
                <h4 class="mb-3">Categoria já cadastrada.</h4>
                <p class="mb-0">Por favor, verifique e tente novamente.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="categorias.php" class="btn btn-warning px-4">
                    <i class="bi bi-check-lg mr-2"></i>OK
                </a>
            </div>
        </div>
    </div>
</div>

<?php
// Exibe o script com base no resultado
if (!empty($_GET['result'])) {
    if ($_GET['result'] == 'sucesso') {
        echo '<script>
            $(document).ready(function() {
                $("#sucessoCategoriaModal").modal("show");
            });
        </script>';
    } elseif ($_GET['result'] == 'erro') {
        echo '<script>
            $(document).ready(function() {
                $("#erroCategoriaModal").modal("show");
            });
        </script>';
    } elseif ($_GET['result'] == 'existente') {
        echo '<script>
            $(document).ready(function() {
                $("#categoriaExistenteModal").modal("show");
            });
        </script>';
    }
}
?>