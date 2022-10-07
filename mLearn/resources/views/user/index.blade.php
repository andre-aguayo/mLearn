<!DOCTYPE html>
<html>

<head>
    <title>Cadastro de usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-3 mb-3">
        @if (Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif
        @if (Session::get('errors'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('errors') }}</strong>
            </div>
        @endif
        <div class="col-md-12 text-right mb-4">
            <a href="/user/create">
                <button class="btn btn-primary">Cadastrar</button>
            </a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ID EXTERNO</th>
                    <th scope="col">NOME</th>
                    <th scope="col">TELEFONE</th>
                    <th scope="col">NÍVEL DE ACESSO</th>
                    <th scope="col">ALTERAR NIVEL DE ACESSO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <th scope="row">{{ $user->external_id }}</th>
                        <th scope="row">{{ $user->name }}</th>
                        <th scope="row">{{ $user->msisdn }}</th>
                        <th scope="row">{{ $user->access_level }}</th>
                        <th scope="row">
                            @if ($user->access_level == 'pro')
                                <form action="/user/upgrade/{{ $user->external_id }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        UPGRADE
                                    </button>
                                </form>
                            @else
                                <form action="/user/downgrade/{{ $user->external_id }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger">
                                        DOWNGRADE
                                    </button>
                                </form>
                            @endif
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
