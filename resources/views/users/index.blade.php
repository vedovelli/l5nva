@extends('layouts.main')

@section('content')

<h1 class="page-header">
  <i class="fa fa-users"></i>
  Usuários
</h1>

@include('partials.alerts')

 <div class="row">
  <div class="col-md-6">
    <div class="well">
      <form action="{!! route('user.index') !!}">
        <input type="text" class="form-control" name="search" value="{!! $search !!}" placeholder="Digite o termo e pressione enter">
      </form>
    </div>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Usuário</th>
          <th>E-mail</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td width="1%" nowrap>{!! $user->id !!}</td>
          <td>{!! $user->name !!}</td>
          <td>{!! $user->email !!}</td>
          <td width="1%" nowrap>
            <a class="btn btn-xs btn-primary" href="{!! route('user.edit', ['id' => $user->id]) !!}">editar</a>
            <a class="btn btn-xs btn-danger" href="{!! route('user.destroy', ['id' => $user->id]) !!}">excluir</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="row">
      <div class="col-md-12 text-center">
        {!! $users->render() !!}
      </div>
    </div>

  </div>
  <div class="col-md-6">

    @if($loadedUser != null)
    <form action="{!! route('user.update',['id' => $loadedUser->id]) !!}" method="post" id="user-form">
    @else
    <form action="{!! route('user.store') !!}" method="post" id="user-form">
    @endif

      <input type="hidden" name="_token" value="{!! csrf_token() !!}">

      <div class="form-group">
        {!! $datepicker(['name' => 'dataUsuarios', 'id' => 'usuarios_data', 'value' => '18/11/1988']) !!}
      </div>

      <div class="form-group">
        <label for="name" class="control-label">Nome</label>
        <input class="form-control" type="text" name="name" value="{!! $loadedUser != null ? $loadedUser->name : old('name') !!}" id="name" autofocus>
      </div>

      <div class="form-group">
        <label for="name" class="control-label">E-mail</label>
        <input class="form-control" type="text" name="email" value="{!! $loadedUser != null ? $loadedUser->email : old('email') !!}" id="email">
      </div>

      <div class="form-group">
        <label for="senha" class="control-label">Senha</label>
        <input class="form-control" type="password" name="password" id="password">
      </div>

      <div class="form-group">
        <label for="senha" class="control-label">Confirmar Senha</label>
        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
      </div>

      <div class="row">
        <div class="col-md-12 text-right">
          <button class="btn btn-success dave-btn-salvar" data-loading-text="Salvando...">
            <i class="fa fa-save"></i>
            Salvar
          </button>
        </div>
      </div>

    </form>
  </div>
</div>




@stop