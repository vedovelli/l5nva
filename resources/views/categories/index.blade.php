@extends('layouts.main')

@section('content')

<h1 class="page-header">
  <i class="fa fa-list"></i>
  Categorias
</h1>

@include('partials.alerts')

 <div class="row">
  <div class="col-md-6">
    <div class="well">
      <form action="{!! route('category.index') !!}">
        <input type="text" class="form-control" name="search" value="{!! $search !!}" placeholder="Digite o termo e pressione enter">
      </form>
    </div>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Categoria</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td width="1%" nowrap>{!! $category->id !!}</td>
          <td>{!! $category->name !!}</td>
          <td width="1%" nowrap>
            <a class="btn btn-xs btn-primary" href="{!! route('category.edit', ['id' => $category->id]) !!}">editar</a>
            <a class="btn btn-xs btn-danger" href="{!! route('category.destroy', ['id' => $category->id]) !!}">excluir</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="row">
      <div class="col-md-12 text-center">
        {!! $categories->render() !!}
      </div>
    </div>

  </div>
  <div class="col-md-6">

    @if($loadedCategory != null)
    <form action="{!! route('category.update',['id' => $loadedCategory->id]) !!}" method="post">
    @else
    <form action="{!! route('category.store') !!}" method="post">
    @endif

      <input type="hidden" name="_token" value="{!! csrf_token() !!}">

      <div class="form-group">
        <label for="name" class="control-label">Categoria</label>
        <input class="form-control" type="text" name="name" value="{!! $loadedCategory != null ? $loadedCategory->name : old('name') !!}" id="name" autofocus>
      </div>

      <div class="row">
        <div class="col-md-12 text-right">
          <button class="btn btn-success">Salvar</button>
        </div>
      </div>

    </form>
  </div>
</div>




@stop