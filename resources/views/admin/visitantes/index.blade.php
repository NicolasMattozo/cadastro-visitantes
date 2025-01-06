<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Visitantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center" style="background-color: #873e23; color:white">Cadastro de Visitantes</h1>
        <form action="{{ route('visitante.save') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required>
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" required>
            </div>
            <div class="mb-3">
                <label for="congregacao" class="form-label">Congregação</label>
                <input type="text" class="form-control" id="congregacao" name="congregacao" required>
            </div>
            <div class="mb-3">
                <label for="setor" class="form-label">Setor</label>
                <input type="text" class="form-control" id="setor" name="setor" required>
            </div>
            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea class="form-control" id="observacoes" name="observacoes" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Visitante</button>
        </form>
        <a href="{{ route('visitante.exportExcel') }}" class="btn btn-success mt-3">Exportar para Excel</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
