@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html>

    <head>
    </head>

    <body>


        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <div class="row mx-5 my-2 p-3 bg-light border rounded-2">
                            <div class="col-4 flex-fill">
                                <div class="product-image-container">
                                    <img class="product-image" src="{{ asset('storage/uploads/' . basename($product->image_url)) }}" alt="{{ $product->name }}">
                                </div>
                            </div>
                            <div class="col-8 flex-fill">
                                <h3>

                                    <a href="{{ route('products.show', ['id' => $product->id]) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <h5>Vendedor: {{ $product->vendor_name }}</h5>
                                <p class="text-wrap">{{ $product->description }}</p>
                                <p>{{ $product->price }} €</p>
                                @auth
                                    
                                
                                @if (Auth::user()->role_id == 1)
                                    @if (Route::has('carrito'))
                                        <form action="{{ route('carrito.addToCart', $product->product_stockId) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                                        </form>
                                    @endif
                                @endif
                                @if (Auth::user()->role_id == 2)
                                    <button type="button" class="btn btn-primary btn-sm open-modal" data-toggle="modal" data-target="#myModal" data-id="{{ $product->id }}">Añadir stock</button>
                                @endif
                                @endauth

                            </div>
                        </div>
                </div>
            </div>
        </div>

    </body>

    </html>
    
@endsection
