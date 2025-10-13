<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "concept_site";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'] ?? '';
$servico = $_POST['servico'];
$mensagem = $_POST['mensagem'];

$sql = "INSERT INTO CLIENTES (NOME, EMAIL, TELEFONE, SENHA)
        VALUES ('$nome', '$email', '$telefone', 'site')
        ON DUPLICATE KEY UPDATE NOME='$nome', TELEFONE='$telefone'";
$conn->query($sql);

$cliente_id = $conn->insert_id ?: $conn->query("SELECT ID FROM CLIENTES WHERE EMAIL='$email'")->fetch_assoc()['ID'];

$mensagem_completa = "Serviço: $servico\nMensagem: $mensagem";

$sql = "INSERT INTO MENSAGENS (CLIENTE_ID, MENSAGEM)
        VALUES ('$cliente_id', '$mensagem_completa')";
$conn->query($sql);

echo "Mensagem enviada com sucesso!";
$conn->close();
?>
