@extends('layouts.main')

@section('entity', 'Home')

@section('content')

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div id="app" class="jumbotron">
      <div class="container">
        <h1 class="display-5">Usuários!</h1>
        
        <button type="button" class="btn btn-primary" v-on:click="nameBox = 'list'">List</button>
        <button type="button" class="btn btn-primary" v-on:click="nameBox = 'form'">Create</button>

        <form v-if="box('form')">
          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="Entre com o nome" v-model="usuario.nome">
          </div>
          <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" placeholder="Entre com o login" v-model="usuario.login">
          </div>
          <div class="form-group">
            <label for="senha">Password</label>
            <input type="password" class="form-control" id="senha" placeholder="Entre com a senha" v-model="usuario.senha">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Entre com o email" v-model="usuario.email">
          </div>
          <div class="form-group">
            <label for="permissao">Permissão</label>
            <select class="form-control" id="permissao" v-model="usuario.permissao">
              <option>Escrita</option>
              <option>Leitura</option>
            </select>
          </div>
          <button type="button" class="btn btn-success" v-on:click="createOrUpdate(); nameBox='list'">Save</button>
        </form>

        <table v-if="box('list')" class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>Login</th>
              <th>Email</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="usuario in usuarios">
              <th scope="row">@{{ usuario.id }}</th>
              <td>@{{ usuario.nome }}</td>
              <td>@{{ usuario.login }}</td>
              <td>@{{ usuario.email }}</td>
              <td><a href="#" v-on:click="select(usuario); nameBox='form'">Editar</a> | <a href="#" v-on:click="destroy(usuario)">Deletar</a></td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>


 <script src="/js/usuarios.js"></script>

@endsection