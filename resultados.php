<?php
// Conectar ao banco de dados (substitua pelos seus dados de conexão)
$conn = new mysqli("localhost", "intencao_de_voto", "123", "intencao_de_voto");

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para somar os votos por candidato
$sql = "SELECT candidato, COUNT(*) as total_votos FROM votos GROUP BY candidato";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $resultados = [];
    while ($row = $result->fetch_assoc()) {
        $resultados[] = $row;
    }
} else {
    $resultados = [];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultados da Pesquisa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="text-center">
        <header>
            <h1>Resultados da Pesquisa</h1>
        </header>
        <main>
            <!-- Seu conteúdo aqui -->
            <table>
            <thead>
                <tr>
                    <th>Candidato</th>
                    <th>Total de Votos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $resultado): ?>
                    <tr>
                        <td><?= $resultado["candidato"] ?></td>
                        <td><?= $resultado["total_votos"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </main>
        <footer>
            <p>&copy; 2023 Resultados da Pesquisa de Intenção de Voto</p>
        </footer>
    </div>
</body>
</html>
