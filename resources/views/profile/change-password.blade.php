@extends('layouts.main')

@section('content')

<h1 class="page-header">
  <i class="fa fa-user"></i>
  Editar Usuário <small>- {{$loggedUser->name}}</small>
</h1>

@include('partials.alerts')

{!! Form::open(['url' => route('password.update')]) !!}

<table class="table table-bordered table-striped table-hover">
    <tbody>
        <tr>
            <td><strong>Nome</strong></td>
            <td>
    {!! Form::input('password', 'password', ['id' => 'password', 'class' => 'form-control']) !!}
            </td>
        </tr>
        <tr>
            <td><strong>E-mail</strong></td>
            <td>
                {!! Form::email('email', $loggedUser->email, ['id' => 'email', 'class' => 'form-control']) !!}
            </td>
        </tr>
        <tr>
            <td colspan="2">

                <div class="row">
                    <div class="col-md-6">
                        <a href="{!! route('profile.index') !!}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i>
                            Voltar
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-save"></i>
                            Salvar
                        </button>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>

{!! Form::close() !!}

@stop