@extends('adminlte::page')


@section('content')


<div class="container">
<form action="{{ url('/estudiante/'.$estudiante->id) }}" method="post" enctype="multipart/form-data">   
@csrf

{{method_field('PATCH')}}

@include('estudiante.form',['modo'=>'Editar']);

</form>
</div>
@endsection


