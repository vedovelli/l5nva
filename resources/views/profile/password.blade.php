@extends('layouts.main')

@section('content')

<h1 class="page-header">
  <i class="fa fa-lock"></i>
  Trocar Senha
</h1>

@include('partials.alerts')

{!! Form::open(['url' => route('password.update')]) !!}

<table class="table table-bordered table-striped table-hover">
    <tbody>
        <tr>
            <td><strong>Senha</strong></td>
            <td>
    {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}
            </td>
        </tr>
        <tr>
            <td><strong>Confirmar Senha</strong></td>
            <td>
    {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control']) !!}
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-right">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-save"></i>
                    Salvar
                </button>
            </td>
        </tr>
    </tbody>
</table>

{!! Form::close() !!}

@stop