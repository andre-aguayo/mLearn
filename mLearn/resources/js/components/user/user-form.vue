<template>
    <div class="container mt-3 mb-3">
        <div class="alert alert-danger alert-block">
            <div>
                <strong>Erro ao cadastrar usuario</strong>
            </div>
        </div>
        <h3>Cadastro de usuario</h3>
        <form @submit="handleSubmitForm">
            <div class="form-group">
                <label>Telefone</label><small>(Apenas numeros)</small>
                <input type="number" class="form-control" name="msisdn" id="msisdn" min="5500000000000" required
                    model="msisdn">
            </div>

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="name" id="name" required model="name">
            </div>

            <div class="form-group">
                <label>Password</label><small>(Deve conter ao menos 4 digitos)</small>
                <input type="password" class="form-control" name="password" id="password" minlength="4" required
                    model="password">
            </div>

            <div class="form-group">
                <label>Nivel de acesso</label>
                <select class="form-control" name="access_level" id="access_level" required model="access_level">
                    <option value="">--</option>
                    <option value="pro">pro</option>
                    <option value="premium">premium</option>
                </select>
            </div>
            <input type="submit" name="submit" value="Cadastrar" class="btn btn-dark">
        </form>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data: {
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        msisdn: "",
        name: "",
        password: "",
        access_level: "",
    },
    methods: {
        async handleSubmitForm() {
            e.preventDefault();

            response = await axios.post('/api/user/store');
            if (response.success) {
                this.messageSuccess = 'Cadastrado com sucesso.';
            } else {
                this.messageSuccess = 'Nao foi possivel cadastrar o usuário.';
            }
        }
    }
}
</script>
