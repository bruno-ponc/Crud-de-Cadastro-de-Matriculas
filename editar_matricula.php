<?php
include 'conexao.php';
use MongoDB\BSON\ObjectId;

$titulo = "Editar Matrícula";
ob_start();

// Garantir que as coleções existam (compatibilidade com diferentes conexao.php) 
if (!isset($colecaoEstudantes) && isset($banco)) {
    $colecaoEstudantes = $banco->estudantes;
}
if (!isset($colecaoCursos) && isset($banco)) {
    $colecaoCursos = $banco->cursos;
}
if (!isset($colecaoMatriculas) && isset($banco)) {
    $colecaoMatriculas = $banco->matriculas;
}

// Se alguma coleção estiver faltando, interrompe com mensagem
if (!isset($colecaoEstudantes) || !isset($colecaoCursos) || !isset($colecaoMatriculas)) {
    echo "<div class='alert alert-danger'>Erro: coleções do MongoDB não encontradas. Verifique conexao.php.</div>";
    $conteudo = ob_get_clean();
    include 'layout.php';
    exit;
}

// Validar ID recebido
$id = $_GET['id'] ?? '';
if (empty($id)) {
    echo "<div class='alert alert-danger'>ID da matrícula não informado.</div>";
    $conteudo = ob_get_clean();
    include 'layout.php';
    exit;
}

try {
    $matriculaId = new ObjectId($id);
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>ID inválido.</div>";
    $conteudo = ob_get_clean();
    include 'layout.php';
    exit;
}

// Buscar matrícula, estudantes e cursos
$matricula = $colecaoMatriculas->findOne(['_id' => $matriculaId]);
if (!$matricula) {
    echo "<div class='alert alert-danger'>Matrícula não encontrada.</div>";
    $conteudo = ob_get_clean();
    include 'layout.php';
    exit;
}

$estudantes = $colecaoEstudantes->find()->toArray();
$cursos = $colecaoCursos->find()->toArray();

// Processar POST (salvar alterações)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar'])) {
    // validações básicas
    $estudanteSelecionado = $_POST['estudante_id'] ?? '';
    $cursoSelecionado = $_POST['curso_id'] ?? '';

    if (empty($estudanteSelecionado) || empty($cursoSelecionado)) {
        $mensagemErro = "Por favor selecione estudante e curso.";
    } else {
        try {
            $colecaoMatriculas->updateOne(
                ['_id' => $matriculaId],
                ['$set' => [
                    "estudante_id" => new ObjectId($estudanteSelecionado),
                    "curso_id" => new ObjectId($cursoSelecionado)
                ]]
            );
            $mensagemSucesso = "Alterações salvas com sucesso!";
            // atualizar variável local para refletir alterações na UI
            $matricula = $colecaoMatriculas->findOne(['_id' => $matriculaId]);
        } catch (Exception $e) {
            $mensagemErro = "Erro ao salvar: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>

<div class="card p-4">
  <h2 class="mb-4 text-primary">Editar Matrícula</h2>

  <?php if (!empty($mensagemErro)): ?>
    <div class="alert alert-danger"><?= $mensagemErro ?></div>
  <?php endif; ?>

  <?php if (!empty($mensagemSucesso)): ?>
    <div class="alert alert-success"><?= $mensagemSucesso ?></div>
  <?php endif; ?>


  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Estudante</label>
      <select name="estudante_id" class="form-control" required
        oninvalid="this.setCustomValidity('Preencha este campo')" oninput="this.setCustomValidity('')">
        <option value="">-- selecione --</option>
        <?php foreach ($estudantes as $e): ?>
          <option value="<?= (string)$e->_id ?>"
            <?= ((string)$e->_id === (string)($matricula->estudante_id ?? '')) ? 'selected' : '' ?>>
            <?= htmlspecialchars($e->nome ?? '---') ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Curso</label>
      <select name="curso_id" class="form-control" required
        oninvalid="this.setCustomValidity('Preencha este campo')" oninput="this.setCustomValidity('')">
        <option value="">-- selecione --</option>
        <?php foreach ($cursos as $c): ?>
          <option value="<?= (string)$c->_id ?>"
            <?= ((string)$c->_id === (string)($matricula->curso_id ?? '')) ? 'selected' : '' ?>>
            <?= htmlspecialchars($c->nome ?? '---') ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <button name="salvar" class="btn btn-success mt-3">💾 Salvar Alterações</button>
    <a href="lista_matriculas.php" class="btn btn-outline-primary mt-3 ms-2">⬅️ Voltar</a>
  </form>
</div>

<?php
$conteudo = ob_get_clean();
include 'layout.php';
?>
