@extends('layouts.app')

@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100"><!--justify-content: aliniar con el eje pricipal-->
            <div class="row col-lg-12 justify-content-evenly" style="height: 80vh;"> <!-- 80% de la altura de la página -->
                <div class="card d-flex col-md-8 h-100 "> <!-- 70% de la anchura -->
                    <div class="card-header">{{ $plant->name }}</div>

                    <div class="card-body d-flex justify-content-between">

                        <div class="col-md-5 mx-auto">
                            @if ($plant->img_path)
                                <img src="{{ asset('storage/' . $plant->img_path) }}" alt="{{ $plant->name }}"
                                    class="img-fluid">
                            @else
                                <img src="{{ asset('storage/default-image.jpg') }}" alt="Imagen por defecto"
                                    class="img-fluid">
                            @endif
                        </div>
                        <div class="align-items-evenly">
                            <p style="font-family: Arial, sans-serif; font-size: 20px;"><strong>Precio:</strong>
                                ${{ $plant->unit_price }}</p>
                            <p><strong>Descripción:</strong> {{ $plant->description }}</p>
                            <p><strong>Estacion</strong> {{ $plant->season }}</p>

                            <!-- Puedes mostrar otros detalles del producto aquí -->
                            @auth
                                <form action="{{ route('add-to-cart', $plant->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                                </form>
                            @else
                                <p><a href="{{ route('login') }}">Inicia sesión</a> para agregar este producto al carrito.</p>
                            @endauth
                        </div>

                    </div>
                </div>
                <div class="row d-flex col-md-2 h-100 align-items-evenly" style> <!-- 30% de la anchura -->
                    <div class="card d-flex col-md-12 30vh">
                        

                    </div>
                    <div class="card d-flex col-md-12">
                        

                    </div>
                    <div class="card d-flex col-md-12">
                        

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
