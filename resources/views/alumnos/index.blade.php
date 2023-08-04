@extends('layout/template')

@section('title', 'Alumnos | Escuela')

@section('contenido')
<main>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6"> <!-- Acomodamos el buscador de alumnos a la izquierda -->
                <h2>Buscar Alumno</h2>
                <form action="{{ route('alumnos.index') }}" method="GET">
                    <div class="form-row">
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="texto" value="{{$texto}}">
                        </div>
                        <div class="col-auto">
                            <input type="submit" class="btn btn-primary" value="Buscar">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right"> <!-- Acomodamos el botón de registro a la derecha -->
                <h2>Listado de Alumnos</h2>
                <a href="alumnos/create" class="btn btn-primary btn-sm">Nuevo Registro</a>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Fecha Nacimiento</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Nivel</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->id }}</td>
                    <td>{{ $alumno->matricula }}</td>
                    <td>{{ $alumno->nombre }}</td>
                    <td>{{ $alumno->fecha_nacimiento }}</td>
                    <td>{{ $alumno->telefono }}</td>
                    <td>{{ $alumno->email }}</td>
                    <td>{{ $alumno->nivel->nombre }}</td>
                    <td><a href="{{url('alumnos/'.$alumno->id.'/edit')}}" class="btn btn-warning bt-sm">Editar</a></td>
                    <td>
                        <form action="{{url('alumnos/'.$alumno->id)}}" method="POST">
                            @method("DELETE")
                            @csrf <!-- ESTO SE AGREGA EN TODOS LOS FORMULARIOS PARA QUE GENERE UN TOKEN DE SEGURIDAD  -->
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar Este Registro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Otro contenido de la vista -->
    <!-- Asegúrate de incluir Axios en tu página (puede ser mediante CDN o instalación) -->


<!-- Agrega tu botón con el evento onclick -->
<button class="btn btn-primary" id="btnHola">Realizar petición</button>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Definir la función hacerPeticion antes de asignarla al evento onclick
    function hacerPeticion() {
        axios.get('boton')
            .then(response => {
                console.log(response.data);
            })
            .catch(error => {
                console.error('Error al hacer la solicitud:', error);
            });
    }

    // Asignar la función al evento onclick del botón
    document.getElementById('btnHola').onclick = hacerPeticion;
</script> 

    </div>
</main>
@endsection



