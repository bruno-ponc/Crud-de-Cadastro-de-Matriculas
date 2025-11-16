<?php include 'conexao.php'; $titulo = "Cadastrar Curso"; ob_start(); ?>

<div class="card p-4">
  <h2 class="text-primary mb-4">Cadastrar Curso</h2>
  <form method="POST">
    <div class="row mb-3">
      <div class="col-md-4"><label class="form-label">Nome</label><input name="nome" class="form-control" required></div>
      <div class="col-md-3"><label class="form-label">Código</label><input name="codigo" class="form-control" required></div>
      <div class="col-md-2"><label class="form-label">Duração (meses)</label><input type="number" name="duracao" class="form-control"></div>
      <div class="col-md-3"><label class="form-label">Professor</label><input name="professor" class="form-control"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4">
        <label class="form-label">Turno</label>
        <select name="turno" class="form-control">
          <option>Matutino</option>
          <option>Vespertino</option>
          <option>Noturno</option>
        </select>
      </div>
    </div>
    <button name="salvar" class="btn btn-success mt-3">💾 Salvar Curso</button>
    <a href="index.php" class="btn btn-outline-primary mt-3 ms-2">⬅️ Retornar à Página Inicial</a>
  </form>


</div>

<?php
if (isset($_POST['salvar'])) {
    $colecaoCursos->insertOne([
        "nome" => $_POST['nome'],
        "codigo" => $_POST['codigo'],
        "duracao" => $_POST['duracao'],
        "professor" => $_POST['professor'],
        "turno" => $_POST['turno']
    ]);
    echo "<div class='alert alert-success mt-3'>✅ Curso cadastrado com sucesso!</div>";
}
$conteudo = ob_get_clean();
include 'layout.php';
?>
