@extends('layouts.app')

@section('content')
    <h1>Listado de Personas</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('personas.create') }}" class="btn btn-primary">Crear Persona</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($personas as $persona)
                <tr>
                    <td>{{ $persona->id }}</td>
                    <td>{{ $persona->nombre }}</td>
                    <td>{{ $persona->apellido }}</td>
                    <td>{{ $persona->telefono }}</td>
                    <td>
                        <a href="{{ route('personas.show', $persona->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('personas.edit', $persona->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
