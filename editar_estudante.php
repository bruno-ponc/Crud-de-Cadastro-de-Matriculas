<?php
include 'conexao.php';
use MongoDB\BSON\ObjectId;

$titulo = "Editar Estudante";
ob_start();

// buscar o estudante pelo id
$id = $_GET['id'] ?? '';
$estudante = $colecaoEstudantes->findOne(['_id' => new ObjectId($id)]);

if (!$estudante) {
    echo "<div class='alert alert-danger'>Estudante não encontrado.</div>";
} else {
?>
<div class="card p-4">
  <h2 class="mb-4 text-primary">Editar Estudante</h2>
  <form method="POST">
    <div class="row mb-3">
      <div class="col-md-4"><label class="form-label">Nome</label><input name="nome" value="<?= $estudante->nome ?>" class="form-control"></div>
      <div class="col-md-4"><label class="form-label">RG</label><input name="rg" value="<?= $estudante->rg ?>" class="form-control"></div>
      <div class="col-md-4"><label class="form-label">CPF</label><input name="cpf" value="<?= $estudante->cpf ?>" class="form-control"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-3"><label class="form-label">Nascimento</label><input type="date" name="data_nascimento" value="<?= $estudante->data_nascimento ?>" class="form-control"></div>
      <div class="col-md-3"><label class="form-label">Telefone 1</label><input name="telefone1" value="<?= $estudante->telefones[0] ?? '' ?>" class="form-control"></div>
      <div class="col-md-3"><label class="form-label">Telefone 2</label><input name="telefone2" value="<?= $estudante->telefones[1] ?? '' ?>" class="form-control"></div>
    </div>
    <h5>🧑🏽‍👩🏽‍🧒🏽 Filiação</h5>
    <div class="row mb-3">
      <div class="col-md-6"><input name="mae" value="<?= $estudante->filiacao['mae'] ?? '' ?>" class="form-control" placeholder="Nome da Mãe"></div>
      <div class="col-md-6"><input name="pai" value="<?= $estudante->filiacao['pai'] ?? '' ?>" class="form-control" placeholder="Nome do Pai"></div>
    </div>
    <h5>🏠 Endereço</h5>
    <div class="row mb-3">
      <div class="col-md-3"><input name="rua" value="<?= $estudante->endereco['rua'] ?? '' ?>" class="form-control" placeholder="Rua"></div>
      <div class="col-md-2"><input name="numero" value="<?= $estudante->endereco['numero'] ?? '' ?>" class="form-control" placeholder="Número"></div>
      <div class="col-md-3"><input name="bairro" value="<?= $estudante->endereco['bairro'] ?? '' ?>" class="form-control" placeholder="Bairro"></div>
      <div class="col-md-2"><input name="cidade" value="<?= $estudante->endereco['cidade'] ?? '' ?>" class="form-control" placeholder="Cidade"></div>
      <div class="col-md-2"><input name="estado" value="<?= $estudante->endereco['estado'] ?? '' ?>" class="form-control" placeholder="Estado"></div>
    </div>
    <button name="salvar" class="btn btn-success mt-3">💾 Salvar Alterações</button>
    <a href="listar_estudantes.php" class="btn btn-outline-primary mt-3 ms-2">⬅️ Voltar</a>
  </form>
</div>
<?php
}

if (isset($_POST['salvar'])) {
    $colecaoEstudantes->updateOne(
        ['_id' => new ObjectId($id)],
        ['$set' => [
            'nome' => $_POST['nome'],
            'rg' => $_POST['rg'],
            'cpf' => $_POST['cpf'],
            'data_nascimento' => $_POST['data_nascimento'],
            'telefones' => [$_POST['telefone1'], $_POST['telefone2']],
            'filiacao' => ['mae' => $_POST['mae'], 'pai' => $_POST['pai']],
            'endereco' => [
                'rua' => $_POST['rua'],
                'numero' => $_POST['numero'],
                'bairro' => $_POST['bairro'],
                'cidade' => $_POST['cidade'],
                'estado' => $_POST['estado']
            ]
        ]]
    );
    echo "<div class='alert alert-success mt-3'>✅ O Estudante foi atualizado com sucesso!</div>";
}

$conteudo = ob_get_clean();
include 'layout.php';
?>
