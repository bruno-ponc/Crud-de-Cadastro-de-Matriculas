<?php
$titulo = "Início - Sistema Escolar";
ob_start();
?>

<div class="text-center py-5">
  <h1 class="fw-bold text-primary">Bem-vindo ao Sistema Escolar</h1>
  <p class="lead text-muted">Gerencie estudantes, cursos e matrículas com facilidade.</p>

  <div class="row mt-5">
    <div class="col-md-4 mb-3">
      <div class="card p-4 text-center">
        <h5>👩‍🎓 Estudantes</h5>
        <p>Cadastre os dados dos estudantes.</p>
        <a href="cadastrar_estudante.php" class="btn btn-primary">Cadastrar</a>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-4 text-center">
        <h5>🎓 Cursos</h5>
        <p>Gerencie os cursos oferecidos pela instituição.</p>
        <a href="cadastrar_curso.php" class="btn btn-primary">Cadastrar</a>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-4 text-center">
        <h5>🧾 Matrículas</h5>
        <p>Matricule estudantes em seus cursos.</p>
        <a href="matricular.php" class="btn btn-primary">Matricular</a>
      </div>
    </div>
  </div>
</div>

<?php
$conteudo = ob_get_clean();
include 'layout.php';
?>
