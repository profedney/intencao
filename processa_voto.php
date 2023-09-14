<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    $candidato = $data->candidato;

    // Conectar ao banco de dados (substitua pelos seus dados de conexão)
    $conn = new mysqli("localhost", "intencao_de_voto", "123", "intencao_de_voto");

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $sql = "INSERT INTO votos (candidato, data_voto) VALUES ('$candidato', NOW())";

    if ($conn->query($sql) === TRUE) {
        $response = ["success" => true];
    } else {
        $response = ["success" => false];
    }

    $conn->close();

    echo json_encode($response);
} else {
    http_response_code(405); // Método não permitido
    echo json_encode(["error" => "Método não permitido"]);
}
?>
