@extends('layouts.app')

@section('content')
    <h1>Mostrar Persona</h1>

    @if ($persona)
        <div class="card">
            <div class="card-header">
                Detalles de la Persona
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $persona->id }}</p>
                <p><strong>Nombre:</strong> {{ $persona->nombre }}</p>
                <p><strong>Apellido:</strong> {{ $persona->apellido }}</p>
                <p><strong>Teléfono:</strong> {{ $persona->telefono }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('personas.index') }}" class="btn btn-secondary">Volver al Listado</a>
                <a href="{{ route('personas.edit', $persona->id) }}" class="btn btn-warning">Editar</a>
            </div>
        </div>
    @else
        <div class="alert alert-danger">Persona no encontrada.</div>
    @endif
@endsection
