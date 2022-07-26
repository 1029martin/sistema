
<h1>{{$modo}} estudiante</h1>

@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
<ul>    
    @foreach($errors->all() as $error)
<li> {{$error}} </li>
     @endforeach
</ul>
</div>


@endif

<div class="form-group">

<label for="Nombre">Nombre</label>
<input type="text" class="form-control" name="Nombre" 
value="{{ isset($estudiante->Nombre)?$estudiante->Nombre:old('Nombre') }}" id="Nombre">
</div>

<div class="form-group">
<label for="Apellido">Apellido</label>
<input type="text" class="form-control" name="Apellido" 
value="{{ isset($estudiante->Apellido)?$estudiante->Apellido:old('Apellido') }}"  id="Apellido">
</div>

<div class="form-group">
<label for="Correo">Correo</label>
<input type="text" class="form-control" name="Correo" 
value="{{ isset($estudiante->Correo)?$estudiante->Correo:old('Correo') }}"  id="Correo">
</div>

<div class="form-group">
<label for="Foto"></label>
@if(isset($estudiante->Foto))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$estudiante->Foto }}"  width="100" alt="">
@endif
<input type="file" class="form-control" name="Foto" value=""  id="Foto">
</div>


<input class="btn btn-success" type="submit" value="{{$modo}} datos">

<a class="btn btn-primary" href="{{ url('estudiante/') }}">Regresar</a>
<br>