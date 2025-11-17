<?php
include 'conexao.php';
$titulo = "Lista de Estudantes";
ob_start();
?>

<h2 class="mb-4 text-primary">Estudantes Cadastrados</h2>

<table class="table table-striped table-hover align-middle">
  <thead class="table-primary">
    <tr>
      <th>Nome</th>
      <th>CPF</th>
      <th>Cidade</th>
      <th>Estado</th>
      <th class="text-center">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($colecaoEstudantes->find() as $e): ?>
      <tr>
        <td><?= htmlspecialchars($e->nome) ?></td>
        <td><?= htmlspecialchars($e->cpf) ?></td>
        <td><?= htmlspecialchars($e->endereco['cidade'] ?? '') ?></td>
        <td><?= htmlspecialchars($e->endereco['estado'] ?? '') ?></td>
        <td class="text-center">
          <a href="editar_estudante.php?id=<?= $e->_id ?>" class="btn btn-sm btn-warning me-2">🖋️ Editar</a>
          <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmaExclusaoModal" data-id="<?= $e->_id ?>" data-nome="<?= htmlspecialchars($e->nome) ?>">🗑️ Excluir</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php" class="btn btn-outline-primary mt-3">⬅️ Retornar à Página Inicial</a>

<!-- Modal de Confirmação -->
<div class="modal fade" id="confirmaExclusaoModal" tabindex="-1" aria-labelledby="confirmaExclusaoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="confirmaExclusaoLabel">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir o estudante <strong id="nomeEstudante"></strong>?
      </div>
      <div class="modal-footer">
        <form method="POST">
          <input type="hidden" name="id_excluir" id="idExcluir">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="confirmar_exclusao" class="btn btn-danger">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// Passar dados do estudante para o modal
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('confirmaExclusaoModal');
  modal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const nome = button.getAttribute('data-nome');
    document.getElementById('idExcluir').value = id;
    document.getElementById('nomeEstudante').textContent = nome;
  });
});
</script>

<?php
use MongoDB\BSON\ObjectId;

if (isset($_POST['confirmar_exclusao'])) {
    $colecaoEstudantes->deleteOne(['_id' => new ObjectId($_POST['id_excluir'])]);
    echo "<div class='alert alert-success mt-3'>✅ O Estudante foi excluído com sucesso!</div>";
    echo "<meta http-equiv='refresh' content='1;url=listar_estudantes.php'>";
}

$conteudo = ob_get_clean();
include 'layout.php';
?>
