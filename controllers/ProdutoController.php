<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Produto.php';

$produtoModel = new Produto($conn);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');
    echo json_encode($produtoModel->listar());
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $quantidade = $_POST['quantidade'] ?? 0;
    $preco = $_POST['preco'] ?? 0;
    header('Content-Type: application/json');
    if ($produtoModel->inserir($nome, $quantidade, $preco)) {
        echo json_encode(["sucesso" => true, "mensagem" => "Produto cadastrado com sucesso!"]);
    } else {
        echo json_encode(["erro" => "Erro ao cadastrar produto."]);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'] ?? 0;
    header('Content-Type: application/json');
    if ($produtoModel->excluir($id)) {
        echo json_encode(["sucesso" => true, "mensagem" => "Produto excluído com sucesso!"]);
    } else {
        echo json_encode(["erro" => "Erro ao excluir produto."]);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT['id'] ?? 0;
    $nome = $_PUT['nome'] ?? '';
    $quantidade = $_PUT['quantidade'] ?? 0;
    $preco = $_PUT['preco'] ?? 0;
    header('Content-Type: application/json');
    if ($produtoModel->editar($id, $nome, $quantidade, $preco)) {
        echo json_encode(["sucesso" => true, "mensagem" => "Produto editado com sucesso!"]);
    } else {
        echo json_encode(["erro" => "Erro ao editar produto."]);
    }
}


?>
