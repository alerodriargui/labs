@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2>Detalles del pedido</h2>
        @foreach($plantsInCart as $plant)
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $plant->name }}</h5>
                            <p class="card-text">Precio unitario: {{ $plant->unit_price }}€</p>
                            <!-- Si deseas incluir la cantidad de cada unidad en el carrito, asegúrate de tener ese dato disponible -->
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sección para introducir los datos de entrega -->
    <div>
        <h2>Datos de entrega</h2>
        <form method="POST" action="{{ route('realizar-pedido') }}">
            @csrf
            <!-- Campo para introducir el nombre del cliente -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <!-- Mostrar el nombre del usuario autenticado -->
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ auth()->user()->name }}" readonly>
            </div>
            <!-- Campo para introducir la dirección de entrega -->
            <div class="form-group">
                <label for="direccion">Dirección de entrega:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <!-- Botón para realizar el pedido -->
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Realizar Pedido</button>
            </div>
        </form>
    </div>
</div>
@endsection
