<?php include 'conexao.php'; $titulo = "Matrícula"; ob_start(); ?>

<div class="card p-4">
  <h2 class="text-primary mb-4">Realizar Matrícula</h2>
  <form method="POST">
    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Estudante</label>
        <select name="estudante_id" class="form-select" required>
          <option value="" selected disabled>Selecione um estudante</option>
          <?php foreach ($colecaoEstudantes->find() as $e) echo "<option value='{$e->_id}'>{$e->nome}</option>"; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Curso</label>
        <select name="curso_id" class="form-select" required>
          <option value="" selected disabled>Selecione um curso</option>
          <?php foreach ($colecaoCursos->find() as $c) echo "<option value='{$c->_id}'>{$c->nome}</option>"; ?>
        </select>
      </div>
    </div>
    <button name="matricular" class="btn btn-success mt-3">💾 Matricular</button>
    <a href="index.php" class="btn btn-outline-primary mt-3 ms-2">⬅️ Retornar à Página Inicial</a>
  </form>


</div>

<?php
if (isset($_POST['matricular'])) {
    $colecaoMatriculas->insertOne([
        "estudante_id" => new MongoDB\BSON\ObjectId($_POST['estudante_id']),
        "curso_id" => new MongoDB\BSON\ObjectId($_POST['curso_id']),
        "data" => date("Y-m-d")
    ]);
    echo "<div class='alert alert-success mt-3'>✅ Matrícula realizada com sucesso!</div>";
}
$conteudo = ob_get_clean();
include 'layout.php';
?>
