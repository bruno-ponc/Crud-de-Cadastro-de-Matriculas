<?php
require 'vendor/autoload.php';

try {
    $cliente = new MongoDB\Client("mongodb://localhost:27017");
    $banco = $cliente->escola;
    $colecaoEstudantes = $banco->estudantes;
    $colecaoCursos = $banco->cursos;
    $colecaoMatriculas = $banco->matriculas;
} catch (Exception $e) {
    die("<div class='alert alert-danger'>Erro de conexão com MongoDB: " . $e->getMessage() . "</div>");
}
?>
