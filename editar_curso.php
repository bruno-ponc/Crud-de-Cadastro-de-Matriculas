<?php
include 'conexao.php';
use MongoDB\BSON\ObjectId;

$titulo = "Editar Curso";
ob_start();

$id = $_GET['id'] ?? '';
$curso = $colecaoCursos->findOne(['_id' => new ObjectId($id)]);

if (!$curso) {
    echo "<div class='alert alert-danger'>Curso não encontrado.</div>";
} else {
?>
<div class="card p-4">
  <h2 class="text-primary mb-4">Editar Curso</h2>
  <form method="POST">
    <div class="row mb-3">
      <div class="col-md-4"><label class="form-label">Nome</label><input name="nome" value="<?= $curso->nome ?>" class="form-control"></div>
      <div class="col-md-3"><label class="form-label">Código</label><input name="codigo" value="<?= $curso->codigo ?>" class="form-control"></div>
      <div class="col-md-2"><label class="form-label">Duração</label><input type="number" name="duracao" value="<?= $curso->duracao ?>" class="form-control"></div>
      <div class="col-md-3"><label class="form-label">Professor</label><input name="professor" value="<?= $curso->professor ?>" class="form-control"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4">
        <label class="form-label">Turno</label>
        <select name="turno" class="form-select">
          <?php
          $turnos = ['Matutino','Vespertino','Noturno'];
          foreach ($turnos as $t) {
              $sel = ($curso->turno == $t) ? 'selected' : '';
              echo "<option $sel>$t</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <button name="salvar" class="btn btn-success">💾 Salvar Alterações</button>
    <a href="listar_cursos.php" class="btn btn-outline-primary ms-2">⬅️ Voltar</a>
  </form>
</div>
<?php
}

if (isset($_POST['salvar'])) {
    $colecaoCursos->updateOne(
        ['_id' => new ObjectId($id)],
        ['$set' => [
            'nome' => $_POST['nome'],
            'codigo' => $_POST['codigo'],
            'duracao' => $_POST['duracao'],
            'professor' => $_POST['professor'],
            'turno' => $_POST['turno']
        ]]
    );
    echo "<div class='alert alert-success mt-3'>✅ O Curso foi atualizado com sucesso!</div>";
}

$conteudo = ob_get_clean();
include 'layout.php';
?>
