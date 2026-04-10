<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro de seleção</title>
</head>
<body>
    <h1>nova seleção</h1>
    <form method="POST" action="index.php?acao=salvar">
        <p>
            <label>nome:</label><br>
            <input type="text" name="nome" required>
        </p>
        <p>
            <label>grupo:</label><br>
            <input type="text" name="grupo" required>
        </p>
        <p>
            <label>titulos:</label><br>
            <input type="text" name="títulos" required>
        </p>
        <p>
            <label>cadastrado em:</label><br>
            <input type="text" name="cadastrado_em" required>
        </p>

        <button type="submit">salvar seleção</button>
        <a href="index.php">voltar para a lista</a>
    </form>
</body>
</html>
