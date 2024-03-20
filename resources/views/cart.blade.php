@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Carrito</h1>
    @if($plantsInCart->isEmpty())
        <p>No hay plantas en el carrito.</p>
    @else
        <ul>
            @foreach($plantsInCart as $plant)
                <li>{{ $plant->name }} - {{ $plant->unit_price }}€</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
