@extends('adminlte::page')


@section('content')

<div class="container">
    

    @if(Session::has('mensaje'))
  <div class="alert alert-success alert-dismissible" role="alert">  
    {{ Session::get('mensaje') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>   
</div>    

    @endif

 

<br/>
<a href="{{ url('estudiante/create') }}" class="btn btn-success" >Registrar nuevo estudiante</a>
<br/>
<br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>  
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($estudiantes as $estudiante )
            
        <tr>
            <td>{{ $estudiante->id}}</td>

            <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$estudiante->Foto }}" width="100" alt="">
            </td>

            <td>{{ $estudiante->Nombre}}</td>
            <td>{{ $estudiante->Apellido}}</td>
            <td>{{ $estudiante->Correo}}</td>
            <td> 
                <a href="{{ url('/estudiante/'.$estudiante->id.'/edit') }}" class="btn btn-warning">
                Editar
                    
                </a>
                 
                <form action="{{ url('/estudiante/'.$estudiante->id)}}" class="d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')" 
                    value="Borrar">

                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $estudiantes->links() !!}
</div>
@endsection