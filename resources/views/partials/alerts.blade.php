{{-- Quando for sucesso --}}
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
  {!! Session::get('success') !!}
</div>
@endif

{{-- Quando for sucesso --}}
@if(Session::has('message'))
<div class="alert alert-success" role="alert">
  {!! Session::get('message') !!}
</div>
@endif

{{-- Quando vier do Validator --}}
@if(Session::has('errors'))
<div class="alert alert-danger" role="alert">
    <ul>
  @foreach($errors->all() as $error)
    <li>{!! $error !!}</li>
  @endforeach
  </ul>
</div>
@endif

{{-- Quando for erro isolado --}}
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
  {!! Session::get('error') !!}
</div>
@endif