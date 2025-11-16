<?php include 'conexao.php'; $titulo = "Cadastro de Estudante"; ob_start(); ?>

<div class="card p-4">
  <h2 class="mb-4">Cadastrar Estudante</h2>
  <form method="POST" class="needs-validation" novalidate>
    <div class="row mb-3">
      <div class="col-md-4">
        <label class="form-label">Nome Completo</label>
        <input type="text" name="nome" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">RG</label>
        <input type="text" name="rg" class="form-control">
      </div>
      <div class="col-md-4">
        <label class="form-label">CPF</label>
        <input type="text" name="cpf" class="form-control" required>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-3">
        <label class="form-label">Data de Nascimento</label>
        <input type="date" name="data_nascimento" class="form-control" required >
      </div>
      <div class="col-md-3">
        <label class="form-label">Telefone 1</label>
        <input type="text" name="telefone1" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Telefone 2</label>
        <input type="text" name="telefone2" class="form-control" required>
      </div>
    </div>

    <h5 class="mt-4">👪 Filiação</h5>
    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Nome da Mãe</label>
        <input type="text" name="mae" class="form-control" required >
      </div>
      <div class="col-md-6">
        <label class="form-label">Nome do Pai</label>
        <input type="text" name="pai" class="form-control" required >
      </div>
    </div>

    <h5 class="mt-4">🏠 Endereço</h5>
    <div class="row mb-3">
      <div class="col-md-3"><input type="text" name="rua" class="form-control" placeholder="Rua" required></div>
      <div class="col-md-2"><input type="text" name="numero" class="form-control" placeholder="Número" required></div>
      <div class="col-md-3"><input type="text" name="bairro" class="form-control" placeholder="Bairro" required></div>
      <div class="col-md-2"><input type="text" name="cidade" class="form-control" placeholder="Cidade" required></div>
      <div class="col-md-2"><input type="text" name="estado" class="form-control" placeholder="Estado" required></div>
    </div>
    <button class="btn btn-success mt-3" name="salvar">💾 Salvar Estudante</button>
    <a href="index.php" class="btn btn-outline-primary mt-3 ms-2">⬅️ Retornar à Página Inicial</a>
  </form>
</div>


<?php
if (isset($_POST['salvar'])) {
    $dados = [
        "nome" => $_POST['nome'],
        "rg" => $_POST['rg'],
        "cpf" => $_POST['cpf'],
        "data_nascimento" => $_POST['data_nascimento'],
        "telefones" => [$_POST['telefone1'], $_POST['telefone2']],
        "filiacao" => ["mae" => $_POST['mae'], "pai" => $_POST['pai']],
        "endereco" => [
            "rua" => $_POST['rua'],
            "numero" => $_POST['numero'],
            "bairro" => $_POST['bairro'],
            "cidade" => $_POST['cidade'],
            "estado" => $_POST['estado']
        ]
    ];
    $colecaoEstudantes->insertOne($dados);
    echo "<div class='alert alert-success mt-3'>✅ Estudante cadastrado com sucesso!</div>";
}
$conteudo = ob_get_clean();
include 'layout.php';
?>
