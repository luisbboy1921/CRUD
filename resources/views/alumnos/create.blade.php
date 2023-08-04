@extends('layout/template')

@section('title', 'Registrar Alumno | Escuela')

@section('contenido')

<main>
    <div class="container py-4">
        <h2>Registrar Alumnos</h2>

        @if ($errors->any()) <!-- Todo esto se  mete en un if -->
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error) <!--  Este foreach se muestra un lista de errores cuando el formulario no es contestado
                con las validaciones que se le asignaron -->

                <li>{{$error}}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <form action="{{url('alumnos/')}}" method="post">
            @csrf

            <div class="md-3 row">
                <label for="matricula" class="col-sm-2 col-form-label">Matricula</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="matricula" id="matricula" value="{{old('matricula')}}" required>

                </div>

            </div>

            
            <div class="md-3 row">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre Completo</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{old('nombre')}}" required>

                </div>

                
            <div class="md-3 row">
                <label for="fecha" class="col-sm-2 col-form-label">Fecha De Nacimiento</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" name="fecha" id="fecha" value="{{old('fecha')}}" required>

                </div>
                
            <div class="md-3 row">
                <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="telefono" id="telefono" value="{{old('telefono')}}" required>

                </div>
                
            <div class="md-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}">

                </div>

                
            <div class="md-3 row">
                <label for="nivel" class="col-sm-2 col-form-label">Nivel :</label>
                <div class="col-sm-5">
                    
                    <select name="nivel" id="nivel" class="form-select" required>
                        <option value="0">---Escojer Un Nivel----</option>

                        @foreach ($niveles as $nivel) <!--  Esta línea inicia un bucle foreach que recorre la variable $niveles en cada iteracion asigna el valor actual
                        a la variable $nivel -->
                        <option value="{{$nivel->id}}">{{ $nivel->nombre}}</option> <!--  El atributo value del elemento <option> se establece con el valor del campo 
                            id del objeto $nivel. Esto define el valor que se enviará al formulario cuando se seleccione esta opción. -->

                        @endforeach
                            
                    </select>

                    <a href="{{url('alumnos')}}" class="btn btn-secondary">Regresar</a>

                    <button type="submit" class="btn btn-success">Guardar</button>
 
                </div>
        </form>
    </div>
</main>