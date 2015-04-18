@extends('layouts.main')

@section('content')

<h1 class="page-header">
  <i class="fa fa-user"></i>
  Perfil de Usuário <small>- {{$loggedUser->name}}</small>
</h1>

@include('partials.alerts')

<table class="table table-bordered table-striped table-hover">
    <tbody>
        <tr>
            <td><strong>Nome</strong></td>
            <td>{{ $loggedUser->name }}</td>
        </tr>
        <tr>
            <td><strong>E-mail</strong></td>
            <td>{{ $loggedUser->email}}</td>
        </tr>
        <tr>
            <td width="200"><strong>Atualização</strong></td>
            <td>{{ $loggedUser->updated_at }}</td>
        </tr>
        <tr>
            <td><strong>Projetos</strong></td>
            <td>00</td>
        </tr>
        <tr>
            <td colspan="2" class="text-right">
                <a href="{!! route('password.index') !!}" class="btn btn-default">
                    <i class="fa fa-lock"></i>
                    Trocar Senha
                </a>
                <a href="{!! route('profile.edit') !!}" class="btn btn-default">
                    <i class="fa fa-pencil"></i>
                    Atualizar os Dados
                </a>
            </td>
        </tr>
    </tbody>
</table>

@stop