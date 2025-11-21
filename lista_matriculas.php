<?php
include 'conexao.php';
$titulo = "Lista de Matrículas";
ob_start();
?>

<h2 class="mb-4 text-primary">Matrículas Realizadas</h2>

<table class="table table-striped table-hover align-middle">
  <thead class="table-primary">
    <tr>
      <th>Aluno</th>
      <th>Curso</th>
      <th>Data</th>
      <th class="text-center">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($colecaoMatriculas->find() as $m):

      $estudante = $colecaoEstudantes->findOne(["_id" => $m->estudante_id]);
      $curso     = $colecaoCursos->findOne(["_id" => $m->curso_id]);

      $nomeAluno = htmlspecialchars($estudante->nome);
      $nomeCurso = htmlspecialchars($curso->nome);
    ?>
      <tr>
        <td><?= $nomeAluno ?></td>
        <td><?= $nomeCurso ?></td>
        <td><?= htmlspecialchars($m->data) ?></td>
        <td class="text-center">
          <a href="editar_matricula.php?id=<?= $m->_id ?>" class="btn btn-sm btn-warning me-2">🖋️ Editar</a>

          <button 
              class="btn btn-sm btn-danger"
              data-bs-toggle="modal" 
              data-bs-target="#confirmaExclusaoModal"
              data-id="<?= $m->_id ?>" 
              data-aluno="<?= $nomeAluno ?>"
              data-curso="<?= $nomeCurso ?>"
          >🗑️ Excluir</button>
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
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir a matrícula de:
        <br><br>
        <strong id="infoAluno"></strong> no curso <strong id="infoCurso"></strong>?
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
document.addEventListener('DOMContentLoaded', () => {

  const modal = document.getElementById('confirmaExclusaoModal');

  modal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;

    const id     = button.getAttribute('data-id');
    const aluno  = button.getAttribute('data-aluno');
    const curso  = button.getAttribute('data-curso');

    document.getElementById('idExcluir').value = id;
    document.getElementById('infoAluno').textContent = aluno;
    document.getElementById('infoCurso').textContent = curso;
  });

});
</script>

<?php
use MongoDB\BSON\ObjectId;

if (isset($_POST['confirmar_exclusao'])) {

    $colecaoMatriculas->deleteOne([
        '_id' => new ObjectId($_POST['id_excluir'])
    ]);

    echo "<div class='alert alert-success mt-3'>✅ A Matrícula foi excluída com sucesso!</div>";
    echo "<meta http-equiv='refresh' content='1;url=lista_matriculas.php'>";
}

$conteudo = ob_get_clean();
include 'layout.php';
?>
