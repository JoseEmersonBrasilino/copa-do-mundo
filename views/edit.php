<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar</title>
</head>
<body>
    <h2>editar seleção</h2>

    <form method="POST" action="index.php?action=atualizar"> 
        <input type="hidden" name="id" value="<?= $selecao['id']?>">
        <p>
            nome: <input type="text" name="nome" value="<?= safe($selecao['nome'])?>" required>
        </p>  
        <p> 
            grupo: <input type="text" name="grupo" value="<?= safe($selecao['email'])?>" required>
        </p>  
        <p>  
            títulos: <input type="text" name="titulos" value="<?= safe($selecao['matricula'])?>" required>
        </p>
        títulos: <input type="text" name="criado_em" value="<?= safe($selecao['número'])?>" required>
        </p>

        <button type="submit"> salvar alterações </button>
    </form>
</body>
</html>