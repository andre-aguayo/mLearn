<!DOCTYPE html>
<html>

<head>
    <title>Cadastro de usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-3 mb-3">
        @if ($message = Session::get('errors'))
            <div class="alert alert-danger alert-block">
                <div>
                    <strong>Errro ao cadastrar usuario</strong>
                </div>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>Cadastrado com sucesso!</strong>
            </div>
        @endif

        <h3>Cadastro de usuario</h3>
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label>Telefone</label><small>(Apenas numeros)</small>
                <input type="number" class="form-control" name="msisdn" id="msisdn" min="5500000000000" required>
            </div>

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label>Password</label><small>(Deve conter ao menos 4 digitos)</small>
                <input type="password" class="form-control" name="password" id="password" minlength="4" required>
            </div>

            <div class="form-group">
                <label>Nivel de acesso</label>
                <select class="form-control" name="access_level" id="access_level" required>
                    <option value="">--</option>
                    <option value="pro">pro</option>
                    <option value="premium">premium</option>
                </select>
            </div>

            <input type="submit" name="submit" value="Cadastrar" class="btn btn-dark">

        </form>
    </div>
</body>

</html>
