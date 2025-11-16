<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?= $titulo ?? 'Sistema Escolar' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8fafc;
    }
    .navbar {
      background: linear-gradient(90deg, #0d6efd, #1e40af);
    }
    .navbar-brand, .nav-link, .navbar-nav .nav-link.active {
      color: #fff !important;
      font-weight: 500;
    }
    .card {
      border: none;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      border-radius: 1rem;
    }
    footer {
      background: #0d6efd;
      color: white;
      text-align: center;
      padding: 10px;
      margin-top: 30px;
      border-radius: 0.5rem;
    }
    .btn-outline-primary {
  border-radius: 30px;
  font-weight: 500;
  transition: all 0.2s ease-in-out;
    }
    .btn-outline-primary:hover {
      background-color: #0d6efd;
      color: white;
    }

  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">📚 Sistema Escolar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="listar_estudantes.php">Listar Estudantes</a></li>
          <li class="nav-item"><a class="nav-link">|</a></li>
          <li class="nav-item"><a class="nav-link" href="listar_cursos.php">Listar Cursos</a></li>
          <li class="nav-item"><a class="nav-link">|</a></li>
          <li class="nav-item"><a class="nav-link" href="lista_matriculas.php">Relação Matrículas</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo -->
  <main class="container my-4">
    <?= $conteudo ?? '' ?>
  </main>

  <footer>
    <p>© <?= date('Y') ?> Sistemas de Informação | Desenvolvimento de Aplicações para WEB </p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

