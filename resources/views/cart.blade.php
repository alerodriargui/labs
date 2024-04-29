@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tu Carrito</h1>
    @if($plantsInCart->isEmpty())
        <div class="alert alert-info" role="alert">
            No hay plantas en tu carrito.
        </div>
    @else
    <div class="row">
        <div class="col-md-6">
            <h3>Precio total: {{ $totalPrice }}€</h3>
        </div>
    </div>
    <div class="row">
        @foreach($plantsInCart as $plant)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">{{ $plant->name }}</h5>
                            <form method="POST" action="{{ route('remove-from-cart', ['id' => $plant->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Quitar del carrito</button>
                            </form>
                        </div>
                        <p class="card-text">Precio unitario: {{ $plant->unit_price }}€</p>
                        <p class="card-text">Cantidad en carrito: {{ $cartItems[$plant->id] }}</p>
                        <p class="card-text">Precio total: {{ $plant->unit_price * $cartItems[$plant->id] }}€</p>
                        <img src="{{ $plant->img_path }}" class="img-fluid rounded" alt="{{ $plant->name }}" style="max-width: 330px; max-height: 330px;">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-6">
            <form method="GET" action="{{ route('formulario-pedido') }}">
                @csrf
                <button type="submit" class="btn btn-primary">Realizar pedido</button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
